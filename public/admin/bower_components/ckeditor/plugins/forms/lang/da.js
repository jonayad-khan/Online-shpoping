re days ([PR 88])
- allow `null`/`undefined` event titles ([PR 84])
- small optimize for agenda event rendering ([PR 56])
- deprecated:
	- `viewDisplay`
	- `disableDragging`
	- `disableResizing`
- bundled with latest jQuery (1.10.2) and jQuery UI (1.10.3)

[PR 15]: https://github.com/arshaw/fullcalendar/pull/15
[PR 111]: https://github.com/arshaw/fullcalendar/pull/111
[PR 54]: https://github.com/arshaw/fullcalendar/pull/54
[PR 49]: https://github.com/arshaw/fullcalendar/pull/49
[PR 59]: https://github.com/arshaw/fullcalendar/pull/59
[PR 55]: https://github.com/arshaw/fullcalendar/pull/55
[PR 58]: https://github.com/arshaw/fullcalendar/pull/58
[PR 88]: https://github.com/arshaw/fullcalendar/pull/88
[PR 84]: https://github.com/arshaw/fullcalendar/pull/84
[PR 56]: https://github.com/arshaw/fullcalendar/pull/56


v1.6.2 (2013-07-18)
-------------------

- `hiddenDays` option ([686])
- bugfix: when `eventRender` returns `false`, incorrect stacking of events ([762])
- bugfix: couldn't change `event.backgroundImage` when calling `updateEvent` (thx @stephenharris)

[686]: https://code.google.com/p/fullcalendar/issues/detail?id=686
[762]: https://code.google.com/p/fullcalendar/issues/detail