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