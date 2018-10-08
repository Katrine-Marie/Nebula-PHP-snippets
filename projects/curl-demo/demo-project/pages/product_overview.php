<?php
	if(!isset($_SESSION['admin_id'])){
		header("Location: index.php?page=home");
	}
?>
<div class="wrapper overview">
	<?php
		if($_GET['product_created']){
			echo '<div class="modal"><p>Produkt oprettet!</p></div>';
		}elseif($_GET['product_updated']){
			echo '<div class="modal"><p>Produkt redigeret!</p></div>';
		}elseif($_GET['deleted']){
			echo '<div class="modal"><p>Produkt slettet!</p></div>';
		}
	?>
	<h2>
		Alle produkter: 
	</h2>
 		<?php
			echo '<div class="fade">';
			echo '<table>';
			echo '<thead><th>Navn</th><th>Pris</th><th>Antal</th><th>Kategori</th><th>Rediger</th><th>Slet</th></thead>';
			foreach($product as $p){
				echo '<tr>';
				echo '<td>' . $p->productName . '</td>';
				echo '<td>' . $p->price . '</td>';
				echo '<td>' . $p->amount . '</td>';
				echo '<td>' . $p->category->categoryName . '</td>';
				echo '<td><a href="index.php?page=product_update&id=' . $p->productId . '">Rediger</a></td>';
				echo '<td><a href="index.php?page=product_delete&id=' . $p->productId . '">Slet</a></td>';
				echo '</tr>';
			}
			echo '</table>';
			echo '</div>';
		?>
	
	
</div>

