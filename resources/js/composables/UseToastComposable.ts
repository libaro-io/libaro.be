import { Id, toast, ToastActions, ToastType } from "vue3-toastify";
import { ToastTypeEnum } from "@enums/ToastTypeEnum";

export const showToast = (
    message: string,
    type: ToastType = ToastTypeEnum.SUCCESS,
    autoDismiss: boolean = true,
): Id => {
    return toast(message, {
        type: type,
        autoClose: autoDismiss ? 3000 : false,
    });
};

export const hideToast = (id: Id): void => {
    ToastActions.dismiss(id);
};
