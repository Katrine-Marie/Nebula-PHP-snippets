<div class="wrapper">
	
	<h2>
		Opret dig som kunde:
	</h2>
	
	<form class="fade" action="code/createCustomer.php" method="post">
		<label for="name">Navn: </label> 
		<input type="text" name="name" required>

		<label for="username">Brugernavn: </label>
		<input type="text" name="username" required>
		
		<label for="password">Password: </label>
		<input type="password" name="password" required>
		
		<label for="email">E-mail: </label>
		<input type="email" name="email" required>
		
		<label for="address">Adresse: </label>
		<input type="text" name="address">
		
		<label for="zipcode">Zipcode: </label>
		<select name="zipcode">
			<?php
				$curl = new Curl();
			
				$citiesResult = $curl->get("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/zip");
				$cities = json_decode($citiesResult);
			
				foreach($cities as $c){
					echo '<option value="' . $c->zipCode . '">' . $c->zipCode . ' ' . $c->cityName . '</option>';
				}
			?>
		</select>

		<input type="submit" name="submit" value="Indsend">
	</form>
</div>

