<div class="ticker-item">
	<span class="feed-title"><?php print $fields['title_1']->content; ?></span>
	<span class="title"><?php print html_entity_decode($fields['title']->content); ?></span>
	<span class="date">(<?php print format_date($fields['created']->raw, 'custom', 'F j, g:i A'); ?>)</span>
	<span class="body"><?php print $fields['body']->content; ?></span>
</div>