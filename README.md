# Hacks/modifications to enabled modules

# iCal Parser

There's a bug in the fuzzy granularity part of the date module that makes imported all-day iCal events show up on the day before the event. (see http://drupal.org/node/689152)

This can be fixed by editing line 32 of `ParserIcalFeedsParser.inc` to some big number (#5 in the forum above):

	$this->start->SetTime(0,0,0); changes to $this->start->SetTime(10,0,0);

## Feeds

When Feeds runs with Poor Man's Cron, feed update messages will be displayed to all users. So, if an anonymous user happens to visit the page right after a feed update, they'll get a lot of technical, behind the scenes information. 

Unfortunately, the maintainers of Poor Man's Cron and Feeds are in a deadlock over deciding who's module is at fault, so this probably won't get updated in the near future. (http://drupal.org/node/867054)

To fix this, I patched `feeds/plugins/FeedsFeedNodeProcessor.inc`, wrapping the following code (around lines 46-56)

	if ($batch->created) {
		drupal_set_message(…);
	} elseif {
		…
	} else {
		…
	}

with a simple test to check if the user has permission to administer feeds:

	if(user_access("administer feeds")) {
		// drupal_set_message stuff from above
	}

