export default function subNav() {
	// Gather all of the sections
	var sections = document.querySelectorAll("section");
	var ul = document.querySelector(".subnav ul");

	// Create the li element and link
	function makeTheLi(elementId) {
		var li = document.createElement("li");
		var a = document.createElement("a");
		a.setAttribute("href", "#" + elementId);
		a.innerText = elementId;
		li.appendChild(a);

		return li;
	}

	// Loop through the sections, grab the ids, and create the elements
	sections.forEach((e) => {
		var id = e.id;
		if (id !== "") {
			ul.appendChild(makeTheLi(id));
		}
	});
}
