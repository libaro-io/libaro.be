import {TranslationKey} from "../translations/lang-keys";

export interface UspListInterface {
    title?: TranslationKey;
    description?: TranslationKey;
    listItems: {
        title: TranslationKey;
        description: TranslationKey;
    }[]
}
