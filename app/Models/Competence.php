<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $vacancy_id
 * @property int $visible
 * @property int $number
 * @property string $title
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Vacancy|null $vacancy
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competence newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competence newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competence query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competence whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competence whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competence whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competence whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competence whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competence whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competence whereVacancyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competence whereVisible($value)
 * @mixin \Eloquent
 * @mixin IdeHelperCompetence
 */
class Competence extends Model
{
    protected $guarded = [];

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
}
