
v3.5.1 (2017-09-06)
-------------------

- fixed loading trigger not firing (#3810)
- fixed overaggressively fetching events, on option changes (#3820)
- fixed event object `date` property being discarded (tho still parsed) (#3819)
- fixed event object `_id` property being discarded (#3811)


v3.5.0 (2017-08-30)
-------------------

Features:
- Bootstrap 3 theme support (#2334, #3566)
	- via `themeSystem: 'bootstrap3'` (the `theme` option is deprecated)
	- new `bootstrapGlyphicons` option
	- jQuery UI "Cupertino" theme no longer included in zip archive
	- improved theme switcher on demo page (#1436)
	(big thanks to @joankaradimov)
- 25% event rendering performance improvement across the board (#2524)
- console message for unknown method/calendar (#3253)
- Serbian cyrilic/latin (#3656)
- available via Packagist (#2999, #3617)

Bugfixes:
- slot time label invisible when minTime starts out of alignment (#2786)
- bug with inverse-background event rendering when out of range (#3652)
- wrongly disabled prev/next when current date outside of validRange (#3686, #3651)
- updateEvent, error when changing allDay from false to true (#3518)
- updateEvent doesn't support ID changes (#2928)
- Promise then method doesn't forward result (#3744)
- Korean typo (#3693)

Incompatibilities:
- Event Objects obtained from clientEvents or various callbacks are no longer
  references to internally used objects. Rather, they are static object copies.


v3.4.0 (2017-04-27)
-------------------

- composer.json for Composer (PHP package manager) (#3617)
- fix toISOString for locales with non-trivial postformatting (#3619)
- fix for nested inverse-background events (#3609)
- Estonian locale (#3600)
- fixed Latvian localization (#3525)
- internal refactor of async systems


v3.3.1 (2017-04-01)
-------------------

Bugfixes:
- stale calendar title when navigate away from then back to the a view (#3604)
- js error when gotoDate immediately after calendar initialization (#3598)
- agenda view scrollbars causes misalignment in jquery 3.2.1 (#3612)
- navigation bug when trying to navigate to a day of another week (#3610)
- dateIncrement not working when duration and dateIncrement have different units


v3.3.0 (2017-03-23)
-------------------

Features:
- `visibleRange` - complete control over view's date range (#2847, #3105, #3245)
- `validRange` - restrict date range (#429)
- `changeView` - pass in a date or visibleRange as second param (#3366)
- `dateIncrement` - customize prev/next jump (#2710)
- `dateAlignment` - custom view alignment, like start-of-week (#3113)
- `dayCount` - force a fixed number-of-days, even with hiddenDays (#2753)
- `showNonCurrentDates` - option to hide day cells for prev/next months (#437)
- can define a defaultView with a duration/visibleRange/dayCount with needing
  to create a custom view in the `views` object. Known as a "Generic View".

Behavior Changes:
- when custom view is specified with duration `{days:7}`,
  it will no longer align with the start of the week. (#2847)
- when `gotoDate` is called on a custom view with a duration of multiple days,
  the view will always shift to begin with the given date. (#3515)

Bugfixes:
- event rendering when excessive `minTime`/`maxTime` (#2530)
- event drag