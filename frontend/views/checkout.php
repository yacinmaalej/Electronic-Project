<?php
require_once('../../Backend/verify_session.php');
require_once '../../Backend/user/user.class.php'; // Include your functions file
require_once '../public/header.php';
require_once '../../Backend/user/cart.class.php';
$utilisateur = new Utilisateur();
$cart = new Cart();

// Retrieve user data
$userData = $utilisateur->getUserById($_SESSION['user_id']); // Fetch user data

// Retrieve cart items
$cartItems = $cart->getCartItems($_SESSION['user_id']); // Fetch cart items

$totalPrice = 0;
?>

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Checkout</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="#">Home</a></li>
                    <li class="active">Checkout</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <!-- Billing Details -->
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title">Billing address</h3>
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="name" placeholder="Last Name" value="<?php echo htmlspecialchars($userData['nom']); ?>">
                    </div>
                    <div class="form-group">
                        <input class="input" type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($userData['email']); ?>">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="address" placeholder="Address" value="<?php echo htmlspecialchars($userData['address']); ?>">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="city" placeholder="City" value="<?php echo htmlspecialchars($userData['city']); ?>">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="country" placeholder="Country" value="<?php echo htmlspecialchars($userData['country']); ?>">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="zip-code" placeholder="ZIP Code" value="<?php echo htmlspecialchars($userData['zip_code']); ?>">
                    </div>
                    <div class="form-group">
                        <input class="input" type="tel" name="tel" placeholder="Telephone" value="<?php echo htmlspecialchars($userData['phone']); ?>">
                    </div>
                </div>
                <!-- /Billing Details -->

                <!-- Order notes -->
                <div class="order-notes">
                    <textarea class="input" placeholder="Order Notes"></textarea>
                </div>
                <!-- /Order notes -->
            </div>

            <!-- Order Details -->
            <div class="col-md-5 order-details">
                <div class="section-title text-center">
                    <h3 class="title">Your Order</h3>
                </div>
                <div class="order-summary">
                    <div class="order-col">
                        <div><strong>PRODUCT</strong></div>
                        <div><strong>TOTAL</strong></div>
                    </div>
                    <div class="order-products">
                        <?php foreach ($cartItems as $item): 
                            $totalPrice += $item['price'] * $item['quantity']; ?>
                            <div class="order-col">
                                <div><?php echo $item['quantity']; ?>x <?php echo htmlspecialchars($item['name']); ?></div>
                                <div>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="order-col">
                        <div>Shipping</div>
                        <div><strong>FREE</strong></div>
                    </div>
                    <div class="order-col">
                        <div><strong>TOTAL</strong></div>
                        <div><strong class="order-total">$<?php echo number_format($totalPrice, 2); ?></strong></div>
                    </div>
                </div>
                
                <a href="index.php" class="primary-btn order-submit">Place order</a>
            </div>
            <!-- /Order Details -->
        </div>
    </div>
</div>
<!-- /SECTION -->

<!-- NEWSLETTER -->
<div id="newsletter" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="newsletter">
                    <p>Sign Up for the <strong>NEWSLETTER</strong></p>
                    <form>
                        <input class="input" type="email" placeholder="Enter Your Email">
                        <button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
                    </form>
                    <ul class="newsletter-follow">
                        <li>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /NEWSLETTER -->

<?php require_once '../public/footer.php'; ?>
