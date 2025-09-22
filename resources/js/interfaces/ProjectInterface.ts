import {ClientInterface} from "@interfaces/ClientInterface";

export interface ProjectInterface {
    slug: string;
    name: string;
    description: string | null;
    type: string;
    client: ClientInterface;
}
