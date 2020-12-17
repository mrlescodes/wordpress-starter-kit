const { merge } = require('webpack-merge');
const ImageMinimizerPlugin = require('image-minimizer-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const common = require('./webpack.common.js');

const mode = 'production';

module.exports = merge(common(mode), {
  mode,

  plugins: [
    new ImageMinimizerPlugin({
      minimizerOptions: {
        plugins: [
          [
            'gifsicle',
            {
              interlaced: true,
            },
          ],
          [
            'jpegtran',
            {
              progressive: true,
            },
          ],
          [
            'optipng',
            {
              optimizationLevel: 5,
            },
          ],
          [
            'svgo',
            {
              plugins: [
                {
                  inlineStyles: {
                    onlyMatchedOnce: false,
                  },
                },
                { removeViewBox: false },
                {
                  removeUselessStrokeAndFill: {
                    removeNone: true,
                  },
                },
              ],
            },
          ],
        ],
      },
    }),
  ],

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
