<?php
require_once("../Backend/config.php");
$cnx = new Connexion();
$pdo = $cnx->CNXpdo();

$category = isset($_GET['category']) ? $_GET['category'] : 'all';

if ($category !== 'all') {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE category = :category ORDER BY price");
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
} else {
    $stmt = $pdo->prepare("SELECT * FROM products ");
}

$stmt->execute();
$topProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);


foreach ($topProducts as $row): ?>
    <div class="product">
        <div class="product-img">
            <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
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
                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
            </div>
        </div>
        <div class="add-to-cart">
            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
        </div>
    </div>
<?php endforeach; ?>
