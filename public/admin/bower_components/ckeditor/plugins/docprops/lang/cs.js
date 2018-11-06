ells.
  (solves [299])
- can now color events through FullCalendar options and Event-Object properties ([117])
  THIS IS NOW THE PREFERRED METHOD OF COLORING EVENTS (as opposed to using className and CSS)
	- FullCalendar options:
		- eventColor (changes both background and border)
		- eventBackgroundColor
		- eventBorderColor
		- eventTextColor
	- Event-Object options:
		- color (changes both background and border)
		- backgroundColor
		- borderColor
		- textColor
- can now specify an event source as an *object* with a `url` property (json feed) or
  an `events` property (function or array) with additional properties that will
  be applied to the entire event source:
	- color (changes both background and border)
	- backgroudColor
	- borderColor
	- textColor
	- className
	- editable
	- allDayDefault
	- ignoreTimezone
	- startParam (for a feed)
	- endParam   (for a feed)
	- ANY OF THE JQUERY $.ajax OPTIONS
	  allows for easily changing from GET to POST and sending additional parameters ([386])
	  allows for easily attaching ajax handlers such as `error` ([754])
	  allows for turning caching on ([355])
- Google Calendar feeds are now specified differently