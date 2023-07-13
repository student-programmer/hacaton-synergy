import Gradebook from "../classes/request/Gradebook";
import Cookie from "js-cookie";

(function () {
    const btns = document.querySelectorAll(
        ".js-delete-gradebook[data-gradebook-id]"
    );

    if (!btns.length) {
        return;
    }

    const token = Cookie.get("token");

    btns.forEach((btn) => {
        btn.addEventListener("click", () => {
            const idGradebook = parseInt(btn.dataset.gradebookId);

            new Gradebook()
                .delete(token, idGradebook)
                .then(({ message }) => {
                    alert(message);
                })
                .catch((err) => {
                    throw err;
                });
        });
    });
})();
