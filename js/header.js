var prevScrollpos = window.pageYOffset;
var headerHeight = 103; // Высота вашей шапки

window.onscroll = function() {
  if (window.innerWidth > 768) {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
      document.querySelector(".header").style.top = "0";
    } else {
      var scrolledPastHeader = currentScrollPos > headerHeight;
      document.querySelector(".header").style.top = scrolledPastHeader ? "-" + headerHeight + "px" : "0";
    }
    prevScrollpos = currentScrollPos;
  }
}

const burger_button = document.querySelector('#burger_button');
const menu_container = document.querySelector('#menu_container');
burger_button.addEventListener('click', () => {
    burger_button.classList.toggle('burger_active');
    menu_container.classList.toggle('menu_active');
    document.body.classList.toggle('scroll-lock');
    if (menu_container.classList.contains('menu_active')) {
        disableScroll = true;
    } else {
        disableScroll = false;
    }
}) 