import {URLInterface} from "@interfaces/URLInterface";
import {TranslationKey} from "../translations/lang-keys";

export interface MenuInterface {
    weight: number;
    text: TranslationKey;
    url?: URLInterface;
    visible: boolean;
    children?: MenuInterface[];
}
