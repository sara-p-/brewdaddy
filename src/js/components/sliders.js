import Glide from "@glidejs/glide";

export default function sliders() {
	// ******************* Init the Sliders ********************
	var sliders = document.querySelectorAll(".glide");

	// Loop through each slider on the page

	sliders.forEach((element, index) => {
		var newSlider = new Glide(element, {
			type: "carousel",
			animationDuration: 2000,
			focusAt: "1",
			gap: 0,
			// autoplay: 6000,
		});

		// // Applying a cool transition on slide change
		// newSlider.on("move", function () {
		// 	let activeEl = element.querySelector(".glide__slide--active");
		// 	let moving = activeEl.nextElementSibling;
		// 	moving.classList.add("moving");
		// });
		// newSlider.on("move.after", function () {
		// 	let activeEl = element.querySelector(".glide__slide--active");
		// 	let moving = activeEl.nextElementSibling;
		// 	moving.classList.remove("moving");
		// });

		newSlider.mount();
	});
}
