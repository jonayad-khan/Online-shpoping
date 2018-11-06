
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
;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               INDX( 	                 (   p  �      &   a e                 �    x f     �    9m�b� o��j�����b�2m�b�       �               A n y V a l u e s T o k e n . p h p   �    x d     �    vA�b� o��j��d^�b�rA�b�       �               A n y V a l u e T o k e n . p h p     �    � t     �    (��b� o��j��n��b�"��b�       �               A p p r o x i m a t e V a l u e T o k e n . p h p     �    x h     �    ^��b� o��j��^��b�X��b�       �    &          A r r a y C o u n t T o k e n . p h p �    x h     �    _��b� o��j��M�b�V��b�       �               A r r a y E n t r y T o k e n . p h p �    � r     �    r'�b� o��j��iE�b�r'�b�       �               A r r a y E v e r y E n t r y T o k e n . p h p       �    x d     �    �U�b� o��j��u�b��U�b�       ,               C a l l b a c k T o k e n . p h p     �    x h     �    ��b� o��j�����b���b�       �               E x & c t V a l u e T o k e n . p h p �    � p     �    }��b� o��j��X��b�|��b�       �               I d e n t i c a l V a l u e T o k e n . p h p �    x h     �    ���b� o��j��F��b����b�       �               L o g i c a l A n d T o k e n . p h p �    x h     �    ��b� o��j���5�b���b�                      L o g i c a l N o t T o k e n . p h p �    � j     �    �D�b� o��j���_�b��D�b�       9
               O b j e c t S t a t e T o k & n . p h p       �    � p     �    Rl�b� o��j����b�Jl�b�       �               S t r i n g C o n t a i n s T o k e n . p h p �    x f     �    ��b� o��j��գ�b���b�       �               T o k e n I n t e r f a c e . p h p   �    p \     �    ���b� o��j�����b����b�       �               T y p e T o k e n . p h p                                                                                                                                         &                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               &                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               &                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               &                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               & ���� JFIF   d d  �� Ducky     <  �� Adobe d�   �� � 		



��  � �� �           	                 !1AQa"q�2��B#��Rbr$��3C��S�cD%6     !1AQ"aq2��B3���   ? 3�۟���zW[�׉�]��t,�Fi1�4R�k�-��8*�t�+�(~�>kBΩ�KC���?k$����F��v��H@�Y���B���S���S�e֖�� �he}Y;�+�`�/��T#Q��o�Tj����Nf,?�~�[�/�Z��ZF�!cCB/��(�Co�4�_P� IO��Lx"t���ji�< e{*G� �a�
�o#i�%��	�� ��u� ��+��&����<�9��l)to�O����1$�VT�q;125yV�$�$[�t�G�rñ`���'7Z�6�Pt��5U�<yaP�K�f�%
XҘd�l��^��7W!u��ه�"���fHQ)�A��%~JS�{��$[��F��@k���I(m��,��S�+��/D�y%������g�-.��;�rX��x�Y �h���X�B��xӌ�P�@L�w4��f�N(�v�m<��ם@�c&œV�`��vk3�yd���F�gFvx��r�EO�'@9�1Y� I�'v�`�f�~Y�zW��1�#K+��d���М����1�p�?����U�ḿ
�4p��=}5px�-�
�m�X������ȏ�؁��⎎D�̽���I�� �K0>g�铝��?n]�k�cF)  �⺘���Z��b�Q���0}U�D���3�� OT/e튤00�}G�cN���!�s�%#bx�A{5�f��_�`#�K^^8E�Ő*���r���8և9����0-wf�om��љ:�^,�h��R�|�;��:��\��x��F�
_~�%+\d����=�^�^��Tխ��u���t�Bg:���7�`��f�E����)������[�'���=�-t�t��u7o�.a��	R"H՝>��՝�h�0դP�݄�#ׁgu6�
�j���Ƅ�F21�9�(cA�Le�-RZ��$֣�>~x���vKȖ��C��X�;k�����s�r2t��B��k#6d�G
��V���:�|�D�1u�h��y�WE*�$��"TtNU"�`�k���aJ�e�Wϖ9�}�o�vA�[e���#��;����6��8GU�孿�K�E(A>�IO'�;�t�?�;�Mĝ8��"�4��F�{���g��K�E�۹����^����8{Y�n72�5L�x���u�!�gC��4�i�����N��n�F�N_�C��@�������v��?i8ϳ�������9ԟ�f9��+E���⣺��D3%�0N96�c�>=xS<p���&k���m�Z�Tb�>�c2j�F�d}I6Q��vնI#��aZ��1���ܨ�V�=�ЫYU���x��2��X)}�=���k[����n�qN�C�k�XѮmS��g�##H�Ʌj3��-@��l٭dhH#�9����Ie�[|���omm��|����sPg������;��m"���r��fS!��J��WL��ƈ����̶Ͼ�Ei�� �j�z~��$t����!��F���}� ��e���H��Ԍ°��B�DL�p°��S
h���E+ZR���g��'���z�ִ�58V�H���`T�	% ���)�T邅g�F��� �aQ��akǆ#d�>���l�w��ng�}��奒B����3����Y�28�)�(L�ko�G{��sk�$�{�&i��&R4��zIG��&N����]���`�pK���K�`��F�ՙ��r��_zN ��V֬�»������8�J7JX�.�$DTd���w�L[���$6�v��Go+��K	ZS]��N��gb�f�J��n��djr�M���N�(0�%��AbA�� ���: 	k��R�Z����4�~k���c�-�e�����q�.�"��lW^��2;/�U�1�]� ��v�}&� $p]��4`��
:j5$;)'���g��iZ������n�A�->�1,��Ƭ�S�"�pģkXs"�v�����g�|����#h�Ҭ�_ф��+j6��)wn�m{c��o�}jE?1���H@�53Q�褹�ի�� [��w��rm�v�O��ϭ�u+��9S�4m�$�������N3��k���Ә�'�.��p�����=��M�n(p�>�[ZP-ٖG&�+/MB� ��h	��N4'/^����r\�d�
�$W�#�8/'S_S���G��on��Y�.��o�D#���4>��1�� %�o�A��቏2:�T�1���nG,��	E�h@��E�ȕ5�DW���	$�`f�*�G�:"���0¢2�#��9珮�6��v�.������W�9��v��@�,!�i�%dW���8�� ��7���������agӊ�)�dU�J�*��Θel��B`�-�vݦ�}�D�q��(�6�s�R���)?`�%՘��:��ԀWӑ_hŕ�ak ���߶�o��/��E��h�ڇ�r5�Į�2YF����o���,w���9�.�#�HC�U9W
��a�r����!:�A���9a�*��l =^8T�gzH��X >$��D���J:���B�՟�����4��oH�w�=��q��uwG#\�I�c d�9S�5"^�� w&�n�e��[�tnY�t�}������R���	,RV^�lh��~�q
ᔫv3���h/��#��i�x��ybvR�Z�y1Kmݿ��/��H@��H<��N��d�w�r�����\ʨ� ���Z<_k]'�K�st��-序��Ιc/tg�ʷ7ѥ��$�cDf.E ��p�.Z�'�|�� t��ō��W7�yi&4��\?���c�;�;���b�ߣ�n�H���Ė����;�׶W�RJ�Q跖2���<>�#��T>�o����6��>�'^١�,@�T�}m����+p{f�Ϳt�m�2��=J[� 5��cq�ov��*�8�Q*e�FJAM�~�v�<0bB~�7Q�d@\� S	a�	lMQψ#�9 �h��ꡯ�P	�'-�9i�Q�
"�)%�,� �LY��z�H����1��bڠ�黷�؋���yki�҄�V�$��}�)�o�aoH��t� �b����� �ۤ��w	�8�PW2�c��z���C�㴵����K��ݱN���(kJSvݦja�ӻ�on�V8��a��G�J�x��	����v�sFlo��I\KѶuU�#�S\U{-�'�!ɠvE���[-�n�k���KG��H5��� W�p�x��ۑ���kp꺎���
xu�TG���7{9�I��K"�%qG�0*4]k�%�u�:h3����#�H��m�'�]�� ����a��R���m� ���IJ�>x��Z�d�9c��=�đ�yj � ̜�U�� cc�{��N�ެ�N���=ś�Pd�j���e���~���Q���{U�3�+W�*�S������ʉ6]��o�׫�����X���c"�{2v�Õ�(�{q�/�6��[YE븖VbM8�I5��vG}��$�m�m۹���#�%' G�5��H��n���Qn[6������q#E^
��5BH��a�߮��H+w��I��N繭�����!24�Z�OH��ә�n��%�(A~���훹T�$�Ƅ�aQLz^�wF=�՞,��Kͳ�������ܪ�z���ҍ�ߪ��~Q�=��حn�f5����U|�����4��֪� ����õo���[D�$�Y $�Uj��L!�L�odC�6�w{3ub$$�W�Us�� ^�d�mط��i���%2l1�ք�����
��7�W��e��3���r[�[{�j��Y3ˊ����o�4z�SY'��ܙ���6���,h@�Ja��6 �O#
=*|0�~�V7�8��UfVx�J��9��j�X��FO�L�S��4�Y��g��̨Ю���	��}L*�P.�`z�,�Y�08���_���:{k2�0\4�E��?N:a�t�ً�ͽ��;ʄ��H,xy��f�|3�����v�BCd���_��<q;kV�hc������`fU"X߁V���8ϳS�4V顊׸^9���x�
���s�a���!�;��կu��$+���A���KN�1�p�ij5E��X�+�V9�?k�����TR�1 W��<?xD�%�>�qŸE9�����֫"q�y�{ОӺ���scU�(2���V*�vl�-�r[Op��ي����T0$�u��N� �������Bd��53 ��_�yb��"چ=,;���������T��8y�c��h�hϺ�զ	�;Y7]�s���Ŭ"S2G����[��k]$)���7ڪ�W���|�S�{�� f���}n���L��2'���ķz*�3�� �N�Pb�6�dm�ͱ�C�VM4� I'�� ��/�� 뮿U��,����� q*�֓ZK<�[��eهP��p�=�I`���6{%��i����ê� @��u$+�V�hU�9c���5_����]�����nw7۔l!�ɑ��L���]��h<�\�iS^v�Ԟ޺����n�#�"h�AX���ǩD����ul7x�D�vSE��?�mkK���^�,���x�{1�ϲ��p�]�v��7�-�q�
[)�[�+xycɺ��sE������߷nؼk���6�u�e�5%��^�*�;w�@�k��7�m�l�v�{�^��%�!j�ǯ�ˮmb��}Ϸ��ฉn��{�ݓ1���,���ڕ5��amg��5=���]�$��Y�b^��Ӯ��4 	3�Cr<��]d�h��+BV�X}km�-�I��k$ϒ�!#�\< ��)'ق�QQ�`��j�p����,�Ӧ��g��E߻U���o�鷎k�Xs��}��X�&'�qݧ�qi���U��1>����m5A]��KK;h��"�/_
��8���[���c%ʊ
Ky�c��-��mf���)\H��G��M����P0=��a����Eɐ$��\xW3��Zlz�h'�o[��-4�"�,����ۈ_G�z����b�%/z�,�8��Q�[E��zg_܂��t�u��x1�����N�(Pb��^#�����u؟g���$�)#�b�h��@*9`Y1�`��`����f��i�.�]�E�sp�e*�'���,���mq���[�d�Ħ�ĵ�`����� Y�3n��۴;��n\���#ǹF)F�V�!�&���NU�4��0o��E��M��U�����P���������>�P( �	�O�nWm�I�=9����Re(��ɱ-���^���?e����y�w�{p�យ-&T֠Zq�{?������ wnZIa�W�v,���MMJJz�4X�B�F�����7�]ճ�Igs������Ue+��۶�R���=A�6ם����H�5I�Ũ+�R�&GRZ��ϑ�k�`k�_h^[Y[ĩ聒����Ow��Q�O�X�`;�=��E�����Kֻ|��E���Hv�庂&��ˈ�Ι4'��QB<����B_�;��ó�gq�h$�n:]� p���'?�(k��x�h۪������W�wU��3�z&8شc%iשk�:������4�-�j���a�qj��݁M6�}�o����g��?����f��������v+�i�ԩ
�ល|�S�&�g�\.���E9j��^�|��嶲�]F�fHa��_���$'s��$�Ǥ�����|��8;��G�#�����6��ԎL��L���D�<W7<Φl%�Eu,������忽��C#�����2��CG��Ƈo���d��щۑ��|K&��i!Y��1����;~+IS<�5Ա��\�Q��U��F��l�]�F�0eOW
ֹ�rƈv�7Md^H��2�u<�c
�:�BHb�m�3ʬO��W���D!��uC�|	��i4%[L�//��������Z剽c��!���3I5ܲ��+A@=$�+J�"�"�c6��p�:��5U>u�1��i�g�]LSH�W��$�(�1[E���>�m���;��1��_�-��w��d�(�2�'�5Ӎkq3g�'��}�F7i� ��L�� �|ݡ�/�5�>@��=g���D$���gxVx� �����W�����{��ֿ�Է��ֈ#��Lx�����z{;9��v�q���-���Y�h� V��%���8�Sɾ��"��.��~��U�� ܏1�׻��������k�{G���q�բ��6�sU)"q ���b� �erZP{����;��ߩ%�̖�/�Ҙ�W�f�#\6�kp����"���u����uXK�)F�O��嗆��R�� ۞��~��;wm�d����Ө:�cA�x��<ܣb�y�I�d�d�Wv_���#
�u�>���{�d�{����E�	D��%�s:���MNXK/�z�p��ĐD�Ǩ����jf��� ���#�kʋ��m�4�~��a�L��4/��ė��f�n�j��u:d6����S��v�/����I#��r �u[��ʢ\�Ώ�Y|!�/7}�)�A$�
��I�z��!��*��J�8�l�����#����i҃VTӎ�1'c��~��{��EK���!ㅻ����{�����Ԕ�2�)�u�	.@`����Cn�:���H�Z+����`��z���#�}D2�%9R��~
�@܊ݱ�[�������2 ���vd��L`K,����_���/���J�+42PQ���΄Ղ���-��a�P�[��"h)�t�����ۨ@�":�Y�����c��Yfu��Y穚5,A��p1���óE��k#@D�.8�ZM?�&��H<@��S~�M��<�=(�O�p��<FJ��u>����]���Q�u�̒_	�yc^�u��M��H��]��-�[������+�1�5in�Uq���o&e����F��{��!3�X�R}#�Ǵ�>y��C�8S���'�:L=R�lV���Y������]U�O,y��%��~���J�^�1��'�%�eR<����g�{�����u�("�-��Iǵ�ʓ�ܡ����5�p�[�[�B�zx��������ײ1v����Hwk�QӾ+}n�J2N5r�9a��G�n�}�$`Ж>8q7��d�sX#�{4mP6ZЊ0�8al�W���-�����B�ZYM����yW��*Qye�2��g�n�AA,cQPy&�H�����/��]_��c�̝2�~Xb�e`�S��:�&�</�� ��c��rx{p�ƕ�G*�[W�)�Δ�2
l�7r� pnW�;��Xjȩ��#�+[j�&m٢�Nԧ��H�qI&�����$u3�iBxc��a"�i��i!j�G���������� H��pb��y*��u�C��bK��1>���K>�E7E�k�5��buc����Iے�k��DG�M��� �:�,���0�1��K~�#�$i�8y�ݳnn7T��Ydee@��pW���|@�ڷJ� �Ⱥ�U>x猝��[��-�$����8�R��r��H�=�M)���	 ���A��Į���T�Xt�i@�V@M�kyIo-��09��I�"�>Fݴ���p�u�����{ZB�:Q|�*1�n�ݫ��b�7WC�"Ve������E1O�}�smu�����|����D��H�ۢ�	o�	>��]��mF}-�1�3*C��΄-q����;�]����]�w,w8�#8'Q�r��#~�X��dԞ%�Ӏ�C���dI��<�_ӽ����K(cs%�͉��TN-�s��"mUr�{fH�d��{����mܪ$V�
�8��f�n���m5L���m˵w�������H��4}�����ئ@}�����T�.z����=X��X=�ӹ��;~g�O>��%cŬ�>��#��� "�k&��@t���q}�z[ܨ��ɥIʬƔ#�
��~�o+�k�8�/moen�c�X�S��f��jI�O4�n�:���O��h+���X�&��7wq��{d��ċuI]*�(R�Ԥ�'��ɧ���9'm+�Y�(N3�z
��G3�=�n�k�I�ۇV�qn�'���$��\�� ��ޢ�#�Y+����,"��=�m��4��3G��/U�6�+\m�K�Z��]_I���¿�O�z�ͺw���@��r9�G��A��Ɏw�����ќ�z�9=sĩ�P���[[?�0l-xAl�p�G��B)�$
}�d�g=��7�%�T��hy���9�?���%�����IUE�?��p�H��g��h�P�ۇ��r5o[sɹ��oH�`r���X�VR*ǬJ�>xRu^A[�`Kip ��*���Q��߹�cXR��D�mR���l,���f���R��9g�E��� 7��d:+i�P�݅	��T{k����"ckkTC%(*����6h��vW"�o�����5�cTn�=�q�K�����~��O�G�ݓi�r��Z���B�O�	y����K��b}��w��<���30��m�<3 90+�R��ǡ�b��l��O��XCy��e%��o i�fV�Bl�����߳�C�j�cI�� �����^-��R�a���tq�Ust��M�<��6�����K�W�n�Sn���FT�X�'�����c��9��ҡ�nڤm���Z4�J�> �=��z���\V� 1�p��y�N=MV��m���� �]����+��'B�kM1M�c���%��{=�\Ij}WV�VR(�@)"ӊ��qd䕫�=���b�U�rފ٩E��فw��d�~�����E{נ�p�<IA���Ϋ&�^�}2lݹ$�h��a����*}����Z�]������ݶwW�seaĊH�+�5�ĵ�[�n��~�M$ІT�2ڒT�<1���c�Mr�s&��$���e�M'��h� ��L��y�a��bv�ۓŚ|5$��A'ibٯo.�!Gs�5:TfqZZ�[���5�$�D�G�1AS��iL��i_Yv�uݛ�NJ��<�*E����=�ua�.�}w1E�x�Y����<=+!�끇h�Y'��T�H̦��FX[��ې"�+�S�Զ:�[�v���,E��Y�j�T�SX&����Ɲ�;
��r�D�!"��w��@�˥��H*X5q5ু�{k��h�+�EIŲ@E�I�%��%��0������'���7� h8�F9rN���^H���~���3�"�jj[�iX���S=�Ў�H�2�F�Ύ@d�����|�7T�;�t��z�/��+A�C]b���Yr!�2�u��8#�{[o��x�A)�q�}��خ���Z˵N�y���7&!BQ��'���ջ�#�B��#���m���(�:�n�u��EʘkklOS�U�Q���U�koP�|+Jd5����6i�2Y��E�A���kC��j8�偩��߻��i�Y\4FS�ܠ*uG����i�Y��<�c0K��)'��ɱ���<��A�z��u�Zs�q�L�i�N��H��p�-��)4n}W;k�)����~�x.^FjQ�l�����d��ՂZ�׎�-�����L���ޤ���m��ڬXqf�Gc� 1E6���h���#�Q��Z��v.�P���_���ȑ>�`����K<��T��~Sv�pZw�ax�,�R����Q�U}<9e�5��)~�K{����
S����{7�ز�5.$��9T��b�ĶQ�}�ŤBC]"��Fd�ŉA��lכF���V��BUj5u:��H/hx�Iui:�q�	O�u���G&��N*�38�9��y�6�2��Xv�.#O�=T�V��谛�A�c��.#g?�h\�:Tg��W[�����8�r49x�Q��������Hn\1o���y}�=�yMYQ�<�9� S���az]��y����Xc���wk �\z��q��3Y�ti�;��I�㘦X����$}[��:�P p�,0vL��J�tO~Un3o/�l�%���(�A@㟖<�z��7�ڷ�Q�Rk�˶�zXk�(&�������[���6�=��"�S]u�Ҍ�Ng�d�^FKi�)�ւ���i�
Q0�(��.i�)� ,p���C i��8�:W��l¬PT�Aʸk_�ET�mՍ�H�"���k�8�D�m��Yȳ 2�~Ш8R����]�r��)H/b����u��X�U{d�q��n׶n�)-�pt�(N�?�Hǰ��S<�ڳGh���͐ k��Q�cj���wk�c�KjƱ��"VH��Б��#�G{�$�khI��8~sl����u�h�����OR֕*C�7���7�"�T�B�+y
0��4���E^KRL�7�YTsSV9�AQO\wib�uE�K���E�EO�܅����a�f�j���Ѯ��{}�r1ݤ_�K��咆}1/b�䦛$��o�Ϙ�&j��AN���j��ܓGgUR�Yy2P#>\Y�D@Ts�R&ق�D�'=�
��4ʹ�)��R'�?�eOP����OG�XZ��l8�dU����%�5fu��	�	�C�T�'�t �уG�쬈�)z�[�1�]�������nG��3�W���=��ʟ����d�iv���F�k�EN
�z䷷�2���+��bG��?f��X&�v�o�RG��PuU�0�-ao{�_����$*t���nX�Y6�Wj��=�JMxS��K<��Kz�y7��Uo��|�=�{�,�V+$Sz�� ��M�#�L:�4�QT��R��`�b�E���[�����0��Fʦ�q�Ҧ[3{V��;�k���u�U*m��s[,��u�nj��#�'�|�aF����XĶD"k�0ݖ��.P|Y(}�㤲/..$a,�Y��9Uf�<2��GK��Myl��%Y�,�S���/7�S($T5��LI����XF��ݡm$.��Q�Nx�ߐ�K��`�wa�M)-ͪ3�5F:�ɲ�7��i�쨴�V������#�\i���$��ƕ�������H��k�M�[��^�ȯ,���5��� p�'gQ�wr��o�����c���UNH��P
�c;�hधD,�3��~�4B��J�A��FΣ<��X'i���k�+ȔKsnVv����˭�D��\i�(����v�����>�n"YU�C�q��,ޭ�S%W,��r��s(.�yyb�#a�6h�,��.D~>8�a&�øb��5s�𫁛ɬ}J��w��Y�R�VE����vh�2��p�d��������A](�}�c�u��+����f����&��lhh�e�:�L��]�Ǉ߂� �C�|m�.�3�:����Q���ג��ٖv���P6�Y�'�Q����Z�*<�[V�q*I$!P���?�Ig�
�k]���m�OL�L��3������IqG�I� 4�ҹ
`ق��o�R[�,�6 C�5��6�g웶}��] 6�Y�e�����\41��o:�Y� BU|kZ�myc�l��s�����w�?p�%�
��/n�V����;�	�]6�p�spD�#):��Lh��)d�U���\I�����[XPk��$����P�Kh��3��:���*a���G���%E�P�,���xUZ��*a�M׀~�?(1�A�nW�Y�m[��X��� VG�38o������7K+ݣr���mg�m�0N$(崕<E1����of�q9����|]6`\�cE=���%�:�x������H�9�m+�E)/��<=�_g�U�h=�k��YS[�I�OojY.n@,P��Z�U\b�6$�i�i*L�p��R�,��|F=�(�G�����i�I�Rr�KI׬�P?7cJ��DA$J�k#B�R���
�C�R���&mŉ'�+Rm��F��!g �@���uU��d�C|��}H���+��5����9�ճ#j�o�I��Y?m[�W��緩$
�_IJ¼q�+G8��� ���B�F&�U�dP�i�C:r*���?yڵ�D@ꆡ�b�x�oq�S;��+o0TiF�S�.8���5�F��B�߹n��O�S��3�{"�fUܰOm�,��b)��LԏP�nf��$�*�@���4N��ݷ�m�8�]�[X�P��j��ﷄ�ɚt3I$E�\�����=o���R�*FgߍIr5l{N���/�IGAHf�Wȑ�W���	Ǵ��o��-4��ǉ�b�K3�!sr�;��?JC[:�<=�[����H�`J���+Lux�.Z]^��mr��-Bs߄�Gd>��6���tag������E3�@ӏ=�hڶ&��.�7��$(�Q�P�#<W^��I�cO��2��ݪKC�1�F)�R�6�;ězt�!����X�L���_����6�9��!X�/ UUE|3�=D���gi�{� �#�,�=�q҃٢K>�������$�dh�?�L��ጟ����O��Kqw�����Q�ơ�s��ê�y"�{x��ټ�����ʒs�����7W<D�%A/�B���P4�}��v����~M�d�nwGI &�&F��U��Cj<q��o�}rK�a���ӻ�w�ඔ�k��jR(J1�zە���ߥ��M�i�m��G�oS���U�U]_�FՐR��;�_TF���h>�Z�_rX�u}w*����%�7��k�h���G=*8{����_����Rw�����5��L���U䫐t��ׯM��f��Q��=���cg�v�>���`�ۍԪ���m��l��[h���HRF�Q�}Yd���#\[%�ڲ������ۣ�ԖA@%�"���i�m5iɠ�n�Z��AeVcO��jf��� ��kG��ѱ�U3��0-F�[�/v��Y�,�/�S�+�=y�!���Z7kZ�����x~�vɵ�F�wM�&�y�{Lψ2����o��Y��?P��<,@ݤ˯��o��~�R�N(���Y=�ia{�)n�H�x��x�;rݭ-[b�`ĹE �0F&�01�+��"�D������� n(�7۝�nM2�$�1�hrE��o�=�ko����]Dp!A�S�gk���q����S��Ɏ ��	��C�&��y�XS7"ǰ3iT	0J�Ե��]`꿱J&T�d��J��Џ��˒N��ϮZ��jO������H#��lV�RO���i��xc�ի�x<m��X�-��H�|A �v*�A�}gb5�=&��J����2��nÕ��CP�=�����vX5kJx8�m� 16�����µ$��ҿ%6��	آ��)�_���x�Vb����eA���%u��Sp4�9W�[z�ON�mG���|H��m���ks<+n�"ȱWR?O���r�6����'��ۺ]��6��=�{���ܐ������	#�MA����i������]�)���]��XmmͲ���AUI+��8.7l�U�OW�{epgr�ZF�[�'�*Xxe�j�k-�,��ۤ�ut�X� 8��M*ya�T�nI���gy�w�Ci��T�����\���D`(b�0�Q��P����1'��٬7��	��uQo���_ N2m�V�z��Z�Q�E����w��$�D�*����P���`٫Ph��Z����M�,k�1r�9�T�J�:�/A��+P4\k�y�Y�"�M�*
���q'�D�C|���lP�H�1a�	��H�_P��y�p��!@(͑<�q�rj�]�Ϸ����ԎT�*O�XL����瑨t�x�0�<�#��
�T�jpP���PN�!��7w��ח��y�6������]:���I����*eE��<�p�j�A-�i� ��\���:�?��8aJ;��Ǹ�L~]HSˎ��EX��P -�8c�ˁ��]�k�2*�[E�H�5 �Ҹ{���qb���OY�V`�9�'n��	�^�sa/�.�A� 4��v�A�{���.L��P�TH-A��P5)B|�x�:��ly2fz�I�Ft�Z��sut�@��?fD}����M4־ ��M��a�uMJ~㌷�F�Q3��7k{w+�9"��4�vb��\%6��5���Y�������Ř�h���=�_5��K �	�`�:�P?�y�0��d��uۥ��/_�.i��1f����4�ז��^��	����y4sj�4EP+��,K}<��]������k1����t�JX��%J�I>9c54'ɿo�t�I���OQ�k�I:�jc}p�)�nNvݟ�7�ɬv����b�6�RV|H�9�[�E�V�M��4��H�
� ���\R�FL�h�֚tcu���j/s��<��f��kk7����q��&��M�(����5�}i�h{��ܤ}G����� ��S,f�j������moɹ%EB�.X)�X#k�̈0

�@ۧ��hա}UD�ğ#�&�E���@��T��*#�c��w]쯒�I�;�ak&����\MoqG�
UF^$��c���,kC�J��X+S�Ƹo���&��,�OAZ"���~�����rZ��Fe�b�.+��1v��l��(�f�������RϘ�ۑ��s��z�G���*���ȍw�d�̒$"����D�'Ub��9�}�Gؓ��ՖU� `~�OГSb�����0���k
X��fj-H��rRsq��������I���ׯ��R<�;Y����DT���5��q�#��:¥��-�/�}������{���w��r��医/���cvcj�� l�M���*�udr��Jq������m�,�A�)��[\3Uϸ�r�d�Z��.KIG0���5�7j���C8��UmCO�H?�jb�ݷ,S�J�AƄ�<V��*�M������0�+(��C"��D��-�zjm��YP�=j4�q�Mf�Q$���ΰ���<��h���"��=�ǻ�nV�0x$R���'��9a�LV̂GN=��g��39Y�@�XV�G��)���c�+u�H����UG�8{�:�ri_D.�Ywn�����uV��1=������~���Ƹ͵�ۭ�]H�+� �XR�(r�J���#f*h9�ف"�Iom\���Qj`.N|'�c�[�+�π9a�F=}V�i;�ha:5A�x�����e�h��-6�ˍ�$�(zb��J�a,X�#���H(�������rE���_C 3�p�}N�q#��4tV��k\58�{���6���$h��Z�T,,a��q�DtӆG4p���,jd2#�1́-�6�1HƒG����`��/x�6�:�"�>�P����� �4�g�87�8�ݾ�j�dV�^Z��v�"��p!`��A���4T���\
�Aȏ,h��62�["�^�kѶTjo���p���{�2�2i�1\��.ª9]�Q���I:���n͚��l�컥�n���, r�p��$e��ǟw�Ѣ�i�&�m���2  H�x�E�8i��*5G�<���+�5\�[� bE�Jiq�O,V��> ��۫��.��1Վ���Kiƙ�r�{��#�4����e�z3��v0L?ʴ��*A��H�"��\�O