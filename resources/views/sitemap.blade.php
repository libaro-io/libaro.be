@php use App\Http\Controllers\AboutUsController;use App\Http\Controllers\AssetsController;use App\Http\Controllers\BlogController;use App\Http\Controllers\ContactController;use App\Http\Controllers\CookiePolicyController;use App\Http\Controllers\DetailBlogController;use App\Http\Controllers\DetailProductController;use App\Http\Controllers\DetailProjectController;use App\Http\Controllers\Expertises\AiIntegrationsExpertiseController;use App\Http\Controllers\Expertises\AppsExpertiseController;use App\Http\Controllers\Expertises\IOTExpertiseController;use App\Http\Controllers\Expertises\OdooExpertiseController;use App\Http\Controllers\Expertises\RobawsExpertiseController;use App\Http\Controllers\Expertises\WebDevelopmentExpertiseController;use App\Http\Controllers\HomeController;use App\Http\Controllers\IntegrationTimecardController;use App\Http\Controllers\LandingPageController;use App\Http\Controllers\PrivacyPolicyController;use App\Http\Controllers\SupportTimecardController;use App\Http\Controllers\TermsController; @endphp
<urlset xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach(config('app.supported_locales') as $locale)
        @foreach([
            HomeController::class,
            ContactController::class,
            AboutUsController::class,
            WebDevelopmentExpertiseController::class,
            AppsExpertiseController::class,
            AiIntegrationsExpertiseController::class,
            IOTExpertiseController::class,
            OdooExpertiseController::class,
            RobawsExpertiseController::class,
            IntegrationTimecardController::class,
            SupportTimecardController::class,
            PrivacyPolicyController::class,
            CookiePolicyController::class,
            TermsController::class,
            AssetsController::class
        ] as $page)
            <url>
                <loc>{{ action($page, ['locale' => $locale]) }}</loc>
                @foreach(alternative_locales($locale) as $altLocale)
                    <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ action($page, ['locale' => $altLocale]) }}"/>
                @endforeach
                <lastmod>{{ $lastModGeneralPages->toDateString() }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>1.0</priority>
            </url>
        @endforeach

        @foreach($blogs as $blog)
            <url>
                <loc>{{ action(DetailBlogController::class, [ 'locale' => $locale, 'blog' => $blog ]) }}</loc>
                @foreach(alternative_locales($locale) as $altLocale)
                    <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ action(DetailBlogController::class, [ 'locale' => $altLocale, 'blog' => $blog ]) }}"/>
                @endforeach
                <lastmod>{{ $blog->updated_at->toDateString() }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>1.0</priority>
            </url>
        @endforeach

        @foreach($projects as $project)
            <url>
                <loc>{{ action(DetailProjectController::class, [ 'locale' => $locale,  'project' => $project ]) }}</loc>
                @foreach(alternative_locales($locale) as $altLocale)
                    <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ action(DetailProjectController::class, [ 'locale' => $altLocale,  'project' => $project ]) }}"/>
                @endforeach
                <lastmod>{{ $project->updated_at->toDateString() }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>1.0</priority>
            </url>
        @endforeach

        @foreach($products as $product)
            <url>
                <loc>{{ action(DetailProductController::class, [ 'locale' => $locale,  'product' => $product ]) }}</loc>
                @foreach(alternative_locales($locale) as $altLocale)
                    <xhtml:link rel="alternate" hreflang="{{ $altLocale }}" href="{{ action(DetailProductController::class, [ 'locale' => $altLocale,  'product' => $product ]) }}"/>
                @endforeach
                <lastmod>{{ $product->updated_at->toDateString() }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>1.0</priority>
            </url>
        @endforeach
    @endforeach

    @foreach($landingPages as $landingPage)
    <url>
        <loc>{{ action(LandingPageController::class, [ 'locale' => 'nl',  'landingPage' => $landingPage ]) }}</loc>
        <lastmod>{{ $landingPage->updated_at->toDateString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    @endforeach
</urlset>
