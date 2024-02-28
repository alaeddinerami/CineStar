import "./bootstrap";

import "flowbite";

import { Modal } from "flowbite";

let element = document.getElementById("edit-modal");

window.openEditModal = function (id, title) {
    document.getElementById("edit_form").action = "http://127.0.0.1:8000/dashboard/films/edit" + id;
    document.getElementById("title").value = title;
    document.getElementById("genres").value = genres;
    document.getElementById("actors").value = actors;


    Modal.show();
};