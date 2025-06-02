
<?php
$wishlistCount = 0;
if (isset($_SESSION['user_id'])) {
    $pdo = (new Connexion())->CNXbase();
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM wishlist WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $wishlistCount = $stmt->fetchColumn();
}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Electro TN</title>

					<!-- Google font -->
			<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

			<!-- Bootstrap -->
			<link rel="stylesheet" href="/Electronic-Project/frontend/css/bootstrap.min.css" />

			<!-- Slick -->
			<link rel="stylesheet" href="/Electronic-Project/frontend/css/slick.css" />
			<link rel="stylesheet" href="/Electronic-Project/frontend/css/slick-theme.css" />

			<!-- nouislider -->
			<link rel="stylesheet" href="/Electronic-Project/frontend/css/nouislider.min.css" />

			<!-- Font Awesome Icon -->
			<link rel="stylesheet" href="/Electronic-Project/frontend/css/font-awesome.min.css" />

			<!-- Custom stylesheet -->
			<link rel="stylesheet" href="/Electronic-Project/frontend/css/style.css" />


    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="tel:+21654088514"><i class="fa fa-phone"></i> +216-54-088-514</a></li>
						<li><a href="mailto:electroTn@contact.tn"><i class="fa fa-envelope-o"></i> electroTn@contact.tn</a></li>
						<li><a href="https://www.google.com/maps/place/Sfax" target="_blank"><i class="fa fa-map-marker"></i> Sfax Tunisia</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="/Electronic-Project/Backend/user/profile.php?id=<?php echo $user['id']; ?>"><i class="fa fa-user-o"></i> My Account</a></li>
                        <li><a href="/Electronic-Project/Backend/user/login.php"><i class="fa fa-sign-out"></i> Logout</a></li>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="/Electronic-Project/frontend/views/index.php" class="logo">
									<img src="/Electronic-Project/frontend/img/logo2.png" style="width: 50%;margin: 7% auto auto auto;">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select">
										<option value="0">All Categories</option>
										<option value="1">Category 01</option>
										<option value="1">Category 02</option>
									</select>
									<input class="input" placeholder="Search here">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
									<div>
										<a href="/Electronic-Project/frontend/views/wishlist.php">
											<i class="fa fa-heart-o"></i>
											<span>Your Wishlist</span>
											<div class="qty" id="wishlist-count"><?= $wishlistCount ?></div>
										</a>
									</div>
								<!-- /Wishlist -->

								<!-- Cart -->
									<div class="dropdown">
										<a  class="dropdown-toggle" id="cartToggle">
											<i class="fa fa-shopping-cart"></i>
											<span>Your Cart</span>
											<div class="qty">3</div>
										</a>
										<div class="cart-dropdown" id="cartDropdown">
											<div class="cart-list" id="cartList">
												<!-- Produits ajoutés dynamiquement en JS -->
											</div>
											<div class="cart-summary">
												<small id="itemCount">3 Item(s) selected</small>
												<h5 id="subtotal">SUBTOTAL: $2940.00</h5>
											</div>
											<div class="cart-btns">
												<a href="#">View Cart</a>
												<a href="/Electronic-Project/frontend/views/checkout.php">Checkout <i class="fa fa-arrow-circle-right"></i></a>
											</div>
										</div>
									</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="/Electronic-Project/frontend/views/index.php">Home</a></li>
						<li><a href="/Electronic-Project/frontend/views/store.php">Categories</a></li>
						<li><a href="/Electronic-Project/frontend/views/store.php">Laptops</a></li>
						<li><a href="/Electronic-Project/frontend/views/store.php">Smartphones</a></li>
						<li><a href="/Electronic-Project/frontend/views/store.php">Accessories</a></li>
						<li><a href="/Electronic-Project/frontend/views/contact.php">Contact</a></li>
						 <?php
								// Check if the user is logged in and is an admin
								 if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
									 echo '<li><a href="/Electronic-Project/Backend/user/list_users.php">Users</a></li>';
								 }
						?>
						

					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->