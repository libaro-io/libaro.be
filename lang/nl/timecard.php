<?php
return [
    'integration' => [
        'title' => 'Timecard App x ROBAWS',
        'efficiency' => 'Breng efficiëntie naar een hoger niveau',
        'intro' => [
            'heading' => 'Algemeen',
            'paragraph_1' => 'De Timecard App zorgt voor een vereenvoudigde registratie van dagelijkse prestaties door teamleaders in de bouwsector. De naadloze integratie met Robaws zorgt ervoor dat alle prestaties zonder moeite verwerkt worden in de werkbonnen, voortgangstaten en facturatie van Robaws.',
        ],
        'what_is_it' => [
            'heading' => 'Wat houdt het precies in?',
            'paragraph_1' => 'Met deze integratie kunnen teamleiders en werfleiders eenvoudig <strong>urenregistraties</strong>, <strong>materiaalgebruik</strong>, <strong>materieelbeheer</strong>, <strong>afvalregistraties</strong> en <strong>ritten vastleggen</strong> via een gebruiksvriendelijke interface. Deze informatie wordt automatisch verwerkt en dagelijks gesynchroniseerd met het Robaws ERP-systeem, waardoor uw gegevens altijd up-to-date zijn.',
            'paragraph_2' => 'Een belangrijk voordeel van deze integratie is de mogelijkheid om, <strong>in de vorm van een werkbon</strong>, <strong>alle kosten direct aan specifieke projecten te koppelen</strong>, wat resulteert in een duidelijk overzicht van uitgaven en budgetten. Door de realtime monitoring van omzet versus kosten, geïntegreerd met jouw Robaws-account, kun je werkbonnen, voortgangsstaten en facturatie efficiënt beheren, wat leidt tot een nauwkeurige winstberekening.',
            'paragraph_3' => 'Bovendien stelt de <strong>automatische synchronisatie</strong> je in staat om een volledig overzicht te behouden van alle lopende projecten zonder handmatige invoer in meerdere systemen. Indien nodig kunnen gegevens eenvoudig worden aangepast en opnieuw worden verzonden.',
            'paragraph_4' => 'Naast het registreren van werkmiddelen, automatisch koppelen van werkbonnen, etc. biedt de app nog enkele unieke functionaliteiten. Dankzij een slim algoritme doet de app <strong>automatisch een voorstel voor prestaties</strong> op basis van de voorgaande dagen.',
            'paragraph_5' => 'Je kunt bijgevolg deze suggesties gemakkelijk controleren of aanpassen waar nodig. Bijkomstig is het met de app mogelijk om <strong>prestaties in te voeren voor collega’s</strong>. Dit is vooral handig wanneer teamleden niet in staat zijn om hun eigen registraties uit te voeren. Daardoor blijft de werkbon steeds volledig en up-to-date.',
        ],
        'benefits' => [
            'heading' => 'Voordelen van de integratie',
            'paragraph' => 'De koppeling met Robaws biedt tal van voordelen voor bedrijven die streven naar efficiëntere werkprocessen en een betere projectcontrole:',
            'list_1' => '<strong>Efficiënt kostenbeheer:</strong> Houd budgetten scherp in de gaten en voorkom onverwachte overschrijdingen met real-time inzicht in projectkosten.',
            'list_2' => '<strong>Tijdsbesparing:</strong> Bespaar kostbare uren door gegevens automatisch te registreren en te synchroniseren, waardoor minder handmatige invoer nodig is.',
            'list_3' => '<strong>Gebruiksvriendelijke interface:</strong> Met een intuïtieve en eenvoudige gebruikerservaring kunnen alle teamleden gemakkelijk hun uren en materiaal registreren.',
            'list_4' => '<strong>Betere projectcontrole:</strong> Houd de voortgang van projecten en het gebruik van middelen nauwgezet bij voor een efficiënter beheer.',
            'list_5' => '<strong>Naadloze integratie:</strong> De integratie sluit moeiteloos aan op uw bestaande workflows en optimaliseert de samenwerking tussen verschillende afdelingen.',
        ],
        'implementation' => [
            'heading' => 'Hoe wordt dit in jouw workflow geïmplementeerd?',
            'paragraph_1' => 'De implementatie van de integratie is eenvoudig en snel. Het proces omvat de volgende stappen:',
            'list_1' => '<strong>Activatie:</strong> We zorgen ervoor dat de app wordt aangepast aan jouw bedrijf en gekoppeld wordt aan je bestaande Robaws-account en gegevens.',
            'list_2' => '<strong>Documentatie:</strong> We bezorgen je duidelijke instructies over het gebruik van de app. Indien nodig zetten we even een korte video call op voor een demo.',
            'list_3' => '<strong>Ondersteuning:</strong> De integratie wordt continu onderhouden en verbeterd om de beste ervaring te bieden aan alle gebruikers. De implementatie vereist minimale inspanning van uw team en zorgt ervoor dat uw bedrijf vrijwel direct profiteert van een efficiëntere werkwijze.',
        ],
        'questions' => 'Heeft u verdere vragen of ondersteuning nodig?',
        'click_here' => 'Klik hier',
    ],
    'support' => [
        'title' => 'Supportpagina Timecard App',
        'documentation' => [
            'heading' => 'Documentatie',
            'manual' => 'Handleiding',
        ],
        'faq' => [
            'heading' => 'FAQ',
            'questions' => [
                'how_to_sync_robaws' => [
                    'question' => 'Hoe werkt de synchronisatie tussen de app en Robaws?',
                    'answer' => 'Alle ingevoerde dagrapporten worden dagelijks om 23:59 uur automatisch gesynchroniseerd met Robaws. U hoeft hier zelf niets voor te doen.',
                ],
                'edit_after_sync' => [
                    'question' => 'Kan ik een dagrapport aanpassen na synchronisatie?',
                    'answer' => 'Ja, u kunt de functie “wis uit ERP” gebruiken om een rapport terug te zetten naar een bewerkbare status. Daarna kunt u het opnieuw synchroniseren met Robaws.',
                ],
                'articles_not_visible' => [
                    'question' => 'Wat moet ik doen als bepaalde artikelen of materialen niet zichtbaar zijn in de app?',
                    'answer' => 'Controleer of de artikelen correct zijn ingedeeld in een artikelgroep in Robaws. Alleen artikelen in een geldige categorie worden weergegeven in de app.',
                ],
                'user_roles' => [
                    'question' => 'Kan ik gebruikersrollen of toegangsrechten instellen in de app?',
                    'answer' => 'Ja, de app maakt onderscheid tussen gebruikersrollen, zoals werfleiders en admins. De rol van een gebruiker kan aangepast worden door admins. Dit kan op de users pagina in de Timecard App.',
                ],
                'no_internet' => [
                    'question' => 'Wat gebeurt er als mijn internetverbinding tijdelijk wegvalt?',
                    'answer' => 'De PWA heeft beperkte offline functionaliteiten. Er zal internetverbinding nodig zijn om deze te kunnen gebruiken.',
                ],
                'vehicles_and_equipment' => [
                    'question' => 'Hoe worden voertuigen en materieel weergegeven in de app?',
                    'answer' => 'Voertuigen en materieel worden automatisch gesynchroniseerd vanuit Robaws en ingedeeld op basis van de categorieën die u in Robaws hebt ingesteld.',
                ],
                'multiple_projects' => [
                    'question' => 'Is de integratie geschikt voor meerdere projecten tegelijk?',
                    'answer' => 'Ja, u kunt meerdere projecten beheren en rapporteren in de app. Elk rapport wordt gekoppeld aan het juiste project binnen Robaws.',
                ],
                'correct_sync' => [
                    'question' => 'Hoe weet ik zeker dat mijn gegevens correct zijn gesynchroniseerd?',
                    'answer' => 'Na synchronisatie wordt een bevestiging weergegeven in de app. U kunt ook controleren in Robaws of er onder werkbonnen een nieuwe werkbon is bijgekomen.',
                ],
                'error_messages' => [
                    'question' => 'Wat moet ik doen als ik foutmeldingen krijg?',
                    'answer' => 'Controleer of uw app up-to-date is. Mocht het probleem blijven bestaan, neem dan contact op via info@libaro.be voor technische ondersteuning.',
                ],
                'pricing_structure' => [
                    'question' => 'Hoe ziet de prijsstructuur er uit voor het gebruik van deze app?',
                    'answer' => 'Het betreft een abonnementsformule dat € 49 / teamleader per maand kost. Dit houdt in: per teamleader kan een onbeperkt aantal werknemers in je team zitten. Ook inclusief integratie, technische support en lopende updates en upgrades.',
                ],
            ],
        ],
        'installation_instructions' => [
            'heading' => 'Installatie-instructies',
            'description' => 'Instructies voor het installeren van een PWA (Progressive Web App) op iOS en Android toestellen.',
            'ios' => [
                'heading' => 'iOS',
                'step_1' => 'Open Safari op je iPhone.',
                'step_2' => 'Navigeer naar <a href="https://timecard.libaro.io/">https://timecard.libaro.io/</a> in de adresbalk van Safari.',
                'step_3' => 'Tik op het "Delen"-icoon (vierkant met een pijl omhoog) onderaan het scherm.',
                'step_4' => 'In het geopende menu scrol je naar beneden en tik je op "Zet op beginscherm".',
                'step_5' => 'Tik op "Voeg toe" in de rechterbovenhoek van het scherm.',
                'step_6' => 'De app wordt nu toegevoegd aan het beginscherm van je iPhone. Je kunt de app openen door op het nieuwe icoon te tikken.',
            ],
            'android' => [
                'title' => 'Android',
                'step_1' => 'Open Google Chrome op je Android-toestel.',
                'step_2' => 'Navigeer naar <a href="https://timecard.libaro.io/">https://timecard.libaro.io/</a> in de adresbalk van Chrome.',
                'step_3' => 'Tik op het Menu-icoon (drie verticale stipjes) rechtsboven in het scherm.',
                'step_4' => 'In het geopende menu tik je op "Toevoegen aan startscherm" of "App installeren" (afhankelijk van je Android-versie).',
                'step_5' => 'Pas indien gewenst de naam van de app aan en tik op "Toevoegen" of "Installeren" om de PWA aan je startscherm toe te voegen.',
                'step_6' => 'De PWA wordt nu toegevoegd aan het startscherm van je Android-toestel. Je kunt de app openen door op het nieuwe icoon te tikken.',
            ],
            'further_help' => [
                'support_inquiry' => 'Heeft u verdere vragen of ondersteuning nodig?',
                'team_ready' => 'Ons team staat klaar om u te helpen!',
                'email' => 'info@libaro.be',
                'availability' => 'Wij zijn beschikbaar van maandag tot vrijdag van 09:00 tot 17:00 uur.',
            ],
        ],
    ]
];
