
export default interface PageInterface {
    pageProps: {
        recaptcha_site_key: string;
        locale: string;
        socials: {
            facebook: string;
            linkedin: string;
            mail: string;
            github: string;
        },
        company: {
            name: string;
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
        },
        assets: {
            s3: {
                prefix: string
            }
        },
        url: {
            search: string;
            origin: string;
            pathname: string;
            href: string;
        },
    }

    [key: string]: string | number | object | boolean;
}
