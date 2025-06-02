<?php
require_once('../../Backend/verify_session.php');
require_once '../public/header.php';
$pdo = (new Connexion())->CNXbase();

$userId = $_SESSION['user_id'];


$stmt = $pdo->prepare("
    SELECT p.* FROM wishlist w 
    JOIN products p ON w.product_id = p.id 
    WHERE w.user_id = ?
");
$stmt->execute([$userId]);
$wishlistProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Wichlist</h3>
						
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							
									<div class="products-slick">
									<?php	foreach ($wishlistProducts as $row): 
										$isFavorited = false;
										if (isset($_SESSION['user_id'])) {
											$userId = $_SESSION['user_id'];
											$check = $pdo->prepare("SELECT 1 FROM wishlist WHERE user_id = ? AND product_id = ?");
											$check->execute([$userId, $row['id']]);
											$isFavorited = $check->fetchColumn() > 0;
										}?>
										 <div class="product">
											<div class="product-img">
												<img src="../<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
												<div class="product-label">
													<span class="sale">-30%</span>
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category"><?= htmlspecialchars($row['category']) ?></p>
												<h3 class="product-name"><a href="#"><?= htmlspecialchars($row['name']) ?></a></h3>
												<h4 class="product-price">$<?= htmlspecialchars($row['price']) ?>
													<del class="product-old-price">$<?= htmlspecialchars($row['price'] + 50) ?></del>
												</h4>
												<div class="product-rating">
													<i class="fa fa-star"></i><i class="fa fa-star"></i>
													<i class="fa fa-star"></i><i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="product-btns">
													<button class="add-to-wishlist" data-product-id="<?= $row['id'] ?>"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
													<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
												</div>
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
											</div>
										</div>
										<?php endforeach; ?>
									</div>					 
								<!-- /product -->
									
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
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
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->
<?php require_once '../public/footer.php';?>
	</body>
</html>
