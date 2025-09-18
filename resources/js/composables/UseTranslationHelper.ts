import { trans, transChoice } from "laravel-vue-i18n";
import { TranslationKey } from "../translations/lang-keys";

export const getTrans = (
    key: TranslationKey,
    replace: Record<string, string> = {},
    number: number | null = null,
): string => {
    if (key === null || key === trans(key, replace)) {
        return "";
    }

    if (number !== null) {
        return transChoice(key, number, replace);
    }
    return trans(key, replace);
};
