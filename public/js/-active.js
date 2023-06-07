var x = document.querySelector("#returned");

x.addEventListener("click", function () {
    if (x.value == 0) {
        x.value = 1;
    } else {
        x.value = 0;
    }
});
