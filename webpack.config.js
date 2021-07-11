const path = require("path");
const webpack = require("webpack");
const HtmlWebpackPlugin = require("html-webpack-plugin");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
	mode: "development",
	entry: ["./src/js/index.js"],
	output: {
		filename: "[name].js",
		path: path.resolve(__dirname, "dist"),
		publicPath: "",
	},
	devtool: "inline-source-map",
	devServer: {
		contentBase: "./dist",
	},
	module: {
		rules: [
			{
				test: /\.(png|svg|jpg|jpeg|gif|mp3)$/i,
				type: "asset/resource",
				generator: {
					//If emitting file, the file path is
					filename: "images/[name][ext][query]",
				},
			},
			{
				test: /\.s[ac]ss$/i,
				use: [
					// fallback to style-loader in development
					process.env.NODE_ENV !== "production"
						? "style-loader"
						: MiniCssExtractPlugin.loader,
					"css-loader",
					"sass-loader",
				],
			},
			{
				test: /\.css$/,
				use: [{ loader: "style-loader" }, { loader: "css-loader" }],
			},
			// {
			// 	test: /\.(jpe?g|png|gif)$/i,
			// 	use: [{ loader: "file-loader" }],
			// 	// options: {
			// 	// 	name: "[name].[ext]",
			// 	// 	outputPath: "assets/images/",
			// 	// 	//the images will be emited to dist/assets/images/ folder
			// 	// },
			// },
		],
	},
	plugins: [
		new CleanWebpackPlugin({
			cleanStaleWebpackAssets: false,
		}),
		new HtmlWebpackPlugin({
			title: "Development",
			// Load a custom template (lodash by default)
			filename: "index.html",
			template: "src/html/pages/index.html",
		}),
		new HtmlWebpackPlugin({
			title: "Development",
			// Load a custom template (lodash by default)
			filename: "contact.html",
			template: "src/html/pages/contact.html",
		}),
		new HtmlWebpackPlugin({
			title: "Single",
			filename: "single.html",
			template: "src/html/pages/single.html",
		}),
		new HtmlWebpackPlugin({
			title: "404",
			filename: "404.html",
			template: "src/html/pages/404.html",
		}),
		new MiniCssExtractPlugin({
			// Options similar to the same options in webpackOptions.output
			// both options are optional
			filename: "[name].css",
			chunkFilename: "[id].css",
		}),
		new webpack.ProvidePlugin({
			$: "jquery",
			jQuery: "jquery",
			"window.jQuery": "jquery'",
			"window.$": "jquery",
		}),
	],
};
