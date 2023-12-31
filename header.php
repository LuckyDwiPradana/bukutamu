<!DOCTYPE html>
<html lang="en">
<head>
	<title>Buku Tamu</title>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.css">
 <script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<style>
	body { background: url(image/login.jpg);
 background-size: cover;}
 .container { background: auto; }
</style>

<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Buku Tamu</a>
		</div>
			

		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a id="pesan_sedia" href="#" data-toggle="modal" data-target="#myModal"><span class='glyphicon glyphicon-list-alt'></span>  Isi Buku Tamu</a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li><a href="admin/"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
			</ul>

		</div>
	</div>
</nav>