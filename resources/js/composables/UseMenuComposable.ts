import { MenuInterface } from "@interfaces/MenuInterface";
import { usePage } from "@inertiajs/vue3";
import PageInterface from "@interfaces/PageInterface";

const page = usePage<PageInterface>();

export const getFilteredMenu = (menu: MenuInterface[]): MenuInterface[] => {
    return menu
        .filter((item) => item.visible);
}

export const getFilteredChildren = (menu: MenuInterface): MenuInterface[] => {
    if (!menu.children) {
        return [];
    }
    return menu.children
        .filter((item) => item.visible);
}

const normalizePath = (path: string): string => {
    if (!path || path === '/' || path === '/nl' || path === '/en') {
        return '/';
    }
    return path
        .replace(/^\/(nl|en)(\/|$)/, '/')  // Remove language prefix
        .replace(/\/$/, '')                 // Remove trailing slash
        .toLowerCase();                     // Normalize case
};

export const checkIfMenuItemIsActive = (item: MenuInterface): boolean => {
    if (!item?.url?.url) return false;

    const normalizedCurrent = normalizePath(page.props.pageProps.url.pathname);
    const normalizedItem = normalizePath(item.url.url);

    // Handle home page
    if (normalizedItem === '/') {
        return normalizedCurrent === '/';
    }

    // For other pages, check exact match or nested routes
    return normalizedCurrent === normalizedItem ||
        normalizedCurrent.startsWith(`${normalizedItem}/`);
};
