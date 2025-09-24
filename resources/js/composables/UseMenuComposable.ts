import {MenuInterface} from "@interfaces/MenuInterface";


export const getFilteredMenu = (menu: MenuInterface[]): MenuInterface[] => {
    return menu.sort((a, b) => a.weight - b.weight)
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

    const normalizedCurrent = normalizePath(window.location.pathname);
    const normalizedItem = normalizePath(item.url.url);

    // Handle home page
    if (normalizedItem === '/') {
        return normalizedCurrent === '/';
    }

    // For other pages, check exact match or nested routes
    return normalizedCurrent === normalizedItem ||
           normalizedCurrent.startsWith(`${normalizedItem}/`);
};
