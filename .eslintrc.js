module.exports = {
  root: true,
  parserOptions: {
    parser: 'babel-eslint',
  },
  env: {
    browser: true,
  },
  extends: ['standard', 'plugin:vue/recommended', 'plugin:prettier/recommended', 'prettier/vue'],
  plugins: [
    'vue',
    'prettier', // prettierをESLintと併用する
  ],
  rules: {
    // Prettierのルール
    'prettier/prettier': [
      'error',
      {
        printWidth: 120,
        tabWidth: 2,
        useTabs: false,
        singleQuote: true,
        trailingComma: 'all',
        bracketSpacing: true,
        arrowParens: 'avoid',
        semi: false,
        endOfLine: 'lf',
      },
    ],
  },
}
