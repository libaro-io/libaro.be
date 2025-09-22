import {ProjectBlockTypeEnum} from "@enums/ProjectBlockTypeEnum";

export interface ProjectBlockInterface {
    type: ProjectBlockTypeEnum;
    data: {
        text?: string;
        image?: string;
    }
}
