import {BlockInterface} from "@interfaces/BlockInterface";

export interface BlogInterface {
    title: string;
    slug: string;
    date: string;
    tags: string[];
    link: string | null;
    author: string;
    blocks?: BlockInterface[]
}
