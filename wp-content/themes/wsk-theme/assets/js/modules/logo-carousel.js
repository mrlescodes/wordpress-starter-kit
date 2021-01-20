import { tns } from 'tiny-slider/src/tiny-slider';

if ($('.logo-carousel').length > 0) {
  tns({
    container: '.logo-carousel',
    controls: true,
    nav: false,
    items: 2,
    autoplay: true,
    autoplayButtonOutput: false,
    responsive: {
      640: {
        items: 3,
      },
      800: {
        items: 4,
      },
      960: {
        items: 5,
      },
    },
  });
}
