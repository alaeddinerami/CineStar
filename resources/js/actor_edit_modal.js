import "./bootstrap";

import "flowbite";

import { Modal } from "flowbite";

let element = document.getElementById("edit-modal");

const modal = new Modal(element);

window.openModal = function (v) {
    document.getElementById("name").value = v;
    modal.show();
};
