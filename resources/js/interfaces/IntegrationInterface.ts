import {TranslationKey} from "../translations/lang-keys";

export interface IntegrationInterface {
    title: TranslationKey;
    description: TranslationKey;
    badges: TranslationKey[];
    icon: string;
}
