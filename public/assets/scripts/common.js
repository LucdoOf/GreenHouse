window.addEventListener("load", () => {
    [...document.getElementsByClassName("menu-title")].forEach(menu => {
        menu.addEventListener("click", (e) => {
            if (!menu.parentNode.classList.contains("fixed")) menu.parentNode.classList.toggle("active");
        });
    });
});
