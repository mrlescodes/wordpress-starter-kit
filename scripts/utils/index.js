/* eslint-disable no-console */
const { brightBlue, red, yellow, brightGreen } = require('colors');

const variants = {
  processing: brightBlue,
  error: red,
  warning: yellow,
  success: brightGreen,
};

function bannerMessage(message, variant = 'processing') {
  if (!(variant in variants)) {
    const variantKeys = Object.keys(variants);

    throw new Error(`Variant does not exist, please select from: ${variantKeys.join(', ')}`);
  }

  const output = `
--------------------------------------
${message} 
--------------------------------------
`;

  console.log(variants[variant](output));
}

module.exports = { bannerMessage };
