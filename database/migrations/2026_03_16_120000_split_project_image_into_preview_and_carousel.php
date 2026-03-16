<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SplitProjectImageIntoPreviewAndCarousel extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('projects')) {
            return;
        }

        Schema::table('projects', function (Blueprint $table) {
            if (! Schema::hasColumn('projects', 'preview_image')) {
                $table->string('preview_image')->nullable()->after('description');
            }

            if (! Schema::hasColumn('projects', 'carousel_images')) {
                $table->json('carousel_images')->nullable()->after('preview_image');
            }
        });

        if (Schema::hasColumn('projects', 'image')) {
            DB::table('projects')
                ->select('id', 'image')
                ->orderBy('id')
                ->chunkById(100, function ($projects): void {
                    foreach ($projects as $project) {
                        if ($project->image === null) {
                            continue;
                        }

                        DB::table('projects')
                            ->where('id', $project->id)
                            ->update([
                                'preview_image' => $project->image,
                                'carousel_images' => json_encode([$project->image]),
                            ]);
                    }
                });

            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('projects')) {
            return;
        }

        Schema::table('projects', function (Blueprint $table) {
            if (! Schema::hasColumn('projects', 'image')) {
                $table->string('image')->nullable()->after('description');
            }
        });

        DB::table('projects')
            ->select('id', 'preview_image', 'carousel_images')
            ->orderBy('id')
            ->chunkById(100, function ($projects): void {
                foreach ($projects as $project) {
                    $image = $project->preview_image;

                    if (is_string($project->carousel_images)) {
                        $carouselImages = json_decode($project->carousel_images, true);

                        if (is_array($carouselImages) && isset($carouselImages[0]) && is_string($carouselImages[0])) {
                            $image = $carouselImages[0];
                        }
                    }

                    DB::table('projects')
                        ->where('id', $project->id)
                        ->update(['image' => $image]);
                }
            });

        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'carousel_images')) {
                $table->dropColumn('carousel_images');
            }

            if (Schema::hasColumn('projects', 'preview_image')) {
                $table->dropColumn('preview_image');
            }
        });
    }
}
