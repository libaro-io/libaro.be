import {ClientInterface} from "@interfaces/ClientInterface";
import {BlockInterface} from "@interfaces/BlockInterface";

export interface ProjectInterface {
    slug: string;
    name: string;
    description: string | null;
    type: string;
    client: ClientInterface;
    blocks?: BlockInterface[]
}
