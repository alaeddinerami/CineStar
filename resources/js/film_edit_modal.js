import "./bootstrap";

import "flowbite";

import { Modal } from "flowbite";

let element = document.getElementById("edit-modal");

const modal = new Modal(element);

window.openEditModal = function (id, title,genres,actors,overview) {
    document.getElementById("edit_form").action = "http://127.0.0.1:8000/dashboard/films/edit/" + id;
    document.getElementById("title_edit").value = title;
    document.getElementById("genres_edit").value = genres;
    document.getElementById("actors_edit").value = actors;
    document.getElementById("overview_edit").value = overview;
    modal.show();
};
