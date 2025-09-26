@php use App\Http\Controllers\AboutUsController;use App\Http\Controllers\AssetsController;use App\Http\Controllers\BlogController;use App\Http\Controllers\ContactController;use App\Http\Controllers\CookiePolicyController;use App\Http\Controllers\DetailProductController;use App\Http\Controllers\DetailProjectController;use App\Http\Controllers\Expertises\AiIntegrationsExpertiseController;use App\Http\Controllers\Expertises\AppsExpertiseController;use App\Http\Controllers\Expertises\OdooExpertiseController;use App\Http\Controllers\Expertises\WebDevelopmentExpertiseController;use App\Http\Controllers\HomeController;use App\Http\Controllers\IntegrationTimecardController;use App\Http\Controllers\LandingPageController;use App\Http\Controllers\PrivacyPolicyController;use App\Http\Controllers\SupportTimecardController;use App\Http\Controllers\TermsController; @endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    @foreach(config('app.supported_locales') as $locale)
        <url>
            <loc>{{ action(HomeController::class, ['locale' => $locale]) }}</loc>
        </url>
        <url>
            <loc>{{ action(ContactController::class, ['locale' => $locale]) }}</loc>
        </url>
        <url>
            <loc>{{ action(AboutUsController::class, ['locale' => $locale]) }}</loc>
        </url>
        <url>
            <loc>{{ action(AboutUsController::class, ['locale' => $locale]) }}</loc>
        </url>
        <url>
            <loc>{{ action(WebDevelopmentExpertiseController::class, ['locale' => $locale]) }}</loc>
        </url>
        <url>
            <loc>{{ action(AppsExpertiseController::class, ['locale' => $locale]) }}</loc>
        </url>
        <url>
            <loc>{{ action(AiIntegrationsExpertiseController::class, ['locale' => $locale]) }}</loc>
        </url>
        <url>
            <loc>{{ action(OdooExpertiseController::class, ['locale' => $locale]) }}</loc>
        </url>
        @foreach($blogs as $blog)
            <url>
                <loc>{{ action(BlogController::class, [ 'locale' => $locale, 'blog' => $blog ]) }}</loc>
            </url>
        @endforeach
        @foreach($landingPages as $landingPage)
            <url>
                <loc>{{ action(LandingPageController::class, [ 'locale' => $locale, 'landingPage' => $landingPage ]) }}</loc>
            </url>
        @endforeach
        @foreach($projects as $project)
            <url>
                <loc>{{ action(DetailProjectController::class, [ 'locale' => $locale, 'project' => $project ]) }}</loc>
            </url>
        @endforeach
        @foreach($products as $product)
            <url>
                <loc>{{ action(DetailProductController::class, [ 'locale' => $locale, 'product' => $product ]) }}</loc>
            </url>
        @endforeach
        <url>
            <loc>{{ action(IntegrationTimecardController::class, ['locale' => $locale]) }}</loc>
        </url>
        <url>
            <loc>{{ action(SupportTimecardController::class, ['locale' => $locale]) }}</loc>
        </url>
        <url>
            <loc>{{ action(PrivacyPolicyController::class, ['locale' => $locale]) }}</loc>
        </url>
        <url>
            <loc>{{ action(CookiePolicyController::class, ['locale' => $locale]) }}</loc>
        </url>
        <url>
            <loc>{{ action(TermsController::class, ['locale' => $locale]) }}</loc>
        </url>
        <url>
            <loc>{{ action(AssetsController::class, ['locale' => $locale]) }}</loc>
        </url>
    @endforeach
</urlset>
