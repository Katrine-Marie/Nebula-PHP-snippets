<?php
	if(!isset($_SESSION['admin_id'])){
		header("Location: index.php?page=home");
	}
?>
<div class="wrapper">
	
	<h2>
		Opret kategori:
	</h2>
	
	<form class="fade" action="code/createCategory.php" method="post">
		<label for="name">Navn: </label> 
		<input type="text" name="name">

		<input type="submit" name="submit" value="Indsend">
	</form>
</div>

