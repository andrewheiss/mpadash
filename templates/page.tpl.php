<!DOCTYPE html>
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">
<head>
	<title><?php print $head_title; ?></title>
	<?php print $head; ?>
	<link href='http://fonts.googleapis.com/css?family=Copse' rel='stylesheet' type='text/css' />
	<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:regular,bold" rel="stylesheet" type="text/css" />
	<?php print $styles; ?>
  
	<meta name="description" content="" />
	<meta name="keywords" content="" />
</head>
<body id="dashboard" class="<?php echo $classes; ?>">
	<?php if (!$is_front): ?>
		<?php print $messages; ?>
		<section id="mini-content-wrapper" class="row">
			<section id="navigation" class="column grid_4">
				<?php print $admin_navigation; ?>
			</section>
			<section id="mini-content" class="column grid_12">
				<?php print $tabs; ?>
				<?php print $content; ?>
			</section>
		</section>	
	<?php endif ?>

	<div class="row">
		<div id="sidebar" class="column grid_4">
			<div class="first-row">
				<div class="column grid_4">
					<aside id="info">
						<div id="datetime">
							<div id="time"></div>
							<div id="date"></div>
						</div>
						<div id="weather"></div>
					</aside>
				</div>
			</div>
			<div class="row">
				<div id="box-under-time" class="cycle column grid_4">
					<?php print $box_under_time; ?>
				</div>
			</div>
		</div>
		<div id="large-area" class="column grid_12">
			
			<section data-duration="<?php print $group_of_blocks_duration; ?>" id="blocks">
				<div class="first-row">
					<div class="block-cycle column grid_8">
						<?php print $large_area_top_left; ?>
					</div>
					<div class="block-cycle column grid_4">
						<?php print $large_area_top_right; ?>
					</div>
				</div>
				<div class="row">
					<div class="block-cycle column grid_8">
						<?php print $large_area_bottom_left; ?>
					</div>
					<div class="block-cycle column grid_4">
						<?php print $large_area_bottom_right; ?>
					</div>
				</div>
			</section>
			<section data-duration="<?php print $ad_duration; ?>" id="large-image">
				<?php print $large_area_image; ?>
			</section>
		</div>
	</div>
	
	<div id="ticker-wrapper" class="row">
		<?php print $ticker; ?>
	</div>
	
	<?php if ($use_google_jquery): ?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<?php endif ?>
	
	<?php print $scripts; ?>
	<script>
	$(document).ready(function() {
	    $('#ticker-wrapper').cycle({
			fx: 'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...
			timeout: <?php print $ticker_block_duration; ?>,
			speed: 700,
		});
		
		$('#large-area').cycle({
			fx: 'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...
			speed: 700,
			timeoutFn: function(curr, next, opts, fwd) {
			    return parseInt($(opts.elements[opts.currSlide]).attr("data-duration")); }
		});
		
		$('.block-cycle').cycle({
			fx: 'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...
			timeout: <?php print $block_duration; ?>,
			speed: 700,
		});
		
	});
	</script>
</body>
</html>
