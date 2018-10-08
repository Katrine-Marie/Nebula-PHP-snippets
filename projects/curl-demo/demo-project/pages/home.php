<div class="wrapper home">
	<?php
		if($_GET['product_created']){
			echo '<div class="modal"><p>Produkt oprettet!</p></div>';
		}elseif($_GET['category_created']){
			echo '<div class="modal"><p>Kategori oprettet!</p></div>';
		}elseif($_GET['customer_created']){
			echo '<div class="modal"><p>Din profil er oprettet!</p></div>';
		}elseif($_GET['customer_updated']){
			echo '<div class="modal"><p>Din profil er opdateret!</p></div>';
		}
	
	if(isset($_POST['submit'])){
		$search = htmlspecialchars($_POST['search'], ENT_QUOTES);
		
		echo '<h2>Resultater for søgningen: ' . $search . '</h2>';
		echo '<ul class="fade">';
		$productBySearch = $curl->get("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/product/search/{$search}");
		if(strlen($productBySearch) < 5){
			echo '<p>Ingen resultater. Prøv en anden søgning</p>';
		}else {
			$searchResult = json_decode($productBySearch);
		foreach($searchResult as $s){
				echo '<li><strong>Produkt:</strong> <a href="index.php?page=product&id=' . $s->productId . '">' . $s->productName . '</a> - Pris:</strong> ' . $s->price . ' kr. - <strong>Kategori:</strong> ' . $s->category->categoryName . '</li>';
		}
		}
		echo '</ul>';
	}else {
		echo '<h2>Alle vores produkter:</h2>';
		echo '<ul class="fade">';
		foreach($product as $p){
			echo '<li><strong>Produkt:</strong> <a href="index.php?page=product&id=' . $p->productId . '">' . $p->productName . '</a> - Pris:</strong> ' . $p->price . ' kr. - <strong>Kategori:</strong> ' . $p->category->categoryName . '</li>';
		}
		echo '</ul>';
	}
		?>
	<form method="post" action="" class="inline-form">
		<label for="search">Søg efter produkt:</label>
		<input type="search" name="search">
		<input type="submit" name="submit" value="Søg efter produkt">
	</form>
	
	
</div>

