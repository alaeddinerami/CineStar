let items = document.querySelectorAll(".navitem");

let url = window.location.pathname;
url = url.substring(url.indexOf("/") + 1, url.lastIndexOf("/"));
if (url === "/") {
    url = window.location.pathname;
    url = url.substring(1);
}
switch (url) {
    case "home":
        items.forEach((item) => {
            item.classList.remove("checked");
        });
        items[0].classList.add("checked");
        break;
    case "adventures":
        items.forEach((item) => {
            item.classList.remove("checked");
        });
        items[1].classList.add("checked");
        break;
    case "stats":
        items.forEach((item) => {
            item.classList.remove("checked");
        });
        items[2].classList.add("checked");
        break;
    case "about":
        items.forEach((item) => {
            item.classList.remove("checked");
        });
        items[3].classList.add("checked");
        break;
    default:
        break;
}
