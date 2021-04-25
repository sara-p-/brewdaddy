import "../scss/main.scss";

import vue from "./components/vue";
import styleGuide from "./components/styleguide";
import menu from "./components/menu";
import mobileTables from "./components/tables";
import sliders from "./components/sliders";
import filters from "./components/filters";
import modals from "./components/modals";
import mobileFilters from "./components/mobile-filters";
import scrollTo from "./components/scroll-to";

document.addEventListener("DOMContentLoaded", function () {
	vue();
	// styleGuide();

	menu();
	mobileTables();
	sliders();
	filters();
	modals();
	if (document.location.pathname === "/") {
		mobileFilters();
	}
	if (document.location.pathname === "/single.html") {
		scrollTo();
	}
});
