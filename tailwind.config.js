/** @type {import('tailwindcss').Config} */
const theme = require("tailwindcss/defaultTheme");
const defaultTheme = require("tailwindcss/defaultTheme");
const plugin = require("tailwindcss/plugin");

module.exports = {
  content: [
    "./assets/**/*.{css,js}",
    "./**/*.php",
    "./*.php",
    "../../modules/**/*.php",
  ],
  theme: {
    screens: {
      xs: "480px",
      sm: "640px",
      md: "768px",
      lg: "1024px",
      xl: "1280px",
      "2xl": "1440px",
      "3xl": "1920px",
    },
    extend: {
      container: {
        center: true,
        padding: {
          DEFAULT: "1rem",
          md: "0",
        },
        screens: {
          sm: "640px",
          md: "768px",
          lg: "1024px",
          xl: "1280px",
          "2xl": "1440px",
        },
      },
      fontFamily: {
        sans: ["Lato", ...defaultTheme.fontFamily.sans],
      },
      colors: {
        primary: {
          100: "#ceecd8",
          200: "#9dd9b1",
          300: "#6dc789",
          400: "#3cb462",
          DEFAULT: "#0ba13b",
          600: "#09812f",
          700: "#076123",
          800: "#044018",
          900: "#02200c",
        },
        secondary: {
          100: "#fff0cc",
          200: "#ffe199",
          300: "#ffd166",
          400: "#ffc233",
          DEFAULT: "#ffb300",
          600: "#cc8f00",
          700: "#996b00",
          800: "#664800",
          900: "#332400",
        },
      },
      typography: (theme) => ({
        DEFAULT: {
          css: {
            "--tw-prose-headings": theme("colors.black"),
            "--tw-prose-body": theme("colors.black"),
            "--tw-prose-links": theme("colors.primary.DEFAULT"),
            maxWidth: false,
            letterSpacing: "0.035em",
            a: {
              "text-decoration": "none",
              "&:hover": {
                color: theme("colors.primary.700"),
              },
            },
            h1: {
              fontSize: theme("fontSize.3xl")[0],
              textTransform: "uppercase",
              letterSpacing: "0.1em",
            },
            h2: {
              fontSize: theme("fontSize.2xl")[0],
              textTransform: "uppercase",
              letterSpacing: "0.075em",
            },
            h3: {
              fontSize: theme("fontSize.2xl")[0],
              textTransform: "uppercase",
              letterSpacing: "0.056em",
            },
            h4: {
              textTransform: "uppercase",
            },
            h5: {
              textTransform: "uppercase",
            },
            h6: {
              textTransform: "uppercase",
            },
          },
        },

        lg: {
          css: {
            h1: {
              fontSize: theme("fontSize.5xl")[0],
            },
            h2: {
              fontSize: theme("fontSize.4xl")[0],
            },
            h3: {
              fontSize: theme("fontSize.3xl")[0],
            },
          },
        },
      }),
    },
  },
  safelist: ["btn", "btn--primary", "btn--secondary", "btn--secondary-alt"],
  plugins: [
    plugin(function ({ addUtilities, theme }) {
      addUtilities({
        ".text-shadow": {
          "text-shadow": "0 1px 1px rgba(0,0,0,0.3)",
        },
        ".shadow-inner-xl": {
          "box-shadow": "inset 0px 3px 23px rgba(0,0,0,0.25)",
        },
        ".btn": {
          display: "inline-block",
          "border-radius": "14px",
          "padding-left": "1.5rem",
          "padding-right": "1.5rem",
          "padding-top": "0.85rem",
          "padding-bottom": "0.85rem",
          "text-transform": "uppercase",
          "text-align": "center",
          "line-height": "1",
          transition: "all 0.2s ease-in-out",
        },
        ".btn--primary": {
          color: theme("colors.white"),
          "background-color": theme("colors.primary.DEFAULT"),
          "&:hover": {
            "background-color": theme("colors.primary.600"),
          },
        },
        ".btn--secondary": {
          color: theme("colors.primary.DEFAULT"),
          "background-color": theme("colors.white"),
          "&:hover": {
            "background-color": theme("colors.secondary.DEFAULT"),
            color: theme("colors.white"),
          },
        },
        ".btn--secondary-alt": {
          color: theme("colors.white"),
          "background-color": theme("colors.secondary.DEFAULT"),
          "&:hover": {
            "background-color": theme("colors.secondary.600"),
            color: theme("colors.white"),
          },
        },
      });
    }),
    require("@tailwindcss/forms"),
    require("@tailwindcss/aspect-ratio"),
    require("@tailwindcss/container-queries"),
    require("@tailwindcss/typography"),
    require("tailwind-scrollbar")({ nocompatible: true }),
  ],
};
