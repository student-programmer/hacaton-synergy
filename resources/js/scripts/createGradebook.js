import Gradebook from "../classes/request/Gradebook";
import Cookie from "js-cookie";

(function () {
    const form = document.querySelector("#form-gradebook-create");

    if (!form) {
        return;
    }

    const alert = document.querySelector("#alert-add-gradebook");

    form.addEventListener("submit", (e) => {
        e.preventDefault();

        const fd = new FormData(form);

        fd['date_of_issue'] = Date(fd['date_of_issue']);

        const token = Cookie.get("token");

        new Gradebook()
            .create(fd, token)
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
