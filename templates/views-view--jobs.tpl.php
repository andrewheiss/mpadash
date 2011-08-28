<div class="fake-table <?php print $classes; ?>">
<?php
	if ($rows) {
		print $rows;
	} elseif ($empty) {
		print $empty;
	}
?>
</div>