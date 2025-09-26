import {TranslationKey} from "../translations/lang-keys";

export interface ListWithImageInterface {
    title?: TranslationKey;
    descriptions?: TranslationKey[];
    listItems: {
        title: TranslationKey;
        description: TranslationKey;
        image: string;
    }[]
}
