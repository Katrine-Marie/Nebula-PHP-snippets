<div class="wrapper">
 		<?php
			
			$curl = new Curl();
			$singleCategory = $curl->get("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/category/single/{$_GET['id']}");
			$single = json_decode($singleCategory);
			foreach($single as $s){
				echo '<h2>Kategori: ' . $s->categoryName . '</h2>';
			}
			echo '<ul class="fade">';
			if(!empty($productByCategory)){
				foreach($productByCategory as $p){
						echo '<li><strong>Produkt:</strong> <a href="index.php?page=product&id=' . $p->productId . '">' . $p->productName . '</a> - <strong>Pris:</strong> ' . $p->price . ' kr. - <strong>Kategori:</strong> ' . $p->category->categoryName . '</li>';
				}
			}else {
				echo '<h2>Der er endnu ikke tilføjet nogen produkter til denne kategori.</h2>';
			}
			echo '</ul>';
		?>
	</div>
<?php include_once('includes/footer.php'); ?>