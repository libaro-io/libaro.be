<?php

namespace App\Http\Controllers\Timecard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function __invoke()
    {

        $faqs = collect([
            [
                "question" => "Hoe werkt de synchronisatie tussen de app en Robaws?",
                "answer" => "Alle ingevoerde dagrapporten worden dagelijks om 23:59 uur automatisch gesynchroniseerd met Robaws. U hoeft hier zelf niets voor te doen."
            ],
            [
                "question" => "Kan ik een dagrapport aanpassen na synchronisatie?",
                "answer" => "Ja, u kunt de functie “wis uit ERP” gebruiken om een rapport terug te zetten naar een bewerkbare status. Daarna kunt u het opnieuw synchroniseren met Robaws."
            ],
            [
                "question" => "Wat moet ik doen als bepaalde artikelen of materialen niet zichtbaar zijn in de app?",
                "answer" => "Controleer of de artikelen correct zijn ingedeeld in een artikelgroep in Robaws. Alleen artikelen in een geldige categorie worden weergegeven in de app."
            ],
            [
                "question" => "Kan ik gebruikersrollen of toegangsrechten instellen in de app?",
                "answer" => "Ja, de app maakt onderscheid tussen gebruikersrollen, zoals werfleiders en admins. De rol van een gebruiker kan aangepast worden door admins. Dit kan op de users pagina in de Timecard App."
            ],
            [
                "question" => "Wat gebeurt er als mijn internetverbinding tijdelijk wegvalt?",
                "answer" => "De PWA heeft beperkte offline functionaliteiten. Er zal internetverbinding nodig zijn om deze te kunnen gebruiken."
            ],
            [
                "question" => "Hoe worden voertuigen en materieel weergegeven in de app?",
                "answer" => "Voertuigen en materieel worden automatisch gesynchroniseerd vanuit Robaws en ingedeeld op basis van de categorieën die u in Robaws hebt ingesteld."
            ],
            [
                "question" => "Is de integratie geschikt voor meerdere projecten tegelijk?",
                "answer" => "Ja, u kunt meerdere projecten beheren en rapporteren in de app. Elk rapport wordt gekoppeld aan het juiste project binnen Robaws."
            ],
            [
                "question" => "Hoe weet ik zeker dat mijn gegevens correct zijn gesynchroniseerd?",
                "answer" => "Na synchronisatie wordt een bevestiging weergegeven in de app. U kunt ook controleren in Robaws of er onder werkbonnen een nieuwe werkbon is bijgekomen."
            ],
            [
                "question" => "Wat moet ik doen als ik foutmeldingen krijg?",
                "answer" => "Controleer of uw app up-to-date is. Mocht het probleem blijven bestaan, neem dan contact op via info@libaro.be voor technische ondersteuning."
            ],
            [
                "question" => "Hoe ziet de prijsstructuur er uit voor het gebruik van deze app?",
                "answer" => "Het betreft een abonnementsformule dat € 49 / teamleader per maand kost. Dit houdt in: per teamleader kan een onbeperkt aantal werknemers in je team zitten. Ook inclusief integratie, technische support en lopende updates en upgrades."
            ]
        ]);

        return view('pages.timecard.support',
            [
                'faqs' => $faqs
            ]
        );
    }
}
