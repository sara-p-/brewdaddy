import { gsap } from "gsap";
import { forEach } from "lodash";
import {
	createFilterButtons,
	backButton,
	createOptionPanels,
} from "./html-components";

export default function mobileFilters() {
	// 1. Loop through the Facets
	// 2. Create a Filter Button from each Facet filter with a data attribute value
	// 3. Create an Option Panel for each Facet filter with a matching data attribute value
	// 4. Get the slideToggle animations working.
	// 5. Loop through each Facet value array and create Option Buttons for each in the corresponding Option Panel
	// 6. On click of a Facet Option Button, add a "check" icon to the button, and pass the value back to the original Filter Button

	var filterPanel = document.querySelector("header #original-panel");
	var filterBox = filterPanel.querySelector(".filters");

	// making a fake facet object to loop through
	var facets = [
		{
			name: "Beer Style",
			values: ["saison", "porter", "stout", "ale", "lager", "sour"],
		},
		{
			name: "Beer Sub Style",
			values: ["saison-sub", "porter-sub", "stout-sub", "ale-sub"],
		},
	];

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

	// ******************** Opening/Closing of the corresponding panels ****************
	function panelToggle(button, matchingPanel, matchingBackButton) {
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

	// Function to toggle the Original Panel Open and closed
	var originalFilterButton = document.querySelector("header .filter-button");
	var originalBackButton = filterPanel.querySelector("button.back");
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
				} else {
					option.setAttribute("data-panel-option-value", "");
					option.setAttribute("data-option", "false");
					icon.classList.add("fas", "fa-plus");
				}
			});
		});
	});

	// Function to update the NewDataValues
	function updateDataValues(filterValue, mutationTarget) {
		var values = "";
		if (filterValue == "") {
			values = mutationTarget.target.dataset.panelOptionValue;
		} else {
			values =
				filterValue +
				", " +
				mutationTarget.target.dataset.panelOptionValue;
		}
		return values;
	}

	// Function to pass the option values to the original filters when option attributes are changed
	const passValuesToFilter = function (mutations, observer) {
		for (const mutation of mutations) {
			var parentFilter = document.querySelector(
				`.filter-panel [data-panel-button="${mutation.target.dataset.parentFilter}"]`
			);
			var parentFilterAttribute = parentFilter.dataset.optionValues;
			var parentSpan = parentFilter.querySelector("span.select-values");
			var optionBoolean = mutation.target.dataset.option;
			var optionValue = mutation.target.dataset.panelOption;
			var newDataValues = updateDataValues(
				parentFilterAttribute,
				mutation
			);

			if (mutation.attributeName == "data-option") {
				if (optionBoolean == "false") {
					// Add the value to the string
					newDataValues = newDataValues.replace(optionValue, "");

					console.log(`on add: ${newDataValues}`);
				}

				parentFilter.setAttribute("data-option-values", newDataValues);
				parentSpan.innerText = newDataValues;
			}
		}
	};

	// Create an observer instance linked to the callback function
	const observer = new MutationObserver(passValuesToFilter);

	// Loop through the Filter Options and attach the mutation observer to their data attributes
	const allFilterOptions = document.querySelectorAll(".option-button");
	allFilterOptions.forEach((filter, index) => {
		observer.observe(filter, { attributes: true });
	});

	// ****************** Reset Button ********************
	// 1. On click, empty all relevant data attributes and spans of the values
	var reset = document.querySelector("header .filter-reset");

	reset.addEventListener("click", (e) => {
		// Loop through the filter buttons and set the data attributes and spans to null
		originalFilters.forEach((filter, index) => {
			filter.setAttribute("data-option-values", "");
			var filterOptions = document.querySelectorAll(
				`header [data-panel="${filter.dataset.panelButton}"] button.filter-button`
			);
			// Loop through the filter options and set the values to null
			filterOptions.forEach((option, i) => {
				option.setAttribute("data-panel-option-value", "");
				// grab the option icon and remove the classes, then set the class to "plus"
				var icon = option.querySelector("i");
				icon.removeAttribute("class");
				icon.classList.add("fas", "fa-plus");
			});
		});
	});
}
