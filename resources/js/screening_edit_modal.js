import "./bootstrap";

import "flowbite";

import { Modal } from "flowbite";

let element = document.getElementById("edit-modal");
let modal = new Modal(element);

window.openEditModal = function (id, date) {
    document.getElementById("edit_form").action =
        "http://127.0.0.1:8000/dashboard/screenings/edit/" + id;
    let date_string = date.split(" ");
    document.getElementById("date").value = date_string[0];
    switch (date_string[1]) {
        case "20:00:00":
            document.getElementById("time").options[1].selected = true;
            break;
        case "23:00:00":
            document.getElementById("time").options[2].selected = true;
            break;

        default:
            break;
    }
    modal.show();
};
