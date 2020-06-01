import '../css/app.css';

import $ from 'jquery';
import greet from './greet';

$(document).ready(function() {
    $('body').prepend('<h1>'+greet('jill')+'</h1>');
});