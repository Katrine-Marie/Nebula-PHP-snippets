<div class="wrapper cart">
		<h2>
			Din indkøbskurv:
		</h2>
		<div class="fade">
		<?php
			if($_GET['completed']){
				echo '<div class="modal"><p>Din orde er blevet indsendt!</p></div>';
			}
			
			
			if(getCartProductAmount() == 0){
				echo '<p>Din indkøbskurv er tom!</p>';
			}else {
				?>
			<form method="post" action="code/createOrder.php">
				<input type="submit" name="order" value="Placér Ordre">
			</form>
			<br>
				<?php
// 				echo '<pre>';
// 				var_dump($_SESSION);
// 				echo '</pre>';
				
				$total = 0;
				foreach($_SESSION['cart'] as $key=>$cart){
					$total = $total + $cart[2];
					
// 					echo '<pre>';
// 					var_dump($cart);
// 					echo '</pre>';
					echo '<div class="fade">';
					echo '<p><strong>Produkt</strong> - ' . $cart[1] . '</p>';
					echo '<p><strong>Pris</strong> - ' . $cart[2] . ' kr.</p>';
					echo '<p><strong>Kategori</strong> - ' . $cart[3] . '</p>';
					
					?>
					<form method="post" action="">
						<input type="hidden" name="key" value="<?php echo $key; ?>">
						<input type="submit" value="Fjern" name="delete">
					</form>
					<?php
					if(isset($_POST['delete'])){
						unset($_SESSION['cart'][$_POST['key']]);
						
						header("Location: index.php?page=cart");
					}
					
					echo '</div>';
					echo '<p>Total-pris: ' . $total . ' kr.</p>';
				}
			}
			if(isset($_SESSION['cart'])){
		?>
			<form method="post" action="">
				<input class="deletion" type="submit" name="reset" value="Tøm Indkøbskurv">
			</form>
			<?php
			}
				if(isset($_POST['reset'])){
					require_once('code/cart.php');
					
					unsetCartSession();
				}
			?>
		</div>
	</div>
<?php include_once('includes/footer.php'); ?>