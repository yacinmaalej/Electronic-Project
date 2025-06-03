//===============================Header catégories =============================

document.getElementById('category-search-form').addEventListener('submit', function(e) {
    e.preventDefault(); 

    const categoryId = document.getElementById('category-select').value;
    const searchQuery = document.querySelector('.header-search .input').value; // Get the search query if needed

    if (categoryId !== "0") {
        window.location.href = `store.php?category=${categoryId}&search=${encodeURIComponent(searchQuery)}`;
    } else {
        window.location.href = `store.php?search=${encodeURIComponent(searchQuery)}`;
    }
});
//===============================End Header catégories =============================

//===============================Your cart drop down list =============================

document.addEventListener('DOMContentLoaded', function() {
    const cartToggle = document.getElementById('cartToggle');
    const dropdown = cartToggle.closest('.dropdown');
    const cartList = document.getElementById('cartList');
    const subtotal = document.getElementById('subtotal'); 
    const cartQuantity = document.querySelector('.qty'); 

    

    if (!cartToggle || !cartList || !itemCount || !subtotal || !cartQuantity) {
        console.error("One or more elements are not found in the DOM");
        return;
    }

    let cartItems = [];

    cartToggle.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        dropdown.classList.toggle('open');
        fetchCartItems();
    });

    document.addEventListener('click', function(e) {
        if (!dropdown.contains(e.target) && e.target !== cartToggle) {
            dropdown.classList.remove('open');
        }
    });

    function fetchCartItems() {
        fetch('get_cart.php')
            .then(response => response.json())
            .then(data => {
                cartItems = data;
                renderCart();
            })
            .catch(error => console.error('Error fetching cart items:', error));
    }

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
                    <img src="../${item.image}" alt="${item.name}">
                </div>
                <div class="product-body">
                    <h3 class="product-name"><a href="#">${item.name}</a></h3>
                    <h4 class="product-price"><span class="qty">${item.quantity}x</span>$${item.price.toFixed(2)}</h4>
                </div>
            `;
            cartList.appendChild(productWidget);
        });

        itemCount.textContent = `${totalItems} Item(s) selected`;
        subtotal.textContent = `SUBTOTAL: $${totalPrice.toFixed(2)}`;
        cartQuantity.textContent = totalItems; 
    }

    // Event delegation for delete buttons
    cartList.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete')) {
            const productId = e.target.getAttribute('data-id');
            removeFromCart(productId);
        }
    });

    function removeFromCart(productId) {
        fetch('remove_from_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_id=${productId}`
        })
        .then(response => {
            if (response.ok) {
                fetchCartItems(); 
            } else {
                console.error('Failed to remove item from cart');
            }
        })
        .catch(error => console.error('Error removing item from cart:', error));
    }

    fetchCartItems(); 
});


//===============================End Your cart drop down list =============================

//=======================================index page ================



document.addEventListener('DOMContentLoaded', function () {
    const tabLinks = document.querySelectorAll('.section-tab-nav a');
    const productContainer = document.querySelector('#tab2 .products-slick');

    function loadProducts(category = 'all') {
        const url = '/Electronic-Project/frontend/views/product_section.php?category=' + category;

        fetch(url)
            .then(res => res.text())
            .then(html => {
                productContainer.innerHTML = html;

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

    tabLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const category = this.getAttribute('data-category');
            loadProducts(category);
        });
    });

    loadProducts('all');
});




//======================================= End index page ================

document.addEventListener("DOMContentLoaded", function() {
    "use strict";

    document.querySelector(".menu-toggle > a").addEventListener("click", function(e) {
        e.preventDefault();
        document.getElementById("responsive-nav").classList.toggle("active");
    });

    document.querySelector(".cart-dropdown").addEventListener("click", function(e) {
        e.stopPropagation();
    });

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
        document.querySelectorAll(".checkbox-filter input").forEach(input => {
            input.addEventListener("change", loadProducts);
        });

        const priceMin = document.getElementById("price-min");
        const priceMax = document.getElementById("price-max");
        
        if (priceMin) priceMin.addEventListener("change", loadProducts);
        if (priceMax) priceMax.addEventListener("change", loadProducts);

        window.addEventListener('load', loadProducts);
    }


// Fonction pour gérer les wichlist    


document.addEventListener('click', function (e) {
    const btn = e.target.closest('.add-to-wishlist');
    if (!btn) return;
    
    const productId = btn.dataset.productId;
    const icon = btn.querySelector('i');

    fetch('/Electronic-Project/Backend/products/toggle_wishlist.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'product_id=' + encodeURIComponent(productId)
    })
    .then(response => response.json())
    .then(data => {
    if (data.success) {
        icon.classList.toggle('fa-heart');
        icon.classList.toggle('fa-heart-o');

        // Mise à jour du compteur
        if (data.action === 'added') {
            updateWishlistCount(1);
        } else if (data.action === 'removed') {
            updateWishlistCount(-1);
        }
    } else {
        alert(data.message || 'Login required');
    }
})

    .catch(error => {
        console.error('Error:', error);
        alert('Error processing wishlist');
    });
});

// mettre à jour dynamiquement #wishlist-count après chaque clic
function updateWishlistCount(change) {
    const countElem = document.getElementById('wishlist-count');
    if (!countElem) return;
    let count = parseInt(countElem.textContent) || 0;
    count += change;
    countElem.textContent = count < 0 ? 0 : count;
}

function fetchAndUpdateWishlistCount() {
    fetch('/Electronic-Project/Backend/products/get_count.php')
        .then(res => res.json())
        .then(data => {
            const countElem = document.getElementById('wishlist-count');
            if (countElem) {
                countElem.textContent = data.count;
            }
        })
        .catch(err => console.error('Error loading wishlist count:', err));
}

document.addEventListener('DOMContentLoaded', function () {
    fetchAndUpdateWishlistCount();
});

//===============================Store page product list =============================



//===============================End Product list =============================



