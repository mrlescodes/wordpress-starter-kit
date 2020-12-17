#!/usr/bin/env node

const browserSync = require('browser-sync').create();

const { bannerMessage } = require('../utils');
const browserSyncConfig = require('../../browsersync.config.js');

function start() {
  bannerMessage('Starting development server', 'processing');

  browserSync.init(browserSyncConfig);
}

module.exports = {
  start,
};
