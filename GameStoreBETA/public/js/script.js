function mobileNav() {
  const hamburger = document.getElementById('hamburger-icon');
  const menu = document.getElementById('mobile-menu');

  if (menu.style.display != "none") {
    menu.style.display = "none";
  } else { menu.style.display = "block" }
}