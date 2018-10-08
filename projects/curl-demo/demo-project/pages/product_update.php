<?php
	if(!isset($_SESSION['admin_id'])){
		header("Location: index.php?page=home");
	}
?>
<div class="wrapper">
	
	<h2>
		Rediger produkt:
	</h2>
	<?php
		foreach($currentProduct as $c){
	?>
	<form class="fade" action="code/updateProduct.php" method="post">
		<label for="productName">Navn: </label> 
		<input type="text" name="productName" value="<?php echo $c->productName; ?>">

		<label for="price">Pris: </label>
		<input type="number" name="price" value="<?php echo $c->price; ?>">
		
		<label for="amount">Antal: </label>
		<input type="number" name="amount" value="<?php echo $c->amount; ?>">

		<label for="productDescription">Beskrivelse: </label>
		<textarea name="productDescription"><?php echo $c->productDescription; ?></textarea>

		<label for="category">Kategori: </label>
		<select name="category">
		<?php
			foreach($category as $ca){
				if($ca->categoryId == $c->category->categoryId){
					echo '<option value="' . $ca->categoryId . '" selected>' . $ca->categoryName . '</option>';
				}else {
					echo '<option value="' . $ca->categoryId . '">' . $ca->categoryName . '</option>';
				}
			}
		?>
		</select>

		<input type="hidden" name="id" value="<?php echo $c->productId; ?>">
		
		<input type="submit" name="submit" value="Indsend">
	</form>
	<?php
		}		
	?>
</div>

