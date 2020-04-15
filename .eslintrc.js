module.exports = {
  parser: 'babel-eslint',
  extends: [
    'eslint:recommended',
    'plugin:react/recommended',
  ],
  plugins: [
    'react-hooks',
    'babel',
    'react',
  ],
  env: {
    browser: true,
    node: true,
    es6: true,
  },
  parserOptions: {
    useJSXTextNode: true,
    ecmaVersion: 2020,
    sourceType: 'module',
    ecmaFeatures: {
      modules: true,
      jsx: true,
    },
  },
  globals: {
    wp: false,
    __webpack_public_path__: true, // This is needed for dynamic imports
  },
  settings: {
    'import/resolver': {
      node: {
        extensions: ['.js', '.jsx', '.json'],
      },
    },
    react: {
      version: 'v16.9.0', // This is a current React version in WordPress 5.4
    },
  },
  rules: {
    'no-console': 'warn',
    'no-unused-vars': 'warn',
    'react-hooks/rules-of-hooks': 'error',
    'react-hooks/exhaustive-deps': 'warn',
  },
};
