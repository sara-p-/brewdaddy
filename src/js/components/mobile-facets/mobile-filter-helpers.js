import { gsap } from "gsap";
import { spanMaker } from "./html-components";

// ******************** Pass Values to Original Filters for fSelects *********************
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
		e = e.replaceAll("-", " ");
		html.push(spanMaker(e));
	});
	return html;
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

// ******************** Get min and max slider values ****************
export function sliderMinMax(element) {
	var values = [];
	var minMaxArray = [];
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
	minMaxArray.push(Math.min(...values));
	minMaxArray.push(Math.max(...values));

	return minMaxArray;
}

// ******************** Reset Slider Values ****************
export function resetSlider(index, sliderValues) {
	var slider = $(`[data-panel="${index}"] .slider`);
	var valueInput = $(`[data-panel="${index}"] .slider-values`);
	var originalFilterButton = document.querySelector(
		`button[data-panel-button="${index}"]`
	);
	var filterSpan = originalFilterButton.querySelector(".button-values");
	filterSpan.innerHTML = "";
	slider.slider("values", [sliderValues[0], sliderValues[1]]);
	valueInput.val(
		slider.slider("values", 0) + " - " + slider.slider("values", 1)
	);
}
