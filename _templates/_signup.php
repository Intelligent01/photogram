<?

$signup=false;


if(!empty($_POST['username']) and !empty($_POST['phone']) and !empty($_POST['email']) and !empty($_POST['password']) ){
   
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $error=false;
    $error= user::signup($username, $email, $password, $password);
    $signup=true;
}
if ($signup) {
    
    if(!$error){
      ?>
    <div class="bg-light p-5 rounded">
        <h1>signup Failed</h1>
        <p class="lead">error to signup,<?=$error?></p>
        <a class="btn btn-lg btn-primary" href="/docs/5.0/components/navbar/" role="button">signup »</a>
      </div>
    
    
    <?php 
    }else{
      ?>
      <div class="bg-light p-5 rounded">
        <h1>signup Successful</h1>
        <p class="lead">This example is a quick exercise to signup.</p>
        <a class="btn btn-lg btn-primary" href="/docs/5.0/components/navbar/" role="button">login »</a>
      </div>

    <?}
}else{
?>


<main class="form-signup">
  <form action="signup.php" method="post">
    <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Please sign up</h1>

    <div class="form-floating">
    <input name="username" type="text" class="form-control" id="floatingInput" placeholder="Username">
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
      <input name="phone" type="tel" class="form-control" id="floatingPassword" placeholder="Phone">
      <label for="floatingPassword">Phone</label>
    </div>
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
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
  </form>
</main>

<?}?>