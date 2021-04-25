import { gsap } from "gsap";

export default function menu() {
	// Create the function to toggleSlide the various panels
	function toggleSlide(element, button) {
		var clicked = false;
		// Create the slide animation all of the panels will use
		var panelSlide = gsap
			.timeline({
				paused: true,
			})
			.fromTo(
				element,
				{
					x: "100%",
				},
				{
					x: "0%",
					duration: 0.3,
					onStart: () => {
						element.style.display = "block";
						button.classList.add("open");
					},
					onReverseComplete: () => {
						element.style.display = "none";
						button.classList.remove("open");
					},
				}
			);

		button.addEventListener("click", (e) => {
			e.preventDefault;
			if (clicked == false) {
				panelSlide.play();
				clicked = true;
			} else {
				panelSlide.reverse();
				clicked = false;
			}
		});
	}

	// ****************** Main Menu ***************************
	const mobilePanel = document.querySelector(".mobile-panel");
	const hamburger = document.querySelector("button.hamburger");

	toggleSlide(mobilePanel, hamburger);

	// ****************** Filter Panel *************************
	const filterButton = document.querySelector("button.filter-button");
	const filterPanel = document.querySelector(".filter-panel");

	if (filterButton !== null) {
		toggleSlide(filterPanel, filterButton);
	}
}
