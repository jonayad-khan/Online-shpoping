:t.classList.add(e);else{var n=" "+(t.getAttribute("class")||"")+" ";n.indexOf(" "+e+" ")<0&&t.setAttribute("class",(n+e).trim())}}function Bn(t,e){if(e&&(e=e.trim()))if(t.classList)e.indexOf(" ")>-1?e.split(/\s+/).forEach(function(e){return t.classList.remove(e)}):t.classList.remove(e);else{for(var n=" "+(t.getAttribute("class")||"")+" ",r=" "+e+" ";n.indexOf(r)>=0;)n=n.replace(r," ");t.setAttribute("class",n.trim())}}function Un(t){if(t){if("object"==typeof t){var e={};return!1!==t.css&&y(e,Ra(t.name||"v")),y(e,t),e}return"string"==typeof t?Ra(t):void 0}}function Wn(t){Wa(function(){Wa(t)})}function zn(t,e){(t._transitionClasses||(t._transitionClasses=[])).push(e),Hn(t,e)}function Vn(t,e){t._transitionClasses&&d(t._transitionClasses,e),Bn(t,e)}function Xn(t,e,n){var r=Kn(t,e),i=r.type,o=r.timeout,a=r.propCount;if(!i)return n();var s=i===Fa?Ha:Ua,u=0,c=function(){t.removeEventListener(s,l),n()},l=function(e){e.target===t&&++u>=a&&c()};setTimeout(function(){u<a&&c()},o+1),t.addEventListener(s,l)}function Kn(t,e){var n,r=window.getComputedStyle(t),i=r[Ma+"Delay"].split(", "),o=r[Ma+"Duration"].split(", "),a=Jn(i,o),s=r[Ba+"Delay"].split(", "),u=r[Ba+"Duration"].split(", "),c=Jn(s,u),l=0,f=0;return e===Fa?a>0&&(n=Fa,l=a,