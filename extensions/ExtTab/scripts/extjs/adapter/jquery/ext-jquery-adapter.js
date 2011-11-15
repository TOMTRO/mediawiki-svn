/*
 * Ext JS Library 3.0.0
 * Copyright(c) 2006-2009 Ext JS, LLC
 * licensing@extjs.com
 * http://www.extjs.com/license
 */
window.undefined=window.undefined;Ext={version:"3.0"};Ext.apply=function(d,e,b){if(b){Ext.apply(d,b)}if(d&&e&&typeof e=="object"){for(var a in e){d[a]=e[a]}}return d};(function(){var g=0,t=Object.prototype.toString,s=function(e){if(Ext.isArray(e)||e.callee){return true}if(/NodeList|HTMLCollection/.test(t.call(e))){return true}return((e.nextNode||e.item)&&Ext.isNumber(e.length))},u=navigator.userAgent.toLowerCase(),z=function(e){return e.test(u)},i=document,l=i.compatMode=="CSS1Compat",B=z(/opera/),h=z(/chrome/),v=z(/webkit/),y=!h&&z(/safari/),f=y&&z(/applewebkit\/4/),b=y&&z(/version\/3/),C=y&&z(/version\/4/),r=!B&&z(/msie/),p=r&&z(/msie 7/),o=r&&z(/msie 8/),q=r&&!p&&!o,n=!v&&z(/gecko/),d=n&&z(/rv:1\.8/),a=n&&z(/rv:1\.9/),w=r&&!l,A=z(/windows|win32/),k=z(/macintosh|mac os x/),j=z(/adobeair/),m=z(/linux/),c=/^https/i.test(window.location.protocol);if(q){try{i.execCommand("BackgroundImageCache",false,true)}catch(x){}}Ext.apply(Ext,{SSL_SECURE_URL:"javascript:false",isStrict:l,isSecure:c,isReady:false,enableGarbageCollector:true,enableListenerCollection:false,USE_NATIVE_JSON:false,applyIf:function(D,E){if(D){for(var e in E){if(Ext.isEmpty(D[e])){D[e]=E[e]}}}return D},id:function(e,D){return(e=Ext.getDom(e)||{}).id=e.id||(D||"ext-gen")+(++g)},extend:function(){var D=function(F){for(var E in F){this[E]=F[E]}};var e=Object.prototype.constructor;return function(K,H,J){if(Ext.isObject(H)){J=H;H=K;K=J.constructor!=e?J.constructor:function(){H.apply(this,arguments)}}var G=function(){},I,E=H.prototype;G.prototype=E;I=K.prototype=new G();I.constructor=K;K.superclass=E;if(E.constructor==e){E.constructor=H}K.override=function(F){Ext.override(K,F)};I.superclass=I.supr=(function(){return E});I.override=D;Ext.override(K,J);K.extend=function(F){Ext.extend(K,F)};return K}}(),override:function(e,E){if(E){var D=e.prototype;Ext.apply(D,E);if(Ext.isIE&&E.toString!=e.toString){D.toString=E.toString}}},namespace:function(){var D,e;Ext.each(arguments,function(E){e=E.split(".");D=window[e[0]]=window[e[0]]||{};Ext.each(e.slice(1),function(F){D=D[F]=D[F]||{}})});return D},urlEncode:function(I,H){var F,D=[],E,G=encodeURIComponent;for(E in I){F=!Ext.isDefined(I[E]);Ext.each(F?E:I[E],function(J,e){D.push("&",G(E),"=",(J!=E||!F)?G(J):"")})}if(!H){D.shift();H=""}return H+D.join("")},urlDecode:function(E,D){var H={},G=E.split("&"),I=decodeURIComponent,e,F;Ext.each(G,function(J){J=J.split("=");e=I(J[0]);F=I(J[1]);H[e]=D||!H[e]?F:[].concat(H[e]).concat(F)});return H},urlAppend:function(e,D){if(!Ext.isEmpty(D)){return e+(e.indexOf("?")===-1?"?":"&")+D}return e},toArray:function(){return r?function(e,F,D,E){E=[];Ext.each(e,function(G){E.push(G)});return E.slice(F||0,D||E.length)}:function(e,E,D){return Array.prototype.slice.call(e,E||0,D||e.length)}}(),each:function(G,F,E){if(Ext.isEmpty(G,true)){return}if(!s(G)||Ext.isPrimitive(G)){G=[G]}for(var D=0,e=G.length;D<e;D++){if(F.call(E||G[D],G[D],D,G)===false){return D}}},iterate:function(E,D,e){if(s(E)){Ext.each(E,D,e);return}else{if(Ext.isObject(E)){for(var F in E){if(E.hasOwnProperty(F)){if(D.call(e||E,F,E[F])===false){return}}}}}},getDom:function(e){if(!e||!i){return null}return e.dom?e.dom:(Ext.isString(e)?i.getElementById(e):e)},getBody:function(){return Ext.get(i.body||i.documentElement)},removeNode:r?function(){var e;return function(D){if(D&&D.tagName!="BODY"){e=e||i.createElement("div");e.appendChild(D);e.innerHTML=""}}}():function(e){if(e&&e.parentNode&&e.tagName!="BODY"){e.parentNode.removeChild(e)}},isEmpty:function(D,e){return D===null||D===undefined||((Ext.isArray(D)&&!D.length))||(!e?D==="":false)},isArray:function(e){return t.apply(e)==="[object Array]"},isObject:function(e){return e&&typeof e=="object"},isPrimitive:function(e){return Ext.isString(e)||Ext.isNumber(e)||Ext.isBoolean(e)},isFunction:function(e){return t.apply(e)==="[object Function]"},isNumber:function(e){return typeof e==="number"&&isFinite(e)},isString:function(e){return typeof e==="string"},isBoolean:function(e){return typeof e==="boolean"},isDefined:function(e){return typeof e!=="undefined"},isOpera:B,isWebKit:v,isChrome:h,isSafari:y,isSafari3:b,isSafari4:C,isSafari2:f,isIE:r,isIE6:q,isIE7:p,isIE8:o,isGecko:n,isGecko2:d,isGecko3:a,isBorderBox:w,isLinux:m,isWindows:A,isMac:k,isAir:j});Ext.ns=Ext.namespace})();Ext.ns("Ext","Ext.util","Ext.lib","Ext.data");Ext.apply(Function.prototype,{createInterceptor:function(b,a){var c=this;return !Ext.isFunction(b)?this:function(){var e=this,d=arguments;b.target=e;b.method=c;return(b.apply(a||e||window,d)!==false)?c.apply(e||window,d):null}},createCallback:function(){var a=arguments,b=this;return function(){return b.apply(window,a)}},createDelegate:function(c,b,a){var d=this;return function(){var f=b||arguments;if(a===true){f=Array.prototype.slice.call(arguments,0);f=f.concat(b)}else{if(Ext.isNumber(a)){f=Array.prototype.slice.call(arguments,0);var e=[a,0].concat(b);Array.prototype.splice.apply(f,e)}}return d.apply(c||window,f)}},defer:function(c,e,b,a){var d=this.createDelegate(e,b,a);if(c>0){return setTimeout(d,c)}d();return 0}});Ext.applyIf(String,{format:function(b){var a=Ext.toArray(arguments,1);return b.replace(/\{(\d+)\}/g,function(c,d){return a[d]})}});Ext.applyIf(Array.prototype,{indexOf:function(c){for(var b=0,a=this.length;b<a;b++){if(this[b]==c){return b}}return -1},remove:function(b){var a=this.indexOf(b);if(a!=-1){this.splice(a,1)}return this}});Ext.ns("Ext.grid","Ext.dd","Ext.tree","Ext.form","Ext.menu","Ext.state","Ext.layout","Ext.app","Ext.ux","Ext.chart","Ext.direct");Ext.apply(Ext,function(){var b=Ext,a=0;return{emptyFn:function(){},BLANK_IMAGE_URL:Ext.isIE6||Ext.isIE7?"http://extjs.com/s.gif":"data:image/gif;base64,R0lGODlhAQABAID/AMDAwAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==",extendX:function(c,d){return Ext.extend(c,d(c.prototype))},getDoc:function(){return Ext.get(document)},isDate:function(c){return Object.prototype.toString.apply(c)==="[object Date]"},num:function(d,c){d=Number(d===null||typeof d=="boolean"?NaN:d);return isNaN(d)?c:d},value:function(e,c,d){return Ext.isEmpty(e,d)?c:e},escapeRe:function(c){return c.replace(/([.*+?^${}()|[\]\/\\])/g,"\\$1")},sequence:function(f,c,e,d){f[c]=f[c].createSequence(e,d)},addBehaviors:function(g){if(!Ext.isReady){Ext.onReady(function(){Ext.addBehaviors(g)})}else{var d={},f,c,e;for(c in g){if((f=c.split("@"))[1]){e=f[0];if(!d[e]){d[e]=Ext.select(e)}d[e].on(f[1],g[c])}}d=null}},combine:function(){var e=arguments,d=e.length,g=[];for(var f=0;f<d;f++){var c=e[f];if(Ext.isArray(c)){g=g.concat(c)}else{if(c.length!==undefined&&!c.substr){g=g.concat(Array.prototype.slice.call(c,0))}else{g.push(c)}}}return g},copyTo:function(c,d,e){if(typeof e=="string"){e=e.split(/[,;\s]/)}Ext.each(e,function(f){if(d.hasOwnProperty(f)){c[f]=d[f]}},this);return c},destroy:function(){Ext.each(arguments,function(c){if(c){if(Ext.isArray(c)){this.destroy.apply(this,c)}else{if(Ext.isFunction(c.destroy)){c.destroy()}else{if(c.dom){c.remove()}}}}},this)},destroyMembers:function(j,g,e,f){for(var h=1,d=arguments,c=d.length;h<c;h++){Ext.destroy(j[d[h]]);delete j[d[h]]}},clean:function(c){var d=[];Ext.each(c,function(e){if(!!e){d.push(e)}});return d},unique:function(c){var d=[],e={};Ext.each(c,function(f){if(!e[f]){d.push(f)}e[f]=true});return d},flatten:function(c){var e=[];function d(f){Ext.each(f,function(g){if(Ext.isArray(g)){d(g)}else{e.push(g)}});return e}return d(c)},min:function(c,d){var e=c[0];d=d||function(g,f){return g<f?-1:1};Ext.each(c,function(f){e=d(e,f)==-1?e:f});return e},max:function(c,d){var e=c[0];d=d||function(g,f){return g>f?1:-1};Ext.each(c,function(f){e=d(e,f)==1?e:f});return e},mean:function(c){return Ext.sum(c)/c.length},sum:function(c){var d=0;Ext.each(c,function(e){d+=e});return d},partition:function(c,d){var e=[[],[]];Ext.each(c,function(g,h,f){e[(d&&d(g,h,f))||(!d&&g)?0:1].push(g)});return e},invoke:function(c,d){var f=[],e=Array.prototype.slice.call(arguments,2);Ext.each(c,function(g,h){if(g&&typeof g[d]=="function"){f.push(g[d].apply(g,e))}else{f.push(undefined)}});return f},pluck:function(c,e){var d=[];Ext.each(c,function(f){d.push(f[e])});return d},zip:function(){var l=Ext.partition(arguments,function(i){return !Ext.isFunction(i)}),g=l[0],k=l[1][0],c=Ext.max(Ext.pluck(g,"length")),f=[];for(var h=0;h<c;h++){f[h]=[];if(k){f[h]=k.apply(k,Ext.pluck(g,h))}else{for(var e=0,d=g.length;e<d;e++){f[h].push(g[e][h])}}}return f},getCmp:function(c){return Ext.ComponentMgr.get(c)},useShims:b.isIE6||(b.isMac&&b.isGecko2),type:function(d){if(d===undefined||d===null){return false}if(d.htmlElement){return"element"}var c=typeof d;if(c=="object"&&d.nodeName){switch(d.nodeType){case 1:return"element";case 3:return(/\S/).test(d.nodeValue)?"textnode":"whitespace"}}if(c=="object"||c=="function"){switch(d.constructor){case Array:return"array";case RegExp:return"regexp";case Date:return"date"}if(typeof d.length=="number"&&typeof d.item=="function"){return"nodelist"}}return c},intercept:function(f,c,e,d){f[c]=f[c].createInterceptor(e,d)},callback:function(c,f,e,d){if(Ext.isFunction(c)){if(d){c.defer(d,f,e||[])}else{c.apply(f,e||[])}}}}}());Ext.apply(Function.prototype,{createSequence:function(b,a){var c=this;return !Ext.isFunction(b)?this:function(){var d=c.apply(this||window,arguments);b.apply(a||this||window,arguments);return d}}});Ext.applyIf(String,{escape:function(a){return a.replace(/('|\\)/g,"\\$1")},leftPad:function(d,b,c){var a=String(d);if(!c){c=" "}while(a.length<b){a=c+a}return a}});String.prototype.toggle=function(b,a){return this==b?a:b};String.prototype.trim=function(){var a=/^\s+|\s+$/g;return function(){return this.replace(a,"")}}();Date.prototype.getElapsed=function(a){return Math.abs((a||new Date()).getTime()-this.getTime())};Ext.applyIf(Number.prototype,{constrain:function(b,a){return Math.min(Math.max(this,b),a)}});Ext.util.TaskRunner=function(e){e=e||10;var f=[],a=[],b=0,g=false,d=function(){g=false;clearInterval(b);b=0},h=function(){if(!g){g=true;b=setInterval(i,e)}},c=function(j){a.push(j);if(j.onStop){j.onStop.apply(j.scope||j)}},i=function(){var l=a.length,n=new Date().getTime();if(l>0){for(var p=0;p<l;p++){f.remove(a[p])}a=[];if(f.length<1){d();return}}for(var p=0,o,k,m,j=f.length;p<j;++p){o=f[p];k=n-o.taskRunTime;if(o.interval<=k){m=o.run.apply(o.scope||o,o.args||[++o.taskRunCount]);o.taskRunTime=n;if(m===false||o.taskRunCount===o.repeat){c(o);return}}if(o.duration&&o.duration<=(n-o.taskStartTime)){c(o)}}};this.start=function(j){f.push(j);j.taskStartTime=new Date().getTime();j.taskRunTime=0;j.taskRunCount=0;h();return j};this.stop=function(j){c(j);return j};this.stopAll=function(){d();for(var k=0,j=f.length;k<j;k++){if(f[k].onStop){f[k].onStop()}}f=[];a=[]}};Ext.TaskMgr=new Ext.util.TaskRunner();if(typeof jQuery=="undefined"){throw"Unable to load Ext, jQuery not found."}(function(){var b;Ext.lib.Dom={getViewWidth:function(d){return d?Math.max(jQuery(document).width(),jQuery(window).width()):jQuery(window).width()},getViewHeight:function(d){return d?Math.max(jQuery(document).height(),jQuery(window).height()):jQuery(window).height()},isAncestor:function(e,f){e=Ext.getDom(e);f=Ext.getDom(f);if(!e||!f){return false}if(e.contains&&!Ext.isSafari){return e.contains(f)}else{if(e.compareDocumentPosition){return !!(e.compareDocumentPosition(f)&16)}else{var d=f.parentNode;while(d){if(d==e){return true}else{if(!d.tagName||d.tagName.toUpperCase()=="HTML"){return false}}d=d.parentNode}return false}}},getRegion:function(d){return Ext.lib.Region.getRegion(d)},getY:function(d){return this.getXY(d)[1]},getX:function(d){return this.getXY(d)[0]},getXY:function(f){var e,j,l,m,i=(document.body||document.documentElement);f=Ext.getDom(f);if(f==i){return[0,0]}if(f.getBoundingClientRect){l=f.getBoundingClientRect();m=c(document).getScroll();return[Math.round(l.left+m.left),Math.round(l.top+m.top)]}var n=0,k=0;e=f;var d=c(f).getStyle("position")=="absolute";while(e){n+=e.offsetLeft;k+=e.offsetTop;if(!d&&c(e).getStyle("position")=="absolute"){d=true}if(Ext.isGecko){j=c(e);var o=parseInt(j.getStyle("borderTopWidth"),10)||0;var g=parseInt(j.getStyle("borderLeftWidth"),10)||0;n+=g;k+=o;if(e!=f&&j.getStyle("overflow")!="visible"){n+=g;k+=o}}e=e.offsetParent}if(Ext.isSafari&&d){n-=i.offsetLeft;k-=i.offsetTop}if(Ext.isGecko&&!d){var h=c(i);n+=parseInt(h.getStyle("borderLeftWidth"),10)||0;k+=parseInt(h.getStyle("borderTopWidth"),10)||0}e=f.parentNode;while(e&&e!=i){if(!Ext.isOpera||(e.tagName!="TR"&&c(e).getStyle("display")!="inline")){n-=e.scrollLeft;k-=e.scrollTop}e=e.parentNode}return[n,k]},setXY:function(d,e){d=Ext.fly(d,"_setXY");d.position();var f=d.translatePoints(e);if(e[0]!==false){d.dom.style.left=f.left+"px"}if(e[1]!==false){d.dom.style.top=f.top+"px"}},setX:function(e,d){this.setXY(e,[d,false])},setY:function(d,e){this.setXY(d,[false,e])}};function c(d){if(!b){b=new Ext.Element.Flyweight()}b.dom=d;return b}Ext.lib.Event={getPageX:function(d){d=d.browserEvent||d;return d.pageX},getPageY:function(d){d=d.browserEvent||d;return d.pageY},getXY:function(d){d=d.browserEvent||d;return[d.pageX,d.pageY]},getTarget:function(d){return d.target},on:function(h,d,g,f,e){jQuery(h).bind(d,g)},un:function(f,d,e){jQuery(f).unbind(d,e)},purgeElement:function(d){jQuery(d).unbind()},preventDefault:function(d){d=d.browserEvent||d;if(d.preventDefault){d.preventDefault()}else{d.returnValue=false}},stopPropagation:function(d){d=d.browserEvent||d;if(d.stopPropagation){d.stopPropagation()}else{d.cancelBubble=true}},stopEvent:function(d){this.preventDefault(d);this.stopPropagation(d)},onAvailable:function(j,e,d){var i=new Date();var g=function(){if(i.getElapsed()>10000){clearInterval(h)}var f=document.getElementById(j);if(f){clearInterval(h);e.call(d||window,f)}};var h=setInterval(g,50)},resolveTextNode:function(d){if(d&&3==d.nodeType){return d.parentNode}else{return d}},getRelatedTarget:function(e){e=e.browserEvent||e;var d=e.relatedTarget;if(!d){if(e.type=="mouseout"){d=e.toElement}else{if(e.type=="mouseover"){d=e.fromElement}}}return this.resolveTextNode(d)}};Ext.lib.Ajax=function(){var d=function(e){return function(g,f){if((f=="error"||f=="timeout")&&e.failure){e.failure.call(e.scope||window,{responseText:g.responseText,responseXML:g.responseXML,argument:e.argument})}else{if(e.success){e.success.call(e.scope||window,{responseText:g.responseText,responseXML:g.responseXML,argument:e.argument})}}}};return{request:function(k,h,e,i,f){var j={type:k,url:h,data:i,timeout:e.timeout,complete:d(e)};if(f){var g=f.headers;if(f.xmlData){j.data=f.xmlData;j.processData=false;j.type=(k?k:(f.method?f.method:"POST"));if(!g||!g["Content-Type"]){j.contentType="text/xml"}}else{if(f.jsonData){j.data=typeof f.jsonData=="object"?Ext.encode(f.jsonData):f.jsonData;j.processData=false;j.type=(k?k:(f.method?f.method:"POST"));if(!g||!g["Content-Type"]){j.contentType="application/json"}}}if(g){j.beforeSend=function(m){for(var l in g){if(g.hasOwnProperty(l)){m.setRequestHeader(l,g[l])}}}}}jQuery.ajax(j)},formRequest:function(i,h,f,j,e,g){jQuery.ajax({type:Ext.getDom(i).method||"POST",url:h,data:jQuery(i).serialize()+(j?"&"+j:""),timeout:f.timeout,complete:d(f)})},isCallInProgress:function(e){return false},abort:function(e){return false},serializeForm:function(e){return jQuery(e.dom||e).serialize()}}}();Ext.lib.Anim=function(){var d=function(e,f){var g=true;return{stop:function(h){},isAnimated:function(){return g},proxyCallback:function(){g=false;Ext.callback(e,f)}}};return{scroll:function(h,f,j,k,e,g){var i=d(e,g);h=Ext.getDom(h);if(typeof f.scroll.to[0]=="number"){h.scrollLeft=f.scroll.to[0]}if(typeof f.scroll.to[1]=="number"){h.scrollTop=f.scroll.to[1]}i.proxyCallback();return i},motion:function(h,f,i,j,e,g){return this.run(h,f,i,j,e,g)},color:function(h,f,j,k,e,g){var i=d(e,g);i.proxyCallback();return i},run:function(g,q,j,p,h,s,r){var l=d(h,s),m=Ext.fly(g,"_animrun");var f={};for(var i in q){switch(i){case"points":var n,u;m.position();if(n=q.points.by){var t=m.getXY();u=m.translatePoints([t[0]+n[0],t[1]+n[1]])}else{u=m.translatePoints(q.points.to)}f.left=u.left;f.top=u.top;if(!parseInt(m.getStyle("left"),10)){m.setLeft(0)}if(!parseInt(m.getStyle("top"),10)){m.setTop(0)}if(q.points.from){m.setXY(q.points.from)}break;case"width":f.width=q.width.to;if(q.width.from){m.setWidth(q.width.from)}break;case"height":f.height=q.height.to;if(q.height.from){m.setHeight(q.height.from)}break;case"opacity":f.opacity=q.opacity.to;if(q.opacity.from){m.setOpacity(q.opacity.from)}break;case"left":f.left=q.left.to;if(q.left.from){m.setLeft(q.left.from)}break;case"top":f.top=q.top.to;if(q.top.from){m.setTop(q.top.from)}break;default:f[i]=q[i].to;if(q[i].from){m.setStyle(i,q[i].from)}break}}jQuery(g).animate(f,j*1000,undefined,l.proxyCallback);return l}}}();Ext.lib.Region=function(f,g,d,e){this.top=f;this[1]=f;this.right=g;this.bottom=d;this.left=e;this[0]=e};Ext.lib.Region.prototype={contains:function(d){return(d.left>=this.left&&d.right<=this.right&&d.top>=this.top&&d.bottom<=this.bottom)},getArea:function(){return((this.bottom-this.top)*(this.right-this.left))},intersect:function(h){var f=Math.max(this.top,h.top);var g=Math.min(this.right,h.right);var d=Math.min(this.bottom,h.bottom);var e=Math.max(this.left,h.left);if(d>=f&&g>=e){return new Ext.lib.Region(f,g,d,e)}else{return null}},union:function(h){var f=Math.min(this.top,h.top);var g=Math.max(this.right,h.right);var d=Math.max(this.bottom,h.bottom);var e=Math.min(this.left,h.left);return new Ext.lib.Region(f,g,d,e)},constrainTo:function(d){this.top=this.top.constrain(d.top,d.bottom);this.bottom=this.bottom.constrain(d.top,d.bottom);this.left=this.left.constrain(d.left,d.right);this.right=this.right.constrain(d.left,d.right);return this},adjust:function(f,e,d,g){this.top+=f;this.left+=e;this.right+=g;this.bottom+=d;return this}};Ext.lib.Region.getRegion=function(g){var i=Ext.lib.Dom.getXY(g);var f=i[1];var h=i[0]+g.offsetWidth;var d=i[1]+g.offsetHeight;var e=i[0];return new Ext.lib.Region(f,h,d,e)};Ext.lib.Point=function(d,e){if(Ext.isArray(d)){e=d[1];d=d[0]}this.x=this.right=this.left=this[0]=d;this.y=this.top=this.bottom=this[1]=e};Ext.lib.Point.prototype=new Ext.lib.Region();if(Ext.isIE){function a(){var d=Function.prototype;delete d.createSequence;delete d.defer;delete d.createDelegate;delete d.createCallback;delete d.createInterceptor;window.detachEvent("onunload",a)}window.attachEvent("onunload",a)}})();