<?php
	if(!isset($_SESSION['admin_id'])){
		header("Location: index.php?page=home");
	}
?>
<div class="wrapper customers">
	
	<h2>
		Alle kunder:
	</h2>
 		<?php
			echo '<div class="fade">';
			foreach($allCustomers as $c){
				echo '<div class="fade">';
				echo '<p>Navn: ' . $c->name . '</p>';
				echo '<p>Brugernavn: ' . $c->username . '</p>';

				echo '<br><p><strong>Ordrer:</strong></p>';
				$curl = new Curl();
				$orderResult = $curl->get("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/order/customer/{$c->id}");
				$order = json_decode($orderResult);
				foreach($order as $o){
					$date = date_create($o->timestamp);
					
					echo '<div class="fade">';
					echo '<p>Order-nr.: ' . $o->id . '</p>';
					echo '<p>Ordre indgivet: ' . date_format($date, "d/m - Y (H:i:s)") . '</p>';
					if($o->status->statusId == 2){
						echo '<p>Status: ' . $o->status->statusName . '</p>';
					}else {
						?>
		<form method="post" action="code/updateOrder.php">
			<input type="hidden" name="orderId" value="<?php echo $o->id; ?>">
			<input type="hidden" name="customerId" value="<?php echo $c->id; ?>">
			<input type="hidden" name="timestamp" value="<?php echo $o->timestamp; ?>">
			<input type="submit" value="Marker som udført" name="submit">
		</form>
		<?php
					}
					$detailsResult = $curl->get("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/details/{$o->id}");
				$details = json_decode($detailsResult);
					
					$total = 0;
					
					foreach($details as $d){
						$total = $total + $d->price;
						
						$productIdResult = $curl->get("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/product/{$d->productId}");
	$currentProduct = json_decode($productIdResult);
						foreach($currentProduct as $cp){
							echo '<p>Produkt: ' . $cp->productName . ' - Antal: ' . $d->amount . ' - Pris: '. $d->price . ' kr.</p>';
						}
					}
					echo '<p>Total-pris: ' . $total . '</p>';
					echo '</div>';
					echo '<br>';
				}
				
				echo '</div><br>';
			}
			echo '</div>';
		?>
</div>

