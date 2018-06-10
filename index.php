<?php
require 'php/bootstrap.php';
$bootstrap = new Bootstrap();

ob_start();

try {
	$bootstrap -> execute();

} catch (Exception $exception) {
	$bootstrap -> setError($exception);
	$bootstrap -> execute();
}

$content = ob_get_clean();

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include 'includes/head.php'; ?>
		<script>
			var main = {};
		</script>
	</head>
	<?php flush(); ?>
	<body>
		<a class="skiplink" href="#content">skip to content</a>
		<div class="wrapper" role="main">
			<?php include 'includes/header.php'; ?>
			<?php include 'includes/navigation.php'; ?>

			<div class="content" id="content">
				<?php echo $content; ?>
			</div>
			
			<?php include 'includes/footer.php'; ?>
			<?php include 'includes/disclaimer.php'; ?>
		</div>
		<?php include 'includes/scripts.php'; ?>
	</body>
</html>