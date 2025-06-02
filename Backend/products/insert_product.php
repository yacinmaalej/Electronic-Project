
<?php require_once('../../frontend/public/header.php'); ?>
<div class="section">
<div class="container mt-5">
    <h2>Add Product</h2>
    <form action="traitement_insc_prod.php" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="name">Name</label>
            <input type="name" name="name" id="name" class="form-control"  placeholder="Name"required>
        </div>

        <div class="form-group">
            <label for="brand">Brand</label>
            <input type="text" name="brand" class="form-control" placeholder="Brand">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" class="form-control" placeholder="Description">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" placeholder="Price">
        </div>
        <div class="form-group" >
            <label for="category">Category</label>
        <select name="category" class="form-control">
            <option value="accessories">Accessories</option>
            <option value="smartphone" >Smartphone</option>
            <option value="laptop" >Laptop</option>
        </select>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" class="form-control" placeholder="Stock">
        </div>

        <div class="form-group">
            <label for="image">Photo</label>
            <input type="file" name="image" class="form-control-file" id="image" >
           
        </div>

        <button type="submit" class="btn btn-success">Add Product</button>
    </form>
</div>
</div>
<?php require_once('../../frontend/public/footer.php'); ?>
