// eslint-disable-next-line @typescript-eslint/no-var-requires
const path = require( 'path' );
// eslint-disable-next-line @typescript-eslint/no-var-requires
const jetpackWebpackConfig = require( '@automattic/jetpack-webpack-config/webpack' );
const verbumConfig = require( './verbum.webpack.config.js' );

module.exports = [
	...verbumConfig,
	{
		entry: {
			'block-theme-previews': './src/features/block-theme-previews/index.js',
			'core-customizer-css':
				'./src/features/custom-css/custom-css/js/core-customizer-css.core-4.9.js',
			'core-customizer-css-preview':
				'./src/features/custom-css/custom-css/js/core-customizer-css-preview.js',
			'customizer-control': './src/features/custom-css/custom-css/css/customizer-control.css',
			'error-reporting': './src/features/error-reporting/index.js',
			'jetpack-global-styles': './src/features/jetpack-global-styles/index.js',
			'jetpack-global-styles-customizer-fonts':
				'./src/features/jetpack-global-styles/customizer-fonts/index.js',
			'override-preview-button-url':
				'./src/features/override-preview-button-url/override-preview-button-url.js',
			'paragraph-block-placeholder':
				'./src/features/paragraph-block-placeholder/paragraph-block-placeholder.js',
			'tags-education': './src/features/tags-education/tags-education.js',
			'wpcom-admin-bar': './src/features/wpcom-admin-bar/wpcom-admin-bar.scss',
			'wpcom-sidebar-notice': './src/features/wpcom-sidebar-notice/wpcom-sidebar-notice.scss',
		},
		mode: jetpackWebpackConfig.mode,
		devtool: jetpackWebpackConfig.devtool,
		output: {
			...jetpackWebpackConfig.output,
			filename: '[name]/[name].js',
			path: path.resolve( __dirname, 'src/build' ),
		},
		optimization: {
			...jetpackWebpackConfig.optimization,
		},
		resolve: {
			...jetpackWebpackConfig.resolve,
		},
		node: false,
		plugins: [
			...jetpackWebpackConfig.StandardPlugins( {
				MiniCssExtractPlugin: { filename: '[name]/[name].css' },
			} ),
		],
		module: {
			strictExportPresence: true,
			rules: [
				// Transpile JavaScript.
				jetpackWebpackConfig.TranspileRule( {
					exclude: /node_modules\//,
				} ),

				// Transpile @automattic/jetpack-* in node_modules too.
				jetpackWebpackConfig.TranspileRule( {
					includeNodeModules: [ '@automattic/jetpack-' ],
				} ),

				// Handle CSS.
				jetpackWebpackConfig.CssRule( {
					extensions: [ 'css', 'scss' ],
					extraLoaders: [ 'sass-loader' ],
				} ),

				// Handle images.
				jetpackWebpackConfig.FileRule(),
			],
		},
		externals: {
			...jetpackWebpackConfig.externals,
			jetpackConfig: JSON.stringify( {
				consumer_slug: 'jetpack-mu-wpcom',
			} ),
		},
	},
];
