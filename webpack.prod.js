const { merge } = require('webpack-merge');
const TerserPlugin = require('terser-webpack-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const common = require('./webpack.common.js');

const mode = 'production';

module.exports = merge(common(mode), {
  mode,

  optimization: {
    minimize: true,

    minimizer: [
      new TerserPlugin({
        parallel: true,
      }),

      new CssMinimizerPlugin({
        parallel: true,
      }),
    ],
  },
});
