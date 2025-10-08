import {DateTime} from "luxon";
import {nextTick} from "vue";

export const getGifImage = (imageUrl: string): string => {
    if (imageUrl.endsWith('.gif')) {
        nextTick(() => {
            imageUrl += '?v=' + DateTime.now().toSeconds();
        })
    }
    return imageUrl;
}
