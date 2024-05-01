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
    fontSize: {
      sm: "0.875rem",
      base: "1rem",
      lg: "1.125rem",
      xl: "1.25rem",
      "2xl": "1.5625rem",
      "3xl": "1.75rem",
      "4xl": "2.5rem",
      "5xl": "3.25rem",
      "6xl": "4.25rem",
    },
    extend: {
      fontFamily: {
        sans: ["Noto Sans", ...defaultTheme.fontFamily.sans],
      },

      colors: {
        primary: {
          100: "#cfd4dd",
          200: "#a0a9bb",
          300: "#707e99",
          400: "#415377",
          500: "#112855",
          600: "#0e2044",
          700: "#0a1833",
          800: "#071022",
          900: "#030811",
        },
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
      animation: {
        "button-pop": "button-pop 0s ease-out",
        "slide-down": "slide-down 0.35s ease-out",
      },
      keyframes: {
        "button-pop": {
          "0%": {
            transform: "scale(.98)",
          },
          "40%": {
            transform: "scale(1.02)",
          },
          "100%": {
            transform: "scale(1)",
          },
        },
        "slide-down": {
          from: {
            transform: "translateY(-100%)",
          },
          to: {
            transform: "translateY(0)",
          },
        },
      },

      typography: (theme) => ({
        DEFAULT: {
          css: {
            "--tw-prose-headings": theme("colors.primary.500"),
            "--tw-prose-body": theme("colors.black"),
            "--tw-prose-links": theme("colors.primary.600"),
            "--tw-prose-bold": "inherit",
            maxWidth: false,
            fontSize: theme("fontSize.base"),

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
              textTransform: "normal",
              a: {
                "&:hover": {
                  "text-decoration": "none",
                },
              },
            },

            h1: {
              fontSize: theme("fontSize.3xl"),
            },
            h2: {
              fontSize: theme("fontSize.2xl"),
            },
            h3: {
              fontSize: theme("fontSize.2xl"),
            },
          },
        },
        lg: {
          css: {
            fontSize: theme("fontSize.lg"),

            h1: {
              fontSize: theme("fontSize.4xl"),
            },
            h2: {
              fontSize: theme("fontSize.3xl"),
            },
            h3: {
              fontSize: theme("fontSize.2xl"),
            },
          },
        },
      }),
    },
  },
  safelist: ["btn", { pattern: /btn-(primary|secondary|outline)/ }],
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
          display: "inline-flex",
          border: "1px solid transparent",
          "padding-left": "1rem",
          "padding-right": "1rem",
          height: "2.875rem",
          "max-height": "2.875rem",
          "text-align": "center",
          "line-height": "1.5",
          "vertical-align": "middle",
          "text-decoration": "none",
          "align-items": "center",
          "justify-content": "center",
          "flex-shrink": "0",
          "flex-wrap": "wrap",
          "font-size": "inherit",
          cursor: "pointer",
          "border-radius": "0.5rem",
          "transition-duration": "0.25s",
          "transition-timing-function": "cubic-bezier(0,0,.2,1)",
          "transition-property":
            "color,background-color,border-color,opacity,box-shadow,transform",
          "user-select": "none",
          "will-change":
            "color,background-color,border-color,opacity,box-shadow,transform",
          "box-shadow":
            "var(--tw-ring-offset-shadow, 0 0 #0000),var(--tw-ring-shadow, 0 0 #0000), 0 1px 2px 0 rgb(0 0 0 / .05)",
          animation: "button-pop 0.25s ease-out",
          "&:hover": {
            "text-decoration": "none",
          },
          "&:active:hover": {
            animation: "button-pop 0s ease-out",
            transform: "scale(.97)",
          },
          "&:active:focus": {
            animation: "button-pop 0s ease-out",
            transform: "scale(.97)",
          },
        },
        ".btn-sm": {
          padding: "0.25rem 0.5rem",
          "font-size": "0.875rem",
        },
        ".btn-primary": {
          color: theme("colors.white"),
          "background-color": theme("colors.primary.500"),
          "&:hover": {
            "background-color": theme("colors.primary.600"),
            color: theme("colors.white"),
          },
        },
        ".btn-secondary": {
          color: theme("colors.white"),
          "background-color": theme("colors.primary.700"),
          "&:hover": {
            "background-color": theme("colors.primary.800"),
            color: theme("colors.white"),
          },
        },
        ".btn-outline": {
          color: theme("colors.black"),
          "border-color": theme("colors.primary.500"),
          "&:hover": {
            "background-color": theme("colors.primary.600"),
            "border-color": theme("colors.primary.600"),
            color: theme("colors.white"),
          },
        },
      });
    }),
    require("@tailwindcss/forms", {
      strategy: "base", // only generate global styles
    }),
    require("@tailwindcss/aspect-ratio"),
    require("@tailwindcss/typography"),
    require("tailwind-scrollbar")({ nocompatible: true }),
  ],
};
