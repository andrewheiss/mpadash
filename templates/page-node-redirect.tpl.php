<?php 
$number = rand(1, 4);
$top = rand(5, 60);
$left = rand(5, 60);
$images_path = base_path() . path_to_theme() . '/images/';
$bg = $images_path . 'tnrb'.$number.'.jpg'
?>
<!DOCTYPE html>
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">
<head>
	<title><?php print $head_title; ?></title>
	<?php print $head; ?>
	<?php print $scripts; ?>
	<style type="text/css">
		#redirect {
			background: url(<?php print $bg; ?>) no-repeat center center fixed;
		    background-size: cover;
			color: #ffffff;
		}

		#redirect #logo {
			width: 464px;
			height: 161px;
			padding: 50px;
			position: absolute;
			top: <?php print $top; ?>%;
			left: <?php print $left; ?>%;
			background-color: rgba(0, 0, 0, .3);
		}
	</style>
</head>
<body id="redirect">
	<div id="logo">
		<img src="<?php print $images_path . 'logo.png'; ?>" alt="RIPM logo" />
	</div>
</body>
</html>