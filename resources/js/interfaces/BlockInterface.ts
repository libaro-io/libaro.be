import { BlockTypeEnum } from "@enums/BlockTypeEnum";

export interface BlockInterface {
    type: BlockTypeEnum;
    data: {
        number?: number;
        title?: string;
        text?: string;
        image?: string;
        layout?: 'image_text' | 'text_image';
        cards?: {
            image?: string;
            title?: string;
            text?: string;
        }[];
        accordion?: {
            title?: string;
            description?: string;
        }[];
    }
}
