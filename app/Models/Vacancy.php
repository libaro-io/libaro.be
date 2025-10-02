<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $visible
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Competence> $competencies
 * @property-read int|null $competencies_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vacancy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vacancy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vacancy query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vacancy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vacancy whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vacancy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vacancy whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vacancy whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vacancy whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vacancy whereVisible($value)
 * @mixin \Eloquent
 * @mixin IdeHelperVacancy
 */
class Vacancy extends Model
{
    protected $guarded = [];

    public function competencies()
    {
        return $this->hasMany(Competence::class);
    }
}
