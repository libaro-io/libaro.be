import PageInterface from "@interfaces/PageInterface";
import {usePage} from "@inertiajs/vue3";

export const useS3Image = (key: string | null): string | null => {
    if(key == null){
        return null;
    }

    const page = usePage<PageInterface>();
    return `${page.props.pageProps.assets.s3.prefix}${key}`;
}
