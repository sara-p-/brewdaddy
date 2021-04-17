import Glide from "@glidejs/glide";

export default function sliders() {
	// ******************* Init the Sliders ********************

	// Loop through each slider on the page
	var sliders = document.querySelectorAll(".glide");
	sliders.forEach((element, index) => {
		new Glide(element).mount({
			type: "carousel",
		});
	});
}
