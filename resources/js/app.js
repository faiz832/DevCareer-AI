import "./bootstrap";

import Alpine from "alpinejs";

import AOS from "aos";
import "aos/dist/aos.css";

AOS.init({
    duration: 3000,
    once: true,
});

window.Alpine = Alpine;

Alpine.start();
