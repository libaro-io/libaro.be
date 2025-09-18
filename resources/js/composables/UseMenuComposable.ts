import {MenuInterface} from "@interfaces/MenuInterface";


export const getFilteredMenu = (menu: MenuInterface[]): MenuInterface[] => {
    return menu.sort((a, b) => a.weight - b.weight)
        .filter((item) => item.visible);
}

export const checkIfMenuItemIsActive = (item: MenuInterface): boolean => {
    return item.url.url === window.location.pathname;
};
