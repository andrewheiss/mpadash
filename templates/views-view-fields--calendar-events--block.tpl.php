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

if ($fields['field_ical_location_value']->content) {
	$show_location = TRUE;
} else {
	$show_location = FALSE;
}

// Check if today is someone's birthday. If so, add a CSS class so it can be highlighted
// This is based on the presence of a "Global: Custom Text" field with the content of "Birthday"
if (isset($fields['nothing']) && $fields['nothing']->content == "Birthday") {
	$is_birthday = TRUE;
	$today = date('m/d');
	// $today = '09/19';
	if (trim($date_start) == $today) {
		$birthday_class = 'birthday-today';
	}
} else {
	$is_birthday = FALSE;
	$birthday_class = '';
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
	<div class="fake-cell">
		<span class="description <?php print $birthday_class; ?>">
			<?php print clean_content($fields['title']->content); ?>
		</span>
		<?php if ($show_location): ?>
		<span class="location">(<?php print $fields['field_ical_location_value']->content; ?>)</span>
		<?php endif ?>
	</div>
</div>