require('./bootstrap');

window.$ = window.jQuery = require('jquery');
require('jquery-form');
require('jquery.maskedinput/src/jquery.maskedinput');
require('ion-rangeslider');
require('slick-carousel');

require('./scripts');
require('./backend');

$(document).ready($ => {
    $('[name=phone]').mask('+7(999) 999-99-99');
})
