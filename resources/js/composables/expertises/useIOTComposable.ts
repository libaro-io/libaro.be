import {ListWithImageInterface} from "@interfaces/ListWithImageInterface";
import conceptToIOTImage from "@assets/images/iot/concept_to_iot.png";
import {IntegrationInterface} from "@interfaces/IntegrationInterface";
import SmartLightningIcon from "@assets/images/iot/icons/smart_lightning.svg";
import TVIcon from "@assets/images/iot/icons/tv.svg";
import ParkingIcon from "@assets/images/iot/icons/parking.svg";
import AccessIcon from "@assets/images/iot/icons/access.svg";
import ClimateIcon from "@assets/images/iot/icons/climate.svg";
import IntegrationIcon from "@assets/images/iot/icons/integration.svg";
import ProductivityIcon from "@assets/images/iot/icons/productivity.svg";
import EnergyIcon from "@assets/images/iot/icons/energy.svg";
import SecurityIcon from "@assets/images/iot/icons/security.svg";

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
    {
        title: 'pages.iot.integrations.tv_display.title',
        description: 'pages.iot.integrations.tv_display.description',
        badges: [
            'pages.iot.integrations.tv_display.badges.0',
            'pages.iot.integrations.tv_display.badges.1',
            'pages.iot.integrations.tv_display.badges.2',
            'pages.iot.integrations.tv_display.badges.3',
        ],
        icon: TVIcon
    },
    {
        title: 'pages.iot.integrations.parking.title',
        description: 'pages.iot.integrations.parking.description',
        badges: [
            'pages.iot.integrations.parking.badges.0',
            'pages.iot.integrations.parking.badges.1',
            'pages.iot.integrations.parking.badges.2',
            'pages.iot.integrations.parking.badges.3',
        ],
        icon: ParkingIcon
    },
    {
        title: 'pages.iot.integrations.access_control.title',
        description: 'pages.iot.integrations.access_control.description',
        badges: [
            'pages.iot.integrations.access_control.badges.0',
            'pages.iot.integrations.access_control.badges.1',
            'pages.iot.integrations.access_control.badges.2',
            'pages.iot.integrations.access_control.badges.3',
        ],
        icon: AccessIcon
    },
    {
        title: 'pages.iot.integrations.climate.title',
        description: 'pages.iot.integrations.climate.description',
        badges: [
            'pages.iot.integrations.climate.badges.0',
            'pages.iot.integrations.climate.badges.1',
            'pages.iot.integrations.climate.badges.2',
            'pages.iot.integrations.climate.badges.3',
        ],
        icon: ClimateIcon
    },
    {
        title: 'pages.iot.integrations.vending.title',
        description: 'pages.iot.integrations.vending.description',
        badges: [
            'pages.iot.integrations.vending.badges.0',
            'pages.iot.integrations.vending.badges.1',
            'pages.iot.integrations.vending.badges.2',
            'pages.iot.integrations.vending.badges.3',
        ],
        icon: IntegrationIcon
    },
]

export const whyIOTList: IntegrationInterface[] = [
    {
        title: 'pages.iot.why_choose_iot.benefits.productivity.title',
        description: 'pages.iot.why_choose_iot.benefits.productivity.description',
        icon: ProductivityIcon
    },
    {
        title: 'pages.iot.why_choose_iot.benefits.energy.title',
        description: 'pages.iot.why_choose_iot.benefits.energy.description',
        icon: EnergyIcon
    },
    {
        title: 'pages.iot.why_choose_iot.benefits.security.title',
        description: 'pages.iot.why_choose_iot.benefits.security.description',
        icon: SecurityIcon
    },
]
