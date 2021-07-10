export default function subNav() {
	// Gather all of the sections
	const body = document.querySelector("body");
	const sections = document.querySelectorAll("section");
	const ul = document.querySelector(".subnav ul");

	// Create the li element and link
	function makeTheLi(elementId) {
		const li = document.createElement("li");
		const a = document.createElement("a");
		a.setAttribute("href", "#" + elementId);
		a.innerText = elementId;
		li.appendChild(a);

		return li;
	}

	// Loop through the sections, grab the ids, and create the elements
	if (body.classList.contains("single")) {
		sections.forEach((e) => {
			if (e.id !== "") {
				ul.appendChild(makeTheLi(e.id));
			}
		});
	}
}
