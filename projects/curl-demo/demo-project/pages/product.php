<?php require_once('code/cart.php'); ?>
<?php 
	if(isset($_POST['add'])){
		addToCart($_POST['productId']);
	}

	if($_GET['added']){
		echo '<div class="modal"><p>Produkt tilføjet til indkøbskurv!</p></div>';
	}
?>
	<div class="wrapper">
 		<?php
			foreach($currentProduct as $c){
				echo '<h2>' . $c->productName . '</h2>';
				echo '<ul class="fade">';
				echo '<li>Pris: ' . $c->price . '</li>';
				echo '<li>Kategori: ' . $c->category->categoryId . ' - ' . $c->category->categoryName . '</li>';
				echo '<li>Beskrivelse: ' . $c->productDescription . '</li>';
				echo '</ul>';
				if($_SESSION['id'] && $c->amount >= 1){
		?>
		<div class="space-between">
		<form method="post" action="">
			<input type="hidden" name="productId" value="<?php echo $c->productId; ?>">
			<input type="submit" value="Læg i indkøbskurv" name="add">
		</form>
		<?php
				}elseif($c->amount < 1){
					echo '<p>Produktet er udsolgt.</p>';
				}
				echo '<a href="index.php?page=products&id=' . $c->category->categoryId . '">Tilbage til kategorien ' . $c->category->categoryName . '</a>';
			}
		?>
		</div>
	</div>