import "./bootstrap";

import "flowbite";

import { Modal } from "flowbite";

let element = document.getElementById("edit-modal");

const modal = new Modal(element);

window.openEditModal = function (id, name, seats) {
    document.getElementById("edit_form").action =
        "http://127.0.0.1:8000/dashboard/halls/edit/" + id;
    document.getElementById("edit_name").value = name;
    document.getElementById("edit_seats").value = seats;
    modal.show();
};
