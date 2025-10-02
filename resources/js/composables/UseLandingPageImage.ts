import landingPageHomeImage1 from "@assets/images/libaro-team_1.webp";
import landingPageHomeImage2 from "@assets/images/libaro-team_2.webp";
import landingPageHomeImage3 from "@assets/images/libaro-team_3.webp";
import landingPageHomeImage4 from "@assets/images/libaro-team_4.webp";
import landingPageHomeImage5 from "@assets/images/libaro-team_5.webp";
import landingPageHomeImage6 from "@assets/images/libaro-team_6.webp";
import landingPageHomeImage7 from "@assets/images/libaro-team_7.webp";
import landingPageHomeImage8 from "@assets/images/libaro-team_8.webp";
import landingPageHomeImage9 from "@assets/images/libaro-team_9.webp";
import landingPageHomeImage10 from "@assets/images/libaro-team_10.webp";
import landingPageHomeImage11 from "@assets/images/libaro-team_11.webp";
import landingPageHomeImage12 from "@assets/images/libaro-team_12.webp";
import landingPageHomeImage13 from "@assets/images/libaro-team_13.webp";
import landingPageHomeImage14 from "@assets/images/libaro-team_14.webp";

export const getLandingPageImage = (image_index: number | null): string => {
    if(image_index === null) {
        return landingPageHomeImage1;
    }

    const images = [
        landingPageHomeImage1,
        landingPageHomeImage2,
        landingPageHomeImage3,
        landingPageHomeImage4,
        landingPageHomeImage5,
        landingPageHomeImage6,
        landingPageHomeImage7,
        landingPageHomeImage8,
        landingPageHomeImage9,
        landingPageHomeImage10,
        landingPageHomeImage11,
        landingPageHomeImage12,
        landingPageHomeImage13,
        landingPageHomeImage14,
    ];

    return images[image_index - 1];
}
