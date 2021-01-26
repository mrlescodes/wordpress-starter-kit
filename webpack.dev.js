const { merge } = require('webpack-merge');
const common = require('./webpack.common.js');

const mode = 'development';

module.exports = merge(common(mode), {
  mode,

  devtool: 'inline-cheap-module-source-map',
});
