/** @type {import('tailwindcss').Config} */
import defaultTheme from "tailwindcss/defaultTheme";

module.exports = {
  presets: [
    // Manage Tailwind Typography's configuration in a separate file.
    require("./tailwind-typography.config.js"),
  ],
  content: ["./assets/**/*.{css,js}", "./**/*.php"],
  theme: {
    extend: {
      sans: ["Inter", ...defaultTheme.fontFamily.sans],
    },
  },
  plugins: [
    require("@tailwindcss/forms"),
    require("@tailwindcss/aspect-ratio"),
    require("@tailwindcss/container-queries"),
  ],
};
