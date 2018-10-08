<?php
	if(!isset($_SESSION['admin_id'])){
		header("Location: index.php?page=home");
	}
?>
<div class="wrapper">
	
	<h2>
		Opret produkt:
	</h2>
	
	<form class="fade" action="code/createProduct.php" method="post">
		<label for="productName">Navn: </label> 
		<input type="text" name="productName">

		<label for="price">Pris: </label>
		<input type="number" name="price">
		
		<label for="amount">Antal: </label>
		<input type="number" name="amount">

		<label for="productDescription">Beskrivelse: </label>
		<textarea name="productDescription"></textarea>

		<label for="category">Kategori: </label>
		<select name="category">
		<?php
			foreach($category as $c){
				echo '<option value="' . $c->categoryId . '">' . $c->categoryName . '</option>';
			}
		?>
		</select>

		<input type="submit" name="submit" value="Indsend">
	</form>
</div>

