<?php

namespace App\Services;


use App\Models\LandingPage;
use App\Models\Showcase;
use App\ValueObjects\LandingPageParams;
use Illuminate\Support\Str;

class LandingPageGenerator
{

    /**
     * @var \Illuminate\Support\Collection
     */
    private $skills;
    /**
     * @var \Illuminate\Support\Collection
     */
    private $locations;
    /**
     * @var \Illuminate\Support\Collection
     */
    private $targets;


    public function __construct()
    {
        $this->skills = LandingPageParams::skills();
        $this->locations = LandingPageParams::locations();
        $this->targets = LandingPageParams::targets();
    }

    public function handle($regenerate = false): void
    {
        foreach ($this->targets as $target) {
            foreach ($this->skills as $skill) {
                foreach ($this->locations as $location) {
                    if ($this->landingPageExists($target, $skill, $location) && !$regenerate) {
                        continue;
                    }

                    $this->createLandingPage($target, $skill, $location);
                }
            }
        }
    }

    private function createLandingPage(string $target, string $skill, string $location): void
    {
        $landingPage = new LandingPage();
        $landingPage->title = $this->generateTitle($target, $skill, $location);
        $landingPage->slug = Str::slug($landingPage->title);

        $landingPage->target = $target;
        $landingPage->skill = $skill;
        $landingPage->location = $location;

        $landingPage->image_index = rand(1, 13);

        $landingPage->text1 = $this->generateSubTitle($target, $skill);
        $landingPage->text2 = $this->generateText($target, $skill, $location);

        $landingPage->save();

        $this->syncShowcases($landingPage, $skill);
    }

    private function generateTitle(string $target, string $skill, string $location): string
    {
        $title = LandingPageParams::title();
        $title = str_replace('{target}', $target, $title);
        $title = str_replace('{skill}', $skill, $title);
        $title = str_replace('{location}', $location, $title);

        return $title;
    }

    private function generateSubTitle(string $target, string $skill)
    {
        $subTitle = LandingPageParams::subTitle();
        $subTitle = str_replace('{target}', $target, $subTitle);
        $subTitle = str_replace('{skill}', $skill, $subTitle);

        return $subTitle;
    }

    private function generateText(string $target, string $skill, string $location)
    {
        $AITitle =  LandingPageParams::AITitle();
        $AITitle = str_replace('{target}', $target, $AITitle);
        $AITitle = str_replace('{skill}', $skill, $AITitle);
        $AITitle = str_replace('{location}', $location, $AITitle);
        $openAiGenerator = new OpenAIService();
        $text= $openAiGenerator->generateText($AITitle);

        $lastPeriodPosition = strrpos($text, ".");
        if ($lastPeriodPosition !== false && $lastPeriodPosition < strlen($text) - 1) {
            $text = substr($text, 0, $lastPeriodPosition + 1);
        }
        return $text;
    }

    private function syncShowcases(LandingPage $landingPage, $skill)
    {
        if (Str::endsWith($skill, 's')) {
            $skill = Str::substr($skill, 0, -1);
        }
        $showCases = Showcase::query()
            ->where('type', $skill)
            ->orWhere('description', 'like', '%' . $skill . '%')
            ->take(3)
            ->orderBy('pin_on_homepage', 'desc')
            ->get();

        $landingPage->showcases()->sync($showCases->pluck('id')->toArray());
    }

    private function landingPageExists(string $target, string $skill, string $location): bool
    {
        return LandingPage::query()
            ->where('target', $target)
            ->where('skill', $skill)
            ->where('location', $location)
            ->count();
    }
}
