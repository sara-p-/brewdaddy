import "../scss/main.scss";

import vue from "./components/vue";
import styleGuide from "./components/styleguide";
import menu from "./components/menu";
import mobileTables from "./components/tables";
import sliders from "./components/sliders";

document.addEventListener("DOMContentLoaded", function () {
	vue();
	// styleGuide();

	menu();
	mobileTables();
	sliders();
});
