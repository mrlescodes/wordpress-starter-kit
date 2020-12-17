const path = require('path');
const { cosmiconfigSync } = require('cosmiconfig');
const webpack = require('webpack');
const RemoveEmptyScriptsPlugin = require('webpack-remove-empty-scripts');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');

// Store a reference to cwd as this is subject to change.
const cwd = process.cwd();

/**
 * Resolve a webpack config file
 */
const resolveWebpackConfig = (configPath) => {
  const explorerSync = cosmiconfigSync('webpack');
  try {
    const searchedConfig = configPath ? explorerSync.load(configPath) : explorerSync.search();

    if (!searchedConfig) {
      throw new Error('Webpack config not found');
    }

    return searchedConfig;
  } catch {
    throw new Error('Extended webpack config not found');
  }
};

/**
 * Get our webpack config
 */
const getWebpackConfig = () => {
  const resolvedConfig = resolveWebpackConfig();

  const { config, filepath } = resolvedConfig;
  const { extends: extendsConfig } = config;

  // If this config extends another then merge them.
  if (extendsConfig) {
    // Remove the extends property from the original config.
    delete config.extends;

    // Get the extended config
    const extendedConfigPath = path.join(path.dirname(filepath), extendsConfig);
    const { config: extendedConfig } = resolveWebpackConfig(extendedConfigPath);

    return {
      ...extendedConfig,
      ...config,
    };
  }

  return config;
};

/**
 * Configure entries.
 */
const configureEntries = (entries) => {
  const resolvedEntries = {};

  Object.entries(entries).forEach((entry) => {
    const [key, value] = entry;
    resolvedEntries[key] = path.resolve(cwd, value);
  });

  return resolvedEntries;
};

module.exports = (mode) => {
  const isProduction = mode === 'production';

  const webpackConfig = getWebpackConfig();

  return {
    entry: configureEntries(webpackConfig.entries),

    output: {
      path: path.resolve(cwd, webpackConfig.paths.dist.base),
      filename: webpackConfig.filename.js,
    },

    // Console stats output.
    // @link https://webpack.js.org/configuration/stats/#stats
    stats: webpackConfig.stats,

    // Performance webpackConfig.
    performance: {
      maxAssetSize: webpackConfig.performance.maxAssetSize,
    },

    // Prevent bundling of certain imported packages.
    externals: {
      jquery: 'jQuery',
    },

    // Build rules to handle asset files.
    module: {
      rules: [
        // Scripts.
        {
          test: /\.js$/,
          exclude: /node_modules/,
          use: [
            {
              loader: 'babel-loader',
              options: {
                rootMode: 'upward',
              },
            },
          ],
        },

        // Styles.
        {
          test: /\.(scss|sass)$/,
          include: path.resolve(cwd, webpackConfig.paths.src.css),
          use: [
            {
              loader: MiniCssExtractPlugin.loader,
            },
            {
              loader: 'css-loader',
              options: {
                sourceMap: !isProduction,
                // We copy fonts etc. using CopyWebpackPlugin.
                url: false,
              },
            },
            {
              loader: 'postcss-loader',
              options: {
                postcssOptions: {
                  plugins: ['autoprefixer'],
                },
              },
            },
            {
              loader: 'fast-sass-loader',
              options: {
                includePaths: ['node_modules'],
              },
            },
          ],
        },
      ],
    },

    plugins: [
      // Make jQuery available to our modules
      new webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery',
        'window.jQuery': 'jquery',
        'window.$': 'jquery',
      }),

      // Remove the extra JS files Webpack creates for CSS entries.
      new RemoveEmptyScriptsPlugin({
        silent: isProduction,
      }),

      // Clean the `dist` folder on build.
      new CleanWebpackPlugin({
        cleanStaleWebpackAssets: false,
      }),

      // Extract CSS into individual files.
      new MiniCssExtractPlugin({
        filename: webpackConfig.filename.css,
        chunkFilename: '[id].css',
      }),

      // Copy static assets to the `dist` folder.
      new CopyWebpackPlugin({
        patterns: [
          {
            from: webpackConfig.CopyWebpackPlugin.from,
            to: webpackConfig.CopyWebpackPlugin.to,
            context: path.resolve(cwd, webpackConfig.paths.src.base),
            noErrorOnMissing: true,
          },
        ],
      }),
    ],
  };
};
