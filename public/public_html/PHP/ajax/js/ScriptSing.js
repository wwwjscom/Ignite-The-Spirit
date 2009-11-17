/******************************************************************************
ScriptSing Core
A library to automate many AJAX, DHTML, and other tasks
Copyright (C) <2007>  <Jeremy Nicoll>

This library is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
version 2.1 of the License, or (at your option) any later version.

This library is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public
License along with this library; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA

Please see lgpl.txt for a copy of the license - this notice and the file
lgpl.txt must accompany this code.

Please go to forums.SeeMySites.net for questions and support of this library.
Go to www.ScriptSing.com for code updates.
*******************************************************************************/

var ScriptSingVar = 'ss';

// Inheritence / mixin capabilities for JavaScript
Object.prototype.mixin = function (obj) {
    var v;
    for (v in obj) {
        if (obj[v] == Function.prototype.mixin) {continue;}
        this.prototype[v] = obj[v];
    }
};

Number.mixin ({
    to_hex : function() {return this.toString(16);},
    to_bin : function() {return this.toString(2);},
    to_oct : function() {return this.toString(8);},
    to_dec : function() {return this.toString(10);},
    to_int : function() {return parseInt(this, 10).toString(10);}
});

String.mixin ({
    from_hex : function() {return parseInt(this, 16);},
    from_bin : function() {return parseInt(this, 2);},
    from_oct : function() {return parseInt(this, 8);},
    from_int : function() {return parseInt(this, 10);},
    from_dec : function () {return parseFloat(this, 10);},

    trim : function() {
        return this.replace(/(^\s+)|(\s+$)/, '');
    },

    rtrim : function() {
        return this.replace(/^\s+/, '');
    },

    ltrim : function() {
        return this.replace(/\s+$/, '');
    },

    pad : function(padder, length, left_right) {
        left_right = left_right || 0;
        var counter = length - this.length;
        var str = this;
        for (var i=0; i < counter; i++) {
            if (!left_right) {
                str = padder + str;
            } else {
                str += padder;
            }
        }
        return str;
    },

    to_rgb : function () {
        var i, t;
        var vals = false;
        if (this.charAt(0) == '#') {
            val = this.substring(1);
            if (val.length == 3) {
                t = '';
                for (i=0; i < 3; i++) {t += val.charAt(i) + val.charAt(i);}
                val = t;
            }
            vals = [];
            for (i=0; i < 6; i += 2) {
             vals[vals.length] = val.substr(i, 2).from_hex();
            }
        } else if (this.match(/^rgb/)) {
            val = this.replace(/[a-zA-Z\(\)\s]/g, '');
            vals = val.split(',');
            for (i = 0; i < vals.length; i++) {
                if (vals[i].match(/\%$/)) {
                    vals[i] = vals[i].replace(/\%/, '');
                    vals[i] = (vals[i] / 100) * 255;
                }
            }
        }
        return vals;
    }
});

Array.mixin ( {
    in_array : function (val, strict) {
        var found = false, i;
        if (strict) {
            for (i=0; i < this.length; i++) {
                if (this[i] === val) {
                    found = true;
                    break;
                }
            }
        } else {
            for (i=0; i < this.length; i++) {
                if (this[i] == val) {
                    found = true;
                    break;
                }
            }
        }
        return found;
    },
    each : function (func, asc_desc) {
        var i, proper = ['asc', 'desc'];
        if (asc_desc) {asc_desc = asc_desc.toLowerCase();}
        if (!asc_desc || !proper.in_array(asc_desc)) { asc_desc = 'asc'; }
        if (asc_desc == 'asc') {
            for (i = 0; i < this.length; i++) {
                func(this[i]);
            }
        } else {
            for (i = this.length-1; i >= 0; i--) {
                func(this[i]);
            }
        }
    }
});


Date.mixin({
    daysInMonth : function(month, year) {
        month = month || this.getMonth();
        year = year || this.getFullYear();
        return 32 - new Date(year, month, 32).getDate();
    }
});


document.get_body = function() {
    return this.$s('body', 'tagname')[0];
};

