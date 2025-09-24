import {ProjectBlockTypeEnum} from "@enums/ProjectBlockTypeEnum";

export interface ProjectBlockInterface {
    type: ProjectBlockTypeEnum;
    data: {
        number?: number;
        title?: string;
        text?: string;
        image?: string;
        layout?: 'image_text' | 'text_image';
    }
}
