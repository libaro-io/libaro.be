const colors = require("tailwindcss/colors");

module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      screens: {
        max: "1440px",
      },
      colors: {
        "primary-darkest": "#3e53ab",
        "primary-dark": "#0091ff",
        "primary-medium": "#89bbe1",
        "primary-light": "#f2f8fa",
        footer: "#3a7bbd",
        secondary: "#fc9803",
        "secondary-light": "#fb9801",
        "projects-bg": "#f2f8fa",
        "project-border": "#ebf4f7",
        "button-dark": "#0568e5",
        "grey-light": "rgba(243,241,250,0.30980392156862746)",
        "grey-dark": "rgba(68,62,172,0.06)",
      },
      fontFamily: {
        gilroy: ["gilroy", "sans-serif"],
        grotesk: ["grotesk", "sans-serif"],
      },
      fontSize: {
        h1: ["4.5rem", { lineHeight: "1" }], // ~72px (reduced from 90px)
        h2: ["3.9rem", { lineHeight: "1" }], // ~62px (reduced from 78px)
        h3: ["1.8rem", { lineHeight: "1" }], // ~29px (reduced from 36px)
        h4: ["0.8rem", { lineHeight: "1" }], // ~13px (reduced from 16px)
        menu: ["1.125rem", { lineHeight: "1" }], // ~14px (reduced from 18px)
        paragraph: "1.2rem", // reduced from 1rem
        "7.5xl": "72px", // reduced from 90px
      },
      maxWidth: {
        "8xl": "90rem", // 1440px
        "9xl": "93.75rem", // 1500px
      },
      spacing: {
        7.5: "1.875rem", // 30px
        10.5: "2.625rem", // 42px
        15: "3.75rem", // 60px
        22: "5.625rem",
        29: "7.187rem", // 115px
        45: "11.25rem", // 180px
        74: "18.75rem", // 300px
        90: "90px",
        205: "205px",
        350: "350px",
        420: "420px",
        620: "620px",
        630: "630px",
        768: "768px",
        786: "786px",
        840: "840px",
        856: "856px",
        920: "920px",
      },
      borderWidth: {
        "3px": "3px",
        "6px": "6px",
        10: "10px",
        20: "20px",
        30: "30px",
      },
      borderRadius: {
        "inner-sm": "12px",
        inner: "30px",
        "outer-sm": "40px",
        "outer-md": "45px",
        outer: "50px",
      },
      gridTemplateRows: {
        "showcases-small": "500px repeat(5, minmax(0, 1fr))",
      },
      gridTemplateColumns: {
        10: "repeat(10, minmax(0, 1fr))",
        13: "repeat(13, minmax(0, 1fr))",
        14: "repeat(14, minmax(0, 1fr))",
        15: "repeat(15, minmax(0, 1fr))",
        17: "repeat(17, minmax(0, 1fr))",
        24: "repeat(24, minmax(0, 1fr))",
      },
      gridColumn: {
        "span-10": "span 10 / span 10",
        "span-11": "span 11 / span 11",
        "span-12": "span 12 / span 12",
        "span-13": "span 13 / span 13",
        "span-14": "span 14 / span 14",
        "span-15": "span 15 / span 15",
        "span-17": "span 17 / span 17",
        "span-24": "span 24 / span 24",
      },
      gridColumnStart: {
        13: "13",
        14: "14",
        15: "15",
      },
      minHeight: {
        500: "500px",
      },
      grayscale: {
        50: "50%",
      },
      typography: (theme) => ({
        DEFAULT: {
          css: {
           img: {
            display: "inline",
           },
          },
        },
        gray: {
          css: {
            "--tw-prose-body": colors.gray[700],
            "--tw-prose-headings": theme("colors.primary-dark"),
            "--tw-prose-lead": colors.gray[600],
            "--tw-prose-links": theme("colors.primary-dark"),
            "--tw-prose-bold": colors.gray[900],
            "--tw-prose-counters": colors.gray[500],
            "--tw-prose-bullets": colors.gray[300],
            "--tw-prose-hr": colors.gray[200],
            "--tw-prose-quotes": colors.gray[900],
            "--tw-prose-quote-borders": colors.gray[200],
            "--tw-prose-captions": colors.gray[500],
            "--tw-prose-code": theme("colors.primary-darkest"),
            "--tw-prose-pre-code": theme("colors.primary-darkest"),
            "--tw-prose-pre-bg": theme("colors.primary-light"),
            "--tw-prose-th-borders": colors.gray[300],
            "--tw-prose-td-borders": colors.gray[200],
            "--tw-prose-invert-body": colors.gray[300],
            "--tw-prose-invert-headings": colors.white,
            "--tw-prose-invert-lead": colors.gray[400],
            "--tw-prose-invert-links": colors.white,
            "--tw-prose-invert-bold": colors.white,
            "--tw-prose-invert-counters": colors.gray[400],
            "--tw-prose-invert-bullets": colors.gray[600],
            "--tw-prose-invert-hr": colors.gray[700],
            "--tw-prose-invert-quotes": colors.gray[100],
            "--tw-prose-invert-quote-borders": colors.gray[700],
            "--tw-prose-invert-captions": colors.gray[400],
            "--tw-prose-invert-code": colors.white,
            "--tw-prose-invert-pre-code": colors.gray[300],
            "--tw-prose-invert-pre-bg": "rgb(0 0 0 / 50%)",
            "--tw-prose-invert-th-borders": colors.gray[600],
            "--tw-prose-invert-td-borders": colors.gray[700],
          },
        },
      }),
    },

  },
  plugins: [require("@tailwindcss/forms"), require("@tailwindcss/typography")],
};
