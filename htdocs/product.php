<?php

if (isset($_GET['naamproduct'])) {
    // Prepare statement and execute, prevents SQL injection
    $results = $connect->prepare("SELECT * FROM artikel");
    //$results->bindValue(':search'.'%'.$search.'%');
    $product = $connect->prepare(PDO::FETCH_ASSOC);
    $results = $results->execute();

    // Fetch the product from the database and return the result as an Array
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
        <form action="index.html?page=winkelmandje" method="post">
            <input type="hidden" name="product_id" value="<?=$product['idartikel']?>">
            <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
        </form>
        <div class="description">
            <?=$product['omschrijving']?>
        </div>
    </div>
</div>
