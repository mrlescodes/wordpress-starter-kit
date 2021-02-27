const { merge } = require('webpack-merge');
const common = require('./webpack.common.js');

const mode = 'development';

module.exports = merge(common(mode), {
  mode,

  cache: true,

  devtool: 'eval-cheap-module-source-map',
});
