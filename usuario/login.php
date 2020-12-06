<?php
require_once('./../layout/Layout.php');
require_once('./../helpers/JsonHandler.php');
require_once('../conexion/db_conexion.php');
require_once('./Usuario.php');
require_once('./Service.php');

if (isset($_SESSION['user'])) {
	header("Location:..");
}

$servicios = new UserService('../conexion');
$msg = "";
$msgAuth = isset($_SESSION['msgAuth']) ? $_SESSION['msgAuth'] : NULL;
unset($_SESSION['msgAuth']);

//Agrega
if (isset($_POST['submit'])) {
	$user = $servicios->Login($_POST['inputUser'], $_POST['inputPassword']);

	if ($user) {
		$_SESSION['user'] = json_encode($user);
		header("Location:../index.php");
		exit();
	} else {
		$msg = "Datos invalidos o usuario no existe";
	}
}

$layout = new Layout();
$layout->PrintTopPage();

?>

<form class="form-signin" method="POST" action="login.php">
	<?php if (!empty($msg)) : ?>
		<div class="alert alert-danger" role="alert">
			<?= $msg; ?>
		</div>
	<?php endif ?>
	<?php if (isset($msgAuth)) : ?>
		<div class="alert alert-warning" role="alert">
			<?= $msgAuth; ?>
		</div>
	<?php endif ?>

	<img class="mb-4" src="../assets/img/df.svg" alt="" width="100" height="100">
	<h3 class="mb-3 font-weight-normal"><?= $layout->PAGE_TITLE; ?></h3>
	<p class="h6 text-muted"><?= $layout->DESC_PAGE; ?></p>
	<label for="inputUser" class="sr-only">Usuario</label>
	<input type="text" id="inputUser" name="inputUser" class="form-control" placeholder="Usuario" required="" autofocus="">
	<label for="inputPassword" class="sr-only">Contraseña</label>
	<input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Contraseña" required="">
	<button name="submit" class="btn btn-lg btn-primary btn-block" type="submit">Iniciar</button>
	<a href="../index.php" class="btn btn-lg btn-outline-danger btn-block">Volver</a>
	<p class="mt-5 mb-3 text-muted">&copy VotoE 2020-2021</p>
</form>