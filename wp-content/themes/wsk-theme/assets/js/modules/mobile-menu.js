function readyFn() {
  const $navbar = $('.site-header .navbar');
  const $navbarCollapsible = $('#navbarSupportedContent');

  function show() {
    $navbar.addClass('navbar-mobile-menu-expanded');

    // Add and fade in navbar blackout.
    $('.site').append('<div class="navbar-blackout"></div>');
    $('.navbar-blackout').fadeIn(160);
  }

  function hide() {
    $navbar.removeClass('navbar-mobile-menu-expanded');

    // Fade out and remove navbar blackout.
    $('.navbar-blackout').fadeOut(160, () => {
      $('.navbar-blackout').remove();
    });
  }

  function init() {
    // Register event handlers
    $navbarCollapsible.on('show.bs.collapse', show);
    $navbarCollapsible.on('hide.bs.collapse', hide);
  }

  init();
}

jQuery(readyFn);
