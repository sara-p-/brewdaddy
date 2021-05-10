// ************************* Back Button *******************
export function backButton() {
	var button = document.createElement("button");
	button.classList.add("btn", "full-width", "back");
	var span = document.createElement("span");
	span.classList.add("visually-hidden");
	span.innerText = "Back";
	button.appendChild(span);
	var icon = document.createElement("i");
	icon.classList.add("fas", "fa-long-arrow-alt-left");
	icon.setAttribute("aria-hidden", "true");
	span.after(icon);

	return button;
}

// ************************** Original Filter Buttons and fSelect Option Buttons ******************
export function createFilterButtons(
	type,
	filterName,
	filterNumber,
	buttonAttrValue,
	buttonDisplayValue = null
) {
	var button = document.createElement("button");
	button.classList.add("btn", "white", "full-width", "filter-button");

	var buttonContent = document.createElement("span");
	buttonContent.classList.add("button-content");

	var buttonName = document.createElement("span");
	buttonName.classList.add("button-name");

	var icon = document.createElement("i");

	if (type == "filter") {
		button.setAttribute("data-panel-button", filterNumber);
		button.setAttribute("data-option-values", "");
		button.setAttribute("data-filter-name", filterName);

		var buttonValues = document.createElement("span");
		buttonValues.classList.add("button-values");

		icon.classList.add("fas", "fa-chevron-right");
		icon.setAttribute("aria-hidden", "true");

		buttonName.innerText = filterName.replace("_", " ");

		button.appendChild(buttonContent);
		buttonContent.appendChild(buttonName);
		buttonName.after(buttonValues);
		buttonContent.after(icon);
	} else {
		button.setAttribute("data-panel-option", buttonAttrValue);
		button.setAttribute("data-panel-option-value", "");
		button.setAttribute("data-parent-filter", filterNumber);
		button.setAttribute("data-option", "false");
		button.classList.add("option-button");

		buttonName.innerText = buttonAttrValue;

		icon.classList.add("fas", "fa-plus");
		icon.setAttribute("aria-label", "Select");

		button.appendChild(buttonContent);
		buttonContent.appendChild(buttonName);
		buttonContent.after(icon);
	}

	return button;
}

// ************************** Option Panels ************************
// Option Panels with data attributes that match their corresponding Filter Button data attribute
export function createOptionPanels(number, func) {
	var optionPanel = document.createElement("div");
	optionPanel.classList.add("filter-panel", "option-panel");
	optionPanel.setAttribute("data-panel", number);
	var panelContainer = document.createElement("div");
	panelContainer.classList.add("panel-container");
	optionPanel.appendChild(panelContainer);
	var filterWrapper = document.createElement("div");
	filterWrapper.classList.add("filters");
	var backButton = func;
	panelContainer.appendChild(backButton);
	backButton.after(filterWrapper);

	return optionPanel;
}

// ******************** Original Filter Button Spans (that display the selected values) *************
export function spanMaker(optionName, classes = "span-value-fselect") {
	var span = document.createElement("span");
	span.classList.add("selected-option", classes);
	span.innerText = optionName;
	return span;
}

// ********************** Slider Ranges on Mobile *******************
export function sliderMaker(parentFilter, filterName) {
	var sliderRange = document.createElement("div");
	sliderRange.classList.add("slider-range");
	sliderRange.setAttribute("data-parent-filter", parentFilter);

	var slider = document.createElement("div");
	slider.classList.add("slider");

	var rangeBox = document.createElement("div");
	rangeBox.classList.add("range-box");

	var inputBox = document.createElement("div");
	inputBox.classList.add("input-box");

	var label = document.createElement("label");
	label.setAttribute("for", "amount-" + parentFilter);
	label.innerText = filterName;

	var valueInput = document.createElement("input");
	valueInput.setAttribute("type", "text");
	valueInput.readOnly = true;
	valueInput.classList.add("slider-values");
	valueInput.id = "amount-" + parentFilter;

	var sliderReset = document.createElement("button");
	sliderReset.classList.add("btn", "white", "btn-small", "slider-reset");
	sliderReset.innerText = "Reset";

	inputBox.appendChild(label);
	label.after(valueInput);

	rangeBox.appendChild(inputBox);
	inputBox.after(sliderReset);

	sliderRange.appendChild(slider);
	slider.after(rangeBox);

	return sliderRange;
}
