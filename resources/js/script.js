document.addEventListener("DOMContentLoaded", () => {
    setTimeout(() => {
        const errs = document.querySelector("#errs");
        if (errs) {
            errs.remove();
        }
    }, 3000);
});
