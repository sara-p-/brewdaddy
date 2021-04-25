import { gsap } from "gsap";
import { ScrollTrigger, ScrollToPlugin } from "gsap/all.js";
gsap.registerPlugin(ScrollTrigger);
gsap.registerPlugin(ScrollToPlugin);

export default function scrollTo() {
	const menuLinks = document.querySelectorAll(
		'.subnav a[href*="#"]:not([href="#"])'
	);

	// For each menu link, on click, scroll to section (also change the focus for accessibility)
	menuLinks.forEach((element) => {
		element.addEventListener("click", () => {
			var section = document.querySelector(element.hash); // Grab the section that matches the link hash
			gsap.to(window, {
				duration: 0.3,
				scrollTo: {
					y: element.hash,
					offsetY: 200,
				},
				ease: "linear",
				onComplete: () => {
					var focusElement = section.querySelector("a");
					if (focusElement == null) {
						focusElement = section.querySelector(".title");
					}
					focusElement.focus({ preventScroll: true }); // Change the focus to the scrolled-to element

					menuLinks.forEach((element) => {
						// Remove all of the 'active' classes on links
						element.classList.remove("active");
					});
					element.classList.add("active"); // Add 'active' class on clicked link
				},
			});
		});
	});
}
