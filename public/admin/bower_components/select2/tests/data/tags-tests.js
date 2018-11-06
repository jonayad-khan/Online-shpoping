209)
- jQuery 3 support (#3197, #3124)
- Travis CI integration (#3218)
- EditorConfig for promoting consistent code style (#141)
- use en dash when formatting ranges (#3077)
- height:auto always shows scrollbars in month view on FF (#3202)
- new languages:
	- Basque (#2992)
	- Galician (#194)
	- Luxembourgish (#2979)


v2.7.3 (2016-06-02)
-------------------

internal enhancements that plugins can benefit from:
- EventEmitter not correctly working with stopListeningTo
- normalizeEvent hook for manipulating event data


v2.7.2 (2016-05-20)
-------------------

- fixed desktops/laptops with touch support not accepting mouse events for
  dayClick/dragging/resizing (#3154, #3149)
- fixed dayClick incorrectly triggered on touch scroll (#3152)
- fixed touch event dragging wrongfully beginning upon scrolling document (#3160)
- fixed minified JS still contained comments
- UI change: mouse users must hover over an event to reveal its resizers


v2.7.1 (2016-05-01)
-------------------

- dayClick not firing on touch devices (#3138)
- icons for prev/next not working in MS Edge (#2852)
- fix bad languages troubles with firewalls (#3133, #3132)
- update all dev dependencies (#3145, #3010, #2901, #251)
- git-ignore npm debug logs (#3011)
- misc automated test updates (#3139, #3147)
- Google Calendar htmlLink not always defined (#2844)


v2.7.0 (2016-04-23)
-------------------

touch device support (#994):
	- smoother scrolling
	- interactions initiated via "long press":
		- event drag-n-drop
		- event resize
		- time-range selecting
	- `longPressDelay`


v2.6.1 (2016-02-17)
-------------------

- make `nowIndicator` positioning refresh on window resize


v2.6.0 (2016-01-07)
-------------------

- current time indicator (#414)
- bundled with most recent version of moment (2.11.0)
- UMD wrapper around lang files now handles commonjs (#2918)
- fix bug where external event dragging would not respect eventOverlap
- fix bug where external event dropping would not render the whole-day highlight


v2.5.0 (2015-11-30)
-------------------

- internal timezone refactor. fixes #2396, #2900, #2945, #2711
- internal "grid" system refactor. improved API for plugins.


v2.4.0 (2015-08-16)
-------------------

- add new buttons to the header via `customButtons` ([225])
- control stacking order of events via `eventOrder` ([364])
- control frequency of slot text via `slotLabelInterval` ([946])
- `displayEventTime` ([1904])
- `on` and `off` methods ([1910])
- renamed `axisFormat` to `slotLabelFormat`

[225]: https://code.google.com/p/fullcalendar/issues/detail?id=225
[364]: https://code.google.com/p/fullcalendar/issues/detail?id=364
[946]: https://code.google.com/p/fullcalendar/issues/detail?id=946
[1904]: https://code.google.com/p/fullcalendar/issues/detail?id=1904
[1910]: https://code.google.com/p/fullcalendar/issues/detail?id=1910


v2.3.2 (2015-06-14)
-------------------

- minor code adjustment in preparation for plugins


v2.3.1 (2015-03-08)
-------------------

- Fix week view column title for en-gb ([PR220])
- Publish to NPM ([2447])
- Detangle bower from npm package ([PR179])

[PR220]: https://github.com/arshaw/fullcalendar/pull/220
[2447]: https://code.google.com/p/fullcalendar/issues/detail?id=2447
[PR179]: https://github.com/arshaw/fullcalendar/pull/179


v2.3.0 (2015-02-21)
-------------------

- internal refactoring in preparation for other views
- businessHours now renders on whole-days in addition to timed areas
- events in "more" popover not sorted by time ([2385])
- avoid using moment's deprecated zone method ([2443])
- destroying the calendar sometimes causes all window resize handlers to be unbound ([2432])
- multiple calendars on one page, can't accept external elements after navigating ([2433])
- accept external events from jqui sortable ([1698])
- external jqui drop processed before reverting ([1661])
- IE8 fix: month view renders incorrectly ([2428])
- IE8 fix: eventLimit:true wouldn't activate "more" link ([2330])
- IE8 fix: dragging an event with an href
- IE8 fix: invisible element while dragging agenda view events
- IE8 fix: erratic external element dragging

[2385]: https://code.google.com/p/fullcalendar/issues/detail?id=2385
[2443]: https://code.google.com/p/fullcalendar/issues/detail?id=2443
[2432]: https://code.google.com/p/fullcalendar/issues/detail?id=2432
[2433]: https://code.google.com/p/fullcalendar/issues/detail?id=2433
[1698]: https://code.google.com/p/fullcalendar/issues/detail?id=1698
[1661]: https://code.google.com/p/fullcalendar/issues/detail?id=1661
[2428]: https://code.google.com/p/fullcalendar/issues/detail?id=2428
[2330]: https://code.google.com/p/fullcalendar/issues/detail?id=2330


v2.2.7 (2015-02-10)
-------------------

- view.title wasn't defined in viewRender callback ([2407])
- FullCalendar versions >= 2.2.5 brokenness with Moment versions <= 2.8.3 ([2417])
- Support Bokmal Norwegian language specifically ([2427])

[2407]: https://code.google.com/p/fullcalendar/issues/detail?id=2407
[2417]: https://code.google.com/p/fullcalendar/issues/detail?id=2417
[2427]: https://code.google.com/p/fullcalendar/issues/detail?id=2427


v2.2.6 (2015-01-11)
-------------------

- Compatibility with Moment v2.9. Was breaking GCal plugin ([2408])
- View object's `title` property mistakenly omitted ([2407])
- Single-day views with hiddens days could cause prev/next misbehavior ([2406])
- Don't let the current date ever be a hidden day (solves [2395])
- Hebrew locale ([2157])

[2408]: https://code.google.com/p/fullcalendar/issues/detail?id=2408
[2407]: https://code.google.com/p/fullcalendar/issues/detail?id=2407
[2406]: https://code.google.com/p/fullcalendar/issues/detail?id=2406
[2395]: https://code.google.com/p/fullcalendar/issues/detail?id=2395
[2157]: https://code.google.com/p/fullcalendar/issues/detail?id=2157


v2.2.5 (2014-12-30)
-------------------

- `buttonText` specified for custom views via the `views` option
	- bugfix: wrong default value, couldn't override default
	- feature: default value taken from locale


v2.2.4 (2014-12-29)
-------------