window[ScriptSingVar] = {
    name : 'ScriptSing',
    version : '1.0',
    init : function() {
        var self = this;
        this.add_listener(window, 'load', function() {
            self.add_listener(document.body, 'mousemove', function(e) {
                if (!e) {e = window.event;}
                self.cursor.update.call(self.cursor, e);
            });
        });
        window.$s = document.$s = this.$s;
    },
    _ : function(type) {
        var ele = document.createElement(type);
        this.add_all_extensions(ele);
        return ele;
    },
    _txt : function(txt) {return document.createTextNode(txt);},

    // Searches for elements based on attributes of the elements.
    /* Used like this:
        document.$s('some_id') // For searching by ID only

        // This will search for all elements that are a child of some_element that
        // are paragraphs, with the class name of green (elements can have mulitple classes),
        // and has the border attribute set to "0".
        // You can have an unlimited number of search parameters.
        // Since a document can only have on ID,
        some_element.$s('p', 'tagname', 'green', 'class', 'border', '0');
    */

    $s : function () {
        var i, i2, t_objs, objs, t_class, p_obj;
        p_obj = this.getElementsByTagName instanceof Function ? this : document;
        if (arguments.length === 0 || (arguments.length > 2 && arguments.length % 2 !== 0)) {
            throw('Invalid number of arguments passed to $');
        } else if (arguments.length == 1 || arguments[1].toLowerCase() == 'id') {
            return p_obj.getElemetById ? p_obj.getElementById(arguments[0]) : document.getElementById(arguments[0]);
        }

        // Get the initial set of objects
        var arg_1 = arguments[1].toLowerCase();
        switch (arg_1) {
            case 'class':
                t_objs = p_obj.getElementsByTagName('*');
                objs = []; // To be filled below on matching criteria
                for (i=0; i < t_objs.length; i++) {
                    t_class = t_objs[i].className.split(' ');
                    for (i2=0; i2 < t_class.length; i2++) {
                        if (t_class[i2].toLowerCase() == arguments[0].toLowerCase()) {
                            objs[objs.length] = t_objs[i];
                        }
                    }
                }
                break;
            case 'tagname':
                objs = p_obj.getElementsByTagName(arguments[0]);
                break;
            default:
                t_objs = p_obj.getElementsByTagName('*');
                objs = [];
                for (i=0; i < t_objs.length; i++) {
                    if (t_objs[i][arg_1] && t_objs[i][arg_1] == arguments[0]) {objs[objs.length] = t_objs[i];}
                }
                break;
        }

        for (i=3; i < arguments.length; i += 2) {
            if (!objs.length) {break;}
            t_objs = [];
            switch (arguments[i]) {
                case 'class':
                    for (i2=0; i2 < objs.length; i2++) {
                        t_class = objs[i2].className.split(' ');
                        for (i3=0; i3 < t_class.length; i3++) {
                            if (t_class[i3].toLowerCase() == arguments[i-1].toLowerCase()) {
                                t_objs[t_objs.length] = objs[i2];
                                break;
                            }
                        }
                    }
                    break;
                case 'tagname':
                    for (i2=0; i2 < objs.length; i2++) {
                        if (objs[i2].tagName.toLowerCase() == arguments[i-1].toLowerCase()) {
                            t_objs[t_objs.length] = objs[i2];
                        }
                    }
                    break;
                default:
                    for (i2=0; i2 < objs.length; i2++) {
                        if (objs[i2][arguments[i-1]] !== undefined && objs[i2][arguments[i-1]].toLowerCase() == arguments[i-1].toLowerCase()) {
                            t_objs[t_objs.length] = objs[i2];
                        }
                    }
                    break;
            }
            objs = t_objs;
        }
        window[ScriptSingVar].add_all_extensions(objs[i]);
        return objs;
    },

    // designed to extend HTML and other elements (since Safari does not support the Element extension yet)
    extend : function (ele, obj) {
        if (ele instanceof String) {ele = this.$s(ele);}
        if (obj) {for (v in obj) {ele[v] = obj[v];}}
        else {this.add_all_extensions(ele);}
    },

    add_all_extensions : function (ele) {
        if (!ele) {return false;}
        if (ele instanceof Array) {
            for (var i=0; i < ele.length; i++) {
                if (ele[i].$s instanceof Function) {continue;}
                this.extend(ele[i], this.vis.extensions);
                this.extend(ele[i], {$s : this.$s});
            }
        } else {
            if (ele.$s instanceof Function) {return true};
            this.extend(ele, this.vis.extensions);
            this.extend(ele, {$s : this.$s});
        }
        return true;
    },

    // Random functions
    rand : function (low_num, high_num) {
        var t;
        if (high_num === undefined) {
		high_num = low_num;
		low_num = 0;
        } else if (low_num > high_num) {
            t = high_num;
            high_num = low_num;
            low_num = t;
        }
        return Math.random() * (high_num - low_num) + low_num;
    },

    rand_char : function() {
        var chars = "0123456789abcdefghijklmnopqurstuvwxyzABCDEFGHIJKLMNOPQURSTUVWXYZ";
        return chars.substr( this.rand(62), 1 );
    },

    rand_id : function(size) {
        var str = "";
        for(var i = 0; i < size; i++) {str += this.rand_char();}
        return str;
    },
    // Get browser's XMLHttpRequest object
    get_http_request : function () {
        http_request = false;
        if (window.XMLHttpRequest) { // Mozilla, Safari, IE7...
           http_request = new XMLHttpRequest();
        } else if (window.ActiveXObject) { // older IE
           try {
              http_request = new ActiveXObject("Msxml2.XMLHTTP");
           } catch (e) {
              try {
                 http_request = new ActiveXObject("Microsoft.XMLHTTP");
              } catch (e) {}
           }
        }
       return http_request;
    },

    // XML functions
    obj_to_xml : function (obj, doc_name) {
        var t, str = '', v, tag_name, arr = false, cdata;
        if (doc_name) {str = '<'+doc_name+'>';}
        for (v in obj) {
            t = typeof(obj[v]);
            if (parseInt(v, 10) >= 0) {arr = true;}
            if (arr) {
                tag_name = obj_to_xml_parent;
                str += '<'+tag_name+'>';
            } else {
                tag_name = v;
            }
            switch(t) {
                case 'object':
                    obj_to_xml_parent = v;
                    str += arguments.callee(obj[v]);
                break;
                case 'number':
                case 'string':
                    cdata = obj[v].match(/<|\&/);
                    if (!arr) {str += '<'+tag_name+'>';}
                    if (cdata) {str += '<![CDATA[';}
                    str += obj[v];
                    if (cdata) {str += ']]>';}
                    if (!arr) {str += '</'+tag_name+'>';}
                break;
            }
            if (arr) {
                str += '</'+tag_name+'>';
            }
        }
        if (doc_name) {str += '</'+doc_name+'>';}
        return str;
    },
    xmldoc_strip_ws : function(ele) {
        var remove_child, i;
        if (ele.childNodes) {
            remove_child = [];
            for (i=0; i < ele.childNodes.length; i++) {
                if (ele.childNodes[i].tagName) {
                    arguments.callee(ele.childNodes[i]);
                } else if (ele.childNodes[i].nodeType == 3 && /^\s+$/.test(ele.childNodes[i].data)) {
                    remove_child[remove_child.length] = i;
                }
            }
            for (i=0; i < remove_child.length; i++) {
                ele.removeChild(ele.childNodes[i]);
            }
        }
    },

    // JSON converters
    json_encode : function(v) {
	var a = [];
	function e(s) { a[a.length] = s; }
	function g(x) {
            var c, i, l, v;
            switch (typeof x) {
                case 'object':
                    if (x) {
                        if (x instanceof Array) {
                            e('[');
                            l = a.length;
                            for (i = 0; i < x.length; i += 1) {
                                v = x[i];
                                if (typeof v != 'undefined' && typeof v != 'function') {
                                    if (l < a.length) { e(','); }
                                g(v); }
                            }
                            e(']');
                            return;
                        } else if (typeof x.toString != 'undefined') {
                            e('{');
                            l = a.length;
                            for (i in x) {
                                v = x[i];
                                if (x.hasOwnProperty(i) && typeof v != 'undefined' && typeof v != 'function') {
                                    if (l < a.length) { e(','); }
                                    g(i);
                                    e(':');
                                    g(v);
                                }
                            }
                            return e('}');
                        }
                    }
                    e('null');
                    return;
                case 'number':
                    e(isFinite(x) ? +x : 'null');
                    return;
                case 'string':
                    l = x.length; e('"');
                    for (i = 0; i < l; i += 1) {
                        c = x.charAt(i);
                        if (c >= ' ') {
                            if (c == '\\' || c == '"') { e('\\'); }
                            e(c);
                        } else {
                            switch (c) {
                                case '\b':
                                    e('\\b');
                                    break;
                                case '\f':
                                    e('\\f');
                                    break;
                                case '\n':
                                    e('\\n');
                                    break;
                                case '\r':
                                    e('\\r');
                                    break;
                                case '\t':
                                    e('\\t');
                                    break;
                                default:
                                    c = c.charCodeAt();
                                    e('\\u00' + Math.floor(c / 16).toString(16) + (c % 16).toString(16));
                            }
                        }
                    }
                        e('"');
                        return;
                case 'boolean':
                    e(String(x));
                    return;
                default:
                    e('null');
                    return;
            }
        }
        g(v);
        return a.join('');
    },
    json_decode : function (text) {
        var p = /^\s*(([,:{}\[\]])|"(\\.|[^\x00-\x1f"\\])*"|-?\d+(\.\d*)?([eE][+-]?\d+)?|true|false|null)\s*/, token, operator;

        function error(m, t) {
            throw {
                name: 'JSONError',
                message: m,
                text: t || operator || token
            };
        }

        function next(b) {
            var t;
            if (b && b != operator) {
                error("Expected '" + b + "'");
            }
            if (text) {
                t = p.exec(text);
                if (t) {
                    if (t[2]) {
                        token = null;
                        operator = t[2];
                    } else {
                        operator = null;
                        try {
                                token = eval(t[1]);
                        } catch (e) {
                                error("Bad token", t[1]);
                        }
                    }
                    text = text.substring(t[0].length);
                } else {
                    error("Unrecognized token", text);
                }
            } else {
                token = operator = undefined;
            }
        }

        function val() {
            var k, o;
            switch (operator) {
            case '{':
                next('{');
                o = {};
                if (operator != '}') {
                    for (;;) {
                        if (operator || typeof token != 'string') { error("Missing key");  }
                        k = token;
                        next();
                        next(':');
                        o[k] = val();
                        if (operator != ',') { break; }
                        next(',');
                    }
                }
                next('}');
                return o;
            case '[':
                next('[');
                o = [];
                if (operator != ']') {
                    for (;;) {
                        o.push(val());
                        if (operator != ',') { break; }
                        next(',');
                    }
                }
                next(']');
                return o;
            default:
                if (operator !== null) {
                    error("Missing value");
                }
                k = token;
                next();
                return k;
            }
        }
        next();
        return val();
    },

    css_to_js  : function (val) {
        // Processes a CSS style name and changes it into its JavaScript equivelant.
        // TODO: Check for non-standard browser namings (such as cssFloat, etc).
        switch(val.toLowerCase()) {
            case 'float':
                if (BrowserDetect.browser == 'MSIE' || BrowserDetect.browser == 'Explorer') {val = 'style-float';}
                else {val = 'css-float';}
                break;
        }
        var w = val.match(/\w[^\-]+/g);
        val = w[0];
        for (var i=1; i < w.length; i++) {
            val += w[i].charAt(0).toUpperCase() + w[i].substring(1);
        }
        return val;
    },

    js_loader : function (file_name, func) {
        var script = this._("script");
        script.lang = "javascript";
        script.type = "text/javascript";
        var sender = new SendReceive('get', 'raw');
        sender.receiver = function(str) {
            //The duplication is to ensure that this works on as many browsers as possible.
            script.innerText = str;
            script.innerHTML = str;
            script.text = str;
            window[ScriptSingVar].$s('head', 'tagname')[0].appendChild(script);
            if (func) {func();}
        };
        sender.send_request(file_name, {});
    },

    // Color conversion
    rgb_to_hsv : function (red, green, blue) {
        var min, max, delta, hue, sat, bright;
        if (arguments.length == 1 && arguments[0] instanceof Array)  {
            red = arguments[0][0];
            green = arguments[0][1];
            blue = arguments[0][2];
        } else if(arguments.length == 3) {
            red = arguments[0];
            green = arguments[1];
            blue = arguments[2];
        } else {
            throw 'Invalid arguments passed to rgb_to_hsv';
        }

        red /= 255;
        green /= 255;
        blue /= 255;

        min = Math.min( red, green, blue );
        max = Math.max( red, green, blue );
        bright = max;

        delta = max - min;

        if( max !== 0 ) {sat = delta / max;}
        else {
            sat = 0;
            hue = -1;
            return [hue, sat, bright];
        }

        if (delta > 0) {
            if( red == max ) { hue = ( green - blue ) / delta; }		// between yellow & magenta
            else if( green == max ) {hue = 2 + ( blue - red ) / delta;}	// between cyan & yellow
            else {hue = 4 + ( red - green ) / delta; }	// between magenta & cyan
        } else {
            hue = 0;
        }
        hue *= 60;				// degrees
        if( hue < 0 ) {hue += 360;}
        return [hue, sat, bright];
    },

    hsv_to_rgb : function (hue, sat, bright) {
        var red, green, blue, i, f, p, q, t;
        if (arguments.length == 1 && arguments[0] instanceof Array)  {
            hue = arguments[0][0];
            sat = arguments[0][1];
            bright = arguments[0][2];
        } else if(arguments.length == 3) {
            hue = arguments[0];
            sat = arguments[1];
            bright = arguments[2];
        } else {
            throw 'Invalid arguments passed to hsv_to_rgb';
        }
        if( sat == 0 ) {
            // achromatic (grey)
            red = green = blue = bright;
            return [red, green, blue];
        }

        hue /= 60;			// sector 0 to 5
        i = Math.floor( hue );
        f = hue - i;			// factorial part of h
        p = bright * ( 1 - sat );
        q = bright * ( 1 - sat * f );
        t = bright * ( 1 - sat * ( 1 - f ) );

        switch( i ) {
            case 0:
                red = bright;
                green = t;
                blue = p;
                break;
            case 1:
                red = q;
                green = bright;
                blue = p;
                break;
            case 2:
                red = p;
                green = bright;
                blue = t;
                break;
            case 3:
                red = p;
                green = q;
                blue = bright;
                break;
            case 4:
                red = t;
                green = p;
                blue = bright;
                break;
            default:
                red = bright;
                green = p;
                blue = q;
                break;
        }
        red *= 255;
        green *= 255;
        blue *=255;
        return [red, green, blue];
    },

    cursor : {
        //An object that keeps track of where the cursor is on the screen.
        x : 0,
        y : 0,

        update : function (e) {
            var body;
            var ss = window[ScriptSingVar];
            if (e.pageX || e.pageY) {
							this.x = e.pageX;
							this.y = e.pageY;
            }   else if (e.clientX || e.clientY) {
							 body = document.get_body();
							 this.x = e.clientX + body.scrollLeft;
							 this.y = e.clientY + body.scrollTop;
            }
        },

        get_pos: function () {
            return [this.x, this.y];
        },

        is_in : function (obj) {
            var ss = window[ScriptSingVar];

            if (!(obj instanceof Array)) {
                if (!obj.get_pos || typeof(obj.get_pos) != 'function') {
                    ss.extend(obj, ss.vis.extensions);
                }
                var coords1 = obj.get_pos();
                var coords2 = {x : coords1.x + obj.offsetWidth, y: coords1.y + obj.offsetHeight};
                obj = [ [ coords1.x, coords1.y ], [ coords2.x, coords2.y ] ];
            }

            if (obj instanceof Array) {
                if (this.x > obj[0][0] && this.x < obj[1][0] && this.y > obj[0][1] && this.y < obj[1][1]) {
                    return true;
                }
            }
            return false;
        }
    },

    add_listener : function (obj, type, handler) {
        if (obj.attachEvent !== undefined) {
          obj.attachEvent("on" + type, handler);
        } else {
          obj.addEventListener(type, handler, false);
        }
    },

    remove_listener : function  (obj, type, handler) {
      if (obj.attachEvent !== undefined) {
        obj.detachEvent("on" + type, handler);
      } else {
        obj.removeEventListener(type, handler, false);
      }
    },

    get_target : function(e) {
        return e.target || e.srcElement;
    }
};

