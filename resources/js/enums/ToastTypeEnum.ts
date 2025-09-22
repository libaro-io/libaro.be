import { getTrans } from "@composables/UseTranslationHelper";

export enum ToastTypeEnum {
    SUCCESS = "success",
    ERROR = "error",
    LOADING = "loading",
}

export const getToastTypeLabel = (type: ToastTypeEnum): string => {
    return getTrans(`enums.toast_type.${type}`);
};
