export interface LinkBuilderInterface {
    url: string;
    method: 'get' | 'post' | 'put' | 'delete' | 'patch';
    options?: {
        [key: string]: unknown;
    }
}
