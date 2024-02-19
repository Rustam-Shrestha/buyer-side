let toggler = document.getElementById("toggler");
let menus = document.getElementsByClassName("navbar");
toggler.addEventListener("click", () => {
    // sliding all the available menus
    for (let num = 0; num < menus.length; i++) {
        menus[num].classList.toggle("show");
    }
});


