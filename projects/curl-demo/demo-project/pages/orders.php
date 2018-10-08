<?php
	if(!isset($_SESSION['id'])){
		header("Location: index.php?page=home");
	}
?>
<div class="wrapper customers">
	
	<h2>
		Dine ordrer:
	</h2>
 		<?php
			echo '<div class="fade">';
	
			$curl = new Curl();
			$orderResult = $curl->get("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/order/customer/{$_SESSION['id']}");
			$order = json_decode($orderResult);
			foreach($order as $o){
				$date = date_create($o->timestamp);
				
				echo '<div class="fade">';
				echo '<p>Order-nr.: ' . $o->id . '</p>';
				echo '<p>Ordre indgivet: ' . date_format($date, "d/m - Y (H:i:s)") . '</p>';
				echo '<p>Status: ' . $o->status->statusName . '</p>';
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
			echo '</div>';
		?>
</div>

