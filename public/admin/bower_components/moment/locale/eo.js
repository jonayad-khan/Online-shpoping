	offsetTop += obj.offsetTop;
				}
				return offsetTop;
			},
		    _offset: function (obj) {
				return {
					left: this._offsetLeft(obj),
					top: this._offsetTop(obj)
				};
		    },
			_css: function(elementRef, styleName, value) {
                if ($) {
                    $.style(elementRef, styleName, value);
                } else {
                    var style = styleName.replace(/^-ms-/, "ms-").replace(/-([\da-z])/gi, function (all, letter) {
                        return letter.toUpperCase();
                    });
                    elementRef.style[style] = value;
                }
			},
			_toValue: function(percentage) {
				return this.options.scale.toValue.apply(this, [percentage]);
			},
			_toPercentage: function(value) {
				return this.options.scale.toPercentage.apply(this, [value]);
			},
			_setTooltipPosition: function(){
				var tooltips = [this.tooltip, this.tooltip_min, this.tooltip_max];
				if (this.options.orientation === 'vertical'){
					var tooltipPos = this.options.tooltip_position || 'right';
					var oppositeSide = (tooltipPos === 'left') ? 'right' : 'left';
					tooltips.forEach(function(tooltip){
						this._addClass(tooltip, tooltipPos);
						tooltip.style[oppositeSide] = '100%';
					}.bind(this));
				} else if(this.options.tooltip_position === 'bottom') {
					tooltips.forEach(function(tooltip){
						this._addClass(tooltip, 'bottom');
						tooltip.style.top = 22 + 'px';
					}.bind(this));
				} else {
					tooltips.forEach(function(tooltip){
						this._addClass(tooltip, 'top');
						tooltip.style.top = -this.tooltip.outerHeight - 14 + 'px';
					}.bind(this));
				}
			}
		};

		/*********************************

			Attach to global namespace

		*********************************/
		if($) {
			var namespace = $.fn.slider ? 'bootstrapSlider' : 'slider';
			$.bridget(namespace, Slider);
		}

	})( $ );

	return Slider;
}));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                