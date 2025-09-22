import {ClientInterface} from "@interfaces/ClientInterface";
import {ProjectBlockInterface} from "@interfaces/ProjectBlockInterface";

export interface ProjectInterface {
    slug: string;
    name: string;
    description: string | null;
    type: string;
    client: ClientInterface;
    blocks?: ProjectBlockInterface[]
}
