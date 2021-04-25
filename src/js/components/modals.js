import MicroModal from "micromodal";

export default function modals() {
	// ***************** Init the modals ******************
	var theModals = document.querySelectorAll(".modal");

	theModals.forEach((element, index) => {
		var id = element.id;
		var button = document.querySelector("button." + id);

		button.addEventListener("click", (e) => {
			console.log(id);
			MicroModal.show(id);
			var openModal = document.querySelector(".modal.is-open");
			openModal.querySelector(".modal__close").focus();
		});
	});
}
