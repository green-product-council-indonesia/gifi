const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
	theme: {
		extend: {
			fontFamily: {
				sans: ["Inter var", ...defaultTheme.fontFamily.sans],
			},
		},
	},
	variants: {
		extend: {
			backgroundColor: ["active"],
		},
	},
	purge: {
		content: ["./app/**/*.php", "./resources/**/*.html", "./resources/**/*.js", "./resources/**/*.jsx", "./resources/**/*.ts", "./resources/**/*.tsx", "./resources/**/*.php", "./resources/**/*.vue", "./resources/**/*.twig", "./vendor/wire-elements/modal/resources/views/*.blade.php", "./storage/framework/views/*.php"],
		options: {
			defaultExtractor: (content) => content.match(/[\w-/.:]+(?<!:)/g) || [],
			whitelistPatterns: [/-active$/, /-enter$/, /-leave-to$/, /show$/],
			safelist: ["sm:max-w-2xl"],
		},
	},
	plugins: [require("@tailwindcss/forms"), require("@tailwindcss/typography")],
};
