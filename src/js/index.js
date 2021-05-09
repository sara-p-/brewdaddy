import "../scss/main.scss";

import vue from "./components/vue";
import styleGuide from "./components/styleguide";
import menu from "./components/menu";
import mobileTables from "./components/tables";
import sliders from "./components/sliders";
import filters from "./components/filters";
import modals from "./components/modals";
import mobileFilters from "./components/mobile-facets/mobile-filters";
import scrollTo from "./components/scroll-to";
import subNav from "./components/subnav";
// import slideRanges from "./components/mobile-facets/slide-ranges";

document.addEventListener("DOMContentLoaded", function () {
	// vue();
	// styleGuide();

	menu();
	mobileTables();
	sliders();
	modals();
	subNav();
	if (typeof FWP !== "undefined") {
		filters();
		mobileFilters();
		// slideRanges();
	}

	if (document.location.pathname === "/single.html") {
		scrollTo();
	}
});
