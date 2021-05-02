// Create an AJAX request to the custom endpoint
export function brewdaddySendRequest(facets) {
	fetch(wpApiSettings.root + "brewdaddy/v1/all", {
		method: "GET",
	})
		.then((data) => data.json())
		.then((data) => {
			data.forEach((e, i) => {
				facets.forEach((element, index) => {
					if (e.facet_name == element.name) {
						facets[index].values.push(e.facet_value);
					}
				});
			});
		});
}
