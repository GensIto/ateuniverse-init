import '@babel/polyfill';

jQuery(function ($) {
  console.log('test.jsが読みこまれた');
  $('body').addClass('jquery-add-class');
});
