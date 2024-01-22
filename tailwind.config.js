/** @type {import('tailwindcss').Config} */
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
      xxs: "320px",
      xs: "480px",
      sm: "640px",
      md: "768px",
      lg: "1024px",
      xl: "1280px",
      "2xl": "1440px",
      "3xl": "1920px",
    },
    extend: {
      fontFamily: {
        sans: ["Noto Sans", ...defaultTheme.fontFamily.sans],
        heading: ["Aero Matics", ...defaultTheme.fontFamily.sans],
      },
      width: {
        "full-p-1": "calc(100% - 2.5rem)",
        "full-p-2": "calc(100% - 4rem)",
      },
      maxWidth: {
        content: "60rem", // 960px
        wide: "64rem", // 1024px
        big: "90rem", // 1440px
      },

      typography: (theme) => ({
        DEFAULT: {
          css: {
            "--tw-prose-headings": theme("colors.black"),
            "--tw-prose-body": theme("colors.black"),
            "--tw-prose-links": theme("colors.black"),
            "--tw-prose-bold": "inherit",
            maxWidth: false,
            fontSize: theme("fontSize.base")[0],

            a: {
              "text-decoration": "none",
              "text-underline-offset": "0.425rem",
              "font-weight": 400,
              "&:hover": {
                "text-decoration": "underline",
              },
            },

            "h1, h2, h3, h4, h5, h6": {
              "font-weight": 700,
              textTransform: "uppercase",
              a: {
                "&:hover": {
                  "text-decoration": "none",
                },
              },
            },

            h1: {
              fontSize: theme("fontSize.3xl")[0],
            },
            h2: {
              fontSize: theme("fontSize.2xl")[0],
            },
            h3: {
              fontSize: theme("fontSize.2xl")[0],
            },
          },
        },

        lg: {
          css: {
            fontSize: theme("fontSize.xl")[0],

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
        md: {
          css: {
            fontSize: theme("fontSize.lg")[0],

            h1: {
              fontSize: theme("fontSize.4xl")[0],
            },
            h2: {
              fontSize: theme("fontSize.3xl")[0],
            },
            h3: {
              fontSize: theme("fontSize.2xl")[0],
            },
          },
        },
      }),
    },
  },
  safelist: ["btn", "btn-sm", "btn-primary", "btn-secondary", "btn-outline"],
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
          "background-color": "transparent",
          display: "inline-block",
          "border-radius": theme("borderRadius.DEFAULT"),
          border: "1px solid transparent",
          padding: "0.525rem 1.25rem",
          "text-align": "center",
          "line-height": "1.5",
          "vertical-align": "middle",
          "text-decoration": "none",
          transition:
            "color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out",
          "user-select": "none",
          "&:hover": {
            "text-decoration": "none",
          },
        },
        ".btn-sm": {
          padding: "0.25rem 0.5rem",
          "font-size": "0.875rem",
          "border-radius": theme("borderRadius.xs"),
        },
        ".btn-primary": {
          color: theme("colors.white"),
          "background-color": theme("colors.gray.500"),
          "&:hover": {
            "background-color": theme("colors.gray.600"),
            color: theme("colors.white"),
          },
        },
        ".btn-secondary": {
          color: theme("colors.white"),
          "background-color": theme("colors.gray.700"),
          "&:hover": {
            "background-color": theme("colors.gray.800"),
            color: theme("colors.white"),
          },
        },
        ".btn-outline": {
          color: theme("colors.black"),
          "border-color": theme("colors.gray.500"),
          "&:hover": {
            "background-color": theme("colors.gray.600"),
            "border-color": theme("colors.gray.600"),
            color: theme("colors.white"),
          },
        },
      });
    }),
    require("@tailwindcss/forms"),
    require("@tailwindcss/aspect-ratio"),
    require("@tailwindcss/typography"),
    require("tailwind-scrollbar")({ nocompatible: true }),
  ],
};
