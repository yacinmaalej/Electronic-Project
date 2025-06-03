<?php
require_once('../../Backend/verify_session.php');
require_once '../public/header.php';
$pdo = (new Connexion())->CNXbase();

$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("
    SELECT p.*, c.quantity FROM cart c 
    JOIN products p ON c.product_id = p.id 
    WHERE c.user_id = ?
");
$stmt->execute([$userId]);
$cartProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div id="breadcrumb" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Shopping Cart</h3>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="products-slick">
                    <?php foreach ($cartProducts as $row): ?>
                        <div class="product">
                            <div class="product-img">
                                <img src="../<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                            </div>
                            <div class="product-body">
                                <p class="product-category"><?= htmlspecialchars($row['category']) ?></p>
                                <h3 class="product-name"><a href="#"><?= htmlspecialchars($row['name']) ?></a></h3>
                                <h4 class="product-price">$<?= htmlspecialchars($row['price']) ?>
                                    <del class="product-old-price">$<?= htmlspecialchars($row['price'] + 50) ?></del>
                                </h4>
                                <p>Quantity: <?= htmlspecialchars($row['quantity']) ?></p>
                                <div class="product-btns">
                                    <form action="remove_from_cart.php" method="POST">
                                        <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../public/footer.php'; ?>
