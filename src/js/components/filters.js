import { gsap } from "gsap";

export default function filters() {
	// ******************* Hide/Show the hidden range inputs ********************
	var falseSelects = document.querySelectorAll(".false-select");

	falseSelects.forEach((element, index) => {
		var falseButton = element.querySelector("button.false-button");
		var bottom = element.querySelector("bottom");

		var showRange = gsap.to(bottom, {
			// x: "0%",
			// duration: 0.3,
		});
	});
}
