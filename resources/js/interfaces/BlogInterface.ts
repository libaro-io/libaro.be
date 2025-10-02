import {BlockInterface} from "@interfaces/BlockInterface";

export interface BlogInterface {
    title: string;
    description: string | null;
    slug: string;
    date: string;
    tags: string[];
    link: string | null;
    author: string;
    image: string | null;
    blocks?: BlockInterface[]
}
