s.defaultAllDayEventDuration=e.duration(this.opt("defaultAllDayEventDuration")),this.defaultTimedEventDuration=e.duration(this.opt("defaultTimedEventDuration")),this.optionsModel.watch("buildingMomentLocale",["?locale","?monthNames","?monthNamesShort","?dayNames","?dayNamesShort","?firstDay","?weekNumberCalculation"],function(e){var n,i=e.weekNumberCalculation,s=e.firstDay;"iso"===i&&(i="ISO");var r=Object.create(Ft(e.locale));e.monthNames&&(r._months=e.monthNames),e.monthNamesShort&&(r._monthsShort=e.monthNamesShort),e.dayNames&&(r._weekdays=e.dayNames),e.dayNamesShort&&(r._weekdaysShort=e.dayNamesShort),null==s&&"ISO"===i&&(s=1),null!=s&&(n=Object.create(r._week),n.dow=s,r._week=n),"ISO"!==i&&"local"!==i&&"function"!=typeof i||(r._fullCalendar_weekCalc=i),t.localeData=r,t.currentDate&&t.localizeMoment(t.currentDate)})},moment:function(){var t;return"local"===this.opt("timezone")?(t=Vt.moment.apply(null,arguments),t.hasTime()&&t.local()):t="UTC"===this.opt("timezone")?Vt.moment.utc.apply(null,arguments):Vt.moment.parseZone.apply(null,arguments),this.localizeMoment(t),t},msToMoment:function(t,e){var n=Vt.moment.utc(t);return e?n.stripTime():n=this.applyTimezone(n),this.localizeMoment(n),n},msToUtcMoment:function(t,e){var n=Vt.moment.utc(t);return e&&n.stripTime(),this.localizeMoment(n),n},localizeMoment:function(t){t._locale=this.localeData},getIsAmbigTimezone:function(){return"local"!==this.opt("timezone")&&"UTC"!==this.opt("timezone")},applyTimezone:function(t){if(!t.hasTime())return t.clone();var e,n=this.moment(t.toArray()),i=t.time()-n.time();return i&&(e=n.clone().add(i),t.time()-e.time()==0&&(n=e)),n},footprintToDateProfile:function(t,e){var n,i=Vt.moment.utc(t.unzonedRange.startMs);return e||(n=Vt.moment.utc(t.unzonedRange.endMs)),t.isAllDay?(i.stripTime(),n&&n.stripTime()):(i=this.applyTimezone(i),n&&(n=this.applyTimezone(n))),new Ne(i,n,this)},getNow:function(){var t=this.opt("now");return"function"==typeof t&&(t=t()),this.moment(t).stripZone()},humanizeDuration:function(t){return t.locale(this.opt("locale")).humanize()},getEventEnd:function(t){return t.end?t.end.clone():this.getDefaultEventEnd(t.allDay,t.start)},getDefaultEventEnd:function(t,e){var n=e.cl