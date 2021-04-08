import "../scss/main.scss";

import vue from "./components/vue";
import styleGuide from "./components/styleguide";
import menu from "./menu";


document.addEventListener("DOMContentLoaded", function () {
	vue();
	styleGuide();

	menu();
});
