barOptions(this.computeFooterOptions()),t.render(),t.el&&this.el.append(t.el)},setToolbarsTitle:function(t){this.toolbarsManager.proxyCall("updateTitle",t)},updateToolbarButtons:function(){var t=this.getNow(),e=this.view,n=e.buildDateProfile(t),i=e.buildPrevDateProfile(this.currentDate),s=e.buildNextDateProfile(this.currentDate);this.toolbarsManager.proxyCall(n.isValid&&!e.currentUnzonedRange.containsDate(t)?"enableButton":"disableButton","today"),this.toolbarsManager.proxyCall(i.isValid?"enableButton":"disableButton","prev"),this.toolbarsManager.proxyCall(s.isValid?"enableButton":"disableButton","next")},queryToolbarsHeight:function(){return this.toolbarsMana