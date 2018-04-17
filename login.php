
<?php
include_once $_SERVER['DOCUMENT_ROOT']."/E-Shop/konfiguracija.php";
include 'include/head.php';

$email=((isset($_POST['email']))?sanitize($_POST['email']):'');
$email = trim($email);
$password=((isset($_POST['password']))?sanitize($_POST['password']):'');

$errors= array();
?>
<body>
  <div class="grid-container">
<br><br>
<style>
/* body{ */
  /* background-image:url("/E-Shop/logo/spots2.jpg");
  background-size: 140vw 140vh; */
/* } */
</style>
      <div class="grid-x grid-padding-x">
    <div class="large-4 large-offset-4 cell centered">

      <div class="wrapper">
      	<div class="container">
      		<h1>Welcome</h1>
      			<?php
      			if(isset($_GET['verify']) && $_GET['verify']==$validation){
      				echo 'Your mail is confirmed. Please log in.';
      				$update = $connection->prepare("
      				update user set active=true where sessionid=:verify;
      				");
      				$update->execute(array(
      				'verify' => $_GET['verify']));
      			}
      			?>
      		<form class="form" action="authorize.php" method="post">
      			<input type="text" placeholder="Username" id="username"  name= "username" value="<?php
      			if (isset($_GET["username"])) {
      				echo $_GET["username"];
      			}
      			?>" required>
      			<input type="password" placeholder="Password" id="pwd" name="password" required>
      			<button type="submit" id="login-button">
      				Login
      			</button>
      			<br />
      			<label>Not a member yet?</label>
      			<br />
      			<a href="register.php" class="button">Register here</a>
      			<br />
      			<?php
      			if (isset($_GET["failure"])) {
      				echo "Wrong Username/Password combination";
      			}
      			?>
      		</form>
      	</div>
      </div>


<!-- <?php include 'includes/podnozje.php' ?> -->
