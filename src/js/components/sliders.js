import Glide from "@glidejs/glide";

export default function sliders() {
	// init the glide slider
	new Glide(".glide").mount({
		type: "carousel",
	});
}
