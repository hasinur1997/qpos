const path = require('path');

const entryPoint = {
    frontend: './assets/src/frontend/index.js',
    admin: './assets/src/admin/index.js',
}

const exportPath = path.resolve(__dirname, './assets/js')

module.exports = {
    entry: entryPoint,
    output: {
        path: exportPath,
        filename: '[name].js'
    },
    resolve: {
        alias: {
            frontend: path.resolve(__dirname, 'assets/src/frontend/'),
            admin: path.resolve(__dirname, 'assets/src/admin/'),
        }
    },
    module: {
        rules: [
            {
                test: /\.(js|jsx)$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader'
                }
            }
        ],
    },
}