!==it||e in t)||Qn(t,e,n)}function Hn(t,e,n){var r=t[e];pl.call(t,e)&&Hs(r,n)&&(n!==it||e in t)||Qn(t,e,n)}function Vn(t,e){for(var n=t.length;n--;)if(Hs(t[n][0],e))return n;return-1}function Xn(t,e,n,r){return ff(t,function(t,i,o){e(r,t,n(t),o)}),r}function Kn(t,e){return t&&Ii(e,Ru(e),t)}function Jn(t,e){return t&&Ii(e,Pu(e),t)}function Qn(t,e,n){"__proto__"==e&&Ol?Ol(t,e,{configurable:!0,enumerable:!0,value:n,writable:!0}):t[e]=n}function Gn(t,e){for(var n=-1,r=e.length,i=Zc(r),o=null==t;++n<r;)i[n]=o?it:Du(t,e[n]);return i}function Zn(t,e,n){return t===t&&(n!==it&&(t=t<=n?t:n),e!==it&&(t=t>=e?t:e)),t}function Yn(t,e,n,r,i,o){var a,s=e&ft,u=e&pt,l=e&dt;if(n&&(a=i?n(t,r,i,o):n(t)),a!==it)return a;if(!tu(t))return t;var f=dp(t);if(f){if(a=ko(t),!s)return Di(t,a)}else{var p=Cf(t),d=p==Xt||p==Kt;if(vp(t))return wi(t,s);if(p==Zt||p==Mt||d&&!i){if(a=u||d?{}:Ao(t),!s)return u?Ri(t,Jn(a,t)):Li(t,Kn(a,t))}else{if(!_n[p])return i?t:{};a=Eo(t,p,Yn,s)}}o||(o=new gn);var h=o.get(t);if(h)return h;o.set(t,a);var v=l?u?vo:ho:u?Pu:Ru,g=f?it:v(t);return c(g||t,function(r,i){g&&(i=r,r=t[i]),Hn(a,i,Yn(r,