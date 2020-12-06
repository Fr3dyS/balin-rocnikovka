let mobileMenu = document.getElementById("mobile-menu");
let mobileButton = document.getElementById("mobile-button");

const toggleMenu = () => {
    if(mobileMenu.classList.contains("active-menu")) {
        mobileMenu.classList.remove("active-menu");
    } else {
        mobileMenu.classList.add("active-menu");
    }
}

mobileButton.onclick = toggleMenu;