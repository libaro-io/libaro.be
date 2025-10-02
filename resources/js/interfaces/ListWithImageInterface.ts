import {TranslationKey} from "../translations/lang-keys";
import {LinkBuilderInterface} from "@interfaces/LinkBuilderInterface";

export interface ListWithImageInterface {
    title?: TranslationKey;
    descriptions?: TranslationKey[];
    listItems: {
        title: TranslationKey;
        description: TranslationKey;
        image: string;
        badges?: TranslationKey[];
        link?: {
            title: TranslationKey;
            url: LinkBuilderInterface
        }
    }[]
}
