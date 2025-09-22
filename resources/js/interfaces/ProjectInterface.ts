import {ClientInterface} from "@interfaces/ClientInterface";

export interface ProjectInterface {
    name: string;
    type: string;
    client: ClientInterface;
}
