<?php
	if(!isset($_SESSION['admin_id'])){
		header("Location: index.php?page=home");
	}

	require_once("class/Category.php");
	require_once("class/Product.php");

	if(isset($_GET['id'])){
		$id = $_GET['id'];
		
		foreach($currentProduct as $c) { 
			$name = $c->productName;
		}
		
		// confirmation
		if(!isset($_POST['confirm'])){
			$confirm = "Vil du slette produktet " . $name . "?";
		}
		else {
			
			$curl->delete("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/product/{$id}");
			
			header('Location: index.php?page=product_overview&deleted=true');
		}
		
		if(isset($_POST['deny'])){
			header('Location: index.php?page=product_overview');
		};
	}
?> 
	
<div class="wrapper">
	
	<h2>
		Slet produkt:
	</h2>
	<div class="delete">
		<p>
			Vil du slette produktet <?php echo $name; ?>?
		</p>
		<form method="post">
			<input class="deletion" type="submit" name="confirm" value="Ja">
			<input type="submit" name="deny" value="Nej">
		</form>
	</div>
</div>