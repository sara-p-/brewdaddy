// This is where I'll keep most of my html building functions

// create a function to make the back button featured on all panels
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

// Create a function that makes either the filter buttons or the option buttons
export function createFilterButtons(
	type,
	filterName,
	filterNumber,
	buttonAttrValue
	// buttonAttrDisplay
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

		var buttonValues = document.createElement("span");
		buttonValues.classList.add("button-values");

		icon.classList.add("fas", "fa-chevron-right");
		icon.setAttribute("aria-hidden", "true");

		buttonName.innerText = filterName;

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

// Create a function to make the Option Panels, and give them a data attribute that matches their corresponding Filter Button data attribute
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

// Function to create span elements for the filter button selected options
export function spanMaker(optionName) {
	var span = document.createElement("span");
	span.classList.add("selected-option");
	span.innerText = optionName;
	return span;
}
