nction(t,e){return t*this.daysPerRow+this.getColDayIndex(e)},getColDayIndex:function(t){return this.isRTL?this.colCnt-1-t:t},getDateDayIndex:function(t){var e=this.dayIndices,n=t.diff(this.dayDates[0],"days");return n<0?e[0]-1:n>=e.length?e[e.length-1]+1:e[n]},computeColHeadFormat:function(){return this.rowCnt>1||this.colCnt>10?"ddd":this.colCnt>1?this.opt("dayOfMonthFormat"):"dddd"},sliceRangeByRow:function(t){var e,n,i,s,r,o=this.daysPerRow,a=this.view.computeDayRange(t),l=this.getDateDayIndex(a.start),u=this.getDateDayIndex(a.end.clone().subtract(1,"days")),c=[];for(e=0;e<this.rowCnt;e++)n=e*o,i=n+o-1,s=Math.max(l,n),r=Math.min(u,i),s=Math.ceil(s),r=Math.floor(r),s<=r&&c.push({row:e,firstRowDayIndex:s-n,lastRowDayIndex:r-n,isStart:s===l,isEnd:r===u});return c},sliceRangeByDay:function(t){var e,n,i,s,r,o,a=this.daysPerRow,l=this.view.computeDayRange(t),u=this.getDateDayIndex(l.start),c=this.getDateDayIndex(l.end.clone().subtract(1,"days")),h=[];for(e=0;e<this.rowCnt;e++)for(n=e*a,i=n+a-1,s=n;s<=i;s++)r=Math.max(u,s),o=Math.min(c,s),r=Math.ceil(r),o=Math.floor(o),r<=o&&h.push({row:e,firstRowDayIndex:r-n,lastRowDayIndex:o-n,isStart:r===u,isEnd:o===c});return h},renderHeadHtml:function(){var t=this.view.calendar.theme;return'<div class="fc-row '+t.getClass("headerRow")+'"><table class="'+t.getClass("tableGrid")+'"><thead>'+this.renderHeadTrHtml()+"</thead></table></div>"},renderHeadIntroHtml:function(){return this.renderIntroHtml()},renderHeadTrHtml:function(){return"<tr>"+(this.isRTL?"":this.renderHeadIntroHtml())+this.renderHeadDateCellsHtml()+(this.isRTL?this.renderHeadIntroHtml():"")+"</tr>"},renderHeadDateCellsHtml:function(){var t,e,n=[];for(t=0;t<this.colCnt;t++)e=this.getCellDate(0,t),n.push(this.renderHeadDateCellHtml(e));return n.join("")},renderHeadDateCellHtml:function(t,e,n){var i=this.view,s=i.activeUnzonedRange.containsDate(t),r=["fc-day-header",i.calendar.theme.getClass("widgetHeader")],o=tt(t.format(this.colHeadFormat));return 1===this.rowCnt?r=r.concat(this.getDayClasses(t,!0)):r.push("fc-"+_t[t.day()]),'<th class="'+r.join(" ")+'"'+(1===(s&&this.rowCnt)?' data-date="'+t.format("YYYY-MM-DD")+'"':"")+(e>1?' colspan="'+e+'"':"")+(n?" "+n:"")+">"+(s?i.buildGotoAnchorHtml({date:t,forceOff:this.rowCnt>1||1===this.colCnt},o):o)+"</th>"},renderBgTrHtml:function(t){return"<tr>"+(this.isRTL?"":this.renderBgIntroHtml(t))+this.renderBgCellsHtml(t)+(this.isRTL?this.renderBgIntroHtml(t):"")+"</tr>"},renderBgIntroHtml:function(t){return this.renderIntroHtml()},renderBgCellsHtml:function(t){var e,n,i=[];for(e=0;e<this.colCnt;e++)n=this.getCellDate(t,e),i.push(this.renderBgCellHtml(n));return i.join("")},renderBgCellHtml:function(t,e){var n=this.view,i=n.activeUnzonedRange.containsDate(t),s=this.getDayClasses(t);return s.unshift("fc-day",n.calendar.theme.getClass("widgetContent")),'<td class="'+s.join(" ")+'"'+(i?' data-date="'+t.format("YYYY-MM-DD")+'"':"")+(e?" "+e:"")+"></td>"},renderIntroHtml:function(){},bookendCells:function(t){var e=this.renderIntroHtml();e&&(this.isRTL?t.append(e):t.prepend(e))}},we=Vt.DayGrid=me.extend(ye,{numbersVisible:!1,bottomCoordPadding:0,rowEls:null,cellEls:null,helperEls:null,ro