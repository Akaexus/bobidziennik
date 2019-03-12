const webpack = require('webpack');
const path = require('path');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

module.exports = {
	module: {
		rules: [
			{
				test: /\.(scss|css)$/,
				use: [
					{
						loader: 'style-loader'
					},
					{
						loader: 'css-loader'
					},
					{
						loader: 'sass-loader'
					}
				]
			}, {
				test: /\.(png|svg|jpg|gif)$/,
				use: [
          'file-loader'
				]
			}
		]
	},
  plugins: [new UglifyJsPlugin()],
  entry: './src/index.js',
	output: {
		filename: 'index.js',
		path: path.resolve(__dirname, 'js')
	},
	mode: 'development',
};
