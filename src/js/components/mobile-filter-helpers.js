import { gsap } from "gsap";
import { spanMaker } from "./html-components";

// ******************** Mobile Filters ****************
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
	console.log(html);
	return html;
}
