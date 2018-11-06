
	            if (left) {
	                this._left = (this._left + left) % 1;
	                s.left = this._left + "px";
	            }
	            if (top) {
	                this._top = (this._top + top) % 1;
	                s.top = this._top + "px";
	            }
	        }
	    };
	    /*\
	     * Paper.clear
	     [ method ]
	     **
	     * Clears the paper, i.e. removes all the elements.
	    \*/
	    R.prototype.clear = function () {
	        R.eve("raphael.clear", this);
	        var c = this.canvas;
	        while (c.firstChild) {
	            c.removeChild(c.firstChild);
	        }
	        this.bottom = this.top = null;
	        (this.desc = $("desc")).appendChild(R._g.doc.createTextNode("Created with Rapha\xebl " + R.version));
	        c.appendChild(this.desc);
	        c.appendChild(this.defs = $("defs"));
	    };
	    /*\
	     * Paper.remove
	     [ method ]
	     **
	     * Removes the paper from the DOM.
	    \*/
	    R.prototype.remove = function () {
	        eve("raphael.remove", this);
	        this.canvas.parentNode && this.canvas.parentNode.removeChild(this.canvas);
	        for (var i in this) {
	            this[i] = typeof this[i] == "function" ? R._removedFactory(i) : null;
	        }
	    };
	    var setproto = R.st;
	    for (var method in elproto) if (elproto[has](method) && !setproto[has](method)) {
	        setproto[method] = (function (methodname) {
	            return function () {
	                var arg = arguments;
	                return this.forEach(function (el) {
	                    el[methodname].apply(el, arg);
	                });
	            };
	        })(method);
	    }
	}.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));