// -------- send_receive --------
//  Using get_http_request, this action makes a call to a remote page with data appropriately formatted for the send_type, and then processes the response according to the receive_type.
//  (c) 2007 Jeremy Nicoll LGPL terms.

SendReceive = function (send_type, receive_type) {
	this.remote = false;
	this.set_send_type(send_type);
	this.set_receive_type(receive_type);
};

SendReceive.prototype = {
    // --------- Send / Get Post Request ---------
    // Sends a Post Request via a variety of methods.
    set_send_type : function(send_type) {
        this.p_raw = false;
        var found = true;
        if (send_type.substring(-3) == 'raw') {
            this.p_raw = true;
            if (send_type.length > 3) {send_type = send_type.substring(0, send_type.length - 3);}
        }
        switch (send_type) {
            case 'raw':
                this.p_mime_type = 'text/plain';
            break;
            case 'post':
                this.p_mime_type = 'application/x-www-form-urlencoded';
            break;
            case 'get':
                // do nothing
            break;

            case 'json':
                this.p_mime_type = 'text/json';
            break;

            case 'xml':
                this.p_mime_type = 'text/xml';
            break;
            default:
                found = false;
            break;
        }
        if (found) {this.post_type = send_type;}
        return found;
    },
    set_receive_type : function(receive_type) {
        this.to_array = false;
        found = true;

        this.r_raw = false;
        var found = true;
        if (receive_type.substring(-4) == '_raw') {
            this.r_raw = true;
            if (receive_type.length > 4) {receive_type = receive_type.substring(0, receive_type.length - 4);}
        }

        switch (receive_type) {
            case 'urlencode':
                this.r_mime_type = 'application/x-www-form-urlencoded';
            break;
            case 'raw':
                this.r_raw = true;
                this.r_mime_type = 'text/plain';
            break;
            case 'json':
                this.r_mime_type = 'text/json';
            break;
            // xml_array is currently unused.
            case 'xml_array':
                this.to_array = true;
                receive_type = 'xml';
            case 'xml':
                this.r_mime_type = 'text/xml,application/xml';
            break;
            default:
                found = false;
            break;
        }
        if (found) {this.receive_type = receive_type;}
        return found;
    },

    abort : function () {
        if (this.remote) {this.remote.abort();}
    },

    send_request : function (url, request, quiet) {
        var final_request, arr = false, v;
        if (typeof(this.receiver) != 'function' && this.async !== false) {
            alert('Function not supplied for callback.');
            return false;
        }
        if (quiet === null || quiet === undefined) {this.quiet = false;}

        if (this.raw) {
            final_request = request;
        } else {
            switch (this.post_type) {
                case 'json':
                    final_request = window[ScriptSingVar].json_encode(request);
                break;
                case 'get':
                case 'urlencode':
                case 'post':
                    switch (typeof(request)) {
                        case 'array':
                            final_request = request.join('&');
                            break;
                        case 'object':
                            final_request = '';
                            var first = true;
                            for (v in request) {
                                if (first) {first = false;} else {final_request += '&';}
                                final_request += v+'='+escape(request[v]);
                            }
                        break;
                        default:
                            if (this.post_type != 'get') {
                                this.err_msg = 'Invalid type sent: ' + typeof(request);
                                return false;
                            }
                        break;
                    }
                break;
            }
        }

        this.remote = new window[ScriptSingVar].get_http_request();
        if (this.async == false) {dont_wait = false;}
        else {dont_wait = true;}
        var self = this;
        if (dont_wait) {
            this.remote.onreadystatechange = function () {
                self.get_request(self);
            };
        }
        if (this.post_type != 'get') {
            this.remote.open('POST', url, dont_wait);
            this.remote.setRequestHeader("Content-type", this.p_mime_type);
            this.remote.setRequestHeader("Content-length", final_request.length);
            this.remote.setRequestHeader("Connection", "close");
            this.remote.setRequestHeader("Accept", this.r_mime_type);
            this.remote.send(final_request);
        } else {
            var append_url = final_request ? '?' + final_request : '';
            this.remote.open('GET', url + append_url, dont_wait);
            this.remote.send('');
        }
        return this.get_request(this, !dont_wait);
    },

    get_request : function (obj, sync) {
        if (!sync) {
            if (obj.remote.readyState == 4) {
                if (obj.remote.status == 200) {
                    if (obj.r_raw || obj.receive_type == 'text') {
                        obj.response = obj.remote.responseText;
                    } else {
                        switch (obj.receive_type) {
                            case 'json':
                                obj.response = eval('(' + obj.remote.responseText.trim() + ')');
                                // If you need a safer version, uncomment the following line:
                                // obj.response = window[ScriptSingVar].json_decode(obj.remote.responseText.trim());
                                break;
                            case 'urlencode':
                                var response_t = obj.remote.responseText.trim();
                                var response = {}
                                var r = response_t.split('&'), r2;
                                for (var i=0; i < r.length; i++) {
                                    r2 = r[i].split('=');
                                    response[unescape(r2[0])] = unescape(r2[1]);
                                }
                                obj.response = response;
                                break;

                            case 'xml':
                                obj.response = obj.remote.responseXML.documentElement;
                                window[ScriptSingVar].xmldoc_strip_ws(obj.response);
                                break;
                        }
                    }
                    obj.receiver(obj.response);
                } else {
                    if (!obj.quiet) {alert('There was a problem with the request. Error code: ' + obj.remote.status);}
                    else {
                        obj.receiver({status : 'remote', error_msg : remote.status});
                    }
                }
            }
        } else {
            switch (obj.receive_type) {
                case 'json':
                    obj.response = window[ScriptSingVar].json_decode(obj.remote.responseText);
                    break;
                default:
                    obj.response = obj.remote.responseText;
                    break;
                case 'text/xml':
                    obj.response = obj.remote.responseXML.documentElement;
                    window[ScriptSingVar].xmldoc_strip_ws(obj.response);
                    break;
            }
            if (obj.receiver && typeof(obj.receiver) == 'function') {
                obj.receiver(obj.response);
            }
        }
        return true;
    }

};

