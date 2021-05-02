import { gsap } from "gsap";
// import { forEach } from "lodash";
import {
	createFilterButtons,
	backButton,
	createOptionPanels,
} from "./html-components";
import { panelToggle, updateDataValues } from "./mobile-filter-helpers";
import { brewdaddySendRequest } from "./fetch-request";

export default function mobileFilters() {
	// Create our array to hold the facet names and values
	var facetValues = [];
	for (const prop in FWP.facets) {
		facetValues.push({
			name: prop,
			values: [],
		});
	}

	// Call our Fetch Function (which will also update our facetValues array)
	if (document.readyState != "loading") {
		brewdaddySendRequest(facetValues);
	} else {
		document.addEventListener("DOMContentLoaded", (event) => {
			brewdaddySendRequest(facetValues);
		});
	}
	console.log(facetValues);
	// 1. Loop through the Facets and create:
	//      - A Filter Button with a data attribute value
	//      - An Option Panel for each Facet filter with a matching data attribute value, populated with Option Buttons that correspond to the Facet values
	// 2. Get the slideToggle animations working.
	// 3. Transfer the data
	// 6. On click of a Facet Option Button, add a "X" icon to the button, and pass the value back to the original Filter Button

	var filterPanel = document.querySelector("header #original-panel");
	var filterBox = filterPanel.querySelector(".filters");
	var originalFilterButton = document.querySelector("header .filter-button");
	var originalBackButton = filterPanel.querySelector("button.back");

	// ******************** 1: Creation of Elements from the Facet Values *********************
	// Loop through the facets and create the elements
	facets.forEach((element, index) => {
		// Create the Filter Buttons
		filterBox.appendChild(
			createFilterButtons("filter", element.name, index, null)
		);

		// Create the corresponding Option Panels
		var optionPanelBox = createOptionPanels(index, backButton());
		if (index < 1) {
			filterPanel.after(optionPanelBox);
		} else {
			document
				.querySelector(`[data-panel="${index - 1}"]`)
				.after(optionPanelBox);
		}

		// Create the Option Buttons and append them to the corresponding Option Panel
		element.values.forEach((value, i) => {
			var optionP = document.querySelector(`[data-panel="${index}"]`);
			var optionFilterBox = optionP.querySelector(".filters");
			var optionButton = createFilterButtons(
				"option",
				null,
				index,
				value
			);
			if (i < 1) {
				optionFilterBox.appendChild(optionButton);
			} else {
				document
					.querySelector(
						`[data-panel-option="${element.values[i - 1]}"]`
					)
					.after(optionButton);
			}
		});
	});

	// ******************** 4: Toggle the Panels *********************
	// Function to toggle the Original Panel Open and closed
	panelToggle(originalFilterButton, filterPanel, originalBackButton);

	// Create the function to open the correct Option Panel depending on the Filter Button that is clicked
	var filterButtons = filterPanel.querySelectorAll("button.filter-button");
	filterButtons.forEach((button, index) => {
		var buttonDataNumber = button.dataset.panelButton;
		var matchingPanel = document.querySelector(
			`[data-panel="${buttonDataNumber}"]`
		);
		var matchingBackButton = matchingPanel.querySelector("button.back");
		panelToggle(button, matchingPanel, matchingBackButton);
	});

	// ******************** Transfer of Data Values *********************
	// 1. On first click of a Filter Option, store the option value in the data attribute of the Filter Option, and change the Filter Option button icon to "x".
	// 2. If the same Filter Option is clicked again, remove the value in the data attribute, and remove the icon
	// 3. When the user clicks the Back Button, transfer the array with the selected values to the corresponding filter button

	// Loop through the first panel
	var originalFilters = filterPanel.querySelectorAll(".filter-button");
	originalFilters.forEach((filter) => {
		// store the data attribute
		var dataPanelButtonValue = filter.dataset.panelButton;
		var relatedOptions = document.querySelectorAll(
			`header [data-panel="${dataPanelButtonValue}"] button.filter-button`
		);

		// Move on to loop through the corresponding options
		relatedOptions.forEach((option, index) => {
			option.addEventListener("click", (e) => {
				var value = option.dataset.panelOption;

				// grab the option icon and remove the classes
				var icon = option.querySelector("i");
				icon.removeAttribute("class");

				// Set the data value and change the icon
				if (option.dataset.panelOptionValue == "") {
					option.setAttribute(
						"data-panel-option-value",
						option.dataset.panelOption
					);
					option.setAttribute("data-option", "true");
					icon.classList.add("fas", "fa-times");
					option.classList.add("selected");
				} else {
					option.setAttribute("data-panel-option-value", "");
					option.setAttribute("data-option", "false");
					icon.classList.add("fas", "fa-plus");
					option.classList.remove("selected");
				}
			});
		});
	});

	// Function to pass the option values to the original filters when option attributes are changed
	const passValuesToFilter = function (mutations, observer) {
		for (const mutation of mutations) {
			if (mutation.attributeName == "data-option") {
				// Grab the parent filter and it's attribute values (we will set these values in our updataDataValues function)
				var parentFilter = document.querySelector(
					`.filter-panel [data-panel-button="${mutation.target.dataset.parentFilter}"]`
				);
				var parentFilterAttribute = parentFilter.dataset.optionValues;

				// Grab the parent filter span where we will add our new spans
				var parentSpan = parentFilter.querySelector(
					"span.button-values"
				);

				// Grab the boolean value of the select (true when selected), and the value itself
				var optionBoolean = mutation.target.dataset.option;
				var optionValue = mutation.target.dataset.panelOption;

				// On each mutation, clear out the parentSpan of any children
				while (parentSpan.firstChild) {
					parentSpan.removeChild(parentSpan.firstChild);
				}

				// Run our function to update the parent filter attribute values
				var newDataValues = updateDataValues(
					parentFilter,
					parentFilterAttribute,
					optionBoolean,
					optionValue
				);

				// Populate the parentSpan with the child spans
				newDataValues.forEach((e) => {
					parentSpan.appendChild(e);
				});
			}
		}
	};

	// Create an observer instance linked to the callback function
	const observer = new MutationObserver(passValuesToFilter);

	// Loop through the Filter Options and attach the mutation observer to their data attributes
	const allFilterOptions = document.querySelectorAll(".option-button");
	allFilterOptions.forEach((filter) => {
		observer.observe(filter, { attributes: true });
	});

	// ****************** Reset Button ********************
	// 1. On click, empty all relevant data attributes and spans of the values
	var reset = document.querySelector("header .filter-reset");

	reset.addEventListener("click", (e) => {
		// Loop through the filter buttons and clear the data attributes and the option value spans
		originalFilters.forEach((filter) => {
			filter.setAttribute("data-option-values", "");
			var filterOptions = document.querySelectorAll(
				`header [data-panel="${filter.dataset.panelButton}"] button.filter-button`
			);
			var optionSpan = filter.querySelector(".button-values");
			while (optionSpan.firstChild) {
				optionSpan.removeChild(optionSpan.firstChild);
			}
			// Loop through the filter options and set the values to null
			filterOptions.forEach((option, i) => {
				option.setAttribute("data-panel-option-value", "");
				// grab the option icon and remove the classes, then set the class to "plus"
				var icon = option.querySelector("i");
				icon.removeAttribute("class");
				icon.classList.add("fas", "fa-plus");
				option.classList.remove("selected");
			});
		});
	});
}
