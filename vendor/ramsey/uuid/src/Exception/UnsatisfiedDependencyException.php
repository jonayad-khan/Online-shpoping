:function(t,e,n){var i,s=this.eventDefs;if(null!==this.currentTimezone&&this.currentTimezone!==n)for(i=0;i<s.length;i++)s[i]instanceof ke&&s[i].rezone();return this.currentTimezone=n,ae.resolve(s)},addEventDef:function(t){this.eventDefs.push(t)},removeEventDefsById:function(t){return X(this.eventDefs,function(e){return e.id===t})},removeAllEventDefs:function(){this.eventDefs=[]},getPrimitive:function(){return this.rawEventDefs},applyManualRawProps:function(t){var e=_e.prototype.applyManualRawProps.apply(this,arguments);return this.setRawEventDefs(t.events),e}});Ye.allowRawProps({events:!1}),Ye.parse=function(e,n){var i;return t.isArray(e.events)?i=e:t.isArray(e)&&(i={events:e}),!!i&&