RepeatRequest = function(page, request, interval) {
	this.page = page || '';
	this.request = request || false;
	this.send_method = 'json';
	this.receive_method = 'json';
	this.success_function = false;
	this.fail_function = false;
	this.stopOnFail = true;
	this.interval = interval || 3000;
	this.timer_var = false;
    this.receiver = this.receive;
};

RepeatRequest.prototype = {
    start : function() {
		if (this.check_vals() && this.set_send_type(this.send_method) && this.set_receive_type(this.receive_method)) {
			this.start_requests();
			return true;
		} else {
			return false;
		}
    },

    send_request : SendReceive.prototype.send_request,
    get_request : SendReceive.prototype.get_request,
    set_send_type : SendReceive.prototype.set_send_type,
    set_receive_type : SendReceive.prototype.set_receive_type,
    abort : SendReceive.prototype.abort,

    check_vals : function() {
        if (this.page !== '' && parseInt(this.interval) > 0 && typeof(this.interval) == 'number' && typeof(this.fail_function) == 'function' && typeof(this.success_function) == 'function' && typeof(this.request) == 'object') {
            return true;
        } else {
            return false;
        }
    },
    start_requests : function() {
        if (!this.check_vals()) {return false;}
        var ref = this;
        this.timer_var = setInterval(function(){ref.start_ref();}, this.interval);
        return true;
    },

    start_ref : function () {
        this.send_request(this.page, this.request, this.receive, true);
    },

    receive : function(getBack) {
        if (!getBack) {
            this.stop();
            alert('No response sent back to receive function.');
        } else if (getBack.status == 'error') {
            if (this.stopOnFail) {this.stop();}
            this.fail_function(getBack);
        } else if (getBack.status == 'remote') {
            this.stop();
            alert('There was a problem with the request. Error code: ' + getBack.error_msg);
        } else {
            this.success_function(getBack);
        }
    },
    stop : function() {
        this.abort();
        clearInterval(this.timer_var);
    }
};

