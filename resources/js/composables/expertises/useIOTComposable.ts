import {ListWithImageInterface} from "@interfaces/ListWithImageInterface";
import conceptToIOTImage from "@assets/images/iot/concept_to_iot.png";
import {IntegrationInterface} from "@interfaces/IntegrationInterface";
import SmartLightningIcon from "@assets/images/iot/icons/smart_lightning.svg";

export const conceptToAppsBlock: ListWithImageInterface = {
    title: 'pages.iot.how_it_works.title',
    descriptions: [
        'pages.iot.how_it_works.descriptions.0',
    ],
    listItems: [
        {
            title: 'pages.iot.how_it_works.list_items.strategy_analysis.title',
            description: 'pages.iot.how_it_works.list_items.strategy_analysis.description',
            image: conceptToIOTImage,
            badges: [
                'pages.iot.how_it_works.list_items.strategy_analysis.badges.0',
                'pages.iot.how_it_works.list_items.strategy_analysis.badges.1',
                'pages.iot.how_it_works.list_items.strategy_analysis.badges.2',
                'pages.iot.how_it_works.list_items.strategy_analysis.badges.3'
            ]
        },
        {
            title: 'pages.iot.how_it_works.list_items.custom_design.title',
            description: 'pages.iot.how_it_works.list_items.custom_design.description',
            image: conceptToIOTImage,
            badges: [
                'pages.iot.how_it_works.list_items.custom_design.badges.0',
                'pages.iot.how_it_works.list_items.custom_design.badges.1',
                'pages.iot.how_it_works.list_items.custom_design.badges.2',
                'pages.iot.how_it_works.list_items.custom_design.badges.3'
            ]
        },
        {
            title: 'pages.iot.how_it_works.list_items.implementation_support.title',
            description: 'pages.iot.how_it_works.list_items.implementation_support.description',
            image: conceptToIOTImage,
            badges: [
                'pages.iot.how_it_works.list_items.implementation_support.badges.0',
                'pages.iot.how_it_works.list_items.implementation_support.badges.1',
                'pages.iot.how_it_works.list_items.implementation_support.badges.2',
                'pages.iot.how_it_works.list_items.implementation_support.badges.3',
                'pages.iot.how_it_works.list_items.implementation_support.badges.4'
            ]
        }
    ]
}

export const integrationsList: IntegrationInterface[] = [
    {
        title: 'pages.iot.integrations.smart_lighting.title',
        description: 'pages.iot.integrations.smart_lighting.description',
        badges: [
            'pages.iot.integrations.smart_lighting.badges.0',
            'pages.iot.integrations.smart_lighting.badges.1',
            'pages.iot.integrations.smart_lighting.badges.2',
            'pages.iot.integrations.smart_lighting.badges.3',
        ],
        icon: SmartLightningIcon
    },
]
