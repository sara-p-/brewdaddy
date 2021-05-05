import { gsap } from "gsap";

import {
	addFacetType,
	fSelects,
	createTheElements,
	toggleOptionPanels,
	transferDataValues,
	passValuesToFilter,
	observer,
	panelToggle,
	updateDataValues,
	resetButton,
} from "./mobile-filter-helpers";

// Create an AJAX request to the custom endpoint
export function brewdaddySendRequest() {
	// Create our array to hold the facet names and values
	var facetValues = [];
	for (const prop in FWP.facets) {
		facetValues.push({
			name: prop,
			display: [],
			values: [],
			type: "",
		});
	}

	fetch(wpApiSettings.root + "brewdaddy/v1/all", {
		method: "GET",
	})
		.then((data) => data.json())
		.then((data) => {
			data.forEach((e, i) => {
				facetValues.forEach((element, index) => {
					if (e.facet_name == element.name) {
						facetValues[index].values.push(e.facet_value);
						facetValues[index].display.push(e.facet_display_value);
					}
				});
			});
			// Add the facet type, and split the fSelect Facets up from the rest of the group
			var facetSelects = fSelects(addFacetType(facetValues));

			// Loop through the facets and create the elements
			createTheElements(facetSelects);

			// Toggle all of the Option Panels
			toggleOptionPanels();

			// Transfer the data values
			transferDataValues();

			// Loop through the Filter Options and attach the mutation observer to their data attributes
			const allFilterOptions = document.querySelectorAll(
				".option-button"
			);
			allFilterOptions.forEach((filter) => {
				observer.observe(filter, { attributes: true });
			});

			// Reset the Filters on click of the reset button
			resetButton();
		});
}
