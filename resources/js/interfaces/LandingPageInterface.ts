import {ClientInterface} from "@interfaces/ClientInterface";
import {BlockInterface} from "@interfaces/BlockInterface";
import {ProjectInterface} from "@interfaces/ProjectInterface";

export interface LandingPageInterface {
    title: string;
    block: {
        title: string;
        subtitle: string;
        text: string;
        image_index: number;
    };
    projects: ProjectInterface[];
}
