import { gsap } from "gsap";

export default function beerAnimation() {
	// ************** Single Recipe beer image animation ************** //
	const background = document.querySelector(".image-background");

	gsap.to(background, {
		duration: 3,
		y: "0%",
	});
}
