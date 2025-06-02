//===============================Your cart drop down list =============================

document.addEventListener('DOMContentLoaded', function() {
    // Éléments du DOM
    const cartToggle = document.getElementById('cartToggle');
    const dropdown = cartToggle.closest('.dropdown'); // Plus précis que querySelector
    const cartList = document.getElementById('cartList');
    const itemCount = document.getElementById('itemCount');
    const subtotal = document.getElementById('subtotal');

    if (!cartToggle) {
        console.error("L'élément #cartToggle n'existe pas dans le DOM");
        return;
    }

    // Données du panier (exemple)
    const cartItems = [
        { id: 1, name: "product name goes here", price: 980.00, quantity: 1, img: "./img/product01.png" },
        { id: 2, name: "product name goes here", price: 980.00, quantity: 3, img: "./img/product02.png" }
    ];

    // Afficher/masquer le dropdown
    cartToggle.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation(); // Empêche la propagation immédiate
        dropdown.classList.toggle('open');
    });

    // Fermer le panier quand on clique ailleurs
    document.addEventListener('click', function(e) {
        if (!dropdown.contains(e.target) && e.target !== cartToggle) {
            dropdown.classList.remove('open');
        }
    });

    // Remplir le panier
    function renderCart() {
        cartList.innerHTML = '';
        let totalItems = 0;
        let totalPrice = 0;

        cartItems.forEach(item => {
            totalItems += item.quantity;
            totalPrice += item.price * item.quantity;

            const productWidget = document.createElement('div');
            productWidget.className = 'product-widget';
            productWidget.innerHTML = `
                <div class="product-img">
                    <img src="${item.img}" alt="">
                </div>
                <div class="product-body">
                    <h3 class="product-name"><a href="#">${item.name}</a></h3>
                    <h4 class="product-price"><span class="qty">${item.quantity}x</span>$${item.price.toFixed(2)}</h4>
                </div>
                <button class="delete" data-id="${item.id}"><i class="fa fa-close"></i></button>
            `;
            cartList.appendChild(productWidget);
        });

        // Mettre à jour le résumé
        itemCount.textContent = `${totalItems} Item(s) selected`;
        subtotal.textContent = `SUBTOTAL: $${totalPrice.toFixed(2)}`;
        document.querySelector('.qty').textContent = totalItems;

        // Gestion de la suppression
        document.querySelectorAll('.delete').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                const id = parseInt(this.getAttribute('data-id'));
                const index = cartItems.findIndex(item => item.id === id);
                if (index !== -1) {
                    cartItems.splice(index, 1);
                    renderCart();
                }
            });
        });
    }

    // Initialisation
    renderCart();
});

//===============================End Your cart drop down list =============================

//=======================================index page ================



document.addEventListener('DOMContentLoaded', function () {
    const tabLinks = document.querySelectorAll('.section-tab-nav a');
    const productContainer = document.querySelector('#tab2 .products-slick');

    function loadProducts(category = 'all') {
        // Load products based on the category
        const url = 'product_section.php?category=' + category;

        fetch(url)
            .then(res => res.text())
            .then(html => {
                productContainer.innerHTML = html;

                // Set active class if match found
                tabLinks.forEach(link => {
                    const linkCategory = link.getAttribute('data-category');
                    if (linkCategory === category) {
                        link.parentElement.classList.add('active');
                    } else {
                        link.parentElement.classList.remove('active');
                    }
                });
            })
            .catch(err => console.error('Fetch error:', err));
    }

    // Handle tab clicks
    tabLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const category = this.getAttribute('data-category');
            loadProducts(category);
        });
    });

    // Load the default category (change 'laptops' to 'all' if needed)
    loadProducts('all');
});




//======================================= End index page ================

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

// Fonction pour vérifier si on est sur la page produit
function isProductPage() {
    // Vérifie la présence d'éléments spécifiques à la page produit
    return document.getElementById('product-list') !== null;
}

    function loadProducts() {
        // Ne rien faire si on n'est pas sur la page produit
        if (!isProductPage()) return;

        let category = document.querySelector('input[name="category"]:checked')?.value || '';
        let brand = document.querySelector('input[name="brand"]:checked')?.value || '';
        let minPrice = document.getElementById("price-min")?.value || 0;
        let maxPrice = document.getElementById("price-max")?.value || 10000;

        fetch(`list_products.php?category=${category}&brand=${brand}&minPrice=${minPrice}&maxPrice=${maxPrice}`)
            .then(response => response.json())
            .then(products => {
                let productContainer = document.getElementById("product-list");
                if (!productContainer) return;
                
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
            })
            .catch(error => console.error('Error loading products:', error));
    }

    // Attacher les événements seulement sur la page produit
    if (isProductPage()) {
        // Écouteurs pour les filtres
        document.querySelectorAll(".checkbox-filter input").forEach(input => {
            input.addEventListener("change", loadProducts);
        });

        // Écouteurs pour les prix (avec vérification d'existence)
        const priceMin = document.getElementById("price-min");
        const priceMax = document.getElementById("price-max");
        
        if (priceMin) priceMin.addEventListener("change", loadProducts);
        if (priceMax) priceMax.addEventListener("change", loadProducts);

        // Chargement initial
        window.addEventListener('load', loadProducts);
    }

//===============================End Product list =============================



