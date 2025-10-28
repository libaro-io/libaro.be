import {BlockInterface} from "@interfaces/BlockInterface";

export interface VacancyInterface {
    title: string;
    description: string | null;
    slug: string;
    image: string | null;
    blocks?: BlockInterface[]
}
