import { tns } from 'tiny-slider/src/tiny-slider';

tns({
  container: '.logo-carousel',
  controls: false,
  nav: false,
  items: 2,
  responsive: {
    640: {
      items: 4,
    },
    700: {
      items: 6,
    },
    900: {
      items: 8,
    },
  },
});
