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
import beerAnimation from "./components/beer-animation";
// import slideRanges from "./components/mobile-facets/slide-ranges";

document.addEventListener("DOMContentLoaded", function () {
	// vue();
	// styleGuide();

	menu();
	mobileTables();
	sliders();
	modals();
	subNav();
	if (window.location.href.indexOf("/recipe/") > -1) {
		beerAnimation();
		scrollTo();
	}

	if (typeof FWP !== "undefined") {
		filters();
		mobileFilters();
	}
});
