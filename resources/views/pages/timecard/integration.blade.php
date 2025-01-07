<x-layout>
    @section('title', 'Timecard App x ROBAWS')
    <div class="hidden max:block border-b-10 border-secondary"
         style="background-image: url('{{ asset('/storage/images/header_striped.jpg') }}'); background-repeat: no-repeat; background-size: cover">

        <div class="max:max-w-8xl mx-auto">
            <div class="hidden max:block">
                <x-nav/>

            </div>
            <div class="pt-24">
                <x-header-single-column title="Timecard App x ROBAWS"/>
            </div>
        </div>
    </div>

    <div x-data="{ show: false }" class="max:hidden relative">
        <div
            style="background-image: url('{{ asset('/storage/images/header_bg.png') }}'); background-repeat: no-repeat; background-size: cover">
            <div class="relative max:max-w-8xl mx-auto">
                <x-header-single-column title="Supportpagina Robaws"
                                        subtitle="Hoe kunnen wij u helpen?"/>
            </div>
        </div>
        <x-header-hamburger/>

        <div x-show="show"
             x-transition:enter="transition transform duration-1000"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="z-30 bg-primary-dark fixed top-0 left-0 min-h-screen w-screen">
            <x-nav-full-screen/>
        </div>
    </div>
    <main class="md:mt-24">
        <section class="max-w-8xl mx-auto md:mb-24 p-4">
            <img src="{{ asset('images/timecard/robows-logo.png') }}" alt="Timecard App" class="w-64 max-w-full mb-12">
            <h1 class="font-gilroy font-bold text-5xl text-primary-darkest mb-5">{{ __('Breng efficiëntie naar een hoger niveau') }}</h1>
            <p class="font-grotesk font-semibold text-xl md:text-2xl text-primary-darkest">
                De Timecard App zorgt voor een vereenvoudigde registratie van dagelijkse prestaties door teamleaders in
                de bouwsector. De naadloze integratie met Robaws zorgt ervoor dat alle prestaties zonder moeite verwerkt
                worden in de werkbonnen, voortgangstaten en facturatie van Robaws. </p>
            <h2 class="font-gilroy font-bold text-3xl text-primary-darkest mt-12 mb-5">{{ __('Wat houdt het precies in?') }}</h2>
            <p class="font-grotesk font-semibold text-base text-primary-darkest xl:w-2/3">
                Met deze integratie kunnen teamleiders en werfleiders eenvoudig <strong>urenregistraties</strong>,
                <strong>materiaalgebruik</strong>,
                <strong>materieelbeheer</strong>, <strong>afvalregistraties</strong> en <strong>ritten
                    vastleggen</strong> via een gebruiksvriendelijke interface. Deze
                informatie wordt automatisch verwerkt en dagelijks gesynchroniseerd met het Robaws ERP-systeem, waardoor
                uw gegevens altijd up-to-date zijn.
            </p>
            <p class="font-grotesk font-semibold text-base text-primary-darkest mt-5 xl:w-2/3">
                Een belangrijk voordeel van deze integratie is de mogelijkheid om, <strong>in de vorm van een werkbon,
                    alle
                    kosten direct aan specifieke projecten te koppelen</strong>, wat resulteert in een duidelijk
                overzicht van
                uitgaven en budgetten. Door de realtime monitoring van omzet versus kosten, geïntegreerd met jouw
                Robaws-account, kun je werkbonnen, voortgangsstaten en facturatie efficiënt beheren, wat leidt tot een
                nauwkeurige winstberekening.
            </p>
            <p class="font-grotesk font-semibold text-base text-primary-darkest mt-5 xl:w-2/3">
                Bovendien stelt de <strong>automatische synchronisatie</strong> je in staat om een volledig overzicht te
                behouden van
                alle lopende projecten zonder handmatige invoer in meerdere systemen. Indien nodig kunnen gegevens
                eenvoudig worden aangepast en opnieuw worden verzonden.
            </p>
            <p class="font-grotesk font-semibold text-base text-primary-darkest mt-5 xl:w-2/3">
                Naast het registreren van werkmiddelen, automatisch koppelen van werkbonnen, etc. biedt de app nog
                enkele unieke functionaliteiten. Dankzij een slim algoritme doet de app <strong>automatisch een voorstel
                    voor
                    prestaties</strong> op basis van de voorgaande dagen. Je kunt bijgevolg deze suggesties gemakkelijk
                controleren
                of aanpassen waar nodig. Bijkomstig is het met de app <strong>mogelijk om prestaties in te voeren voor
                    collega’s</strong>. Dit is vooral handig wanneer teamleden niet in staat zijn om hun eigen
                registraties uit te
                voeren. Daardoor blijft de werkbon steeds volledig en up-to-date.
            </p>
            <h2 class="font-gilroy font-bold text-3xl text-primary-darkest mt-12 mb-5">{{ __('Voordelen van de integratie') }}</h2>
            <p
                class="font-grotesk font-semibold text-base text-primary-darkest xl:w-2/3">
                De koppeling met Robaws biedt tal van voordelen voor bedrijven die streven naar efficiëntere
                werkprocessen en een betere projectcontrole:
            </p>
            <ul class="font-grotesk font-semibold text-base text-primary-darkest mt-5 xl:w-2/3 ml-10 flex flex-col gap-3 list-disc">
                <li><strong>Efficiënt kostenbeheer:</strong> Houd budgetten scherp in de gaten en voorkom onverwachte overschrijdingen met real-time inzicht in projectkosten.</li>
                <li><strong>Tijdsbesparing:</strong> Bespaar kostbare uren door gegevens automatisch te registreren en te synchroniseren, waardoor minder handmatige invoer nodig is.</li>
                <li><strong>Gebruiksvriendelijke interface:</strong> Met een intuïtieve en eenvoudige gebruikerservaring kunnen alle teamleden gemakkelijk hun uren en materiaal registreren.</li>
                <li><strong>Betere projectcontrole:</strong> Houd de voortgang van projecten en het gebruik van middelen nauwgezet bij voor een efficiënter beheer.</li>
                <li><strong>Naadloze integratie:</strong> De integratie sluit moeiteloos aan op uw bestaande workflows en optimaliseert de samenwerking tussen verschillende afdelingen.</li>
            </ul>
            <h2 class="font-gilroy font-bold text-3xl text-primary-darkest mt-12 mb-5">{{ __('Hoe wordt dit in jouw workflow geïmplementeerd?') }}</h2>
            <p class="font-grotesk font-semibold text-base text-primary-darkest xl:w-2/3">
                De implementatie van de integratie is eenvoudig en snel. Het proces omvat de volgende stappen:
            </p>
            <ol class="font-grotesk font-semibold text-base text-primary-darkest mt-5 xl:w-2/3 ml-10 flex flex-col gap-3 list-decimal">
                <li><strong>Activatie:</strong> We zorgen ervoor dat de app wordt aangepast aan jouw bedrijf en gekoppeld wordt aan je bestaande Robaws-account en gegevens.</li>
                <li><strong>Documentatie:</strong> We bezorgen je duidelijke instructies over het gebruik van de app. Indien nodig zetten we even een korte video call op voor een demo.</li>
                <li><strong>Ondersteuning en updates:</strong> De integratie wordt continu onderhouden en verbeterd om de beste ervaring te bieden aan alle gebruikers.</li>
            </ol>
            <p class="font-grotesk font-semibold text-base text-primary-darkest mt-5 xl:w-2/3">
                De implementatie vereist minimale inspanning van uw team en zorgt ervoor dat uw bedrijf vrijwel direct profiteert van een efficiëntere werkwijze.
            </p>
            <div class="images grid grid-cols-1 md:grid-cols-3 gap-4 mt-12 md:max-w-6xl mx-auto">
                <img src="{{ asset('images/timecard/screenshots/1.png') }}" alt="Timecard App" class="max-w-full mt-12">
                <img src="{{ asset('images/timecard/screenshots/2.png') }}" alt="Timecard App" class="max-w-full mt-12">
                <img src="{{ asset('images/timecard/screenshots/3.png') }}" alt="Timecard App" class="max-w-full mt-12">
                <img src="{{ asset('images/timecard/screenshots/4.png') }}" alt="Timecard App" class="max-w-full mt-12 md:col-span-3">
            </div>
        </section>
    </main>

    <x-footer/>

</x-layout>

