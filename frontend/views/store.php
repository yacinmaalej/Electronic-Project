<?php
require_once('../../Backend/verify_session.php');
require_once '../public/header.php';

$pdo = (new Connexion())->CNXbase();
$brandsStmt = $pdo->query("SELECT DISTINCT brand FROM products ORDER BY brand ASC");
?>
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <ul class="section-tab-nav tab-nav">
                        <li><a href="#tab2" data-category="all">All</a></li>
                        <li><a href="#tab2" data-category="laptop">Laptops</a></li>
                        <li><a href="#tab2" data-category="smartphone">Smartphones</a></li>
                        <li><a href="#tab2" data-category="accessories">Accessories</a></li>
                    </ul>
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
        
                <!-- products -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="add-new-product">
                                    <a href="../../Backend/products/insert_product.php" class="btn btn-primary">Add New Product</a>
                                </div>
                        <div class="products-tabs">
                            <div id="tab2" class="tab-pane fade in active">
                                <div class="products-slick" id="products-list" ></div>
                                <div id="slick-nav-2" class="products-slick-nav"></div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /products -->

            </div>
            <!-- /STORE -->
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
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /NEWSLETTER -->

<?php require_once '../public/footer.php'; ?>
</body>
</html>
