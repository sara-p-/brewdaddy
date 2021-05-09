import { gsap } from "gsap";
// import { forEach } from "lodash";
import {
	createFilterButtons,
	backButton,
	createOptionPanels,
} from "./html-components";
import {
	panelToggle,
	updateDataValues,
	filterPanel,
	originalFilterButton,
} from "./mobile-filter-helpers";
import { brewdaddySendRequest } from "./fetch-request";

export default function mobileFilters() {
	// Call our Fetch Function (which will also update our facetValues array)
	if (document.readyState != "loading") {
		brewdaddySendRequest();
	} else {
		document.addEventListener("DOMContentLoaded", (event) => {
			brewdaddySendRequest();
		});
	}

	// ******************** Toggle the Original Panel *********************
	// Function to toggle the Original Panel Open and closed
	var originalBackButton = filterPanel.querySelector("button.back");

	panelToggle(originalFilterButton, filterPanel, originalBackButton);
}
