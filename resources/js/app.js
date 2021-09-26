require('./bootstrap');

window.$ = window.jQuery = require('jquery');
require('jquery-form');
require('jquery.maskedinput');
require('ion-rangeslider');
require('slick-carousel');
require('jquery.maskedinput/src/jquery.maskedinput');

require('./scripts');

$(document).ready($ => {
    $('[name=phone]').mask('+7(999)999-99-99');
})

window.axios = require('axios')
require('./backend');
