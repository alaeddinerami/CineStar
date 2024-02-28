import "./bootstrap";

import "flowbite";

import { Modal } from "flowbite";

let element = document.getElementById("delete-modal");
let modal = new Modal(element);

window.openDeleteModal = function (id) {
    document.getElementById("delete_form").action =
        "http://127.0.0.1:8000/dashboard/screenings/delete/" + id;
    modal.show();
};
