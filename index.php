<?php session_start()?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>InstaGo</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

		<!-- InstaGo Header -->
		<header id="header" class="alt">
			<div class="inner">
				<h1>InstaGo</h1>
				<p>Free Open-Soruce PHP Instagram Photos Downloader</p>
				<form id="url-form" method="POST" action="insta.php">
					<input type="text" name="url" placeholder="Paste URL Here..."/><br><br>
					<input type="submit" name="get" value="Get Image"/>
					<a style="border-bottom:none" href="https://media.giphy.com/media/7FfMCFDtOJKuvMYEs7/giphy.gif" target="blank">
						<input type="button" value="How to use?">
					</a>
				</form>
			</div>
		</header>

		<!-- Session Messages -->
		<?php 
		if (isset($_SESSION['response'])):
			if ($_SESSION['response'] == 'error'):?>
				<script>
					function TriggerIt() {
						alertify.alert('Invalid URL :( Insert Valid Instagram Post URL');
					}
				</script>
			<?php 
			else:?>
			<div class="modal">
				<h2>Right Click on the image and save it, click anywhere to close;)</h2>
				<img src="<?php echo $_SESSION['response']?>">
			</div>
		<?php 
			endif;
		endif?>

		<!-- Scripts -->
		<script src="https://cdn.rawgit.com/alertifyjs/alertify.js/v1.0.10/dist/js/alertify.js"></script>
		<script src="assets/js/main.js"></script>
	</body>
</html>
<?php session_destroy()?>