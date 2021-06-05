import Glide from "@glidejs/glide";
import { gsap } from "gsap";

export default function sliders() {
	// ******************* Init the Sliders ********************
	var sliders = document.querySelectorAll(".glide");

	// Loop through each slider on the page
	sliders.forEach((element, index) => {
		var newSlider = new Glide(element, {
			type: "carousel",
			animationDuration: 1500,
			focusAt: "1",
			gap: 0,
			// autoplay: 6000,
		})

			.mount()
			.on("move", function () {
				const activeSlide = element.querySelector(
					".glide__slide--active"
				).previousElementSibling;
				const background = activeSlide.querySelector(
					".image-background"
				);
				gsap.to(background, {
					duration: 3,
					y: "100%",
				});
			})
			.on("move.after", function () {
				const activeSlide = element.querySelector(
					".glide__slide--active"
				).previousElementSibling;
				const background = activeSlide.querySelector(
					".image-background"
				);
				gsap.to(background, {
					duration: 2,
					y: "0%",
				});
			});
	});
}
