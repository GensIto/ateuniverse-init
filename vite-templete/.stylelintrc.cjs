module.exports = {
  extends: ['stylelint-config-standard-scss', 'stylelint-config-recess-order', 'stylelint-config-prettier-scss'],
  rules: {
    'scss/at-rule-no-unknown': [
      true,
      {
        ignoreAtRules: ['apply', 'layer', 'responsive', 'screen', 'tailwind']
      }
    ],
    'selector-class-pattern': null,
    'declaration-empty-line-before': 'never',
    'rule-empty-line-before': [
      'always',
      {
        ignore: ['first-nested', 'after-comment']
      }
    ],
    'alpha-value-notation': 'number',
    'block-no-empty': true,
    'declaration-block-no-duplicate-custom-properties': true,
    'declaration-block-no-duplicate-properties': true,
    'keyframe-block-no-duplicate-selectors': true,
    'no-duplicate-at-import-rules': true,
    'color-no-invalid-hex': true,
    'function-calc-no-unspaced-operator': true,
    'keyframe-declaration-no-important': true,
    'custom-property-no-missing-var-function': true,
    'declaration-no-important': true,
    'max-nesting-depth': 2,
    'import-notation': 'string',
    'no-invalid-position-at-import-rule': null,
    'selector-id-pattern': null
  }
};
