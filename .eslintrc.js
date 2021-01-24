module.exports = {
  root: true, // So parent files don't get applied
  env: {
    es6: true,
    browser: true,
    node: true,
  },
  extends: [
    'plugin:import/recommended',
    'airbnb-base',
    'plugin:eslint-comments/recommended',
    'plugin:promise/recommended',
    'plugin:unicorn/recommended',
    'prettier',
  ],
  rules: {
    // https://eslint.org/docs/rules/arrow-body-style
    'arrow-body-style': ['error', 'always'],

    // https://eslint.org/docs/rules/no-use-before-define
    'no-use-before-define': ['error', { functions: false }],

    // https://basarat.gitbooks.io/typescript/docs/tips/defaultIsBad.html
    'import/prefer-default-export': 'off',

    // Missing yarn workspace support
    'import/no-extraneous-dependencies': 'off',

    // Allow disabling of eslint for a whole file
    'eslint-comments/disable-enable-pair': ['error', { allowWholeFile: true }],

    // Enable uppercase Component filenames
    'unicorn/filename-case': 'off',

    // Common abbreviations are known and readable
    'unicorn/prevent-abbreviations': 'off',
  },
  globals: {
    jQuery: true,
    $: true,
    wskt: true,
    wskts: true,
    google: true,
  },
};
