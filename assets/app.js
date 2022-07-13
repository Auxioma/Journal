import './bootstrap';

const $ = require('jquery');
global.$ = global.jQuery = $;

require('bootstrap');
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');
require('owl.carousel');

import './styles/app.scss';


var owl = $('.owl-carousel');
owl.owlCarousel({
    nav:false,
    pagination :false,
    dots: false,
    loop: false,
    autoplay: true,
    autoplaySpeed: 3000,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },            
        960:{
            items:1
        },
        1200:{
            items:1
        }
    }
});
owl.on('mousewheel', '.owl-stage', function (e) {
    if (e.deltaY > 0) {
        owl.trigger('next.owl');
    } else {
        owl.trigger('prev.owl');
    }
    e.preventDefault();
});