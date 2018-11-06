entDef(t)})},removeAllEventDefs:function(){var e=t.isEmptyObject(this.eventDefsByUid);this.eventDefsByUid={},this.eventDefsById={},this.eventInstanceGroupsById={},e||this.tryRelease()},removeEventDef:function(t){var e=this.eventDefsById,n=e[t.id];delete this.eventDefsByUid[t.uid],n&&(K(n,t),n.length||delete e[t.id],this.removeEventInstancesForDef(t))},getEventInstances:function(){var t,e=this.eventInstanceGroupsById,n=[];for(t in e)n.push.apply(n,e[t].eventInstances);return n},getEventInstancesWithId:function(t){var e=this.eventInstanceGroupsById[t];return e?e.eventInstances.slice():[]},getEventInstancesWithoutId:function(t){var e,n=this.eventInstanceGroupsById,i=[];for(e in n)e!==t&&i.push.apply(i,n[e].eventInstances);return i},addEventInstance:function(t,e){var n=this.eventInstanceGroupsById;(n[e]||(n[e]=new Oe)).eventInstances.push(t),this.tryRelease()},removeEventInstancesForDef:function(t){var e,n=this.eventInstanceGroupsById,i=n[t.id];i&&(e=X(i.eventInstances,function(e){return e.def===t}),i.eventInstances.length||delete n[t.id],e&&this.tryRelease())},tryRelease:function(){this.pendingCnt||(this.freezeDepth?this.stuntedReleaseCnt++:this.release())},release:function(){this.releaseCnt++,this.trigger("release",this.eventInstanceGroupsById)},whenReleased:function(){var t=this;return this.releaseCnt?ae.resolve(this.eventInstanceGroupsById):ae.construct(function(e){t.one("release",e)})},freeze:function(){this.freezeDepth++||(this.stuntedReleaseCnt=0)},thaw:function(){--this.freezeDepth||!this.stuntedReleaseCnt||this.pendingCnt||this.release()}}),Pe={parse:function(t,n){return Y(t.start)||e.isDuration(t.start)||Y(t.end)||e.isDuration(t.end)?Ae.parse(t,n):ke.parse(t,n)}},Be=Vt.EventDef=ht.extend(ie,{source:null,id:null,rawId:null,uid:null,title:null,url:null,rendering:null,constraint:null,overlap:null,editable:null,startEditable:null,durationEditable:null,color:null,backgroundColor:null,borderColor:null,textColor:null,className:null,miscProps:null,constructor:function(t){this.source=t,this.className=[],this.miscProps={}},isAllDay:function(){},buildInstances:function(t){},clone:function(){var e=new this.constructor(this.source);return e.id=this.id,e.rawId=this.rawId,e.uid=this.uid,Be.copyVerbatimStandardProps(this,e),e.className=this.className,e.miscProps=t.extend({},this.miscProps),e},hasInverseRendering:function(){return"inverse-background"===this.getRendering()},hasBgRendering:function(){var t=this.getRendering();return"inverse-background"===t||"background"===t},getRendering:function(){return null!=this.rendering?this.rendering:this.source.rendering},getConstraint:function(){return null!=this.constraint?this.constraint:null!=this.source.constraint?this.source.constraint:this.source.calendar.opt("eventConstraint")},getOverlap:function(){return null!=this.overlap?this.overlap:null!=this.source.overlap?this.source.overlap:this.source.calendar.opt("eventOverlap")},isStartExplicitlyEditable:function(){return null!==this.startEditable?this.startEditable:this.source.startEditable},isDurationExplicitlyEditable:function(){return null!==this.durationEditable?this.durationEditable:this.source.durationEditable},isExplicitlyEditable:function(){return null!==this.editable?this.editable:this.source.editable},toLegacy:function(){var e=t.extend({},this.miscProps);return e._id=this.uid,e.source=this.source,e.className=this.className,e.allDay=this.isAllDay(),null!=this.rawId&&(e.id=this.rawId),Be.copyVerbatimStandardProps(this,e),e},applyManualRawProps:function(e){return null!=e.id?this.id=Be.normalizeId(this.rawId=e.id):this.id=Be.generateId(),null!=e._id?this.uid=String(e._id):this.uid=Be.generateId(),t.isArray(e.className)&&(this.className=e.className),"string"==typeof e.className&&(this.className=e.className.split(/\s+/)),!0},applyOtherRawProps:function(t){this.miscProps=t}});Be.allowRawProps=se,Be.copyVerbatimStandardProps=re,Be.uuid=0,Be.normalizeId=function(t){return String(t)},Be.generateId=function(){return"_fc"+Be.uuid++},Be.allowRawProps({_id:!1,id:!1,className:!1,source:!1,title:!0,url:!0,rendering:!0,constraint:!0,overlap:!0,editable:!0,startEditable:!0,durationEditable:!0,color:!0,backgroundColor:!0,borderColor:!0,textColor:!0}),Be.parse=function(t,e){var n=new this(e),i=e.calendar.opt("eventDataTransform"),s=e.eventDataTransform;return i&&(t=i(t)),s&&(t=s(t)),!!n.applyRawProps(t)&&n};var ke=Be.extend({dateProfile:null,buildInstances:function(){return[this.buildInstance()]},buildInstance:function(){return new Le(this,this.dateProfile)},isAllDay:function(){return this.dateProfile.isAllDay()},clone:function(){var t=Be.prototype.clone.call(this);return t.dateProfile=this.datePr