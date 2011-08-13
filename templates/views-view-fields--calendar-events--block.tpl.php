<?php //dpm($fields); 

$date_start = $fields['field_ical_date_value']->content;
$time_start = $fields['field_ical_date_value_1']->content;

if ($fields['field_ical_date_value']->raw == $fields['field_ical_date_value2']->raw) {
	// In ParserIcalFeedsParser.inc, change `$this->start->setTime(6, 0, 0);` to `$this->start->setTime(6, 0, 0);` or else all day events will be improperly adjusted for time zones (they'll show up a day early)
	$date_start = str_replace('(All day)', '', $date_start);
	$time_start = 'All day';
}

if ($fields['field_ical_date_value_1']) {
	$show_time = TRUE;
} else {
	$show_time = FALSE;
}

?>

<div class="fake-row">
	<div class="fake-cell date">
		<?php print $date_start; ?>
	</div>
	<?php if ($show_time): ?>
	<div class="fake-cell time">
		<?php echo $time_start; ?>
	</div>
	<?php endif ?>
	<div class="fake-cell description">
		<?php print $fields['title']->content; ?>
	</div>
</div>