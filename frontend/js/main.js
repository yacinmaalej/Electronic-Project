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

//===============================Product list =============================

function loadProducts() {
    let category = document.querySelector('input[name="category"]:checked')?.value || '';
    let brand = document.querySelector('input[name="brand"]:checked')?.value || '';
    let minPrice = document.getElementById("price-min").value || 0;
    let maxPrice = document.getElementById("price-max").value || 10000;

    fetch(`list_products.php?category=${category}&brand=${brand}&minPrice=${minPrice}&maxPrice=${maxPrice}`)
        .then(response => response.json())
        .then(products => {
            let productContainer = document.getElementById("product-list");
            productContainer.innerHTML = "";

            products.forEach(product => {
                productContainer.innerHTML += `
                    <div class="col-md-4 col-xs-6">
                        <div class="product">
                            <div class="product-img">
                                <img src="${product.image}" alt="">
                            </div>
                            <div class="product-body">
                                <p class="product-category">${product.category}</p>
                                <h3 class="product-name"><a href="#">${product.name}</a></h3>
                                <h4 class="product-price">$${product.price}</h4>
                            </div>
                            <div class="add-to-cart">
                                <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                            </div>
                        </div>
                    </div>`;
            });
        });
}

// Attach event listeners to filters
document.querySelectorAll(".checkbox-filter input").forEach(input => {
    input.addEventListener("change", loadProducts);
});
document.getElementById("price-min").addEventListener("change", loadProducts);
document.getElementById("price-max").addEventListener("change", loadProducts);

window.onload = loadProducts;


