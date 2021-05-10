import $ from "jquery";
import "webpack-jquery-ui/slider";
import "webpack-jquery-ui/css";
import { gsap } from "gsap";
import {
	spanMaker,
	createFilterButtons,
	backButton,
	createOptionPanels,
	sliderMaker,
} from "./html-components";
import slideRanges from "./slide-ranges";

// ************************* Splitting the Facets up by type into new arrays *******************
export function addFacetType(originalArray) {
	// Add the facet "type" to our Original Array
	originalArray.forEach((value) => {
		for (const typeName in FWP.facet_type) {
			if (value.name == typeName) {
				value.type = FWP.facet_type[typeName];
			}
		}
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

// ************************** Remove the Search Facet from the array *******************
export function noSearch(originalArray) {
	originalArray.forEach((value) => {
		if (value.type == "search") {
			var i = originalArray.indexOf(value);
			originalArray.splice(i, 1);
		}
	});

	return originalArray;
}

// ******************** Creation of Elements from the Facets *********************
export var filterPanel = document.querySelector("header #original-panel");
export var originalFilterButton = document.querySelector(
	"header .filter-button"
);

export function createTheElements(facetArray) {
	var filterBox = filterPanel.querySelector(".filters");
	// Loop through the facets and create the elements
	facetArray.forEach((element, index) => {
		// Create the Filter Buttons
		filterBox.appendChild(
			createFilterButtons(
				"filter",
				element.name,
				index,
				null,
				element.type
			)
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

		// If the facet type is fSelect: Create the Option Buttons and append them to the corresponding Option Panel
		if (element.type == "fselect") {
			console.log(element);
			element.values.forEach((value, i) => {
				var optionP = document.querySelector(`[data-panel="${index}"]`);
				var optionFilterBox = optionP.querySelector(".filters");
				var optionButton = createFilterButtons(
					"option",
					null,
					index,
					value,
					element.type,
					element.display
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
		}

		// If the facet type is a range slider: Create the slider and update the values on slide event
		if (element.type == "slider") {
			var optionP = document.querySelector(`[data-panel="${index}"]`);
			var optionFilterBox = optionP.querySelector(".filters");
			var optionSlider = sliderMaker(index, element.name);

			optionFilterBox.appendChild(optionSlider);

			var slider = $(`[data-panel="${index}"] .slider`);
			var valueInput = $(`[data-panel="${index}"] .slider-values`);
			var originalFilterButton = document.querySelector(
				`button[data-panel-button="${index}"]`
			);
			var filterSpan = originalFilterButton.querySelector(
				".button-values"
			);

			var values = [];
			element.values.forEach((e, i) => {
				var float = parseFloat(e);
				if (i == 0) {
					float = Math.floor(e);
				} else if (i == element.values.length - 1) {
					float = Math.ceil(e);
				} else {
					float = Math.round(e);
				}
				values.push(float);
			});
			var minVal = Math.min(...values);
			var maxVal = Math.max(...values);
			// Setting up the slider through jQuery and passing the Facet values to it
			slider.slider({
				range: true,
				min: minVal,
				max: maxVal,
				values: [minVal, maxVal],
				slide: function (event, ui) {
					// Update the Range Slider value
					valueInput.val(ui.values[0] + " - " + ui.values[1]);
					// Remove the value spans in the parent Button
					var innerSpans = filterSpan.children;
					console.log(innerSpans);
					if (innerSpans.length) {
						filterSpan.innerHTML = "";
					}
					// Create the value spans for the parent button and assign the values to them
					filterSpan.appendChild(
						spanMaker(ui.values[0], "span-value-slider")
					);
					filterSpan.appendChild(
						spanMaker(ui.values[1], "span-value-slider")
					);
					// Pass Values to Facets
					FWP.facets[originalFilterButton.dataset.filterName] = [
						ui.values[0],
						ui.values[1],
					];
					FWP.fetchData();
				},
			});
			// Set the values of the Range Slider amount input
			valueInput.val(
				slider.slider("values", 0) + " - " + slider.slider("values", 1)
			);

			// Remove values if slider "reset" button is clicked
			var sliderReset = optionP.querySelector(".slider-reset");
			sliderReset.addEventListener("click", (e) => {
				filterSpan.innerHTML = "";
				slider.slider("values", [minVal, maxVal]);
				valueInput.val(
					slider.slider("values", 0) +
						" - " +
						slider.slider("values", 1)
				);
				FWP.facets[originalFilterButton.dataset.filterName] = [];
				FWP.fetchData();
			});
		}
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
		panelSlide.restart();
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

// ******************** Transfer of Data Values for fSelect *********************
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

// ******************** Update Parent Filter for fSelect *********************
// Function to update the Parent filter data attributes, as well as creating the child spans that will show the selected values
export function updateDataValues(
	parentFilter,
	filterValue,
	optionBoolean,
	optionValue
) {
	var html = [];
	// on each mutation, if the boolean is true - add the filter value
	// If the boolean is false - remove the filter value
	if (optionBoolean == "true") {
		filterValue = filterValue + " " + optionValue;
	} else {
		filterValue = filterValue.replace(optionValue, "");
	}

	// Add the option values to the parent filter, and update the Facet Value
	parentFilter.setAttribute("data-option-values", filterValue);
	var valueArray = filterValue.split(" ");
	valueArray = valueArray.filter((item) => item);
	FWP.facets[parentFilter.dataset.filterName] = valueArray;
	FWP.fetchData();

	valueArray.forEach((e) => {
		html.push(spanMaker(e));
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
		FWP.reset();
	});
}

// ********************** Apply Button **************************
export function applyButton() {
	var button = document.querySelector("header .filter-apply");
	var originalPanel = document.querySelector("#original-panel");
	var slideClose = gsap
		.timeline({
			paused: true,
		})
		.fromTo(
			originalPanel,
			{
				x: "0%",
			},
			{
				x: "100%",
				duration: 0.3,
				onComplete: () => {
					originalPanel.style.display = "none";
				},
			}
		);
	button.addEventListener("click", (e) => {
		slideClose.restart();
	});
}
