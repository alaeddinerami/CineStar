function openModal() {
    document.getElementById("Modal").classList.remove("hidden");
}

function closeModal() {
    document.getElementById("Modal").classList.add("hidden");
}
console.log("yep");

window.onclick = function (event) {
    let popup = document.getElementById("Modal");
    if (event.target == popup) {
        popup.classList.add("hidden");
    }
};
