<?php
$login = false;

if(!empty($_POST['email']) and !empty($_POST['password'])) {


    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = User::login($email, $password);
    $login = true;
}

if($login) {

    if (!$result) {?>
<div class="bg-light p-5 rounded">
	<h1>login failed</h1>
	<p class="lead">error , incorrect username or password </p>
	<a class="btn btn-lg btn-primary" href="login.php" role="button">login Again »</a>
</div>
<?php
    } else {
        ?>
		
<div class="bg-light p-5 rounded">
	<h1>login Successful</h1>
	<p class="lead">This example is a quick exercise to login.</p>
	<a class="btn btn-lg btn-primary" href="/" role="button">HOME PAGE »</a>
</div>

<?php
    }
} else {
    ?>


<main class="form-signin">
	<form action="login.php" method="post">
		<img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
		<h1 class="h3 mb-3 fw-normal">Please sign in</h1>

		<div class="form-floating">
			<input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
			<label for="floatingInput">Email address</label>
		</div>
		<div class="form-floating">
			<input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
			<label for="floatingPassword">Password</label>
		</div>

		<div class="checkbox mb-3">
			<label>
				<input type="checkbox" value="remember-me"> Remember me
			</label>
		</div>
		<button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
		<p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
	</form>
</main>

<?}?>