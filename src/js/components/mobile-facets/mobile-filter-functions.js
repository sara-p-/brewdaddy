import $ from "jquery";
import "webpack-jquery-ui/slider";
import "webpack-jquery-ui/datepicker";
import "webpack-jquery-ui/css";
import { gsap } from "gsap";
import {
	spanMaker,
	createFilterButtons,
	backButton,
	createOptionPanels,
	sliderMaker,
	dateRangeMaker,
} from "./html-components";
import {
	panelToggle,
	sliderMinMax,
	resetSlider,
	passValuesToFilter,
	formatDate,
	getTheDate,
	setDates,
} from "./mobile-filter-helpers";

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

// ************************** Remove Duplicate Items from the FSelect value array *******************
function removeDuplicates(array) {
	let newArray = [];
	array.forEach((c) => {
		if (!newArray.includes(c)) {
			newArray.push(c);
		}
	});

	return newArray;
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

		var optionP = document.querySelector(`[data-panel="${index}"]`);
		var optionFilterBox = optionP.querySelector(".filters");
		var originalFilterButton = document.querySelector(
			`button[data-panel-button="${index}"]`
		);
		var filterSpan = originalFilterButton.querySelector(".button-values");

		// If the facet type is fSelect: Create the Option Buttons and append them to the corresponding Option Panel
		if (element.type == "fselect") {
			// Remove duplicate entries from the value and display arrays
			var theValues = removeDuplicates(element.values);
			var theDisplay = removeDuplicates(element.display);
			theValues.forEach((value, i) => {
				var optionP = document.querySelector(`[data-panel="${index}"]`);
				var optionFilterBox = optionP.querySelector(".filters");
				var optionButton = createFilterButtons(
					"option",
					null,
					index,
					value,
					theDisplay[i]
				);

				if (i < 1) {
					optionFilterBox.appendChild(optionButton);
				} else {
					document
						.querySelector(
							`[data-panel-option="${theValues[i - 1]}"]`
						)
						.after(optionButton);
				}
			});
		}

		// If the facet type is a range slider: Create the slider and update the values on slide event
		if (element.type == "slider") {
			optionFilterBox.appendChild(sliderMaker(index, element.name));

			var slider = $(`[data-panel="${index}"] .slider`);
			var valueInput = $(`[data-panel="${index}"] .slider-values`);

			// Grab the slider max and min values
			var sliderValues = sliderMinMax(element);

			// Setting up the slider through jQuery and passing the Facet values to it
			slider.slider({
				range: true,
				min: sliderValues[0],
				max: sliderValues[1],
				values: [sliderValues[0], sliderValues[1]],
				slide: function (event, ui) {
					// Update the Range Slider value
					valueInput.val(ui.values[0] + " - " + ui.values[1]);
					// Remove the value spans in the parent Button
					var innerSpans = filterSpan.children;
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
				resetSlider(index, sliderValues);
				FWP.facets[originalFilterButton.dataset.filterName] = [];
				FWP.fetchData();
			});
		}

		// If the facet type is a datepicker: Create the datepicker and update the values
		if (element.type == "date_range") {
			optionFilterBox.appendChild(dateRangeMaker(index));
			var args = {
				defaultDate: "+1w",
				changeMonth: true,
				changeYear: true,
				dateFormat: "mm/dd/yy",
			};
			var from = $("#start-date")
				.datepicker(args)
				.on("change", function () {
					to.datepicker("option", "minDate", getTheDate(this));
					setDates(
						filterSpan,
						from.datepicker("getDate"),
						to.datepicker("getDate")
					);
				});
			var to = $("#end-date")
				.datepicker(args)
				.on("change", function () {
					from.datepicker("option", "maxDate", getTheDate(this));
					setDates(
						filterSpan,
						from.datepicker("getDate"),
						to.datepicker("getDate")
					);
				});
			// Reset button
			var resetDate = document.querySelector(".date-reset");
			resetDate.addEventListener("click", (e) => {
				to.datepicker("setDate", null);
				from.datepicker("setDate", null);
				// Clear value spans
				// clear the span values on the filter button
				var innerSpans = filterSpan.children;
				if (innerSpans.length) {
					filterSpan.innerHTML = "";
				}
				// Clear Facet values
				FWP.facets["brew_date"] = [];
				FWP.fetchData();
			});
		}
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

// Create an observer instance linked to the callback function
export const observer = new MutationObserver(passValuesToFilter);

// ****************** Reset Button ********************
// 1. On click, empty all relevant data attributes and spans of the values
export function resetButton(facetArray) {
	var reset = document.querySelector("header .filter-reset");
	var originalFilters = filterPanel.querySelectorAll(".filter-button");

	reset.addEventListener("click", (e) => {
		facetArray.forEach((element, index) => {
			// Clear the values of the Original Filter Buttons
			var originalFilter = document.querySelector(
				`[data-panel-button="${index}"]`
			);
			originalFilter.setAttribute("data-option-values", "");
			var filterOptions = document.querySelectorAll(
				`header [data-panel="${index}"] button.filter-button`
			);
			var optionSpan = originalFilter.querySelector(".button-values");
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

			// Clear the slider values
			if (element.type == "slider") {
				resetSlider(index, sliderMinMax(element));
			}
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
