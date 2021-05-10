import {
	panelToggle,
	filterPanel,
	applyButton,
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

	// ******************** Apply the filters *********************
	// Close Filter panel after selections
	applyButton();
}