var BrowserDetect = {
	init: function () {
		this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
		this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || "an unknown version";
		this.OS = this.searchString(this.dataOS) || "an unknown OS";
	},
	searchString: function (data) {
		for (var i=0;i<data.length;i++)	{
			var dataString = data[i].string;
			var dataProp = data[i].prop;
			this.versionSearchString = data[i].versionSearch || data[i].identity;
			if (dataString) {
                            if (dataString.indexOf(data[i].subString) != -1) {
                                return data[i].identity;
                            }
			}
			else if (dataProp) {
			    return data[i].identity;
                        }
		}
                return '';
	},
	searchVersion: function (dataString) {
		var index = dataString.indexOf(this.versionSearchString);
		if (index == -1) {return '';}
		return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
	},
	dataBrowser: [
		{ 	string: navigator.userAgent,
			subString: "OmniWeb",
			versionSearch: "OmniWeb/",
			identity: "OmniWeb"
		},
		{
			string: navigator.vendor,
			subString: "Apple",
			identity: "Safari"
		},
		{
			prop: window.opera,
			identity: "Opera"
		},
		{
			string: navigator.vendor,
			subString: "iCab",
			identity: "iCab"
		},
		{
			string: navigator.vendor,
			subString: "KDE",
			identity: "Konqueror"
		},
		{
			string: navigator.userAgent,
			subString: "Firefox",
			identity: "Firefox"
		},
		{
			string: navigator.vendor,
			subString: "Camino",
			identity: "Camino"
		},
		{		// for newer Netscapes (6+)
			string: navigator.userAgent,
			subString: "Netscape",
			identity: "Netscape"
		},
		{
			string: navigator.userAgent,
			subString: "MSIE",
			identity: "Explorer",
			versionSearch: "MSIE"
		},
		{
			string: navigator.userAgent,
			subString: "Gecko",
			identity: "Mozilla",
			versionSearch: "rv"
		},
		{ 		// for older Netscapes (4-)
			string: navigator.userAgent,
			subString: "Mozilla",
			identity: "Netscape",
			versionSearch: "Mozilla"
		}
	],
	dataOS : [
		{
			string: navigator.platform,
			subString: "Win",
			identity: "Windows"
		},
		{
			string: navigator.platform,
			subString: "Mac",
			identity: "Mac"
		},
		{
			string: navigator.platform,
			subString: "Linux",
			identity: "Linux"
		}
	]

};
BrowserDetect.init();

