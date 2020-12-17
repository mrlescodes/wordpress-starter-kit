module.exports = {
  entries: {
    scripts: './assets/js/main.js',
    styles: './assets/scss/main.scss',
  },
  filename: {
    js: 'js/[name].js',
    css: 'css/[name].css',
  },
  paths: {
    src: {
      base: './assets/',
      css: './assets/scss/',
      js: './assets/js/',
    },
    dist: {
      base: './dist/',
    },
  },
  stats: {
    // Copied from `'minimal'`.
    all: false,
    errors: true,
    modules: true,
    warnings: true,
    // Our additional options.
    assets: true,
    colors: true,
    errorDetails: true,
    excludeAssets: /\.(jpe?g|png|gif|ico|svg|eot|ttf|woff|woff2)$/i,
    moduleTrace: true,
    performance: true,
  },
  performance: {
    maxAssetSize: 100000,
  },
  CopyWebpackPlugin: {
    from: '**/*.{jpg,jpeg,png,gif,ico,svg,eot,ttf,woff,woff2}',
    to: '[path][name].[ext]',
  },
};
