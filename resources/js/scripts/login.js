import Auth from "../classes/request/Auth";
import Cookie from "js-cookie";
import changeStatePasswordType from "./changeStatePasswordType";

(function () {
    const form = document.querySelector("#form-login");

    if (!form) {
        return;
    }

    changeStatePasswordType();

    const alert = document.querySelector("#alert-auth");

    form.addEventListener("submit", (e) => {
        e.preventDefault();

        const fd = new FormData(form);

        new Auth()
            .login(fd)
            .then(({ success, message, token, }) => {
                alert.classList.remove("d-none");
                alert.textContent = message;

                if (success) {
                    alert.classList.add("alert-success")
                    alert.classList.remove("alert-danger");
                } else {
                    alert.classList.remove("alert-success")
                    alert.classList.add("alert-danger");
                    return;
                }

                Cookie.set("token", token);
                window.location.href = "/";
            }).catch((err) => {
                throw err;
            });
    });
})();