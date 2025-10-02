<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property bool $visible
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property string|null $image
 * @property string|null $author
 * @property \Illuminate\Support\Carbon|null $publish_date
 * @property string|null $link
 * @property array $tags
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BlogBlock> $blocks
 * @property-read int|null $blocks_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog wherePublishDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereVisible($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperBlog {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $blog_id
 * @property string $type
 * @property array<array-key, mixed> $content
 * @property int $sort
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Blog $blog
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogBlock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogBlock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogBlock query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogBlock whereBlogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogBlock whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogBlock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogBlock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogBlock whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogBlock whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogBlock whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperBlogBlock {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $image
 * @property int $visible
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $weight
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Project> $projects
 * @property-read int|null $projects_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereWeight($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperClient {}
}

namespace App\Models{
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
 */
	#[\AllowDynamicProperties]
	class IdeHelperCompetence {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $skill
 * @property string $target
 * @property string $location
 * @property int|null $image_index
 * @property string|null $title
 * @property string|null $text1
 * @property string|null $text2
 * @property string|null $text3
 * @property string $slug
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Project> $projects
 * @property-read int|null $projects_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereImageIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereSkill($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereText1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereText2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereText3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperLandingPage {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $project_id
 * @property int $landing_page_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageProject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageProject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageProject query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageProject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageProject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageProject whereLandingPageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageProject whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageProject whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperLandingPageProject {}
}

namespace App\Models{
/**
 * @property int $id
 * @property bool $visible
 * @property bool $is_product
 * @property string $name
 * @property string $description
 * @property string|null $image
 * @property string|null $client_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $slug
 * @property string $type
 * @property int|null $client_id
 * @property string|null $date
 * @property int $pin_on_homepage
 * @property array $tags
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectBlock> $blocks
 * @property-read int|null $blocks_count
 * @property-read \App\Models\Client|null $client
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectContent> $content
 * @property-read int|null $content_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereClientUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereIsProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project wherePinOnHomepage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereVisible($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperProject {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $project_id
 * @property string $type
 * @property array<array-key, mixed> $content
 * @property int $sort
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Project $project
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectBlock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectBlock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectBlock query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectBlock whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectBlock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectBlock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectBlock whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectBlock whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectBlock whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectBlock whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperProjectBlock {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $showcase_id
 * @property int $visible
 * @property int $number
 * @property string $title
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent whereShowcaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent whereVisible($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperProjectContent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
}

namespace App\Models{
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
 */
	#[\AllowDynamicProperties]
	class IdeHelperVacancy {}
}

