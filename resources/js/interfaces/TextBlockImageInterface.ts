import {TranslationKey} from "../translations/lang-keys";

export interface TextBlockImageInterface{
    subTitle?: TranslationKey;
    title: TranslationKey;
    texts: TranslationKey[];
    image: string;
}
