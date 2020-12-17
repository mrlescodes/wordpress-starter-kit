#!/usr/bin/env node

const { program } = require('commander');
const { build, start } = require('../commands');

program
  .command('build')
  .description('Builds the project assets.')
  .option('-d, --dev', 'Build project assets for development.')
  .option('-w, --watch', 'Build project assets in watch mode.')
  .action((options) => build(options));

program.command('start').description('Starts the development server.').action(start);

program.parse(process.argv);