/***/ },
/* 4 */
/***/ function(module, exports, __webpack_require__) {

	var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(1)], __WEBPACK_AMD_DEFINE_RESULT__ = function(R) {
	    if (R && !R.vml) {
	        return;
	    }

	    var has = "hasOwnProperty",
	        Str = String,
	        toFloat = parseFloat,
	        math = Math,
	        round = math.round,
	        mmax = math.max,
	        mmin = math.min,
	        abs = math.abs,
	        fillString = "fill",
	        separator = /[, ]+/,
	        eve = R.eve,
	        ms = " progid:DXImageTransform.Microsoft",
	        S = " ",
	        E = "",
	        map = {M: "m", L: "l", C: "c", Z: "x", m: "t", l: "r", c: "v", z: "x"},
	        bites = /([clmz]),?([^clmz]*)/gi,
	        blurregexp = / progid:\S+Blur\([^\)]+\)/g,
	        val = /-?[^,\s-]+/g,
	        cssDot = "position:absolute;left:0;top:0;width:1px;height:1px;behavior:url(#default#VML)",
	        zoom = 21600,
	        pathTypes = {path: 1, rect: 1, image: 1},
	        ovalTypes = {circle: 1, ellipse: 1},
	        path2vml = function (path) {
	            var total =  /[ahqstv]/ig,
	                command = R._pathToAbsolute;
	            Str(path).match(total) && (command = R._path2curve);
	            total = /[clmz]/g;
	            if (command == R._pathToAbsolute && !Str(path).match(total)) {
	                var res = Str(path).replace(bites, function (all, command, args) {
	                    var vals = [],
	                        isMove = command.toLowerCase() == "m",
	                        res = map[command];
	                    args.replace(val, function (value) {
	                        if (isMove && vals.length == 2) {
	                            res += vals + map[command == "m" ? "l" : "L"];
	                            vals = [];
	                        }
	                        vals.push(round(value * zoom));
	                    });
	                    return res + vals;
	                });
	                return res;
	            }
	            var pa = command(path), p, r;
	            res = [];
	            for (var i = 0, ii = pa.length; i < ii; i++) {
	                p = pa[i];
	                r = pa[i][0].toLowerCase();
	                r == "z" && (r = "x");
	                for (var j = 1, jj = p.length; j < jj; j++) {
	                    r += round(p[j] * zoom) + (j != jj - 1 ? "," : E);
	                }
	                res.push(r);
	            }
	            return res.join(S);
	        },
	        compensation = function (deg, dx, dy) {
	            var m = R.matrix();
	            m.rotate(-deg, .5, .5);
	            return {
	                dx: m.x(dx, dy),
	                dy: m.y(dx, dy)
	            };
	        },
	        setCoords = function (p, sx, sy, dx, dy, deg) {
	            var _ = p._,
	                m = p.matrix,
	                fillpos = _.fillpos,
	                o = p.node,
	                s = o.style,
	                y = 1,
	                flip = "",
	                dxdy,
	                kx = zoom / sx,
	                ky = zoom / sy;
	            s.visibility = "hidden";
	            if (!sx || !sy) {
	                return;
	            }
	            o.coordsize = abs(kx) + S + abs(ky);
	            s.rotation = deg * (sx * sy < 0 ? -1 : 1);
	            if (deg) {
	                var c = compensation(deg, dx, dy);
	                dx = c.dx;
	                dy = c.dy;
	            }
	            sx < 0 && (flip += "x");
	            sy < 0 && (flip += " y") && (y = -1);
	            s.flip = flip;
	            o.coordorigin = (dx * -kx) + S + (dy * -ky);
	            if (fillpos || _.fillsize) {
	                var fill = o.getElementsByTagName(fillString);
	                fill = fill && fill[0];
	                o.removeChild(fill);
	                if (fillpos) {
	                    c = compensation(deg, m.x(fillpos[0], fillpos[1]), m.y(fillpos[0], fillpos[1]));
	                    fill.position = c.dx * y + S + c.dy * y;
	                }
	                if (_.fillsize) {
	                    fill.size = _.fillsize[0] * abs(sx) + S + _.fillsize[1] * abs(sy);
	                }
	                o.appendChild(fill);
	            }
	            s.visibility = "visible";
	        };
	    R.toString = function () {
	        return  "Your browser doesn\u2019t support SVG. Falling down to VML.\nYou are running Rapha\xebl " + this.version;
	    };
	    var addArrow = function (o, value, isEnd) {
	        var values = Str(value).toLowerCase().split("-"),
	            se = isEnd ? "end" : "start",
	            i = values.length,
	            type = "classic",
	            w = "medium",
	            h = "medium";
	        while (i--) {
	            switch (values[i]) {
	                case "block":
	                case "classic":
	                case "oval":
	                case "diamond":
	                case "open":
	                case "none":
	                    type = values[i];
	                    break;
	                case "wide":
	                case "narrow": h = values[i]; break;
	                case "long":
	                case "short": w = values[i]; break;
	            }
	        }
	        var stroke = o.node.getElementsByTagName("stroke")[0];
	        stroke[se + "arrow"] = type;
	        stroke[se + "arrowlength"] = w;
	        stroke[se + "arrowwidth"] = h;
	    },
	    setFillAndStroke = function (o, params) {
	        // o.paper.canvas.style.display = "none";
	        o.attrs = o.attrs || {};
	        var node = o.node,
	            a = o.attrs,
	            s = node.style,
	            xy,
	            newpath = pathTypes[o.type] && (params.x != a.x || params.y != a.y || params.width != a.width || params.height != a.height || params.cx != a.cx || params.cy != a.cy || params.rx != a.rx || params.ry != a.ry || params.r != a.r),
	            isOval = ovalTypes[o.type] && (a.cx != params.cx || a.cy != params.cy || a.r != params.r || a.rx != params.rx || a.ry != params.ry),
	            res = o;


	        for (var par in params) if (params[has](par)) {
	            a[par] = params[par];
	        }
	        if (newpath) {
	            a.path = R._getPath[o.type](o);
	            o._.dirty = 1;
	        }
	        params.href && (node.href = params.href);
	        params.title && (node.title = params.title);
	        params.target && (node.target = params.target);
	        params.cursor && (s.cursor = params.cursor);
	        "blur" in params && o.blur(params.blur);
	        if (params.path && o.type == "path" || newpath) {
	            node.path = path2vml(~Str(a.path).toLowerCase().indexOf("r") ? R._pathToAbsolute(a.path) : a.path);
	            o._.dirty = 1;
	            if (o.type == "image") {
	                o._.fillpos = [a.x, a.y];
	                o._.fillsize = [a.width, a.height];
	                setCoords(o, 1, 1, 0, 0, 0);
	            }
	        }
	        "transform" in params && o.transform(params.transform);
	        if (isOval) {
	            var cx = +a.cx,
	                cy = +a.cy,
	                rx = +a.rx || +a.r || 0,
	                ry = +a.ry || +a.r || 0;
	            node.path = R.format("ar{0},{1},{2},{3},{4},{1},{4},{1}x", round((cx - rx) * zoom), round((cy - ry) * zoom), round((cx + rx) * zoom), round((cy + ry) * zoom), round(cx * zoom));
	            o._.dirty = 1;
	        }
	        if ("clip-rect" in params) {
	            var rect = Str(params["clip-rect"]).split(separator);
	            if (rect.length == 4) {
	                rect[2] = +rect[2] + (+rect[0]);
	                rect[3] = +rect[3] + (+rect[1]);
	                var div = node.clipRect || R._g.doc.createElement("div"),
	                    dstyle = div.style;
	                dstyle.clip = R.format("rect({1}px {2}px {3}px {0}px)", rect);
	                if (!node.clipRect) {
	                    dstyle.position = "absolute";
	                    dstyle.top = 0;
	                    dstyle.left = 0;
	                    dstyle.width = o.paper.width + "px";
	                    dstyle.height = o.paper.height + "px";
	                    node.parentNode.insertBefore(div, node);
	                    div.appendChild(node);
	                    node.clipRect = div;
	                }
	            }
	            if (!params["clip-rect"]) {
	                node.clipRect && (node.clipRect.style.clip = "auto");
	            }
	        }
	        if (o.textpath) {
	            var textpathStyle = o.textpath.style;
	            params.font && (textpathStyle.font = params.font);
	            params["font-family"] && (textpathStyle.fontFamily = '"' + params["font-family"].split(",")[0].replace(/^['"]+|['"]+$/g, E) + '"');
	            params["font-size"] && (textpathStyle.fontSize = params["font-size"]);
	            params["font-weight"] && (textpathStyle.fontWeight = params["font-weight"]);
	            params["font-style"] && (textpathStyle.fontStyle = params["font-style"]);
	        }
	        if ("arrow-start" in params) {
	            addArrow(res, params["arrow-start"]);
	        }
	        if ("arrow-end" in params) {
	            addArrow(res, params["arrow-end"], 1);
	        }
	        if (params.opacity != null ||
	            params.fill != null ||
	            params.src != null ||
	            params.stroke != null ||
	            params["stroke-width"] != null ||
	            params["stroke-opacity"] != null ||
	            params["fill-opacity"] != null ||
	            params["stroke-dasharray"] != null ||
	            params["stroke-miterlimit"] != null ||
	            params["stroke-linejoin"] != null ||
	            params["stroke-linecap"] != null) {
	            var fill = node.getElementsByTagName(fillString),
	                newfill = false;
	            fill = fill && fill[0];
	            !fill && (newfill = fill = createNode(fillString));
	            if (o.type == "image" && params.src) {
	                fill.src = params.src;
	            }
	            params.fill && (fill.on = true);
	            if (fill.on == null || params.fill == "none" || params.fill === null) {
	                fill.on = false;
	            }
	            if (fill.on && params.fill) {
	                var isURL = Str(params.fill).match(R._ISURL);
	                if (isURL) {
	                    fill.parentNode == node && node.removeChild(fill);
	                    fill.rotate = true;
	                    fill.src = isURL[1];
	                    fill.type = "tile";
	                    var bbox = o.getBBox(1);
	                    fill.position = bbox.x + S + bbox.y;
	                    o._.fillpos = [bbox.x, bbox.y];

	                    R._preload(isURL[1], function () {
	                        o._.fillsize = [this.offsetWidth, this.offsetHeight];
	                    });
	                } else {
	                    fill.color = R.getRGB(params.fill).hex;
	                    fill.src = E;
	                    fill.type = "solid";
	                    if (R.getRGB(params.fill).error && (res.type in {circle: 1, ellipse: 1} || Str(params.fill).charAt() != "r") && addGradientFill(res, params.fill, fill)) {
	                        a.fill = "none";
	                        a.gradient = params.fill;
	                        fill.rotate = false;
	                    }
	                }
	            }
	            if ("fill-opacity" in params || "opacity" in params) {
	                var opacity = ((+a["fill-opacity"] + 1 || 2) - 1) * ((+a.opacity + 1 || 2) - 1) * ((+R.getRGB(params.fill).o + 1 || 2) - 1);
	                opacity = mmin(mmax(opacity, 0), 1);
	                fill.opacity = opacity;
	                if (fill.src) {
	                    fill.color = "none";
	                }
	            }
	            node.appendChild(fill);
	            var stroke = (node.getElementsByTagName("stroke") && node.getElementsByTagName("stroke")[0]),
	            newstroke = false;
	            !stroke && (newstroke = stroke = createNode("stroke"));
	            if ((params.stroke && params.stroke != "none") ||
	                params["stroke-width"] ||
	                params["stroke-opacity"] != null ||
	                params["stroke-dasharray"] ||
	                params["stroke-miterlimit"] ||
	                params["stroke-linejoin"] ||
	                params["stroke-linecap"]) {
	                stroke.on = true;
	            }
	            (params.stroke == "none" || params.stroke === null || stroke.on == null || params.stroke == 0 || params["stroke-width"] == 0) && (stroke.on = false);
	            var strokeColor = R.getRGB(params.stroke);
	            stroke.on && params.stroke && (stroke.color = strokeColor.hex);
	            opacity = ((+a["stroke-opacity"] + 1 || 2) - 1) * ((+a.opacity + 1 || 2) - 1) * ((+strokeColor.o + 1 || 2) - 1);
	            var width = (toFloat(params["stroke-width"]) || 1) * .75;
	            opacity = mmin(mmax(opacity, 0), 1);
	            params["stroke-width"] == null && (width = a["stroke-width"]);
	            params["stroke-width"] && (stroke.weight = width);
	            width && width < 1 && (opacity *= width) && (stroke.weight = 1);
	            stroke.opacity = opacity;

	            params["stroke-linejoin"] && (stroke.joinstyle = params["stroke-linejoin"] || "miter");
	            stroke.miterlimit = params["stroke-miterlimit"] || 8;
	            params["stroke-linecap"] && (stroke.endcap = params["stroke-linecap"] == "butt" ? "flat" : params["stroke-linecap"] == "square" ? "square" : "round");
	            if ("stroke-dasharray" in params) {
	                var dasharray = {
	                    "-": "shortdash",
	                    ".": "shortdot",
	                    "-.": "shortdashdot",
	                    "-..": "shortdashdotdot",
	                    ". ": "dot",
	                    "- ": "dash",
	                    "--": "longdash",
	                    "- .": "dashdot",
	                    "--.": "longdashdot",
	                    "--..": "longdashdotdot"
	                };
	                stroke.dashstyle = dasharray[has](params["stroke-dasharray"]) ? dasharray[params["stroke-dasharray"]] : E;
	            }
	            newstroke && node.appendChild(stroke);
	        }
	        if (res.type == "text") {
	            res.paper.canvas.style.display = E;
	            var span = res.paper.span,
	                m = 100,
	                fontSize = a.font && a.font.match(/\d+(?:\.\d*)?(?=px)/);
	            s = span.style;
	            a.font && (s.font = a.font);
	            a["font-family"] && (s.fontFamily = a["font-family"]);
	            a["font-weight"] && (s.fontWeight = a["font-weight"]);
	            a["font-style"] && (s.fontStyle = a["font-style"]);
	            fontSize = toFloat(a["font-size"] || fontSize && fontSize[0]) || 10;
	            s.fontSize = fontSize * m + "px";
	            res.textpath.string && (span.innerHTML = Str(res.textpath.string).replace(/</g, "&#60;").replace(/&/g, "&#38;").replace(/\n/g, "<br>"));
	            var brect = span.getBoundingClientRect();
	            res.W = a.w = (brect.right - brect.left) / m;
	            res.H = a.h = (brect.bottom - brect.top) / m;
	            // res.paper.canvas.style.display = "none";
	            res.X = a.x;
	            res.Y = a.y + res.H / 2;

	            ("x" in params || "y" in params) && (res.path.v = R.format("m{0},{1}l{2},{1}", round(a.x * zoom), round(a.y * zoom), round(a.x * zoom) + 1));
	            var dirtyattrs = ["x", "y", "text", "font", "font-family", "font-weight", "font-style", "font-size"];
	            for (var d = 0, dd = dirtyattrs.length; d < dd; d++) if (dirtyattrs[d] in params) {
	                res._.dirty = 1;
	                break;
	            }

	            // text-anchor emulation
	            switch (a["text-anchor"]) {
	                case "start":
	                    res.textpath.style["v-text-align"] = "left";
	                    res.bbx = res.W / 2;
	                break;
	                case "end":
	                    res.textpath.style["v-text-align"] = "right";
	                    res.bbx = -res.W / 2;
	                break;
	                default:
	                    res.textpath.style["v-text-align"] = "center";
	                    res.bbx = 0;
	                break;
	            }
	            res.textpath.style["v-text-kern"] = true;
	        }
	        // res.paper.canvas.style.display = E;
	    },
	    addGradientFill = function (o, gradient, fill) {
	        o.attrs = o.attrs || {};
	        var attrs = o.attrs,
	            pow = Math.pow,
	            opacity,
	            oindex,
	            type = "linear",
	            fxfy = ".5 .5";
	        o.attrs.gradient = gradient;
	        gradient = Str(gradient).replace(R._radial_gradient, function (all, fx, fy) {
	            type = "radial";
	            if (fx && fy) {
	                fx = toFloat(fx);
	                fy = toFloat(fy);
	                pow(fx - .5, 2) + pow(fy - .5, 2) > .25 && (fy = math.sqrt(.25 - pow(fx - .5, 2)) * ((fy > .5) * 2 - 1) + .5);
	                fxfy = fx + S + fy;
	            }
	            return E;
	        });
	        gradient = gradient.split(/\s*\-\s*/);
	        if (type == "linear") {
	            var angle = gradient.shift();
	            angle = -toFloat(angle);
	            if (isNaN(angle)) {
	                return null;
	            }
	        }
	        var dots = R._parseDots(gradient);
	        if (!dots) {
	            return null;
	        }
	        o = o.shape || o.node;
	        if (dots.length) {
	            o.removeChild(fill);
	            fill.on = true;
	            fill.method = "none";
	            fill.color = dots[0].color;
	            fill.color2 = dots[dots.length - 1].color;
	            var clrs = [];
	            for (var i = 0, ii = dots.length; i < ii; i++) {
	                dots[i].offset && clrs.push(dots[i].offset + S + dots[i].color);
	            }
	            fill.colors = clrs.length ? clrs.join() : "0% " + fill.color;
	            if (type == "radial") {
	                fill.type = "gradientTitle";
	                fill.focus = "100%";
	                fill.focussize = "0 0";
	                fill.focusposition = fxfy;
	                fill.angle = 0;
	            } else {
	                // fill.rotate= true;
	                fill.type = "gradient";
	                fill.angle = (270 - angle) % 360;
	            }
	            o.appendChild(fill);
	        }
	        return 1;
	    },
	    Element = function (node, vml) {
	        this[0] = this.node = node;
	        node.raphael = true;
	        this.id = R._oid++;
	        node.raphaelid = this.id;
	        this.X = 0;
	        this.Y = 0;
	        this.attrs = {};
	        this.paper = vml;
	        this.matrix = R.matrix();
	        this._ = {
	            transform: [],
	            sx: 1,
	            sy: 1,
	            dx: 0,
	            dy: 0,
	            deg: 0,
	            dirty: 1,
	            dirtyT: 1
	        };
	        !vml.bottom && (vml.bottom = this);
	        this.prev = vml.top;
	        vml.top && (vml.top.next = this);
	        vml.top = this;
	        this.next = null;
	    };
	    var elproto = R.el;

	    Element.prototype = elproto;
	    elproto.constructor = Element;
	    elproto.transform = function (tstr) {
	        if (tstr == null) {
	            return this._.transform;
	        }
	        var vbs = this.paper._viewBoxShift,
	            vbt = vbs ? "s" + [vbs.scale, vbs.scale] + "-1-1t" + [vbs.dx, vbs.dy] : E,
	            oldt;
	        if (vbs) {
	            oldt = tstr = Str(tstr).replace(/\.{3}|\u2026/g, this._.transform || E);
	        }
	        R._extractTransform(this, vbt + tstr);
	        var matrix = this.matrix.clone(),
	            skew = this.skew,
	            o = this.node,
	            split,
	            isGrad = ~Str(this.attrs.fill).indexOf("-"),
	            isPatt = !Str(this.attrs.fill).indexOf("url(");
	        matrix.translate(1, 1);
	        if (isPatt || isGrad || this.type == "image") {
	            skew.matrix = "1 0 0 1";
	            skew.offset = "0 0";
	            split = matrix.split();
	            if ((isGrad && split.noRotation) || !split.isSimple) {
	                o.style.filter = matrix.toFilter();
	                var bb = this.getBBox(),
	                    bbt = this.getBBox(1),
	                    dx = bb.x - bbt.x,
	                    dy = bb.y - bbt.y;
	                o.coordorigin = (dx * -zoom) + S + (dy * -zoom);
	                setCoords(this, 1, 1, dx, dy, 0);
	            } else {
	                o.style.filter = E;
	                setCoords(this, split.scalex, split.scaley, split.dx, split.dy, split.rotate);
	            }
	        } else {
	            o.style.filter = E;
	            skew.matrix = Str(matrix);
	            skew.offset = matrix.offset();
	        }
	        if (oldt !== null) { // empty string value is true as well
	            this._.transform = oldt;
	            R._extractTransform(this, oldt);
	        }
	        return this;
	    };
	    elproto.rotate = function (deg, cx, cy) {
	        if (this.removed) {
	            return this;
	        }
	        if (deg == null) {
	            return;
	        }
	        deg = Str(deg).split(separator);
	        if (deg.length - 1) {
	            cx = toFloat(deg[1]);
	            cy = toFloat(deg[2]);
	        }
	        deg = toFloat(deg[0]);
	        (cy == null) && (cx = cy);
	        if (cx == null || cy == null) {
	            var bbox = this.getBBox(1);
	            cx = bbox.x + bbox.width / 2;
	            cy = bbox.y + bbox.height / 2;
	        }
	        this._.dirtyT = 1;
	        this.transform(this._.transform.concat([["r", deg, cx, cy]]));
	        return this;
	    };
	    elproto.translate = function (dx, dy) {
	        if (this.removed) {
	            return this;
	        }
	        dx = Str(dx).split(separator);
	        if (dx.length - 1) {
	            dy = toFloat(dx[1]);
	        }
	        dx = toFloat(dx[0]) || 0;
	        dy = +dy || 0;
	        if (this._.bbox) {
	            this._.bbox.x += dx;
	            this._.bbox.y += dy;
	        }
	        this.transform(this._.transform.concat([["t", dx, dy]]));
	        return this;
	    };
	    elproto.scale = function (sx, sy, cx, cy) {
	        if (this.removed) {
	            return this;
	        }
	        sx = Str(sx).split(separator);
	        if (sx.length - 1) {
	            sy = toFloat(sx[1]);
	            cx = toFloat(sx[2]);
	            cy = toFloat(sx[3]);
	            isNaN(cx) && (cx = null);
	            isNaN(cy) && (cy = null);
	        }
	        sx = toFloat(sx[0]);
	        (sy == null) && (sy = sx);
	        (cy == null) && (cx = cy);
	        if (cx == null || cy == null) {
	            var bbox = this.getBBox(1);
	        }
	        cx = cx == null ? bbox.x + bbox.width / 2 : cx;
	        cy = cy == null ? bbox.y + bbox.height / 2 : cy;

	        this.transform(this._.transform.concat([["s", sx, sy, cx, cy]]));
	        this._.dirtyT = 1;
	        return this;
	    };
	    elproto.hide = function () {
	        !this.removed && (this.node.style.display = "none");
	        return this;
	    };
	    elproto.show = function () {
	        !this.removed && (this.node.style.display = E);
	        return this;
	    };
	    // Needed to fix the vml setViewBox issues
	    elproto.auxGetBBox = R.el.getBBox;
	    elproto.getBBox = function(){
	      var b = this.auxGetBBox();
	      if (this.paper && this.paper._viewBoxShift)
	      {
	        var c = {};
	        var z = 1/this.paper._viewBoxShift.scale;
	        c.x = b.x - this.paper._viewBoxShift.dx;
	        c.x *= z;
	        c.y = b.y - this.paper._viewBoxShift.dy;
	        c.y *= z;
	        c.width  = b.width  * z;
	        c.height = b.height * z;
	        c.x2 = c.x + c.width;
	        c.y2 = c.y + c.height;
	        return c;
	      }
	      return b;
	    };
	    elproto._getBBox = function () {
	        if (this.removed) {
	            return {};
	        }
	        return {
	            x: this.X + (this.bbx || 0) - this.W / 2,
	            y: this.Y - this.H,
	            width: this.W,
	            height: this.H
	        };
	    };
	    elproto.remove = function () {
	        if (this.removed || !this.node.parentNode) {
	            return;
	        }
	        this.paper.__set__ && this.paper.__set__.exclude(this);
	        R.eve.unbind("raphael.*.*." + this.id);
	        R._tear(this, this.paper);
	        this.node.parentNode.removeChild(this.node);
	        this.shape && this.shape.parentNode.removeChild(this.shape);
	        for (var i in this) {
	            this[i] = typeof this[i] == "function" ? R._removedFactory(i) : null;
	        }
	        this.removed = true;
	    };
	    elproto.attr = function (name, value) {
	        if (this.removed) {
	            return this;
	        }
	        if (name == null) {
	            var res = {};
	            for (var a in this.attrs) if (this.attrs[has](a)) {
	                res[a] = this.attrs[a];
	            }
	            res.gradient && res.fill == "none" && (res.fill = res.gradient) && delete res.gradient;
	            res.transform = this._.transform;
	            return res;
	        }
	        if (value == null && R.is(name, "string")) {
	            if (name == fillString && this.attrs.fill == "none" && this.attrs.gradient) {
	                return this.attrs.gradient;
	            }
	            var names = name.split(separator),
	                out = {};
	            for (var i = 0, ii = names.length; i < ii; i++) {
	                name = names[i];
	                if (name in this.attrs) {
	                    out[name] = this.attrs[name];
	                } else if (R.is(this.paper.customAttributes[name], "function")) {
	                    out[name] = this.paper.customAttributes[name].def;
	                } else {
	                    out[name] = R._availableAttrs[name];
	                }
	            }
	            return ii - 1 ? out : out[names[0]];
	        }
	        if (this.attrs && value == null && R.is(name, "array")) {
	            out = {};
	            for (i = 0, ii = name.length; i < ii; i++) {
	                out[name[i]] = this.attr(name[i]);
	            }
	            return out;
	        }
	        var params;
	        if (value != null) {
	            params = {};
	            params[name] = value;
	        }
	        value == null && R.is(name, "object") && (params = name);
	        for (var key in params) {
	            eve("raphael.attr." + key + "." + this.id, this, params[key]);
	        }
	        if (params) {
	            for (key in this.paper.customAttributes) if (this.paper.customAttributes[has](key) && params[has](key) && R.is(this.paper.customAttributes[key], "function")) {
	                var par = this.paper.customAttributes[key].apply(this, [].concat(params[key]));
	                this.attrs[key] = params[key];
	                for (var subkey in par) if (par[has](subkey)) {
	                    params[subkey] = par[subkey];
	                }
	            }
	            // this.paper.canvas.style.display = "none";
	            if (params.text && this.type == "text") {
	                this.textpath.string = params.text;
	            }
	            setFillAndStroke(this, params);
	            // this.paper.canvas.style.display = E;
	        }
	        return this;
	    };
	    elproto.toFront = function () {
	        !this.removed && this.node.parentNode.appendChild(this.node);
	        this.paper && this.paper.top != this && R._tofront(this, this.paper);
	        return this;
	    };
	    elproto.toBack = function () {
	        if (this.removed) {
	            return this;
	        }
	        if (this.node.parentNode.firstChild != this.node) {
	            this.node.parentNode.insertBefore(this.node, this.node.parentNode.firstChild);
	            R._toback(this, this.paper);
	        }
	        return this;
	    };
	    elproto.insertAfter = function (element) {
	        if (this.removed) {
	            return this;
	        }
	        if (element.constructor == R.st.constructor) {
	            element = element[element.length - 1];
	        }
	        if (element.node.nextSibling) {
	            element.node.parentNode.insertBefore(this.node, element.node.nextSibling);
	        } else {
	            element.node.parentNode.appendChild(this.node);
	        }
	        R._insertafter(this, element, this.paper);
	        return this;
	    };
	    elproto.insertBefore = function (element) {
	        if (this.removed) {
	            return this;
	        }
	        if (element.constructor == R.st.constructor) {
	            element = element[0];
	        }
	        element.node.parentNode.insertBefore(this.node, element.node);
	        R._insertbefore(this, element, this.paper);
	        return this;
	    };
	    elproto.blur = function (size) {
	        var s = this.node.runtimeStyle,
	            f = s.filter;
	        f = f.replace(blurregexp, E);
	        if (+size !== 0) {
	            this.attrs.blur = size;
	            s.filter = f + S + ms + ".Blur(pixelradius=" + (+size || 1.5) + ")";
	            s.margin = R.format("-{0}px 0 0 -{0}px", round(+size || 1.5));
	        } else {
	            s.filter = f;
	            s.margin = 0;
	            delete this.attrs.blur;
	        }
	        return this;
	    };

	    R._engine.path = function (pathString, vml) {
	        var el = createNode("shape");
	        el.style.cssText = cssDot;
	        el.coordsize = zoom + S + zoom;
	        el.coordorigin = vml.coordorigin;
	        var p = new Element(el, vml),
	            attr = {fill: "none", stroke: "#000"};
	        pathString && (attr.path = pathString);
	        p.type = "path";
	        p.path = [];
	        p.Path = E;
	        setFillAndStroke(p, attr);
	        vml.canvas && vml.canvas.appendChild(el);
	        var skew = createNode("skew");
	        skew.on = true;
	        el.appendChild(skew);
	        p.skew = skew;
	        p.transform(E);
	        return p;
	    };
	    R._engine.rect = function (vml, x, y, w, h, r) {
	        var path = R._rectPath(x, y, w, h, r),
	            res = vml.path(path),
	            a = res.attrs;
	        res.X = a.x = x;
	        res.Y = a.y = y;
	        res.W = a.width = w;
	        res.H = a.height = h;
	        a.r = r;
	        a.path = path;
	        res.type = "rect";
	        return res;
	    };
	    R._engine.ellipse = function (vml, x, y, rx, ry) {
	        var res = vml.path(),
	            a = res.attrs;
	        res.X = x - rx;
	        res.Y = y - ry;
	        res.W = rx * 2;
	        res.H = ry * 2;
	        res.type = "ellipse";
	        setFillAndStroke(res, {
	            cx: x,
	            cy: y,
	            rx: rx,
	            ry: ry
	        });
	        return res;
	    };
	    R._engine.circle = function (vml, x, y, r) {
	        var res = vml.path(),
	            a = res.attrs;
	        res.X = x - r;
	        res.Y = y - r;
	        res.W = res.H = r * 2;
	        res.type = "circle";
	        setFillAndStroke(res, {
	            cx: x,
	            cy: y,
	            r: r
	        });
	        return res;
	    };
	    R._engine.image = function (vml, src, x, y, w, h) {
	        var path = R._rectPath(x, y, w, h),
	            res = vml.path(path).attr({stroke: "none"}),
	            a = res.attrs,
	            node = res.node,
	            fill = node.getElementsByTagName(fillString)[0];
	        a.src = src;
	        res.X = a.x = x;
	        res.Y = a.y = y;
	        res.W = a.width = w;
	        res.H = a.height = h;
	        a.path = path;
	        res.type = "image";
	        fill.parentNode == node && node.removeChild(fill);
	        fill.rotate = true;
	        fill.src = src;
	        fill.type = "tile";
	        res._.fillpos = [x, y];
	        res._.fillsize = [w, h];
	        node.appendChild(fill);
	        setCoords(res, 1, 1, 0, 0, 0);
	        return res;
	    };
	    R._engine.text = function (vml, x, y, text) {
	        var el = createNode("shape"),
	            path = createNode("path"),
	            o = createNode("textpath");
	        x = x || 0;
	        y = y || 0;
	        text = text || "";
	        path.v = R.format("m{0},{1}l{2},{1}", round(x * zoom), round(y * zoom), round(x * zoom) + 1);
	        path.textpathok = true;
	        o.string = Str(text);
	        o.on = true;
	        el.style.cssText = cssDot;
	        el.coordsize = zoom + S + zoom;
	        el.coordorigin = "0 0";
	        var p = new Element(el, vml),
	            attr = {
	                fill: "#000",
	                stroke: "none",
	                font: R._availableAttrs.font,
	                text: text
	            };
	        p.shape = el;
	        p.path = path;
	        p.textpath = o;
	        p.type = "text";
	        p.attrs.text = Str(text);
	        p.attrs.x = x;
	        p.attrs.y = y;
	        p.attrs.w = 1;
	        p.attrs.h = 1;
	        setFillAndStroke(p, attr);
	        el.appendChild(o);
	        el.appendChild(path);
	        vml.canvas.appendChild(el);
	        var skew = createNode("skew");
	        skew.on = true;
	        el.appendChild(skew);
	        p.skew = skew;
	        p.transform(E);
	        return p;
	    };
	    R._engine.setSize = function (width, height) {
	        var cs = this.canvas.style;
	        this.width = width;
	        this.height = height;
	        width == +width && (width += "px");
	        height == +height && (height += "px");
	        cs.width = width;
	        cs.height = height;
	        cs.clip = "rect(0 " + width + " " + height + " 0)";
	        if (this._viewBox) {
	            R._engine.setViewBox.apply(this, this._viewBox);
	        }
	        return this;
	    };
	    R._engine.setViewBox = function (x, y, w, h, fit) {
	        R.eve("raphael.setViewBox", this, this._viewBox, [x, y, w, h, fit]);
	        var paperSize = this.getSize(),
	            width = paperSize.width,
	            height = paperSize.height,
	            H, W;
	        if (fit) {
	            H = height / h;
	            W = width / w;
	            if (w * H < width) {
	                x -= (width - w * H) / 2 / H;
	            }
	            if (h * W < height) {
	                y -= (height - h * W) / 2 / W;
	            }
	        }
	        this._viewBox = [x, y, w, h, !!fit];
	        this._viewBoxShift = {
	            dx: -x,
	            dy: -y,
	            scale: paperSize
	        };
	        this.forEach(function (el) {
	            el.transform("...");
	        });
	        return this;
	    };
	    var createNode;
	    R._engine.initWin = function (win) {
	            var doc = win.document;
	            if (doc.styleSheets.length < 31) {
	                doc.createStyleSheet().addRule(".rvml", "behavior:url(#default#VML)");
	            } else {
	                // no more room, add to the existing one
	                // http://msdn.microsoft.com/en-us/library/ms531194%28VS.85%29.aspx
	                doc.styleSheets[0].addRule(".rvml", "behavior:url(#default#VML)");
	            }
	            try {
	                !doc.namespaces.rvml && doc.namespaces.add("rvml", "urn:schemas-microsoft-com:vml");
	                createNode = function (tagName) {
	                    return doc.createElement('<rvml:' + tagName + ' class="rvml">');
	                };
	            } catch (e) {
	                createNode = function (tagName) {
	                    return doc.createElement('<' + tagName + ' xmlns="urn:schemas-microsoft.com:vml" class="rvml">');
	                };
	            }
	        };
	    R._engine.initWin(R._g.win);
	    R._engine.create = function () {
	        var con = R._getContainer.apply(0, arguments),
	            container = con.container,
	            height = con.height,
	            s,
	            width = con.width,
	            x = con.x,
	            y = con.y;
	        if (!container) {
	            throw new Error("VML container not found.");
	        }
	        var res = new R._Paper,
	            c = res.canvas = R._g.doc.createElement("div"),
	            cs = c.style;
	        x = x || 0;
	        y = y || 0;
	        width = width || 512;
	        height = height || 342;
	        res.width = width;
	        res.height = height;
	        width == +width && (width += "px");
	        height == +height && (height += "px");
	        res.coordsize = zoom * 1e3 + S + zoom * 1e3;
	        res.coordorigin = "0 0";
	        res.span = R._g.doc.createElement("span");
	        res.span.style.cssText = "position:absolute;left:-9999em;top:-9999em;padding:0;margin:0;line-height:1;";
	        c.appendChild(res.span);
	        cs.cssText = R.format("top:0;left:0;width:{0};height:{1};display:inline-block;position:relative;clip:rect(0 {0} {1} 0);overflow:hidden", width, height);
	        if (container == 1) {
	            R._g.doc.body.appendChild(c);
	            cs.left = x + "px";
	            cs.top = y + "px";
	            cs.position = "absolute";
	        } else {
	            if (container.firstChild) {
	                container.insertBefore(c, container.firstChild);
	            } else {
	                container.appendChild(c);
	            }
	        }
	        res.renderfix = function () {};
	        return res;
	    };
	    R.prototype.clear = function () {
	        R.eve("raphael.clear", this);
	        this.canvas.innerHTML = E;
	        this.span = R._g.doc.createElement("span");
	        this.span.style.cssText = "position:absolute;left:-9999em;top:-9999em;padding:0;margin:0;line-height:1;display:inline;";
	        this.canvas.appendChild(this.span);
	        this.bottom = this.top = null;
	    };
	    R.prototype.remove = function () {
	        R.eve("raphael.remove", this);
	        this.canvas.parentNode.removeChild(this.canvas);
	        for (var i in this) {
	            this[i] = typeof this[i] == "function" ? R._removedFactory(i) : null;
	        }
	        return true;
	    };

	    var setproto = R.st;
	    for (var method in elproto) if (elproto[has](method) && !setproto[has](method)) {
	        setproto[method] = (function (methodname) {
	            return function () {
	                var arg = arguments;
	                return this.forEach(function (el) {
	                    el[methodname].apply(el, arg);
	                });
	            };
	        })(method);
	    }
	}.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));


