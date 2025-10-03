import {DateTime} from "luxon";

export const getGifImage = (imageUrl: string): string => {
    if (imageUrl.endsWith('.gif')) {
        imageUrl += '?v=' + DateTime.now().toSeconds();
    }

    return imageUrl;
}
