import {ClientInterface, placeholderClient} from "@interfaces/ClientInterface";
import {BlockInterface} from "@interfaces/BlockInterface";

export interface ProjectInterface {
    slug: string;
    name: string;
    description: string | null;
    type: string;
    is_product: boolean;
    image: string | null;
    client: ClientInterface;
    client_url: string | null;
    blocks?: BlockInterface[];
    tags: string[];
}

export const placeholderProject: ProjectInterface = {
    slug: '',
    name: '',
    description: null,
    type: '',
    is_product: false,
    image: null,
    client: placeholderClient,
    client_url: null,
    tags: [],
}
