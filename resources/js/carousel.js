import "./bootstrap";

import "flowbite";

import { Carousel } from "flowbite";

let element = document.getElementById("indicators-carousel");

const options = {
    interval: 3000,
};

const instanceOptions = {
    id: "carousel-example",
    override: true,
};

const modal = new Carousel(element, options, instanceOptions);
