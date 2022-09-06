<?php
include('db/config.php');

// Check to make sure the id parameter is specified in the URL
if (isset($_GET['idartikel'])) {
    // Prepare statement and execute, prevents SQL injection
    $results = $connect->prepare('SELECT * FROM artikel WHERE idartikel = ?');
    $results->execute([$_GET['idartikel']]);
    // Fetch the product from the database and return the result as an Array
    $product = $results->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
?>
<div class="product content-wrapper">
    <img src="Img/<?=$product['bestand']?>" width="500" height="500" alt="<?=$product['naamproduct']?>">
    <div>
        <h1 class="name"><?=$product['naamproduct']?></h1>
        <span class="price">
            &dollar;<?=$product['prijs']?>
            <?php if ($product['prijs'] > 0): ?>
                <span class="rrp">&dollar;<?=$product['prijs']?></span>
            <?php endif; ?>
        </span>
        <form action="index.php?page=winkelmandje" method="post">
            <input type="number" name="quantity" value="1" min="1" max="<?=$product['aantal']?>" placeholder="Quantity" required>
            <input type="hidden" name="product_id" value="<?=$product['idartikel']?>">
            <input type="submit" value="Add To Cart">
        </form>
        <div class="description">
            <?=$product['omschrijving']?>
        </div>
    </div>
</div>
