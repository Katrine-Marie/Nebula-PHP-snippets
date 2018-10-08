<div class="wrapper">
	<h2>
		Log ind som kunde:
  </h2>
	<div class="fade">
		<form method="post" action="code/login.php">
			<?php
				if($_GET['err']){
					echo '<p class="error">Forkert brugernavn eller password</p>';
				}
			?>
			<div class="form-row">
				<label for="username">Brugernavn</label>
				<input type="text" id="username" name="username" required>
			</div>
			<div class="form-row">
				<label for="password">Password</label>
				<input type="password" id="password" name="password" required>
			</div>
			<div class="form-row">
				<input type="submit" name="submit" value="Log ind">
			</div>
		</form>
		<a href="index.php?page=customer_create">Opret dig som bruger</a>
	</div>
		<h2>
			Log ind som administrator:
		</h2>
		<div class="fade">
			<form method="post" action="code/admin_login.php">
				<?php
					if($_GET['err2']){
						echo '<p class="error">Forkert brugernavn eller password</p>';
					}
				?>
				<div class="form-row">
					<label for="username">Brugernavn</label>
					<input type="text" id="username" name="username" required>
				</div>
				<div class="form-row">
					<label for="password">Password</label>
					<input type="password" id="password" name="password" required>
				</div>
				<div class="form-row">
					<input type="submit" name="submit" value="Log ind">
				</div>
			</form>
		</div>
</div>