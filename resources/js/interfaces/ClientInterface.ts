export interface ClientInterface {
    name: string;
    image: string | null;
    id: number;
}

export const placeholderClient: ClientInterface = {
    name: '',
    image: null,
    id: 0
}