/***/ }
/******/ ])
});
;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               INDX( 	                 (   p  è      &   a e                 Ê    x f     È    9mğšbÔ oÅÃj©Ó‹ğšbÔ2mğšbÔ       Ú               A n y V a l u e s T o k e n . p h p   É    x d     È    vAğšbÔ oÅÃj©Ód^ğšbÔrAğšbÔ       «               A n y V a l u e T o k e n . p h p     Ë    ˆ t     È    (›ğšbÔ oÅÃj©Ón¸ğšbÔ"›ğšbÔ       ‡               A p p r o x i m a t e V a l u e T o k e n . p h p     Ì    x h     È    ^ÉğšbÔ oÅÃj©Ó^èğšbÔXÉğšbÔ       á    &          A r r a y C o u n t T o k e n . p h p Í    x h     È    _øğšbÔ oÅÃj©ÓMñšbÔVøğšbÔ       ”               A r r a y E n t r y T o k e n . p h p Î    ˆ r     È    r'ñšbÔ oÅÃj©ÓiEñšbÔr'ñšbÔ       ’               A r r a y E v e r y E n t r y T o k e n . p h p       Ï    x d     È    ·UñšbÔ oÅÃj©ÓuñšbÔ²UñšbÔ       ,               C a l l b a c k T o k e n . p h p     Ğ    x h     È    ä„ñšbÔ oÅÃj©Ó¹£ñšbÔâ„ñšbÔ       ¡               E x & c t V a l u e T o k e n . p h p Ñ    € p     È    }³ñšbÔ oÅÃj©ÓXÑñšbÔ|³ñšbÔ       æ               I d e n t i c a l V a l u e T o k e n . p h p Ò    x h     È    ààñšbÔ oÅÃj©ÓFşñšbÔààñšbÔ       ø               L o g i c a l A n d T o k e n . p h p Ó    x h     È    ŒòšbÔ oÅÃj©Óà5òšbÔŒòšbÔ                      L o g i c a l N o t T o k e n . p h p Ô    € j     È    úDòšbÔ oÅÃj©Óó_òšbÔôDòšbÔ       9
               O b j e c t S t a t e T o k & n . p h p       Õ    € p     È    RlòšbÔ oÅÃj©Ó„òšbÔJlòšbÔ       ü               S t r i n g C o n t a i n s T o k e n . p h p Ö    x f     È    ëòšbÔ oÅÃj©ÓÕ£òšbÔæòšbÔ                      T o k e n I n t e r f a c e . p h p   ×    p \     È    ´®òšbÔ oÅÃj©Ó–ÃòšbÔ²®òšbÔ       ¥               T y p e T o k e n . p h p                                                                                                                                         &                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               &                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               &                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               &                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               & ÿØÿà JFIF   d d  ÿì Ducky     <  ÿî Adobe dÀ   ÿÛ „ 		



ÿÀ  × ÿÄ Ÿ           	                 !1AQa"q2‘¡B#±ÁRbr$Ñá‚3Cñ’¢ÂSÒcD%6     !1AQ"aq2‘B3±ÿÚ   ? 3ÜÛŸÓ»§zW[„×‰¸]¨â‰t,¢Fi1â4R•kƒ-¶Ù8*§tı+„(~ã>kBÎ©øKCú×À?k$‹¿şFÈĞvôîH@¦YòõB¢˜çSÙÔS»eÖ–½¯ Éhe}Y;+ö`Ä/ä¤ßT#Qü¯oí±Tj•ªšŸNf,?“~ì[‰/»ZÂòZFó!cCB/¨Š(ÌCoö4ë_Pÿ IO´œLx"t€£újiÏ< e{*GÕ Èa®
o#i‰%’	¥· šuÃ ±İ+éê&€îì<ê9‘…l)toäO˜¤â1$²VTÇq;125yV¯$š$[™tøGírÃ±`¤¸'7Z±6†Pt†¥5Uˆ<yaPì†K€fĞ%
XÒ˜d…l©¹^ÛØ7W!u’ÇÙ‡€"ÆëfHQ)×Aè®%~JS{¸®$[åÒF²´@kÄâîI(mÆé,£“Sæ+Œ»/D™y%º’î€ñ¹ã«gØ-.¤â;„rXœx³Y ‹h¥¢¶X¢B¶½xÓŒƒPà@L¡w4ÉfÉN(¼vÔm<«Ô×@Ìc&Å“V»`îövk3´ydğÅë„FÙgFvxÀ’rúEO·'@9á1Y§ I¦'v›`¸fÌ~Y¡zWìÂ1’#K+…Üd³ê“Ğœ¹ñËìÂ1ŞpŞ?ÔèÛÈU÷mÍ
Ô4pƒ–=}5pxû-–
›mŞX–’¥ÀÈ‚ØÇÌâD’Ì½¿¼¤Iü³ ¯K0>gÇé“ÂÛ?n]ÇkÊcF)  ¸âº˜óóÂZ¥Áb‰QµÄ‚0}UüDòÂõ3Óÿ OT/eíŠ¤00à}G·cN¾¦£!së%#bxÓA{5Ôf¡ü_«`#­K^^8EÈÅ*´ÁÂrü‰8Ö‡9¦£¦œ0-wfïom·ŒÑ™:ã^,Ìhøâ•RÅ|”;¦ı:Şİ\È±xáÊF
_~¥%+\d¡¹İî=û^Ù^ËÜTÕ­ËÆu‘štÇBg:àÑû7»`ßöf¹EéÜÆı)á…’Ÿ‡÷[–'Ö‘=º-tºt®®uÂ„7oõ.a–è	R"HÕ>ÜÃÕ³h’0Õ¤PÓİ„¿#×gu6ï
¬j “ïÆ„ğF21›9Ì(cAãLeº-RZÁä$Ö£â>~xêòÁvKÈ–‘©C’Xˆ;kù®¥«¦s¥r2t¿£Bƒók#6dG
ì¤VÖÓë:|D÷1u¡h£yâWE*È$µ"TtNU"¹`Èkë–âaJôeàWÏ–9œ}ƒoùvA«[e®¹×#³«;°‡¤°6öó8GUäå­¿ŸKE(A>ã‰IO';çtÜ?¿;MÄ8·Ì"ê4úƒF {ãÚ×gñ¶ÕKşEËÛ¹ä–óó ^™å¨ı8{YÈn72‘5L®xŸÃŒu›!×gCµÙ4i‹ˆ„œNå’ÁnƒFºN_•CìÂ@Èô·ÓÁ§²v¯€?i8Ï³û×ÀÀ‹êÏ9ÔŸíŸf9Êö+Eø¶â£º‚õD3%Ö0N96ªc>=xS<pÊÔå&kõ±Ëm›ZŸTbş>¬c2jF¥d}I6Q³ÚvÕ¶I#‰€aZÔÓ1„îàÜ¨¤Vî=¦Ğ«YU¼†xö2õÓX)}î=®ãîk[‹¨íƒËn¶qNÚCºk–XÑ®mSÌİg¡##H É…j3†-@àÜlÙ­dhH#†9³£¼Ie¶[|íìÉomm¹æ|€™Å”sPgû‡ı™´†;‘±m"êÖÕr¹ºfS!ıÔJïÃWL“¶Æˆ¬¿ìÌ¶Ï¾ÙEiÇÿ “jÎz~ÑÉ$tÀ¿¯×!¦ÙF³´‹}Õ ¹‚ešÍĞH’¡ÔŒÂ° úB©DL”pÂ°‘ÈS
h™–îE+ZR¸‰Øgª”'†€©zäÖ´©58VÆHÈ×ê`T×	% ¼ñÈ)¤Té‚…gÆFÒÀŠ ÓaQ¶¤akÇ†#dÃ>©ö×lÙw­ıng·}Òîå¥’B¯Ê÷3šª‚ŠYè28õ)µ(Ló¶koG{ÙûskÜ$´{¹&iÄÈ&R4˜£zIG¶Ú&Nº¬Óü]›ôï`î­¢ûpK‰£¹K©`êFä¢Õ™£•rã¤à_zN ¶ŸVÖ¬ğÂ»ŞÇıÖÚ»8§J7JX¥.„$DTd­öŒwíL[úö§$6—v¬„Go+¦ŠK	ZS]‹àNŒôgbüfÔJ…Õn­¤djrÆMŸØÓNê(0ƒ%ŒŒAbAÿ ˆàØ: 	kÈáR²Zƒ‚âñ4Ç~kõcê-·eöÕæà«q‚.ù"ŠólW^¿ù2;/•UË1§]ÿ ¹÷vå}&ÿ $p]«Ã4`“¦
:j5$;)'ÏŞÛg¥ëiZë‘–ĞïûnçAÜ->Í1,ÖÒÆ¬«SÀ"™pÄ£kXs"ví½ı¹î³Åg½|µ¼Æ#h¼Ò¬Í_Ñ„„¹+j6ù„)wnÉm{còîo–}jE?1¢Œ«H@¥53QŠè¤¹ÚÕ«çÿ [»ÃwİûrmŸvõOµÈÏ­Ìu+¤9S4m®$óöêèãäØN3À¥kšü»Ó˜ã€Â'Ø.û‡pŞÎÅÀù=¹‚M™n(pâ>Ü[ZP-Ù–G&á+/MBÿ ´Œh	åäN4'/^Äí¸Ër\¬dÄ
‡$W‡#8/'S_SĞßõG¾şon½íYØ.¦ûo®D#¶™£4>¡à1šÿ %ªo†A®´á‰2:üTà1ÇêšnG,‰ä	EÒh@ÏÀE‘È•5áDW‚Ú©	$á`fà¹*G†:"˜•æ0Â¢2ã#áË9ç®·6÷Ñv‘.•íÊÊÀW°9û±vÈÕ@»,!“iÛ%dW´®8¶” öá7ÄíûÙ¡Ş–ÕÙagÓŠÚ)â’dU£J´*èÇÎ˜el£ûB`ï-«vİ¦Š}¸D–q»š(—6…sÃRòÆö)?`û%Õ˜º³:³•Ô€WÓ‘_hÅ•°ak üîİß¶öoŸÚ/ÚêEˆüh¡Ú‡Ğr5ğÄ®ğ2YF¯ô¿»o»³³,w»¨Ò9ç.¬#øHC§U9W
†½ar“ÓñÃ!:ÎAÔÓë9a˜*ºl =^8TÆgzH¯æX >$¦¥D™óÇJ:ÒÌÑBòÕŸ¦¥´¨©4 ÀoHów×=ÎãqíñuwG#\£Iäc d¬9Sâ5"^§ÿ w&³nïeÜÖ[£tnYütµ}Ç®¤õìÏRêŞÆ	,RV^¤lhÑĞ~Õq
á”«v3ëŞì¼h/Şù#æiäxˆ‚ybvRÊZİy1Kmİ¿¹®/•½H@ÌÓH<±¯Nšdôwır»¶şáİ\Ê¨’Â ©ëZ<_k]'òKÛst¿ı-åºŒçÎ™c/tgèÊ·7Ñ¥¬¯$šcDf.E  ­p¯.Z…'ó£|’ÿ tîëÅŒ·W7Óyi&4ãã\?¬±×cú;Ş;Åøb’ß£Õn¨Hğ¸çÄ–®œä†¦;åŒ×¶WöRJ×Qè·–2Œõ±<>Ç#ş®T>†o—»õ6ÉÖ>»'^Ù¡ê,@õTÆ}méãµíƒ+p{fîÍ¿t‘m¦2ØŞ=J[Ü 5éâcqéov´´*Ù8ŸQ*eôŒFJAMã~«vÖ<0bB~»7QÂd@\Š S	a«	lMQÏˆ#†9 ·hª¹ê¡¯†P	’'-«9iáQ
"–)%õ,™ ãLYÁ¬z…HÌû°°1ŒıbÚ şé»·…Ø‹‹¹æ•yki˜Ò„œVØ$œŠ}ß)‡oÛaoHê•Ítÿ –b”…Ôşö îÛ¤öÃw	Î8á”PW2Äc’Áz¾¶“Cì¾ã´µ´ù½K‹ùİ±N˜êÊ(kJSvİ¦jaÖÓ»íonİV8ØÖa¤«GÍJæxáë	ú‘û·v×sFloŒâI\KÑ¶uUô#åS\U{-¨'ú!É vEÆÓÚ[-·nÚk’ŞİKG­µH5š’Ì W÷pëx—ÖÛ‘…»ËkpêºŠõ™
xuìTG©Ÿ¬7{9—I™ÈK"%qGµ0*4]kû%u¨:h3¡ğËö#H İmî'ş]Õá õ¹©öa•“R¶å¼ÅmÏ «ƒ¤IJ¨>xöZ”dî9c„Í=ÊÄ‘¡yj Ò ÌœUÄÿ ccº{î­ÖNí³Ş¬ÚN¥ÅË=Å›°PdĞj†‚€eË¿«~úú¾QŠõı{U¼3š+WÓ*ñS‘¼ñÕÁëÊ‰6]æëoØ×«“ØÏ®¨X«¡¦c"¹{2vğÃ•”(Ï{qÜ/ò6¶³[YEë¸–VbM8­I5©ç…vG}®ò$ßm³mÛ¹·ó#§%' G5ëâHÒÑn¦µÙQn[6Şö«üîáq#E^
ª¡5BH¢Ôa½ß®´¾H+wİüI¸öNç¹­ÚíóÎÈ!24ŒZ­OHŠ§Ó™Ïn›ç%ö(A~ıİä±í›¹T·$ÖÆ„êaQLz^¼wF=ÓÕ,ïËKÍ³¾æÜçÓšôÜªÆzûÒ‡ßª“Ñ~Qì=ÑÕØ­nşf5šŠèåU|¹„ÏïÆ4ÙíÖªü û«¸’Ãµo¦ëÆ[D$¡Y $ğUj°ãL!ÙLóodC¹6ôw{3ub$$éWïUsÆÿ ^®dğ¶³mØ·÷iº™ï%2l1ÁÖ„´šŞÚñ
ˆÔ7¨WÌãe©“3¶âÃr[›[{Äj‰áY3ËŠÔıøño‹4z´SY'³¹Ü™Á¶6Œ“Õ,h@åJaõ±6 ´O#
=*|0°~ŒV7Ô8òÃUfVxÔJ 9ƒjXüĞFO¨LÆS4ÓY Ìg©Ì¨Ğ®µñÏ	Á}L*ßP.â`zï,ÏY“08¦ÅÃ_‘¿:{k2ë0\4ŒE–œ?N:a¢t¯Ù‹ÑÍ½«Ë;Ê„ÆâH,xyËf‰|3«««í²êv‚BCdêùå_Áû<q;kV—hcíİı¯à`fU"XßVøÁò8Ï³S«4Vé¡Š×¸^9òÀèxˆ
êÒs¨aáŒñ§!ˆ;¾ñÕ¯u„¼$+éàáAáƒØî¡KNá¸1¬p¸ij5EÛÔXû+V9Ô?kÜğÃŒî¦TR±1 WİÏ<?xDİ%>ıqÅ¸E9ù…Œ¬ñÖ«"qyá{ĞÓº ˜ÁscU»(2‘ƒëV*¿vlë-·r[OpöåÙŠ°•ÔúT0$uåŞNé Îè†ç³Í½ÃBd¤‚53 ÏÕ_Âybšï"Ú†=,;­†çÌ ÀÀ˜ØT©­8yøcÑÑh²hÏº©Õ¦	ß;Y7]ÇsÆÕÅ¬"S2G¥åùŸ[ôÕk]$)’¿²7ÚªÌW·¦¨|ÁS¶{Òÿ f·şŸ}n›†ÛL2'ğ±ãïÄ·z*ï3úÿ úNŠPbï¿6ƒdm¶Í±âšCë’VM4ÿ I'×ÿ šç/¶ÿ ë®¿UŸò,ØöìÛÿ q*ÍÖ“ZK<²[è‹eÙ‡Pª p®=èI`Áêû6{%šïiÙÇã½Ãªÿ @š€u$+ÖV¥hUõ9cÍ÷¯5_ƒÑõÔ]¿†ó¹nw7Û”l!†É‘­£LŒ’]™h<õ\¬iS^v·ÔŞºÛö›Øní´“#©"hçAXÙùóÇ©Dêäóíul7xöD÷vSE¸Ä?¬mkKˆˆ§^Ğ,ÉâÈxù{1²Ï²É¨pì]›v³í‹7Û-Óq¶
[)É[“+xycÉº†ÏsEšª‚¯ÔÖß·nØ¼k¸Ñò6»u»eé5%Øü^Ì*™;wÙ@ékÙî7±m÷lÖv‘{­^’‚%Õ!jó Ç¯¦Ë®mbĞÇ}Ï·¶Îà¸‰n·»{éİ“1µ‘Ü,×¹™Ú•5á÷amgªù5=âÆ]¡$ÛÚY¬b^¬Ó®—’4 	3¥Cr<ñæ]dôhğƒ+BVX}kmä-£IòÁk$Ï’Ô!#ß\< ¨æ²)'Ù‚ä†QQÌ`„—jšp§èÂÔ,ãÓ¦µÌgòEß»UÕÇÔoõé·k¸Xs¬™}ø«X¯&'õqİ§îqi‘¥¤U•ˆ1>³ÈğÄm5A]ÂÆKK;hÓÔ"/_
²ñ8›ä¤É[»­éc%ÊŠ
KyÔc«È-À¥mfÆÎö)\H€¬G¿ªM´ÀìÒP0=Öçaµ¥ÊÊEÉ$ˆÌ\xW3‰ÛZlzìh'³o[…Ô-4Ñ"º,‘—°ê¯Ûˆ_GÁzíÇÜËbê%/zÓ,8ŠåQ‰[EËzg_Ü‚îàtİuÅÅx1¯õ´é—Nû(Pb°^#ƒ§»˜ÂuØŸgîŠà$î)#õb•h±—@*9`Y1û`‰î`»¼¦§f ¥iŸ.ê ]—Eê°spe*‰'ŸŸ¿,‹›ëmqÙŞã[¶déÄ¦šÄµô€`×Ãõêû Y¨3nÒî½Û´;Ñïn\İØÉ#Ç¹F)FŠVÓ!§&«NUõ4İö0o¬ÖE­ÚMâåUŒÊÚœPš©§°ã×äğø>„P( ¦	ÈO³nWmî›IÀ=9µÛÌ¥Re(àÓÉ±-µ”Í^µşã?eÂæÛy¿wş{pšá™-&TÖ Zqá{?×üæ¥öÿ wnZIaÛW¢v,±²MMJJz¤4XËB÷F³îİÇÛ7¶]Õ³İIgs™Ôê¥³­Ue+ÈãÛ¶©R›Ã=AÜ6×ÃÙöçHâ5IÅÅ¨+öRÕ&GRZ„êÏ‘Çk¼`k _h^[Y[Ä©è’†™Œ¸Ow¬æQ³O¹X‹`;»=ğEµ¯øâKÖ»|··EäÏ÷Hv®åº‚&é¾éËˆÁÎ™4'«©QB<ÛîıB_ö;éÜÃ³ûgqÚh$Ûn:]ÿ p¬ˆ­'?Ë(kíÆxïhÛª“ïÒ¨÷÷W³wUÊÇ3Æz&8Ø´c%i×©kÇ:óÄöúõ¯4û-òj¶şÁaqjƒÔİM6}õo’Â÷çg´?ªÁ¨f˜ç¦ßşêü—¸v+iüÔ©
àá›|÷Sä£&ãg©\.“µE9j·À^ê|“®å¶²Ô]FÀfHaÃô_à¾Ÿ$'sÛÁ$ÜÇ¤şğÀ®‹|ûù8;…†Gæ#§†¡ı6ıÔLóêLÆêîDõ<W7<Î¦l%øEu,³ËÛİİÖå¿½õÙC#¶¦‰²Ô2ûÊCG«¾Æ‡o¶˜Šd¹Ñ‰Û‘Ò÷|K&ÄÒi!YŸü1ÕäàÎ;~+IS<†5Ô±¸ \éQ™ãŠU“µF­çl¾]ŠF†0eOW
Ö¹àrÆˆvÜ7Md^HôË2†u<¦c
ê:°BHb“mÈ3Â‘Ê¬OëÃW½¼D!¶„uC®|	Çi4%[Lå//¡ºŠ¬‰¨çZå‰½cşÇ!ªÜ3I5Ü²ü³+A@=$­+Jñ¦"õ"‹c6®×p»:¢5U>uÒ1†ÊiÌg•]LSHÙW÷$Œ(ï1[E¸¥¼>©mÜÍ;ŠÒ1’Ç_Ú-Ïıw•ùd÷(£2˜'Ç5Ókq3gÇ'¨}êF7iÿ éşL—ÿ æ|İ¡‰/5«>@Óä=g’£±D$òåıgxVxå ƒ¨ó¸W‘Ö¹{¥öÖ¿½Ô·°ñÖˆ#¯şLx¾ö¸©ïz{;9ü÷vÖqéÜÂ-¼„§Y€hã V«%ªş8òSÉ¾Ëœ"º™.¯¶~µ¿U…­ Ü1á×»§‰¾‹û÷ıkï{Gµ¼úq½Õ¢œÊ6äsU)"q ğôşbÿ «erZP{³ö„‚;­½ß©%…Ì–åŸ/€Ò˜ßW„f¿#\6‰kp¥ŠË"Á›÷uú‹uXK)F Oåƒê å—†ëêR–ÿ Ûú»~àÛ;wm¹d²¶´ÏÓ¨:æcA¨x¢®<Ü£b†yÎIîd‘d–Wv_…™‰#Â‡
äu¤>í÷{çdí{”’ ’E’	D‡%¡s:‹Š×MNXK/äz¼p†ÄD²Ç¨·Â–±š¨jfî«åÿ °öü#í¯kÊ‹–¥mÈ4~’–aüL¾Ü4/—şÄ—ğ¿Ñfçn”jŠãu:d6è¥û£SòÎvü/ô¹ÛçI#†Ër Êu[‚‡Ê¢\±ÎåY|!¸/7}ª)ßA$À
¶ÇIæz¸è!•ğ*ÜıJî8®lö˜£´Ü#½Äå«iÒƒVTÓ‡1'càÜ~¡­{–íEK‰ùƒ!ã…»Àú¼{İö‹÷›Ô”ë2È)øuÊ	.@`×ú¶ÊCnù:ÃÛĞHÍZ+ïºÈÕ`İÏzÛ÷½#·}D2£%9R„Ÿ~
®@ÜŠİ±·[ÚîòÉä©áŸ2 ïŞêvd²õL`K,¢¤ä‚Ù_±ìî/¶ÄêJË+42PQÔöâÎ„Õ‚—½½-¶Úa‚Pã[³Ç"h)…t°•¿üÃÛ¨@«":ŸY¢’¹çöc­ÀYfu·ëYç©š5,A¨Ìp1ƒ›ÈÃ³Eü£k#@D§.8ÎZM?·&®ÜH<@ÓöS~ÎM´É<×=(ÍOæp©Ï<FJıãu>ÛüÖì²]ˆàQ¨u¦Ì’_	¥yc^›uäMÕíHù¶]®È-Œ[†˜¶ø¸»+‘1Â5inÅUqèúÊo&eõ¤—÷Fîú{ ½!3–XÇR}#ìÇ´¸>yåĞC8Sƒ‰é':L=RİlVÉ ßY––©¦ª¯]U÷O,yşõ%Ÿş~ÌÁ¯J^í1ÈÊ'…%ÈeR<üñó­âg™{šÓäû«u†("¸-†¯IÇµ¡Ê“ÉÜ¡Œı±º5¿pí[ê[ÜB÷zx«ÄÁ˜ëşİ×²1vêáœHwkéQÓ¾+}nëJ2N5rğ9aµ¼GÀn²}$`Ğ–>8q7—ÛdsX#¸{4mP6ZĞŠ08al¥Wõ’Î-ÃêÅÔãBÜZYM’ªµ´yWø±*QyeÚ2Íßg·n«AA,cQPy&ÍH¦½¯Éè/¢ö]_¦ÛcüÌ2Ó~Xb¡e`ÀSÄç:ó&ê</¶êŒ ¹•c¬†rx{p²Æ•ğG*Ú[W¬) Î”¯2
lç7rÿ pnW›;Ÿ—XjÈ©Á€#â®+[j”&mÙ¢êNÔ§¤•HâqI&„ÎæÜİ$u3µiBxcª²a"âiùi!j°G ğôœı³ƒÕÿ H»¯pbåä’y*¼”uÙCˆÙbKÑø1>øµ÷K>ºE7E™k‘5Ïôbucâ›êÜIÛ’¤kÕèDGûMüÆÿ ±:ğ,íÖÓ0¹1¢©K~«#™$iı8yÀİ³nn7T”…Ydee@µâpW¿—|@­Ú·J§ ñÈº†U>xçŒ€Ó[‹‰-ç·$…—œ¨8šR¸ªr‰ÄHİ=ÏM)š’‡	 ıĞÅA÷ÓÄ®ïÛåT¼Xtêi@V@M‹kyIo-½Ì09¡Iò"£>Fİ´ ²¶pßuøåŒï’ÈĞ{ZBÖ:QÂ‚|ê*1çnäİ«€¼bÖ7WC¨"Veª¢¢¾Ş’E1Oª}Ésmu¹‰ÌÒÜ|ÜÁ€õD‹¡HöÛ¢ª	o·	>í¶]êÒmF}-©1È3*C†áÎ„-qéú;Ü]–şíí]ãµw,w8ˆ#8'Qùr¯í#~®XôëdÔ%¨Ó€ºCÈû°dI¨<ö_Ó½ï¸ÚúùK(cs%ÁÍ‰ÖÔTN-¨sá‰Ş"mUrš{fHŸdšÊ{€­¶ÈmÜª$V 
Ÿ8ùfnÑôºm5LÂş³mËµw¸¼‰Á·¿…HäÈ4}â¸ÙêŞ“Ø¦@}ûÄêÀêT”.zşµ®=XóíX=ôÓ¹âÜ;~gO>ÒÂ%cÅ¬§>Œü#»áÿ "©k&€³@tã¡äŞq}Ôz[Ü¨§¨É¥IÊ¬Æ”#
äÁ~¸o+Ôk›8Á/moen÷c‰XŠS¬fïÑjIO4÷nÆ:õêàO¤h+€æÜX¯&Ùô7wq¶î{dÄ‹uI]*’(R×Ô¤ã'²¡É§ÖÊ·9'm+áY(N3«z
Œ²G3Ç=ÔnÎkÓIËÛ‡V¡qnÛ'Õ¦$–á\Ã× ãŞ¢‰#Y+³ãá–,"ªƒ=ßmÍÓ4š‚3G†/Uƒ6Æ+\m—K¿ZÛ÷]_I¨ä¤ñÂ¿ìOêzêÍºw•ù’@«ór9ÍGşÜA¼ªÉw¢¬İÃÑœ¬zü9=sÄ©ÉP’½å§[[?Â0l-xAl‹p²GğÍB)û$
}ØdÄg=°¡7„%¨T•hyøâšÖ9¾?‹¼%ÕÚº’âIUE‹?¿ÕpÙHéüg­Æh·PÏÛ‡«àr5o[sÉ¹½ÌoH©`rƒ©ïX•VR*Ç¬Jü>xRu^A[ä`Kip ¡*¿é£QíÉß¹ÈcXR¥«DÄmR•´›l,¨Šfô©ÀR˜ò¶9g£E‚öÿ 7ËÁd:+iã§P¯İ…	‹ıT{kîùŠŞ"ckkTC%(*ş¥Èò¦6hş¤vW"ÇoïÃÙÃí¶5ÖcTnÄ=„qÕKÁšú¤ô~ÙõOéGÕİ“iîr»ñZ£ÌÃBÉO	yşŞ×Kúòb}ÇÚwâñ<ÑŞØ30´Ümœ<3 90+ğšR ğÇ¡¯b±çlÖèOÛÑXCyşåe%şÛo i¬fV¥Bl‚åêòÀß³­CëjïcIºÿ ²³¶İ^-¥RÕa´ÛátqÂUst‹§M–<÷ì6 ô¿ëäKúW»n—Sn¯¸£FT¹XÉ'ãÖíöšcÍö9“ÑÒ¡ınÚ¤m†ÚúZ4‘Jè> ¥=ÔÃzÖÌİ\VÍ 1²pÓÄy¿N=MVÁçm¨åØÿ ô]úÛæå+µÍ'BùkM1MécìÅÓ%ƒÒ{=ß\Ij}WVŒVR(ê@)"ÓŠºqdä•«»=´òÍb¤U¾rŞŠÙ©EËÙw€ÑdÀ~¼öµÂıE{× ‹p‰<IAÓãîÎ«&‹^¡}2lİ¹$ñh½¹a“à™*}‚˜­ßZã’]íş˜÷†Ëİ¶wW—seaÄŠHˆ+ä5ÄµåŒ[£n·ô~ã´M$Ğ†T–2Ú’Tğ<1€›‡cÙMr·s&‰¢$çÀøe†M'Á°h¶ •©LÀ¦yĞaê“ÖbvıÛ“Åš|5$Çá‹A'ibÙ¯o.!Gs©5:TfqZZ½[àüÄ5ê$‘DÓG”1AS¨ç†iL’—i_Yv“uİ›NJªË<®*E•ùƒ=³ua™.å}w1EªxÅY€¨Ù×<=+!³ë‡h¸Y'½êT»HÌ¦¼™FX[‚‡Û"Ğ+ğSÈÔ¶:Œ[¬v…é÷,EÒYˆjäTøSX&˜ÑİóÆ‡;
”r®D!"Ÿ£wõ@é³Ë¥„H*X5q5à§ï{k‰ãhĞ+èEIÅ²@EïI%¸©%¢œ0 ‘¦ƒá¯'Íä²Ÿ7é h8úF9rNÙÚ×^H—õ~éáï¦3ï´"Újj[êiX¯»S=ĞúHâš2òFºÎ@d¹ø±ıà|Ş7TŞ;Ët¾˜zŸ/å¢¡+AåC]b¨ÍÚYr!–2­uˆ¡8#î{[o‘šxËA)üq’}ØäØ®ˆµ²ZËµN¯yÌíò7&!BQ²«'ˆäÃÕ»«#·B²ß#†ËçmöÓÉ(’:Ön uœ²EÊ˜kklOS×U©Qíà‚U¬koP€|+Jd5Äşî6iÜ2Y–óEÔA‘«ÄkCÇğj8å©Èåß»ÛÏißY\4FSšÜ *uGë«˜Âi´Y¶¸<Åc0Kµü)'¤óÉ±êÑÃ<û©AÂz…•u©ZsûqªL°ißN»ÒH­¢pÒ-îÂ)4n}W;k½)æöîù~ëx.^FjQ¿l·¶·×ûd°ËÕ‚ZÏ×”-Šíà–¾L“şÉŞ¤½õ·mÉ¦Ú¬Xqf’Gcö 1E6™íÄh–Ö÷#©Q„€ZŒ§v.´PŠÎĞ_²ÂòÈ‘>¨`¤ÕK<”ò¸ŸTÊ÷~SvŸpZwÃax¤,ÑR¸ê‰£Q¨U}<9eŒ5õ´)~ÊK{±¿í
Süğ‰Ø{7ñØ²Ú5.$¦’9Tç÷bºÄ¶Qû}ÍÅ¤BC]"’ÈFdóÅ‰A–÷l×›FàÆÎV…BUj5u:àÕH/hxœIui:qÅ	O“uú·´G&û¼N*’38Ô9«yÖ6¨2Îì°Xvˆ.#OÌ=TêVûé‹è°›–AÛc•Ü.#g?–h\ñ:Tg„¿W[­õìÍ€8r49xÇQÌü”¶Şì×óHn\1oÒÈÃy}ó=­yMYQÇ<Î9ÿ S¼”»az]œ’yéÄÛà¢Xcõæä‹wk ñ\zû¢q¦–3Y¿ti’;‚½IÉã˜¦Xë¤½Ã$}[­Æ:ÌP p…,0vLûâJ±tO~Un3o/¨lí‰%¶•âœ(¹A@ãŸ–<Öz½Ü7ÅÚ·—QÊRkÏË¶ŒzXkô(&•“Ëª­ö[ª“Í6‹=³Ã"§S]uÔÒŒ¬NgÇd‚^FKié)”Ö‚ªµÔiÃ
Q0´(„„.iÄ)ÿ ,pÅóC iêò8é:W½¹lÂ¬PTÕAÊ¸k_¶ETë€mÕÃHÁ"¾ª€kç…8ƒDûmäğ¨YÈ³ 2æ¹~Ğ¨8R‚²Î]£rÚê)H/bÕµ¨½uıîXËU{dòqì’Ùn×¶n)-æptä(N¥?ùHÇ°’µS<¦Ú³GhæâÔÍ kÏ®QÉcjŞäÚwkøcêKjÆ±·Á"VH›ÉĞ‘#ĞG{$¿khI¶û8~sl‘€¢ÇuèhŸ¸ÉÓORÖ•*C“7úïİ7õ"øT§BŞ+y
0ôõ4ş¼E^KRLá7šYTsSV9‘AQO\wibªuE›Kû½ÂEˆEOÉÜ…Õû¦¹a«fÁjªš¯Ñ®óšË{}‹r1İ¤_•K±‚å’†}1/bä¦›$àÚo¶Ï˜’&jƒANƒÆjàÔÜ“GgURÈYy2P#>\Y«D@TsÅR&Ù‚ıDÛ'=Æ
¦4Ê¹)ÁÖR'‹?æŒeOPŠïÁ‘OGıXZŞîl8™dU§ˆã%Ö5fu¸Û	ö	–CëTê'‰t ÑƒG€ì¬ˆÆ)z[†1Ä]€¯ˆ û©ƒnG„é3èWüµŠ=ˆ©ÊŸ«¼–®d·ivÀŒ±FªkâEN
°zä··î–2¿ôå+şãbG«‡?fàîX&ãv“o›RG®°PuU0-ao{–_œÚàéš$*tó–ŸnX¥Y6ŠWj³Ò=îJMxSø±K<ªÉKzºy7³¨Uo€|=¹{Û,âV+$SzŠµ ïÆMæ½#ÛL:åœ4­QTğõRÜ`ƒbä¼EÖíºØ[ºŸ—´Œ0ÆFÊ¦q»Ò¦[3{VàÉ;ƒkŠÂûu²U*m®ås[,¿Ãuínj³Ü#'ˆ|øaF¥õXÄ¶D"k…0İ–ìá.P|Y(}¸ã¤²/..$a,ìYå9Ufà<2ÁˆGK’ÃMylšî%Yü,´S—íş/7åS($T5§ÛLI·©÷…XF¯üİ¡m$.¬¤QäNxßÔKúÃ`±waM)-Íª3•5F:ˆÉ²ä7úiŸì¨´ˆV½¬¾—‘Ÿ#å\i§Áç$Æ•Á—‘ÃÀ³ƒHúßk÷MÔ[Û´^ÚÈ¯,š©È5¦•ÿ p'gQ™wrîóo»ışğècùÙŞUNH„úP
Ğc;–hà¤§D,Š3‰Å~Ì4B’å¤Jè‘A¦‘FÎ£<‡»X'i¶—¾k«+È”KsnVv¼Œ˜ÂˆèË­†Dåá\ië(Îíàõv×ı¥ô>¨n"YU¼C­q×,Ş­‚S%W,¾ìr©Òs(.yybµ#a»6h¤,òÌ.D~>8†a&ØÃ¸bŠ™5sûğ«›É¬}J¹•wİáYµRêVE‚ÈÕËvhª2ıçpİd± ®©¡”°A](}Ùc¨uÌÚ+«»‰¥f™œ¯‰&¤ñlhh‚eû:óL§×]ëÇ‡ß‚– ŞC÷|mï.½3¤:¢ªQ¯á‰×’—àÙ–vûóP6²Y¤'à Q¦œë‘ÅZÁ*<š[VÙq*I$!P§†¤?©Ig„
îk]¾ÚómºOL¡Lœè3˜¤’…öçIqG®Iÿ 4éÒ¹
`Ù‚¼€o¯R[Ô,†6 CÈ5ÂÔ6ägì›¶}Çå] 6‘Y¸eÀı¸‡±\41­îo:¢YÂ BU|kZŸmycÏlÛä£s¾îöıÓwı?p’%ô†
Â©Ÿ/nµVµ˜³Ü;Ä	¾]6åpÍspDÏ#):‹ç›Lh¥û)dšUÀ½»\IüÒÄÀú[XPkŸŠ$Ø—ŒP—KhŞî3’:º×Ï*a–›¿Gº‹Ê%E¾P¥,¥·•xUZ€*a¿M×€~ê?(1´A½nW°YÇm[¹äXã¨Ğ¹ VGÒ38oúö‰ıŠÌ7K+İ£ršÆëmgÜmò˜0N$(å´•<E1Ôõ¬Áof¨q9ªüá‚Ø|]6`\ùcE=å™ïï%À:Ûx¶³î¶îÔH½9„m+©E)/¥…<=¸_gÔU£h=Çk¤ÂYS[ÙI‹OojY.n@,P¹ ZU\bõ6$òiöi*L³p‰•Rê,´ä|F=Ÿ(ÅGàŠÚååi’I RráKI×¬¨P?7cJáàDA$J€k#Bä¤R‡ŸÏ
ÒC¦R¸¤&mÅ‰'³+Rm²ŞF¸ª!g Ñ@©û°uU¾Ûd–C|÷–}Hú²«+’Ö5ÔŸ²”9âÕ³#j¦o¿Iş¡Y?m[íW‘Ëç·©$
Ç_IJÂ¼q¨+G8‘ÿ ½öÍB’F&¬U dP¢iãC:r*âõ÷?yÚµÁD@ê†¡†b¤xáoq«S;ş±+o0TiFÈSÇ.8äş§5öF»õBÑß¹nÔ²OÀSŒ3Æ{"ÕfUÜ°Om·,–Ìb)¦±LÔPûnf°ª$·*Ã@é×í¦4N²Âİ·ÒmÊ8Ö]ê[XäPº˜j„ï·„Éšt3I$Eù\ñœ”œ»=oô¾R€*FgßIr5l{NğıÃ/õIGAHfˆWÈ‘‰Wû·õ	Ç´Øİo€-4¸ÄÇ‰÷béK3¼!srÛÍ¾úæ?JC[:é<=Ø[‚öê¡÷HÉ`J â+Lux¹.Z]^ÙÏmrú-Bsß„İGd>«Ã6ıŞËtagºÈÀˆ­E3œ@Ó=éhÚ¶&Üï.í7©™$(ÎQØPÊ#<W^”ÖIßcOïë2ÊÀİªKC‘1­F)úR÷6Ê;Ä›zt¯!´‹çëXÉLˆ§ìŠ_ÖÔûö6¨9‹ß!XÔ/ UUE|3®=D óÉgiİ{— µ#â,œ=êqÒƒÙ¢K>øº¶¿…ˆ…$¥dhä?ÅL±ØáŒŸ’ÎıŞO¹ßKqw¹Š²¢’QÊÆ¡¡s¢ñÃªÑy"í{xÚÜÙ¼‡£íÅÊ’sçÇ«¯‚7W<D´%A/ÔB¢”ÏP4Ä}˜ıvşõı‰~M«dnwGI &ˆ&F–…UÔäCj<qñöo”}rK†a½ßÛÓ»¿wØà¶”Â„Ïk†åœjR(J1îzÛ•µç“Éß¥«àMƒiİmÔßGƒoSÉUÅU]_àFÕRÚÒ;Æ_TF¿œh>ÁZà_rX†u}w*—£³%Œ7›‘k‚h–°ÔG=*8{ñ–×Øø_şš´ÓRwğ·ì¯5µ´L‘ÆÀUä«tıØ×¯M£ìfİìQ¸§=¶ÉcgÖvÀ> ²ä `·ÛÔªªümîílğ†[hû–øHRFÇQ¥}Yd§—–#\[%ßÚ²‹ö›ÀşäÛ£±Ô–A@%ò"µÂîiàm5iÉ ·nï¯ZôÕAeVcO±™jf§±ÿ ··kG¨Ñ±œU3ãá0-Fƒ[•/v×Yˆ,”/ÓS™+‰=y¸!öåZ7kZ®…¨©x~vÉµıFõwMÈ&”y”{LÏˆ2ÈÍû§oöYøÖ?PòÏ<,@İ¤Ë¯öËoê—Ê~âRªN(¬áÖY=œia{­)núHğxˆıx­;rİ­-[b¶`Ä¹E ğ0F&¹01ö+Ãû"¨D€´áğ×ÿ n(‚7Û¢nM2Ê$Ì1àhrEı‡oê=Õko¾¤¿ñ¹]Dp!AÅS†gkó¿Ëq¸ÊêÔS®‡É áÃ	¤šC&šªy°XS7"Ç°3iT	0JÈÔµ©Ç]`ê¿±J&T‘dŠJ¨àĞ³‚Ë’NŒóÏ®Z´jOÁÍÉñ­›ÖH#Ç“lVÒRO¬·i¡ÈxcÕÕ«­x<mÛûX½-”H‘|A v*ªAØ}gb5•=&­ÈJ‘ïá€è2¼nÃ•âÎCPÖ=¡–´÷âvX5kJx8˜mÿ 16„ø«ŸÂµ$áã‰Ò¿%6ÛÂ	Ø¢†)_„¨ıxÓVbº‘›·eA»Øµ%uÉßSp4 9Wö[zÙON©mGÍúû|H†ém¿Íñks<+n²"È±WR?Oš×Òrã6¥ˆñ'©³Ûº]§Ì6¨=Ñ{´½ÕÜüôÇä·Øá	#ÃMAò§½i±¦¿‚·ö]©)Ÿ–Ò]ÒÎXmmÍ²ÆêêŠAUI+¬Ñ8.7lİU†OW«{epgrÛZFÉ[½'ã*XxeŠjªk-»,­’Û¤‘utÄX… 8ÒæM*yaåT–nI¶ÜÁgyÕwĞCi¢üTÏšŒ†ò\¬õD`(bÒ0ÓQà¼¿P”Á§1'ÎßÙ¬7æÍ	¼uQoÔÕë_ N2m²V–z®»Z½Q Eó¶’íÂİwù¢$†D*¢ƒœ’Pú†ª`Ù«PhÛêZœöğMó,k¨1rÕ9’TâJÂ:•/AÙ+P4\kÍyàY…"«MÖ*
€Âq'ÉD°C|ÖæÇlP H­1aâ	ËàHû_PÁİyÔpÀË!@(Í‘<Íq’rjŒ]ÁÏ·ÎÀäáÔTÔ*OXL©¤·ç‘¨tĞxå•0Ş<²#­ç
•T¡jpP¦ƒ«PNË!Å7wª’×—§–y–6ÍÖúÖöŠ]:”¸øI‚²Æü*eEê<Íp¬jËA-³iÿ öÑ\’Á¥:‰?¸ı8aJ;õšÇ¸¿L~]HSË±ÃEX´P -8c˜Ëç]Çkí2*±[E˜HÃ5 ºÒ¸{©¨•qb•š¯OYÏV`ã9 'n®î	Ì^Ìsa/î.‘AŒ 4×®vğAÀ{ñ³Ô×.LîÈP‹TH-A›ÒP5)B|Æxõ:£Ély2fz¬IàFtæ ZËäsutª@˜Ê?fD}ø•¬şM4Ö¾ —·M¨¤aÎuMJ~ãŒ·»FÚQ3§Û7k{w+Ë9"±¸4Švb¾å\%6¦ò5ô´°Y¶¹†‚ÆãÅ˜ŒhÁ‘Ğ=µ_5¼ÑK †	£`ñ±:—P?‰yû0—§d×ÈuÛ¥§Ê/_È.iä«1f¢˜ê4‚×–•…^Òä	µÚÛÉy4sjÕ4EP+£,K}<š½]±‚¶ßŞ×k1¶†äÙtÇJXíÔ%JäI>9c54'É¿o½t¡IÉ´ëOQkæI:‰jc}pÏ)·nNvİŸ¸7­É¬v‡åà’b³6€RV|Hà9â[›E´V¥M¶ö4‰ÒHµ
° —¯ç\RFLûhä¹Öštcu¹¶¤j/s©ã¢<´øfôkk7»íõÀq¶†&¨M¨(ÙñËö5«}ië–h{¼·Ü¤}G´ôú¬ ‚ŠS,fıj¦½ÃÚåƒmoÉ¹%EB·.X)ä“X#k¿Ìˆ0

ã›@Û§®óhÕ¡}UDğÄŸ#ø&½Eş©·@§óT¯•*#äcúw]ì¯’ë—Iğ;Œak&µÁ÷\MoqGÑ
UF^$ı¹c® ê³,kCıJëÔX+SàÆ¸oø‰ä&àÇ,ïOAZ"ÌĞ~ƒ‡¯°rZêí«Fe b.+“˜1vÀlü™(Äf …¤ÛÌæ´RÂ‡Ï˜ÂÛ‘ëÁs¢çzG‡* áëÈwÈd¸Ì’$"¹åç‡DØ'Ub§†9 }âGØ“ÛçÕ–UÀ `~ó‹OĞ“Sb­€¬ô0¨ıÈk
X¼éfj-H©å—rRsq“½°«÷³úIı‘Ã×¯¯­R<û;Y²öäÄDT°´ 5û…q©#˜¹:Â¥Š†-Ì/¤}ø ¶´À{¥âÃwÈærÏÛåŒ»/£®ƒcvcj‹ß lÅM£ş*šudrÌó“Jq¨îóµåŒñ‰m¦,A)ìåŒ[\3UÏ¸»rëd¼ZÕì.KIG0´ªŸ5®7j´£ÚC8ÛäUmCOH?«jb°İ·,SÂJÒAÆ„×<V¤˜*ëM¶à’ÀÁ¼0›+(¦›C"îëDµŞ-ïzjm¯àYPæ=j4·qÆMfí«Q$“ˆèÎ°°®º<×ÃhŒ—´"ÎÙ=ÆÇ»ÚnVÒ0x$RÀšÑ'©ş9a¯LVÌ‚GN=Êåg€39Y‘@ÌXVG¢ù)¹üïc‚+uéHÏÕ‚UG™8{á¢:¸ri_D.¢Ywnª•¸Ñá¡uVò1=Œ¾Ÿ»š~º’«Æ¸ÍµäÛ­Ğ]H+ÿ ÄXRœ(rÄJ‘î·´º€#f*h9àÙ"šIom\š”¯Qj`.N|'¼c½[Õ+…Ï€9aäF=}VŠi;®ha:5A­x´²ı¸Íe”h«Ã-6«Ë¦$¸(zb‘Jşa,Xş#—ƒ¹H(Äˆ¶ø÷û¤rEÃéÑ_C 3ûp©}Nòq#õïš4tV¼Æk\58¹{šÎØ6øĞê—$hëÀZàT,,a­àq“DtÓ†G4pöô³,jd2#à¼1Í- 6÷1HÆ’G§´å÷`£˜/x6á:×"Õ>üPŒ©şÿ ì†4ög87²8şİ¾Šj‡dVŒ^Zı˜vğ"ä†Âp!`üAòğÄ4TÖğ\
‚AÈ,hõ©62û["£^İkÑ¶TjoÅËÍp‚·{„2‡2i¦1\ı¸.Âª9]ÌQ˜´ÓI:›ìÄnÍšÑÏlöì»¥Ón»‚‰, r©p‘€$eûïÇŸw“Ñ¢„iÉ&ÓméÓ¥2  H¦x®E“8i¤‘*5G<ıœ›+„5\í[ÿ bE¶JiqóO,V–> ùóÛ«ú£.Çö1ÕæÒîKiÆ™ r²{¹#4¼˜öĞeÛz3¢›v0L?Ê´ñ*AîÓH«"„¸\›OÂ