window[ScriptSingVar].vis = {
    extensions : {
        get_pos : function () {
            var obj = this, curleft, curtop;
            curleft = curtop = 0;
            if (obj.offsetParent) {
                    curleft = obj.offsetLeft;
                    curtop = obj.offsetTop;
                    while (obj = obj.offsetParent) {
                            curleft += obj.offsetLeft;
                            curtop += obj.offsetTop;
                    }
            }
            return {'x' : curleft, 'y' : curtop};
        },
        set_opacity : function (val) {
            if (this.filters) {
                val *= 100;
                try {
                    this.filters.item("DXImageTransform.Microsoft.Alpha").opacity = val;
                } catch (e) {
                    this.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity='+val+')';
                }
            } else {
                this.style.opacity = val;
            }
        },

        get_opacity : function () {
            if (this.filters) {
                if (this.filters.item("DXImageTransform.Microsoft.Alpha") && div.filters.item("DXImageTransform.Microsoft.Alpha").opacity) {
                    return this.filters.item("DXImageTransform.Microsoft.Alpha").opacity / 100;
                } else {
                    return 1;
                }
            } else {
                var opacity = this.get_style('opacity');
                if (opacity !== undefined) {return opacity;}
                else {return 1;}
            }
        },

        get_style : function (prop) {
            var y;
            if (this.currentStyle) {
                prop = window[ScriptSingVar].css_to_js(prop);
                y = this.currentStyle[prop];
            } else if (window.getComputedStyle) {
                y = document.defaultView.getComputedStyle(this,null).getPropertyValue(prop);
            }
            return y;
        },

        set_style : function (prop, value) {
            this.style[window[ScriptSingVar].css_to_js(prop)] = value;
        },

        is_trans : function (trans) {
            if (trans === null) {return true;}
            return trans instanceof window[ScriptSingVar].vis.Trans;
        },

        set_trans : function (trans) {
            var i, i2, all_trans = true;
            if (trans instanceof Array) {
                for (i=0; i < trans.length; i++) {
                    if (trans[i] instanceof Array)  {
                        for (i2=0; i2 < trans[i].length; i2++) {
                            if (!is_trans(trans[i][i2])) {
                                all_trans = false;
                                break;
                            }
                        }
                    } else if (!is_trans(trans)) {
                        all_trans = false;
                        break;
                    }
                }
            } else if (!this.is_trans(trans)) {
                all_trans = false;
            }
            if (all_trans) {
                this._transitions = trans;
            }
            return all_trans;
        },

        _attr : ['width', 'height', 'foreground', 'background', 'opacity', 'top', 'bottom', 'left', 'right'],
        _transitions : null,
        _trans_timers : [],
        start_trans : function () {
            if (!this._transitions) {return false;}
            trans = this._transitions;
            var level = 0;
            var i, real_trans = [];
            if (trans instanceof Array) {
                for (i=0; i < trans; i++) {
                    if (trans[i] instanceof Array) {
                        this._perform_trans(trans, level);
                        level++;
                    } else {
                        real_trans[real_trans.length] = trans;
                    }
                }
                if (real_trans.length) {this._perform_trans(trans, level);}
            } else {
                this._perform_trans([trans], level);
            }
            return true;
        },


        _perform_trans : function (trans, level) {
            var self = this, step = 0, t_counter = 0, step_trans = false, num_steps, cur_trans;
            function loop_through() {
                var init_trans, i;
                if (!step_trans) {
                    // Get current state
                    init_trans = new window[ScriptSingVar].vis.Trans(0, 0, self);
                    cur_trans = trans[t_counter];
                    step_trans = new window[ScriptSingVar].vis.Trans(0, 0);
                    num_steps = Math.floor(cur_trans.tlength / cur_trans.interval);
                    if (num_steps < 1) {num_steps = 1;}

                    self._attr.each(function(val) {
                        var step_val;
                        if (cur_trans[val] === false) {return;}
                        switch(val) {
                            case 'left':
                            case 'right':
                            case 'top':
                            case 'bottom':
                            case 'width':
                            case 'height':
                            case 'opacity':
                                cur_trans[val] += '';
                                if (cur_trans[val].match(/^\+/)) {
                                    cur_trans[val] += parseFloat(init_trans[val].substring(1));
                                } else if (cur_trans[val].match(/^\-/)) {
                                    cur_trans[val] -= parseFloat(init_trans[val].substring(1));
                                } else {
                                    cur_trans[val] = parseFloat(cur_trans[val]);
                                }
                                step_trans[val] = (cur_trans[val] - init_trans[val]) / num_steps;
                                break;
                            case 'background':
                            case 'foreground':
                                var add_vals = false;
                                if (cur_trans[val].match(/^\+/)) {
                                    add_vals = init_trans[val].substring(1).to_rgb();
                                    for (i; i < 3; i++) {
                                        cur_trans[val][i] += add_vals[i];
                                        if (cur_trans[val][i] > 255) {cur_trans[val][i] = 255;}
                                    }
                                } else if (cur_trans[val].match(/^\-/)) {
                                    add_vals = init_trans[val].substring(1).to_rgb();
                                    for (var i; i < 3; i++) {
                                        cur_trans[val][i] -= add_vals[i];
                                        if (cur_trans[val][i] < 0) {cur_trans[val][i] = 0;}
                                    }
                                }
                                if (!(cur_trans[val] instanceof Array)) {
                                    cur_trans[val] = cur_trans[val].to_rgb();
                                }
                                for (i = 0; i < 3; i++) {
                                    step_trans[val][i] = (cur_trans[val][i] - init_trans[val][i]) / num_steps;
                                }
                                break;
                        }
                    });
                }  //end if for step_trans
                if (!init_trans) {
                    init_trans = new window[ScriptSingVar].vis.Trans(0, 0, self);
                }
                // Apply the transition step
                self._attr.each(function(val) {
                    var style, attr, func, style_val, i;
                    style = attr = func = false;
                    if (step_trans[val] === false) {return;}
                    switch(val) {
                        case 'left':
                        //case 'right':
                        case 'top':
                        //case 'bottom':
                        case 'width':
                        case 'height':
                            style = val;
                            style_val = (init_trans[val] + step_trans[val]) + 'px';
                            break;
                        case 'background':
                        case 'foreground':
                            style_val = [];
                            for (i=0; i < 3; i++) {
                                style_val[i] = init_trans[val][i] + step_trans[val][i];
                            }
                            if (val == 'background') {style = 'background-color';}
                            else {style = 'color';}
                            break;
                        case 'opacity':
                            func = 'set_opacity';
                            style_val = (init_trans[val] + step_trans[val]) + 'px';
                            break;
                    }
                    if (style) {self.style[style] = style_val;}
                    else if (func) {self[func](style_val);}
                });
            }
            loop_through();
            this._trans_timers[level] = setInterval(loop_through,  cur_trans.interval );
        },
        stop_trans : function () {
            this._trans_counters = [];
        }
    },

    Trans : function(length, interval, ele) {
        this._attr = window[ScriptSingVar].vis.extensions._attr;
        this.interval = parseInt(interval, 10) || 50;
        this.tlength = parseInt(length, 10) || 50;

        var self = this;
        for (var i=0; i < this._attr.length; i++) {
            this[this._attr[i]] = false;
        }
        if (ele) {
            ele._attr.each(function(val) {
                var style, attr, func;
                style = attr = func = false;
                switch(val) {
                    case 'left':
                    case 'right':
                    case 'top':
                    case 'bottom':
                    case 'width':
                    case 'height':
                        attr = 'offset' + val[0].toUpperCase() + val.substring(1);
                        break;
                    case 'background':
                        style = 'background-color';
                        break;
                    case 'foreground':
                        style = 'color';
                        break;
                    case 'opacity':
                        func = 'get_opacity';
                        break;
                }
                if (attr) {self[val] = ele[attr];}
                else if (style) {self[val] =  ele.get_style(style).to_rgb();}
                else if (func) {self[val] = ele[func]();}
            });
        }
    },

    color_spinner : function(ele) {
        this.ele = ele;
        this.timer = 300;
        this.col_tracker = 0;
        this.col_tracker_inc = 0;
        this.col_tracker2 = 0;
        this.col_tracker2_inc = 0;
        this.col_trakcer3 = 0;
        this.col_tracker3_inc = 0;
        this.interval_timer = false;
    }
};



