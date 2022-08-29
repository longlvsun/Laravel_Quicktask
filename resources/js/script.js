document.addEventListener("DOMContentLoaded", () => {
    setTimeout(() => {
        const errs = document.querySelector("#errs");
        if (errs) {
            errs.remove();
        }
    }, 3000);
});

const confirmAlert = (buttonId, message) => {
    const button = document.getElementById(buttonId);
    if (button) {
        const res = confirm(message);
        if (res) {
            button.click();
        }
    }
};

window["confirmAlert"] = confirmAlert;
