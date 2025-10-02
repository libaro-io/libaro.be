import OdooForYou from "@assets/images/odoo/odoo_for_you.png";
import {ListWithImageInterface} from "@interfaces/ListWithImageInterface";
import {IntegrationInterface} from "@interfaces/IntegrationInterface";
import FinanceIcon from "@assets/images/odoo/icons/finance.png";
import ServicesIcon from "@assets/images/odoo/icons/services.png";
import WebsiteIcon from "@assets/images/odoo/icons/website.png";
import InventoryIcon from "@assets/images/odoo/icons/production.png";
import MarketingIcon from "@assets/images/odoo/icons/marketing.png";
import SalesIcon from "@assets/images/odoo/icons/sale.png";

export const getWhatIsOdooYou = (): ListWithImageInterface => {
    return {
        title: 'pages.odoo.what_is_odoo_for_you.title',
        descriptions: [
            'pages.odoo.what_is_odoo_for_you.descriptions.0',
        ],
        listItems: [
            {
                title: 'pages.odoo.what_is_odoo_for_you.list_items.inventory_management.title',
                description: 'pages.odoo.what_is_odoo_for_you.list_items.inventory_management.description',
                image: OdooForYou
            },
            {
                title: 'pages.odoo.what_is_odoo_for_you.list_items.e_invoicing.title',
                description: 'pages.odoo.what_is_odoo_for_you.list_items.e_invoicing.description',
                image: OdooForYou
            },
            {
                title: 'pages.odoo.what_is_odoo_for_you.list_items.crm.title',
                description: 'pages.odoo.what_is_odoo_for_you.list_items.crm.description',
                image: OdooForYou
            },
            {
                title: 'pages.odoo.what_is_odoo_for_you.list_items.website.title',
                description: 'pages.odoo.what_is_odoo_for_you.list_items.website.description',
                image: OdooForYou
            }
        ]
    }
}

export const getIntegrations = (): IntegrationInterface[] => {
    return [
        {
            title: 'pages.odoo.integrations.categories.finance.title',
            description: 'pages.odoo.integrations.categories.finance.description',
            badges: [
                'pages.odoo.integrations.categories.finance.badges.accounting',
                'pages.odoo.integrations.categories.finance.badges.invoicing',
                'pages.odoo.integrations.categories.finance.badges.expenses',
                'pages.odoo.integrations.categories.finance.badges.documents',
                'pages.odoo.integrations.categories.finance.badges.spreadsheets',
                'pages.odoo.integrations.categories.finance.badges.sign',
            ],
            icon: FinanceIcon
        },
        {
            title: 'pages.odoo.integrations.categories.sales.title',
            description: 'pages.odoo.integrations.categories.sales.description',
            badges: [
                'pages.odoo.integrations.categories.sales.badges.crm',
                'pages.odoo.integrations.categories.sales.badges.sales',
                'pages.odoo.integrations.categories.sales.badges.pos',
                'pages.odoo.integrations.categories.sales.badges.subscriptions',
                'pages.odoo.integrations.categories.sales.badges.rental',
            ],
            icon: SalesIcon
        },
        {
            title: 'pages.odoo.integrations.categories.marketing.title',
            description: 'pages.odoo.integrations.categories.marketing.description',
            badges: [
                'pages.odoo.integrations.categories.marketing.badges.marketing_automation',
                'pages.odoo.integrations.categories.marketing.badges.email_marketing',
                'pages.odoo.integrations.categories.marketing.badges.sms_marketing',
                'pages.odoo.integrations.categories.marketing.badges.social_media_marketing',
                'pages.odoo.integrations.categories.marketing.badges.events',
                'pages.odoo.integrations.categories.marketing.badges.surveys',
            ],
            icon: MarketingIcon
        },
        {
            title: 'pages.odoo.integrations.categories.inventory_production.title',
            description: 'pages.odoo.integrations.categories.inventory_production.description',
            badges: [
                'pages.odoo.integrations.categories.inventory_production.badges.inventory',
                'pages.odoo.integrations.categories.inventory_production.badges.manufacturing',
                'pages.odoo.integrations.categories.inventory_production.badges.plm',
                'pages.odoo.integrations.categories.inventory_production.badges.purchase',
                'pages.odoo.integrations.categories.inventory_production.badges.maintenance',
                'pages.odoo.integrations.categories.inventory_production.badges.quality',
            ],
            icon: InventoryIcon
        },
        {
            title: 'pages.odoo.integrations.categories.websites_ecommerce.title',
            description: 'pages.odoo.integrations.categories.websites_ecommerce.description',
            badges: [
                'pages.odoo.integrations.categories.websites_ecommerce.badges.website',
                'pages.odoo.integrations.categories.websites_ecommerce.badges.ecommerce',
                'pages.odoo.integrations.categories.websites_ecommerce.badges.blog',
                'pages.odoo.integrations.categories.websites_ecommerce.badges.forum',
                'pages.odoo.integrations.categories.websites_ecommerce.badges.elearning',
                'pages.odoo.integrations.categories.websites_ecommerce.badges.live_chat',
            ],
            icon: WebsiteIcon
        },
        {
            title: 'pages.odoo.integrations.categories.services.title',
            description: 'pages.odoo.integrations.categories.services.description',
            badges: [
                'pages.odoo.integrations.categories.services.badges.project',
                'pages.odoo.integrations.categories.services.badges.timesheet',
                'pages.odoo.integrations.categories.services.badges.field_service',
                'pages.odoo.integrations.categories.services.badges.helpdesk',
                'pages.odoo.integrations.categories.services.badges.planning',
                'pages.odoo.integrations.categories.services.badges.appointments',
            ],
            icon: ServicesIcon
        },
    ]
}
