import $ from "jquery";
import "webpack-jquery-ui/slider";

export function slideRanges(element) {
	element.slider({
		range: true,
		min: 0,
		max: 500,
		values: [75, 300],
	});
}
