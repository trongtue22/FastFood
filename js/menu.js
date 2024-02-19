window.addEventListener("scroll", function() {
    var underNavbar = document.querySelector(".under-navbar");
    if (window.scrollY > 200) {
      underNavbar.classList.add("hide-menu");
    } else {
      underNavbar.classList.remove("hide-menu");
    }
});