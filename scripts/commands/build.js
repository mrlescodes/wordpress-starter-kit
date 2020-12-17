#!/usr/bin/env node

const path = require('path');
const webpack = require('webpack');
const { bannerMessage } = require('../utils');
const PROJECT_ROOT = path.join(path.dirname(__filename), '../../');
const { webpackConfig } = require(`${PROJECT_ROOT}/tooling.config.js`);

function webpackErrorHandler(error, stats) {
  // Fatal errors
  if (error) {
    bannerMessage('Webpack: Fatal errors', 'error');
    console.log(error.stack || error);
    if (error.details) {
      console.log(error.details);
    }
    bannerMessage('Webpack: Compilation failed', 'error');
    return;
  }

  const info = stats.toJson();

  // Compilation errors
  if (stats.hasErrors()) {
    bannerMessage('Webpack: Compilation errors', 'error');
    console.log(info.errors);
    bannerMessage('Webpack: Compilation failed', 'error');
    return;
  }

  // ---
  // If we have made it this far then the compilation was a success
  // ---

  // Customise the returned webpack stats
  // https://webpack.js.org/configuration/stats/
  console.log(stats.toString(webpackConfig.stats));

  bannerMessage('Webpack: Compilation successful', 'success');
}

function build(options) {
  const config = options.dev
    ? require(`${PROJECT_ROOT}/webpack.dev`)
    : require(`${PROJECT_ROOT}/webpack.prod`);

  const compiler = webpack(config);

  return options.watch
    ? compiler.watch({}, webpackErrorHandler)
    : compiler.run(webpackErrorHandler);
}

module.exports = {
  build,
};
