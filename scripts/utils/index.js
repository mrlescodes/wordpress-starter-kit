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

    console.log(
      variants['error'](`Variant does not exist, please select from: ${variantKeys.join(', ')}`),
    );

    return process.exit(1);
  }

  const output = `
--------------------------------------
${message} 
--------------------------------------
`;

  console.log(variants[variant](output));
}

module.exports = { bannerMessage };
