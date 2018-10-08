<?php
	if(!isset($_SESSION['id'])){
		header("Location: index.php?page=home");
	}
?>
<div class="wrapper">
	
	<h2>
		Rediger din profil:
	</h2>
	<?php
		$curl = new Curl();
		$customerResult = $curl->get("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/customer/{$_SESSION['id']}");
		$customer = json_decode($customerResult);
	
		foreach($customer as $c){
	?>
	<form class="fade" action="code/updateCustomer.php" method="post">
		<label for="name">Navn: </label> 
		<input type="text" name="name" value="<?php echo $c->name; ?>" required>

		<label for="username">Brugernavn: </label>
		<input type="text" name="username" value="<?php echo $c->username; ?>" required>
		
		<label for="password">Password: </label>
		<input type="password" name="password" value="<?php echo $c->password; ?>" required>
		
		<label for="email">E-mail: </label>
		<input type="email" name="email"  value="<?php echo $c->email; ?>" required>
		
		<label for="address">Adresse: </label>
		<input type="text" name="address"  value="<?php echo $c->address; ?>">
		
		<label for="zipcode">Zipcode: </label>
		<select name="zipcode">
			<?php
				$curl = new Curl();
			
				$citiesResult = $curl->get("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/zip");
				$cities = json_decode($citiesResult);
			
				foreach($cities as $ci){
					if($ci->zipCode == $c->zipcode){
						echo '<option value="' . $ci->zipCode . '" selected>' . $ci->zipCode . ' ' . $ci->cityName . '</option>';
					}else {
						echo '<option value="' . $ci->zipCode . '">' . $ci->zipCode . ' ' . $ci->cityName . '</option>';
					}
				}
			?>
		</select>

		<input type="submit" name="submit" value="Indsend">
	</form>
	<?php
		}		
	?>
</div>

