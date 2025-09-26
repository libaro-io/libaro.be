export interface ListWithImageInterface {
    title?: string;
    descriptions?: string[];
    listItems: {
        title: string;
        description: string;
        image: string;
    }[]
}
