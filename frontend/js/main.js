document.addEventListener("DOMContentLoaded", function() {
    "use strict";

    // Mobile Nav toggle
    document.querySelector(".menu-toggle > a").addEventListener("click", function(e) {
        e.preventDefault();
        document.getElementById("responsive-nav").classList.toggle("active");
    });

    // Fix cart dropdown from closing
    document.querySelector(".cart-dropdown").addEventListener("click", function(e) {
        e.stopPropagation();
    });

    // Input number handling
    document.querySelectorAll(".input-number").forEach(function(element) {
        let input = element.querySelector("input[type='number']");
        let up = element.querySelector(".qty-up");
        let down = element.querySelector(".qty-down");

        down.addEventListener("click", function() {
            let value = Math.max(parseInt(input.value) - 1, 1);
            input.value = value;
            input.dispatchEvent(new Event("change"));
        });

        up.addEventListener("click", function() {
            let value = parseInt(input.value) + 1;
            input.value = value;
            input.dispatchEvent(new Event("change"));
        });
    });

    // Price Slider using noUiSlider
    let priceSlider = document.getElementById("price-slider");
    let priceInputMin = document.getElementById("price-min");
    let priceInputMax = document.getElementById("price-max");

    if (priceSlider) {
        noUiSlider.create(priceSlider, {
            start: [1, 999],
            connect: true,
            step: 1,
            range: { 'min': 1, 'max': 999 }
        });

        priceSlider.noUiSlider.on("update", function(values, handle) {
            if (handle) {
                priceInputMax.value = values[handle];
            } else {
                priceInputMin.value = values[handle];
            }
        });
    }

    if (priceInputMin) {
        priceInputMin.addEventListener("change", function() {
            priceSlider.noUiSlider.set([this.value, null]);
        });
    }

    if (priceInputMax) {
        priceInputMax.addEventListener("change", function() {
            priceSlider.noUiSlider.set([null, this.value]);
        });
    }
});
