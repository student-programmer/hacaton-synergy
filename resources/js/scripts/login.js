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
                alert.classList.add(success ? "alert-success" : "alert-danger");
                alert.textContent = message;

                if (!success) {
                    return;
                }

                Promise((res) => {
                    setTimeout(() => {
                        Cookie.set("token", token);
                        res();
                    }, 0);
                }).then(() => {
                    window.location.push("/");
                });
            }).catch((err) => {
                throw err;
            });
    });
})();