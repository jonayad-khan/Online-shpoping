s.defaultAllDayEventDuration=e.duration(this.opt("defaultAllDayEventDuration")),this.defaultTimedEventDuration=e.duration(this.opt("defaultTimedEventDuration")),this.optionsModel.watch("buildingMomentLocale",["?locale","?monthNames","?monthNamesShort","?dayNames","?dayNamesShort","?firstDay","?weekNumberCalculation"],function(e){var n,i=e.weekNumberCalculation,s=e.firstDay;"iso"===i&&(i="ISO");var r=Object.create(Ft(e.locale));e.monthNames&&(r._months=e.monthNames),e.monthNamesShort&&(r._monthsShort=e.monthNamesShort),e.dayNames&&(r._weekdays=e.dayNames),e.dayNamesShort&&(r._weekdaysShort=e.dayNamesShort),null==s&&"ISO"===i&&(s=1),null!=s&&(n=Object.create(r._week),n.dow=s,r._week=n),"ISO"!==i&&"local"!==i&&"function"!=typeof i||(r._fullCalendar_weekCalc=i),t.localeData=r,t.currentDate&&t.localizeMoment(t.currentDate)})},moment:function(){var t;return"local"===this.opt("timezone")?(t=Vt.moment.apply(null,arguments),t.hasTime()&&t.local()):t="UTC"===this.opt("timezone")?Vt.moment.utc.apply(null,arguments):Vt.moment.parseZone.ap