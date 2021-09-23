require('./bootstrap');

window.$ = window.jQuery = require('jquery');
require('jquery-form');
require('jquery.maskedinput');
require('ion-rangeslider');
require('slick-carousel');

require('./scripts');

window.axios = require('axios')
require('./backend');
