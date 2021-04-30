import { gsap } from "gsap";

export default function filters() {
	// ******************* Hide/Show the hidden range inputs ********************
	var body = document.querySelector("body");
	var falseSelects = document.querySelectorAll(".false-select");
	var theDuration = 0.1;

	falseSelects.forEach((element, index) => {
		var falseButton = element.querySelector("button.false-button");
		var bottom = element.querySelector(".bottom");
		var bottomInput = element.querySelector("input");
		var height = bottom.offsetHeight;
		var clicked = false;

		// Setting some properties at the beginning
		gsap.set(bottom, {
			height: 0,
			opacity: 0,
		});
		bottom.style.display = "none";
		bottomInput.style.opacity = 0;

		// Creating our GSAP Timeline animation
		var showRange = gsap
			.timeline({
				paused: true,
				loop: false,
			})
			.fromTo(
				bottom,
				{
					height: 0,
					opacity: 0,
				},
				{
					onStart: () => {
						bottom.style.display = "block";
						bottom.classList.add("open");
					},
					height: height,
					opacity: 1,
					duration: theDuration,
					onReverseComplete: () => {
						bottom.style.display = "none";
						bottom.classList.remove("open");
					},
				}
			)
			.fromTo(
				bottomInput,
				{
					opacity: 0,
				},
				{
					opacity: 1,
					duration: theDuration,
				}
			);

		// On button click, run the animation forwards or backwards depending on the value of the "clicked" variable, then reset that variable.
		falseButton.addEventListener("click", function () {
			if (clicked == false) {
				showRange.play();
				clicked = true;
			} else {
				showRange.reverse();
				clicked = false;
			}
		});

		// If the user clicks anywhere outside the input div, hide the input div again
		body.addEventListener("click", (e) => {
			if (clicked == true) {
				showRange.reverse();
				clicked = false;
			}
		});
		// Override the previous event if the user clicks inside of the input div
		element.addEventListener("click", (e) => {
			e.stopPropagation();
		});

		// ******************** Input and span.value Value Changes ************************
		var clear = element.querySelector("button.clear");
		var spanValue = element.querySelector("span.value");

		// On input change, update the span.value tag to show that value
		bottomInput.addEventListener("input", (e) => {
			spanValue.innerText = e.target.value;
		});
		// On "Clear" button click, reset the value of the input, and return the span.value tag to "All"
		// clear.addEventListener("click", (e) => {
		// 	bottomInput.value = "";
		// 	spanValue.innerText = "All";
		// });
	});
}