window[ScriptSingVar].vis.color_spinner.prototype = {
    set_rgb : function(r, g, b) {
        if (r > 255 || r < 0 ||  g > 255 || g < 0 || b > 255 || b < 0) {return false;}
        this.col_tracker = (r / 255) - 0.5;
        this.col_tracker2 = (g / 255) - 0.5;
        this.col_tracker3 = (b / 255) - 0.5;
        return true;
    },

    get_rgb : function () {
        var c1, c2, c3;
        c1 = Math.round(Math.sin(Math.PI * this.col_tracker)*127+128);
        c2 = Math.round(Math.sin(Math.PI * this.col_tracker2)*127+128);
        c3 = Math.round(Math.sin(Math.PI * this.col_tracker3)*127+128);
        return [c1, c2, c3];
    },

    start_spin : function () {
        var self = this;
        if (!this.col_tracker_inc) {this.col_tracker_inc = window[ScriptSingVar].rand(0.008, 0.015);}
        if (!this.col_tracker2_inc) {this.col_tracker2_inc = window[ScriptSingVar].rand(0.008, 0.015);}
        if (!this.col_tracker3_inc) {this.col_tracker3_inc = window[ScriptSingVar].rand(0.008, 0.015);}

        if (!this.col_tracker) {this.col_tracker = window[ScriptSingVar].rand(-0.5, 0.5);}
        if (!this.col_tracker2) {this.col_tracker2 = window[ScriptSingVar].rand(-0.5, 0.5);}
        if (!this.col_tracker3) {this.col_tracker3 = window[ScriptSingVar].rand(-0.5, 0.5);}

        this.col_spin();
        this.interval_timer = setInterval(function(){self.col_spin.call(self);}, self.timer);
    },

    col_spin : function () {
        var c1, c2, c3;
        if (this.col_tracker < -0.5 || this.col_tracker > 0.5) {this.col_tracker_inc = -this.col_tracker_inc;}
        this.col_tracker += this.col_tracker_inc;
        if (this.col_tracker2 < -0.5 || this.col_tracker2 > 0.5) {this.col_tracker2_inc = -this.col_tracker2_inc;}
        this.col_tracker2 += this.col_tracker2_inc;
        if (this.col_tracker3 < -0.5 || this.col_tracker3 > 0.5) {this.col_tracker3_inc = -this.col_tracker3_inc;}
        this.col_tracker3 += this.col_tracker3_inc;

        c1 = Math.round(Math.sin(Math.PI * this.col_tracker)*127+128);
        c2 = Math.round(Math.sin(Math.PI * this.col_tracker2)*127+128);
        c3 = Math.round(Math.sin(Math.PI * this.col_tracker3)*127+128);
        this.ele.style.background = 'rgb(' + c1 +','+ c2 +','+ c3 +')';
    }
};
window[ScriptSingVar].init();
