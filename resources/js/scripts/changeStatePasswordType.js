function changeStatePasswordType() {
    const btn = document.querySelector("#change-password-state-btn");

    if (!btn) {
        return;
    }

    const eyeIcon = document.querySelector("#eye");
    const slashEyeIcon = document.querySelector("#slash-eye");
    const input = document.querySelector("#login-password");

    btn.addEventListener("click", () => {
        const typeInput = input.type;

        if (typeInput === "password") {
            input.type = "text";

            eyeIcon.classList.add("d-none");
            slashEyeIcon.classList.remove("d-none");
        } else {
            input.type = "password";

            eyeIcon.classList.remove("d-none");
            slashEyeIcon.classList.add("d-none");
        }
    });
}

export default changeStatePasswordType;