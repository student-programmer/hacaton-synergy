import Gradebook from "../classes/request/Gradebook";
import Cookie from "js-cookie";

(function () {
	const form = document.querySelector("#form-gradebook-change");

	if (!form) {
		return;
	}

	const alert = document.querySelector("#alert-change-gradebook");
	const gradebookId = window.location.href.split("/").at(-1);

	form.addEventListener("submit", (e) => {
		e.preventDefault();

		console.log(gradebookId);

		const fd = new FormData(form);
		const token = Cookie.get("token");

		new Gradebook()
			.change(fd, token, gradebookId)
			.then(({ success, message }) => {
				alert.classList.remove("d-none");
				alert.textContent = message;

				if (success) {
					alert.classList.add("alert-success");
					alert.classList.remove("alert-danger");
				} else {
					alert.classList.remove("alert-success");
					alert.classList.add("alert-danger");
				}
			})
			.catch((err) => {
				throw err;
			});
	});
})();
