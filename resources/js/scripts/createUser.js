import User from "../classes/request/User";
import changeStatePasswordType from "./changeStatePasswordType";
import Cookie from "js-cookie";

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
        const token = Cookie.get("token");

        new User()
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
