ed scrollbars in month-view when non-integer width (#3453, #3444)
- incorrect date formatting for locales with non-standlone month/day names (#3478)
- date formatting, incorrect omission of trailing period for certain locales (#2504, #3486)
- formatRange should collapse same week numbers (#3467)
- Taiwanese locale updated (#3426)
- Finnish noEventsMessage updated (#3476)
- Croatian (hr) buttonText is blank (#3270)
- JSON feed PHP example, date range math bug (#3485)


v3.1.0 (2016-12-05)
-------------------

- experimental support for implicitly batched ("debounced") event rendering (#2938)
	- `eventRenderWait` (off by default)
- new `footer` option, similar to header toolbar (#654, #3299)
- event rendering batch methods (#3351):
	- `renderEvents`
	- `updateEvents`
- more granular touch settings (#3377):
	- `eventLongPressDelay`
	- `selectLongPressDelay`
- eventDestroy not called when removing the popover (#3416, #3419)
- print stylesheet and gcal extension now offered as minified (#3415)
- fc-today in agenda header cells (#3361, #3365)
- height-related options in tandem with other options (#3327, #3384)
- Kazakh locale (#3394)
- Afrikaans locale (#3390)
- internal refactor related to timing of rendering and firing handlers.
  calls to rerender the current date-range and events from within handlers
  might not execute immediately. instead, will execute after handler finishes.


v3.0.1 (2016-09-26)
-------------------

Bugfixes:
- list view rendering event times incorrectly (#3334)
- list view rendering events/days out of order (#3347)
- events with no title rendering as "undefined"
- add .fc scope to table print styles (#3343)
- "display no events" text fix for German (#3354)


v3.0.0 (2016-09-04)
-------------------

Features:
- List View (#560)
	- new views: `listDay`, `listWeek`, `listMonth`, `listYear`, and simply `list`
	- `listDayFormat`
	- `listDayAltFormat`
	- `noEventsMessage`
- Clickable day/week numbers for easier navigation (#424)
	- `navLinks`
	- `navLinkDayClick`
	- `navLinkWeekClick`
- Programmatically allow/disallow user interactions:
	- `eventAllow` (#2740)
	- `selectAllow` (#2511)
- Option to display week numbers in cells (#3024)
	- `weekNumbersWithinDays` (set to `true` to activate)
- When week calc is ISO, default first day-of-week to Monday (#3255)
- Macedonian locale (#2739)
- Malay locale

Breaking Changes:
- IE8 support dropped
- jQuery: minimum support raised to v2.0.0
- MomentJS: minimum support raised to v2.9.0
- `lang` option renamed to `locale`
- dist files have been renamed to be more consistent with MomentJS:
	- `lang/` -> `locale/`
	- `lang-all.js` -> `locale-all.js`
- behavior of moment metho