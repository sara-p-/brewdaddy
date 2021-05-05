import { gsap } from "gsap";
import {
	spanMaker,
	createFilterButtons,
	backButton,
	createOptionPanels,
} from "./html-components";

// ************************* Splitting the Facets up by type into new arrays *******************
export function addFacetType(originalArray) {
	// Add the facet "type" to our Original Array
	originalArray.forEach((value) => {
		for (const typeName in FWP.facet_type) {
			if (value.name == typeName) {
				value.type = FWP.facet_type[typeName];
			}
		}
		// // Remove the search Facet from the array
		// if (value.name == "recipe_search") {
		// 	var i = originalArray.indexOf(value);
		// 	originalArray.splice(i, 1);
		// }
	});
	// console.log(originalArray);
	return originalArray;
}

// ************************** Create a new array just for the fSelects *******************
export function fSelects(originalArray) {
	var facetSelects = [];
	originalArray.forEach((value) => {
		if (value.type == "fselect") {
			facetSelects.push(value);
		}
	});

	return facetSelects;
}

export var filterPanel = document.querySelector("header #original-panel");
export var filterBox = filterPanel.querySelector(".filters");
export var originalFilterButton = document.querySelector(
	"header .filter-button"
);
export var originalBackButton = filterPanel.querySelector("button.back");

// ******************** 1: Creation of Elements from the Facet Selects *********************
export function createTheElements(selectArray) {
	// Loop through the facets and create the elements
	selectArray.forEach((element, index) => {
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
				// element.display[i]
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
}

// ******************** Toggle the Panels ****************
// Opening and Closing of the Option Panels
export function panelToggle(button, matchingPanel, matchingBackButton) {
	var panelSlide = gsap
		.timeline({
			paused: true,
		})
		.fromTo(
			matchingPanel,
			{
				x: "100%",
			},
			{
				x: "0%",
				duration: 0.3,
				onStart: () => {
					matchingPanel.style.display = "block";
					button.classList.add("open");
				},
				onReverseComplete: () => {
					matchingPanel.style.display = "none";
					button.classList.remove("open");
				},
			}
		);
	button.addEventListener("click", (e) => {
		panelSlide.play();
	});

	matchingBackButton.addEventListener("click", (e) => {
		panelSlide.reverse();
	});
}

// Create the function to open the correct Option Panel depending on the Filter Button that is clicked
export function toggleOptionPanels() {
	var filterButtons = filterPanel.querySelectorAll("button.filter-button");
	filterButtons.forEach((button, index) => {
		var buttonDataNumber = button.dataset.panelButton;
		var matchingPanel = document.querySelector(
			`[data-panel="${buttonDataNumber}"]`
		);
		var matchingBackButton = matchingPanel.querySelector("button.back");
		panelToggle(button, matchingPanel, matchingBackButton);
	});
}

// ******************** Transfer of Data Values *********************
// 1. On first click of a Filter Option, store the option value in the data attribute of the Filter Option, and change the Filter Option button icon to "x".
// 2. If the same Filter Option is clicked again, remove the value in the data attribute, and remove the icon
// 3. When the user clicks the Back Button, transfer the array with the selected values to the corresponding filter button

export function transferDataValues() {
	// Loop through the first panel
	var originalFilters = filterPanel.querySelectorAll(".filter-button");
	originalFilters.forEach((filter) => {
		// store the data attribute
		var dataPanelButtonValue = filter.dataset.panelButton;
		var relatedOptions = document.querySelectorAll(
			`header [data-panel="${dataPanelButtonValue}"] button.filter-button`
		);

		// Move on to loop through the corresponding options
		relatedOptions.forEach((option) => {
			option.addEventListener("click", (e) => {
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
}

// Function to update the Parent filter data attributes, as well as creating the child spans that will show the selected values
export function updateDataValues(
	parentFilter,
	filterValue,
	optionBoolean,
	optionValue
) {
	var html = [];
	// on each mutation, if the boolean is true - add the filter vlaue
	// If the boolean is false - remove the filter value
	if (optionBoolean == "true") {
		filterValue = filterValue + " " + optionValue;
	} else {
		filterValue = filterValue.replace(optionValue, "");
	}

	// Add the option values to the parent filter
	parentFilter.setAttribute("data-option-values", filterValue);

	var array = filterValue.split(" ");
	array.forEach((e, i) => {
		if (e !== "") {
			html.push(spanMaker(e));
		}
	});
	return html;
}

// Function to pass the option values to the original filters when option attributes are changed
export const passValuesToFilter = function (mutations) {
	for (const mutation of mutations) {
		if (mutation.attributeName == "data-option") {
			// Grab the parent filter and it's attribute values (we will set these values in our updataDataValues function)
			var parentFilter = document.querySelector(
				`.filter-panel [data-panel-button="${mutation.target.dataset.parentFilter}"]`
			);
			var parentFilterAttribute = parentFilter.dataset.optionValues;

			// Grab the parent filter span where we will add our new spans
			var parentSpan = parentFilter.querySelector("span.button-values");

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
export const observer = new MutationObserver(passValuesToFilter);

// ****************** Reset Button ********************
// 1. On click, empty all relevant data attributes and spans of the values
export function resetButton() {
	var reset = document.querySelector("header .filter-reset");
	var originalFilters = filterPanel.querySelectorAll(".filter-button");

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
