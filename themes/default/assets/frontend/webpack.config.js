const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
    entry: ['./src/scss/app.scss', './src/js/app.js'],
    output: {
        path: path.resolve(__dirname, './dist'),
        filename: 'app.js',
    },
    module: {
        rules: [
            {
                test: /\.s[ac]ss$/i,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                    },
                    {
                        loader: 'css-loader',
                        options: {
                            url: false
                        }
                    },
                    {
                        loader: 'sass-loader'
                    }
                ],
            },
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: "app.css"
        })
    ],
    resolve: {
        alias: {

        }
    }
}