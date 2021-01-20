import throttle from 'lodash.throttle';

function readyFn() {
  let st = $(window).scrollTop();

  const $navbar = $('.site-header .navbar');

  function toggleTransparency() {
    if (st > 40) {
      $navbar.removeClass('navbar-transparent');
    } else {
      $navbar.addClass('navbar-transparent');
    }
  }

  function handleScroll() {
    st = $(window).scrollTop();

    toggleTransparency();
  }

  function init() {
    if ($('body').hasClass('is-minimal-ui')) {
      toggleTransparency();

      // Register event handlers.
      $(window).on('scroll', throttle(handleScroll, 16.666, { trailing: true }));
      $(window).on('resize', throttle(handleScroll, 111, { trailing: true }));
    }
  }

  init();
}

jQuery(readyFn);
