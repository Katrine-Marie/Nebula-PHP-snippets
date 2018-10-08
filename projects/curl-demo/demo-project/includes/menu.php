<?php require_once('code/cart.php'); ?>
<header>
	<nav>
		<h1>
			<a href="index.php?page=home">
				Imaginary Webshop
			</a>
		</h1>
		<ul class="menu">
			<li class="home"><a href="index.php">Forside</a></li>
			<?php
			$categoriesArray = array();

			foreach($product as $pc){
				foreach($category as $c){
					if($pc->category->categoryId == $c->categoryId){
						$categoriesArray[] = $c->categoryId;
						}
					}
				}
			$menuItems = array_unique($categoriesArray);

			foreach($menuItems as $mi){
				$categoryIdResult = $curl->get("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/category/single/{$mi}");
				$catId = json_decode($categoryIdResult);

				foreach($catId as $cat){
					echo '<li class="cat-' . $cat->categoryId . '"><a href="index.php?page=products&id=' . $cat->categoryId . '">' . $cat->categoryName . '</a></li>';
				}
			}


				if(!isset($_SESSION['id']) && !isset($_SESSION['admin_id'])){
			?>
			<li><a href="index.php?page=login">Log ind</a></li>
			<?php
				} elseif(isset($_SESSION['id'])){
			?>
				<li><a href="index.php?page=cart">Cart (<?php echo getCartProductAmount(); ?>)</a></li>
				<li><a href="index.php?page=orders">Dine ordrer</a></li>
				<li><a href="index.php?page=customer_update">Rediger din profil</a></li>
				<li><a class="warning" href="code/logout.php">Log ud</a></li>
			<?php
				} elseif(isset($_SESSION['admin_id'])) {
			?>
			<li><a class="warning" href="code/logout.php">Log ud</a></li>
		</ul>
	</nav>
	<ul class="admin-menu">
		<li><a href="index.php?page=customers">Kunde-oversigt</a></li>
		<li><a href="index.php?page=product_overview">Produkt-oversigt</a></li>
		<li><a href="index.php?page=product_create">Opret produkt</a></li>
		<li><a href="index.php?page=category_create">Opret kategori</a></li>
		<?php
			}
		?>
	</ul>
</header>