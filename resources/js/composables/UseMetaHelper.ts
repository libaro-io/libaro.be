import { TranslationKey } from "../translations/lang-keys";

// Get all SEO keys that start with "seo.pages."
type SeoKeys = Extract<TranslationKey, `seo.pages.${string}.${string}`>;

// Extract base keys from SEO keys
type ExtractBaseKeys<T> = T extends `seo.pages.${infer K}.${string}` ? K : never;
type BaseSeoKeys = ExtractBaseKeys<SeoKeys>;

// Enforces that for every BaseKey, both the .title and .description keys exist in translations.
type RequiredSeoKeys = {
    [K in BaseSeoKeys]: {
        title: `seo.${K}.title`;
        description: `seo.${K}.description`;
    }
}

/**
 * A type union of all SEO root keys (e.g., "contact" | "home")
 * that are guaranteed to have both a `.title` and `.description` translation.
 */
export type SeoMetaKey = keyof RequiredSeoKeys;
