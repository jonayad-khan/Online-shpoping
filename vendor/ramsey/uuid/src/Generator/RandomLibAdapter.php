 to support date-ranges
- Google Calendar Options:
	- x draggable -> editable
- Bugfixes
	- gcal extension fetched 25 results max, now fetches all


v1.2.1 (2009-06-29)
-------------------

- bugfixes
	- allows and corrects invalid end dates for events
	- doesn't throw an error in IE while rendering when display:none
	- fixed 'loading' callback when used w/ multiple addEventSource calls
	- gcal className can now be an array


v1.2 (2009-05-31)
-----------------

- expanded API
	- 'className' CalEvent attribute
	- 'source' CalEvent attribute
	- dynamically get/add/remove/update events of current month
	- locale improvements: change month/day name text
	- better date formatting ($.fullCalendar.formatDate)
	- multiple 'event sources' allowed
		- dynamically add/remove event sources
- options for prevYear and nextYear buttons
- docs have been reworked (include addition of Google Calendar docs)
- changed behavior of parseDate for number strings
  (now interpets as unix timestamp, not MS times)
- bugfixes
	- rightToLeft month start bug
	- off-by-one errors with month formatting commands
	- events from previous months sticking when clicking prev/next quickly
- Google Calendar API changed to work w/ multiple event sources
	- can also provide 'className' and 'draggable' options
- date utilties moved from $ to $.fullCalendar
- more documentation in source code
- minified version of fullcalendar.js
- test suit (available from svn)
- top buttons now use `<button>` w/ an inner `<span>` for better css cusomization
	- thus CSS has changed. IF UPGRADING FROM PREVIOUS VERSIONS,
	  UPGRADE YOUR FULLCALENDAR.CSS FILE


v1.1 (2009-05-10)
-----------------

- Added the following options:
	- weekStart
	- rightToLeft
	- titleFormat
	- timeFormat
	- cacheParam
	- resize
- Fixed rendering b