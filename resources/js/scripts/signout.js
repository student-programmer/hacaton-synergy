import Cookie from "js-cookie";

(function () {
    const btn = document.querySelector("#signout-btn");

    if (!btn) {
        return;
    }

    btn.addEventListener("click", () => {
        Cookie.remove("token");
        window.location.href = "/auth/login";
    });
})();