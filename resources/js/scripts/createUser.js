import User from "../classes/request/User";
import Cookie from "js-cookie";
import changeStatePasswordType from "./changeStatePasswordType";

(function () {
    const form = document.querySelector("#form-user-create");

    if (!form) {
        return;
    }

    changeStatePasswordType();

    const alert = document.querySelector("#alert-add-user");

    form.addEventListener("submit", (e) => {
        e.preventDefault();

        const fd = new FormData(form);

        new User()
            .create(fd)
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
