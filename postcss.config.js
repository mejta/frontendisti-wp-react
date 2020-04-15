module.exports = ({ file, options, env }) => ({
  plugins: {
    'postcss-import': {},
    'postcss-preset-env': options['postcss-preset-env'] ? options['postcss-preset-env'] : {},
    'cssnano': env === 'production' ? {} : false,
    'postcss-font-display': { display: 'swap', replace: false },
  }
});
