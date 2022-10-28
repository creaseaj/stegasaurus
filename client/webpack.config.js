const path = require("path");
const HtmlWebpackPlugin = require("html-webpack-plugin");

const PORT = 3001;

module.exports = {
    entry: path.resolve(__dirname, "./src/index.js"),
    devServer: {
        // contentBase: path.join(__dirname, "dist"),
        port: PORT,
    },
    output: {
        publicPath: "auto",
    },
    resolve: {
        extensions: [".js", ".jsx"],
        fallback: {
            fs: false,
            path: false,
            util: false,
            stream: false,
            zlib: false,
            assert: false,
            http: false,
            url: false,
            querystring: false,
            https: false
        },
    },
    module: {
        rules: [
            {
                test: /\.css$/i,
                use: ["style-loader", "css-loader"],
            },
            {
                test: /\.svg$/,
                use: ['@svgr/webpack', 'url-loader'],
            },
            {
                test: /\.(js|jsx)$/,
                exclude: /node_modules/,
                use: ["babel-loader"],
            },
        ],
    },
    plugins: [
        new HtmlWebpackPlugin({
            manifest: "./public/manifest.json",
            favicon: "./public/favicon.ico",
            template: "./public/index.html",
        }),
    ],
};