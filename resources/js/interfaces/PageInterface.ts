export default interface PageInterface {
    pageProps:{
        recaptcha_site_key: string;
        locale: string;
        socials: {
            facebook: string;
            linkedin: string;
            mail: string;
            github: string;
        },
        company: {
            email: string;
            phone: string;
            address: {
                street: string;
                number: string;
                zip: string;
                city: string;
            },
            btw: string;
            accountNumber: string;
        }
    }

    [key: string]: string | number | object | boolean;
}
