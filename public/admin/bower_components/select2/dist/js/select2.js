���FϜhc����1��4�R�6i�6�h�~	P��6���S�]*��r�3p��C۴�N�B;�G~�g�j!��|h�<W;����B �V8-�G����dzͳ��S:[����R*n'�Z���g�'���]��?d��m��1)2�j�2Fw������?�t����f���kڛ\�H����$�=�@$@���! pD� C�~�q����%n�1O�n�m�拵��/N�a/c>�ϔ�}�vQ{z,p�Q�GD{��~�9 ���)�ߛzn&@��T���>�5� �1
偠�0���I�˫\!\r��r�h��������3���>��� �]�Y7��P���t��ӴDO[5��nA	�]�������a�l��T��2�A��_&\�An�4'':����aOHc�	0 ��	�w޺�{�G��g3�/R��1T��������������0+��ޔ ��0R����m柅`�o���*~��_g	�uF���j�ǟ�=���sxpE��)V���U9v���u�Z���������O�=��j<_�>o5�@HP�G���x�#��;�I���������0�����Q�� �#zG$@��� �# pD��ZK�*��6Aa\���n�6�v[K��(Ѯ0�zLI/�j�n�Ю��|y�.��4�q�����Eص���W�̈́�x�j�q�
{Y�� ��>�����.]�!a[!�i.d&�~�RJ�4�`��&@Sۥ�sy�7�wp�hq=����l��e�<Q�^w�-4���<X$o@��|�:�P�A�;xIl_�����/�O.��g����s��41��`bY:��q$0pD�H��	8"�I R^, *��V�gqֲ�~6tt�"��KHqXn�Y#o���q��B	sxa���>fy�y���_��E��ŵ���^�ը��w�X���Q���"t�lo�ޡs�9eS�R~�ڥ|;�������i�6\/�$ʗʿ������ �� � � x8_��t���+x�p�+�ި�����$��@<�K�/�:��}������Wk�~��|)q_y��=l`E�	�@�C����
[ɔ�T_߭�����a�;iy�yW�Kբ��d���}����������7��<���f�ø�7�,6�����p`ܢj�_�5������k����_
�|��}�# pD�H��Q��>���'q��_Ǔ�.�t��-o�\��} ]�m�&-�t��-o}d�C�>��r�F���O�|Ӗw8�K��CH����7���<n����~0g���[�I�����\�\�W��<��H����\�o�����Ѡ��K�s)�	������~��n�j����̨�oR��� �kk�g7�ƲHM%��.�z\r���y�&V�����V����et���<�N�8�Q�?��B����� g� C]��FC�|��Oq]n�?d��f��`ܗ��[h	�����W�Ю���� �ʖ�㸧�=@v�*+{��&ɟp7�o��u%1g_W�.9D9X����}U���m�(������O�)�x��c��� f�Q��w& �I�^*�NOւv�_�[��3�1i���7my�#N	�8"G$@��� �# p�Π��QǬ�#Z@�.�ߎ��]�3��%��鎜��ܤ��&\<(_Ƒ���2�:%����GX``��eQ~�e� y�D"�;3ꗀ�Z�ز�n��E������Ijag]��8�@P��� �# pD�H��1����q@'@�q6B������>V'�J �	���M�֝��`��\�����W��#|{ B���̪$�y�4,���}F�>�n���k�-�P��WE�A�tH=�ji��Y'�W;S'QO��QL7����D�O�=@w������=K��F���R�?�����Л�Ε�N����8#(p̯/ b,��?P�w��   %tEXtdate:create 2015-03-11T08:47:11-07:00�=l   %tEXtdate:modify 2015-03-11T07:59:35-07:00�=��   tEXtSoftware Adobe ImageReadyq�e<    IEND�B`�                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     /* Romanian initialisation for the jQuery UI date picker plugin.
 *
 * Written by Edmond L. (ll_edmond@walla.com)
 * and Ionut G. Stan (ionut.g.stan@gmail.com)
 */
(function( factory ) {
	if ( typeof define === "function" && define.amd ) {

		// AMD. Register as an anonymous module.
		define([ "../datepicker" ], factory );
	} else {

		// Browser globals
		factory( jQuery.datepicker );
	}
}(function( datepicker ) {

datepicker.regional['ro'] = {
	closeText: 'Închide',
	prevText: '&#xAB; Luna precedentă',
	nextText: 'Luna următoare &#xBB;',
	currentText: 'Azi',
	monthNames: ['Ianuarie','Februarie','Martie','Aprilie','Mai','Iunie',
	'Iulie','August','Septembrie','Octombrie','Noiembrie','Decembrie'],
	monthNamesShort: ['Ian', 'Feb', 'Mar', 'Apr', 'Mai', 'Iun',
	'Iul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
	dayNames: ['Duminică', 'Luni', 'Marţi', 'Miercuri', 'Joi', 'Vineri', 'Sâmbătă'],
	dayNamesShort: ['Dum', 'Lun', 'Mar', 'Mie', 'Joi', 'Vin', 'Sâm'],
	dayNamesMin: ['Du','Lu','Ma','Mi','Jo','Vi','Sâ'],
	weekHeader: 'Săpt',
	dateFormat: 'dd.mm.yy',
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: ''};
datepicker.setDefaults(datepicker.regional['ro']);

return datepicker.regional['ro'];

}));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           //! moment.js locale configuration
//! locale : Bengali [bn]
//! author : Kaushik Gandhi : https://github.com/kaushikgandhi

;(function (global, factory) {
   typeof exports === 'object' && typeof module !== 'undefined'
       && typeof require === 'function' ? factory(require('../moment')) :
   typeof define === 'function' && define.amd ? define(['../moment'], factory) :
   factory(global.moment)
}(this, (function (moment) { 'use strict';


var symbolMap = {
    '1': '১',
    '2': '২',
    '3': '৩',
    '4': '৪',
    '5': '৫',
    '6': '৬',
    '7': '৭',
    '8': '৮',
    '9': '৯',
    '0': '০'
};
var numberMap = {
    '১': '1',
    '২': '2',
    '৩': '3',
    '৪': '4',
    '৫': '5',
    '৬': '6',
    '৭': '7',
    '৮': '8',
    '৯': '9',
    '০': '0'
};

var bn = moment.defineLocale('bn', {
    months : 'জানুয়ারী_ফেব্রুয়ারি_মার্চ_এপ্রিল_মে_জুন_জুলাই_আগস্ট_সেপ্টেম্বর_অক্টোবর_নভেম্বর_ডিসেম্বর'.split('_'),
    monthsShort : 'জানু_ফেব_মার্চ_এপ্র_মে_জুন_জুল_আগ_সেপ্ট_অক্টো_নভে_ডিসে'.split('_'),
    weekdays : 'রবিবার_সোমবার_মঙ্গলবার_বুধবার_বৃহস্পতিবার_শুক্রবার_শনিবার'.split('_'),
    weekdaysShort : 'রবি_সোম_মঙ্গল_বুধ_বৃহস্পতি_শুক্র_শনি'.split('_'),
    weekdaysMin : 'রবি_সোম_মঙ্গ_বুধ_বৃহঃ_শুক্র_শনি'.split('_'),
    longDateFormat : {
        LT : 'A h:mm সময়',
        LTS : 'A h:mm:ss সময়',
        L : 'DD/MM/YYYY',
        LL : 'D MMMM YYYY',
        LLL : 'D MMMM YYYY, A h:mm সময়',
        LLLL : 'dddd, D MMMM YYYY, A h:mm সময়'
    },
    calendar : {
        sameDay : '[আজ] LT',
        nextDay : '[আগামীকাল] LT',
        nextWeek : 'dddd, LT',
        lastDay : '[গতকাল] LT',
        lastWeek : '[গত] dddd, LT',
        sameElse : 'L'
    },
    relativeTime : {
        future : '%s পরে',
        past : '%s আগে',
        s : 'কয়েক সেকেন্ড',
        m : 'এক মিনিট',
        mm : '%d মিনিট',
        h : 'এক ঘন্টা',
        hh : '%d ঘন্টা',
        d : 'এক দিন',
        dd : '%d দিন',
        M : 'এক মাস',
        MM : '%d মাস',
        y : 'এক বছর',
        yy : '%d বছর'
    },
    preparse: function (string) {
        return string.replace(/[১২৩৪৫৬৭৮৯০]/g, function (match) {
            return numberMap[match];
        });
    },
    postformat: function (string) {
        return string.replace(/\d/g, function (match) {
            return symbolMap[match];
        });
    },
    meridiemParse: /রাত|সকাল|দুপুর|বিকাল|রাত/,
    meridiemHour : function (hour, meridiem) {
        if (hour === 12) {
            hour = 0;
        }
        if ((meridiem === 'রাত' && hour >= 4) ||
                (meridiem === 'দুপুর' && hour < 5) ||
                meridiem === 'বিকাল') {
            return hour + 12;
        } else {
            return hour;
        }
    },
    meridiem : function (hour, minute, isLower) {
        if (hour < 4) {
            return 'রাত';
        } else if (hour < 10) {
            return 'সকাল';
        } else if (hour < 17) {
            return 'দুপুর';
        } else if (hour < 20) {
            return 'বিকাল';
        } else {
            return 'রাত';
        }
    },
    week : {
        dow : 0, // Sunday is the first day of the week.
        doy : 6  // The week that contains Jan 1st is the first week of the year.
    }
});

return bn;

})));
                                                                           //! moment.js locale configuration
//! locale : Sinhalese [si]
//! author : Sampath Sitinamaluwa : https://github.com/sampathsris

import moment from '../moment';

/*jshint -W100*/
export default moment.defineLocale('si', {
    months : 'ජනවාරි_පෙබරවාරි_මාර්තු_අප්‍රේල්_මැයි_ජූනි_ජූලි_අගෝස්තු_සැප්තැම්බර්_ඔක්තෝබර්_නොවැම්බර්_දෙසැම්බර්'.split('_'),
    monthsShort : 'ජන_පෙබ_මාර්_අප්_මැයි_ජූනි_ජූලි_අගෝ_සැප්_ඔක්_නොවැ_දෙසැ'.split('_'),
    weekdays : 'ඉරිදා_සඳුදා_අඟහරුවාදා_බදාදා_බ්‍රහස්පතින්දා_සිකුරාදා_සෙනසුරාදා'.split('_'),
    weekdaysShort : 'ඉරි_සඳු_අඟ_බදා_බ්‍රහ_සිකු_සෙන'.split('_'),
    weekdaysMin : 'ඉ_ස_අ_බ_බ්‍ර_සි_සෙ'.split('_'),
    weekdaysParseExact : true,
    longDateFormat : {
        LT : 'a h:mm',
        LTS : 'a h:mm:ss',
        L : 'YYYY/MM/DD',
        LL : 'YYYY MMMM D',
        LLL : 'YYYY MMMM D, a h:mm',
        LLLL : 'YYYY MMMM D [වැනි] dddd, a h:mm:ss'
    },
    calendar : {
        sameDay : '[අද] LT[ට]',
        nextDay : '[හෙට] LT[ට]',
        nextWeek : 'dddd LT[ට]',
        lastDay : '[ඊයේ] LT[ට]',
        lastWeek : '[පසුගිය] dddd LT[ට]',
        sameElse : 'L'
    },
    relativeTime : {
        future : '%sකින්',
        past : '%sකට පෙර',
        s : 'තත්පර කිහිපය',
        m : 'මිනිත්තුව',
        mm : 'මිනිත්තු %d',
        h : 'පැය',
        hh : 'පැය %d',
        d : 'දිනය',
        dd : 'දින %d',
        M : 'මාසය',
        MM : 'මාස %d',
        y : 'වසර',
        yy : 'වසර %d'
    },
    dayOfMonthOrdinalParse: /\d{1,2} වැනි/,
    ordinal : function (number) {
        return number + ' වැනි';
    },
    meridiemParse : /පෙර වරු|පස් වරු|පෙ.ව|ප.ව./,
    isPM : function (input) {
        return input === 'ප.ව.' || input === 'පස් වරු';
    },
    meridiem : function (hours, minutes, isLower) {
        if (hours > 11) {
            return isLower ? 'ප.ව.' : 'පස් වරු';
        } else {
            return isLower ? 'පෙ.ව.' : 'පෙර වරු';
        }
    }
});
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 /*! Select2 4.0.4 | https://github.com/select2/select2/blob/master/LICENSE.md */

(function(){if(jQuery&&jQuery.fn&&jQuery.fn.select2&&jQuery.fn.select2.amd)var e=jQuery.fn.select2.amd;return e.define("select2/i18n/hr",[],function(){function e(e){var t=" "+e+" znak";return e%10<5&&e%10>0&&(e%100<5||e%100>19)?e%10>1&&(t+="a"):t+="ova",t}return{errorLoading:function(){return"Preuzimanje nije uspjelo."},inputTooLong:function(t){var n=t.input.length-t.maximum;return"Unesite "+e(n)},inputTooShort:function(t){var n=t.minimum-t.input.length;return"Unesite još "+e(n)},loadingMore:function(){return"Učitavanje rezultata…"},maximumSelected:function(e){return"Maksimalan broj odabranih stavki je "+e.maximum},noResults:function(){return"Nema rezultata"},searching:function(){return"Pretraga…"}}}),{define:e.define,require:e.require}})();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         /*! iCheck v1.0.1 by Damir Sultanov, http://git.io/arlzeA, MIT Licensed */
(function(h){function F(a,b,d){var c=a[0],e=/er/.test(d)?m:/bl/.test(d)?s:l,f=d==H?{checked:c[l],disabled:c[s],indeterminate:"true"==a.attr(m)||"false"==a.attr(w)}:c[e];if(/^(ch|di|in)/.test(d)&&!f)D(a,e);else if(/^(un|en|de)/.test(d)&&f)t(a,e);else if(d==H)for(e in f)f[e]?D(a,e,!0):t(a,e,!0);else if(!b||"toggle"==d){if(!b)a[p]("ifClicked");f?c[n]!==u&&t(a,e):D(a,e)}}function D(a,b,d){var c=a[0],e=a.parent(),f=b==l,A=b==m,B=b==s,K=A?w:f?E:"enabled",p=k(a,K+x(c[n])),N=k(a,b+x(c[n]));if(!0!==c[b]){if(!d&&
b==l&&c[n]==u&&c.name){var C=a.closest("form"),r='input[name="'+c.name+'"]',r=C.length?C.find(r):h(r);r.each(function(){this!==c&&h(this).data(q)&&t(h(this),b)})}A?(c[b]=!0,c[l]&&t(a,l,"force")):(d||(c[b]=!0),f&&c[m]&&t(a,m,!1));L(a,f,b,d)}c[s]&&k(a,y,!0)&&e.find("."+I).css(y,"default");e[v](N||k(a,b)||"");B?e.attr("aria-disabled","true"):e.attr("aria-checked",A?"mixed":"true");e[z](p||k(a,K)||"")}function t(a,b,d){var c=a[0],e=a.parent(),f=b==l,h=b==m,q=b==s,p=h?w:f?E:"enabled",t=k(a,p+x(c[n])),
u=k(a,b+x(c[n]));if(!1!==c[b]){if(h||!d||"force"==d)c[b]=!1;L(a,f,p,d)}!c[s]&&k(a,y,!0)&&e.find("."+I).css(y,"pointer");e[z](u||k(a,b)||"");q?e.attr("aria-disabled","false"):e.attr("aria-checked","false");e[v](t||k(a,p)||"")}function M(a,b){if(a.data(q)){a.parent().html(a.attr("style",a.data(q).s||""));if(b)a[p](b);a.off(".i").unwrap();h(G+'[for="'+a[0].id+'"]').add(a.closest(G)).off(".i")}}function k(a,b,d){if(a.data(q))return a.data(q).o[b+(d?"":"Class")]}function x(a){return a.charAt(0).toUpperCase()+
a.slice(1)}function L(a,b,d,c){if(!c){if(b)a[p]("ifToggled");a[p]("ifChanged")[p]("if"+x(d))}}var q="iCheck",I=q+"-helper",u="radio",l="checked",E="un"+l,s="disabled",w="determinate",m="in"+w,H="update",n="type",v="addClass",z="removeClass",p="trigger",G="label",y="cursor",J=/ipad|iphone|ipod|android|blackberry|windows phone|opera mini|silk/i.test(navigator.userAgent);h.fn[q]=function(a,b){var d='input[type="checkbox"], input[type="'+u+'"]',c=h(),e=function(a){a.each(function(){var a=h(this);c=a.is(d)?
c.add(a):c.add(a.find(d))})};if(/^(check|uncheck|toggle|indeterminate|determinate|disable|enable|update|destroy)$/i.test(a))return a=a.toLowerCase(),e(this),c.each(function(){var c=h(this);"destroy"==a?M(c,"ifDestroyed"):F(c,!0,a);h.isFunction(b)&&b()});if("object"!=typeof a&&a)return this;var f=h.extend({checkedClass:l,disabledClass:s,indeterminateClass:m,labelHover:!0,aria:!1},a),k=f.handle,B=f.hoverClass||"hover",x=f.focusClass||"focus",w=f.activeClass||"active",y=!!f.labelHover,C=f.labelHoverClass||
"hover",r=(""+f.increaseArea).replace("%","")|0;if("checkbox"==k||k==u)d='input[type="'+k+'"]';-50>r&&(r=-50);e(this);return c.each(function(){var a=h(this);M(a);var c=this,b=c.id,e=-r+"%",d=100+2*r+"%",d={position:"absolute",top:e,left:e,display:"block",width:d,height:d,margin:0,padding:0,background:"#fff",border:0,opacity:0},e=J?{position:"absolute",visibility:"hidden"}:r?d:{position:"absolute",opacity:0},k="checkbox"==c[n]?f.checkboxClass||"icheckbox":f.radioClass||"i"+u,m=h(G+'[for="'+b+'"]').add(a.closest(G)),
A=!!f.aria,E=q+"-"+Math.random().toString(36).replace("0.",""),g='<div class="'+k+'" '+(A?'role="'+c[n]+'" ':"");m.length&&A&&m.each(function(){g+='aria-labelledby="';this.id?g+=this.id:(this.id=E,g+=E);g+='"'});g=a.wrap(g+"/>")[p]("ifCreated").parent().append(f.insert);d=h('<ins class="'+I+'"/>').css(d).appendTo(g);a.data(q,{o:f,s:a.attr("style")}).css(e);f.inheritClass&&g[v](c.className||"");f.inheritID&&b&&g.attr("id",q+"-"+b);"static"==g.css("position")&&g.css("position","relative");F(a,!0,H);
if(m.length)m.on("click.i mouseover.i mouseout.i touchbegin.i touchend.i",function(b){var d=b[n],e=h(this);if(!c[s]){if("click"==d){if(h(b.target).is("a"))return;F(a,!1,!0)}else y&&(/ut|nd/.test(d)?(g[z](B),e[z](C)):(g[v](B),e[v](C)));if(J)b.stopPropagation();else return!1}});a.on("click.i focus.i blur.i keyup.i keydown.i keypress.i",function(b){var d=b[n];b=b.keyCode;if("click"==d)return!1;if("keydown"==d&&32==b)return c[n]==u&&c[l]||(c[l]?t(a,l):D(a,l)),!1;if("keyup"==d&&c[n]==u)!c[l]&&D(a,l);else if(/us|ur/.test(d))g["blur"==
d?z:v](x)});d.on("click mousedown mouseup mouseover mouseout touchbegin.i touchend.i",function(b){var d=b[n],e=/wn|up/.test(d)?w:B;if(!c[s]){if("click"==d)F(a,!1,!0);else{if(/wn|er|in/.test(d))g[v](e);else g[z](e+" "+w);if(m.length&&y&&e==B)m[/ut|nd/.test(d)?z:v](C)}if(J)b.stopPropagation();else return!1}})})}})(window.jQuery||window.Zepto);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required autofocus>

                                <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>                                                                                                                                                                                                                                                                                   <?php
/**
 * @package dompdf
 * @link    http://dompdf.github.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @author  Helmut Tischer <htischer@weihenstephan.org>
 * @author  Fabien Ménager <fabien.menager@gmail.com>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */
namespace Dompdf\Renderer;

use Dompdf\Adapter\CPDF;
use Dompdf\FontMetrics;
use Dompdf\Frame;

/**
 * Renders text frames
 *
 * @package dompdf
 */
class Text extends AbstractRenderer
{
    /** Thickness of underline. Screen: 0.08, print: better less, e.g. 0.04 */
    const DECO_THICKNESS = 0.02;

    //Tweaking if $base and $descent are not accurate.
    //Check method_exists( $this->_canvas, "get_cpdf" )
    //- For cpdf these can and must stay 0, because font metrics are used directly.
    //- For other renderers, if different values are wanted, separate the parameter sets.
    //  But $size and $size-$height seem to be accurate enough

    /** Relative to bottom of text, as fraction of height */
    const UNDERLINE_OFFSET = 0.0;

    /** Relative to top of text */
    const OVERLINE_OFFSET = 0.0;

    /** Relative to centre of text. */
    const LINETHROUGH_OFFSET = 0.0;

    /** How far to extend lines past either end, in pt */
    const DECO_EXTENSION = 0.0;

    /**
     * @param \Dompdf\FrameDecorator\Text $frame
     */
    function render(Frame $frame)
    {
        $text = $frame->get_text();
        if (trim($text) === "") {
            return;
        }

        $style = $frame->get_style();
        list($x, $y) = $frame->get_position();
        $cb = $frame->get_containing_block();

        if (($ml = $style->margin_left) === "auto" || $ml === "none") {
            $ml = 0;
        }

        if (($pl = $style->padding_left) === "auto" || $pl === "none") {
            $pl = 0;
        }

        if (($bl = $style->border_left_width) === "auto" || $bl === "none") {
            $bl = 0;
        }

        $x += (float)$style->length_in_pt(array($ml, $pl, $bl), $cb["w"]);

        $font = $style->font_family;
        $size = $frame_font_size = $style->font_size;
        $word_spacing = $frame->get_text_spacing() + (float)$style->length_in_pt($style->word_spacing);
        $char_spacing = (float)$style->length_in_pt($style->letter_spacing);
        $width = $style->width;

        /*$text = str_replace(
          array("{PAGE_NUM}"),
          array($this->_canvas->get_page_number()),
          $text
        );*/

        $this->_canvas->text($x, $y, $text,
            $font, $size,
            $style->color, $word_spacing, $char_spacing);

        $line = $frame->get_containing_line();

        // FIXME Instead of using the tallest frame to position,
        // the decoration, the text should be well placed
        if (false && $line->tallest_frame) {
            $base_frame = $line->tallest_frame;
            $style = $base_frame->get_style();
            $size = $style->font_size;
        }

        $line_thickness = $size * self::DECO_THICKNESS;
        $underline_offset = $size * self::UNDERLINE_OFFSET;
        $overline_offset = $size * self::OVERLINE_OFFSET;
        $linethrough_offset = $size * self::LINETHROUGH_OFFSET;
        $underline_position = -0.08;

        if ($this->_canvas instanceof CPDF) {
            $cpdf_font = $this->_canvas->get_cpdf()->fonts[$style->font_family];

            if (isset($cpdf_font["UnderlinePosition"])) {
                $underline_position = $cpdf_font["UnderlinePosition"] / 1000;
            }

            if (isset($cpdf_font["UnderlineThickness"])) {
                $line_thickness = $size * ($cpdf_font["UnderlineThickness"] / 1000);
            }
        }

        $descent = $size * $underline_position;
        $base = $size;

        // Handle text decoration:
        // http://www.w3.org/TR/CSS21/text.html#propdef-text-decoration

        // Draw all applicable text-decorations.  Start with the root and work our way down.
        $p = $frame;
        $stack = array();
        while ($p = $p->get_parent()) {
            $stack[] = $p;
        }

        while (isset($stack[0])) {
            $f = array_pop($stack);

            if (($text_deco = $f->get_style()->text_decoration) === "none") {
                continue;
            }

            $deco_y = $y; //$line->y;
            $color = $f->get_style()->color;

            switch ($text_deco) {
                default:
                    continue;

                case "underline":
                    $deco_y += $base - $descent + $underline_offset + $line_thickness / 2;
                    break;

                case "overline":
                    $deco_y += $overline_offset + $line_thickness / 2;
                    break;

                case "line-through":
                    $deco_y += $base * 0.7 + $linethrough_offset;
                    break;
            }

            $dx = 0;
            $x1 = $x - self::DECO_EXTENSION;
            $x2 = $x + $width + $dx + self::DECO_EXTENSION;
            $this->_canvas->line($x1, $deco_y, $x2, $deco_y, $color, $line_thickness);
        }

        if ($this->_dompdf->getOptions()->getDebugLayout() && $this->_dompdf->getOptions()->getDebugLayoutLines()) {
            $text_width = $this->_dompdf->getFontMetrics()->getTextWidth($text, $font, $frame_font_size);
            $this->_debug_layout(array($x, $y, $text_width + ($line->wc - 1) * $word_spacing, $frame_font_size), "orange", array(0.5, 0.5));
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php

namespace Illuminate\Cache\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Illuminate\Filesystem\Filesystem;

class CacheTableCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'cache:table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a migration for the cache database table';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * @var \Illuminate\Support\Composer
     */
    protected $composer;

    /**
     * Create a new cache table command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  \Illuminate\Support\Composer  $composer
     * @return void
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct();

        $this->files = $files;
        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $fullPath = $this->createBaseMigration();

        $this->files->put($fullPath, $this->files->get(__DIR__.'/stubs/cache.stub'));

        $this->info('Migration created successfully!');

        $this->composer->dumpAutoloads();
    }

    /**
     * Create a base migration file for the table.
     *
     * @return string
     */
    protected function createBaseMigration()
    {
        $name = 'create_cache_table';

        $path = $this->laravel->databasePath().'/migrations';

        return $this->laravel['migration.creator']->create($name, $path);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         INDX( 	                 (     �         t s                 ��     � j     ��     �AАb� Z�0H�tTАb��AАb�H      B               C a c h i n g G e n e r a t o r . p h p       ��     � n     ��     �]Аb� Z�0H��rАb��]Аb�       �               D e f i n e d T a r g e t C l a s s . p h p   ��     p \     ��     [|Аb� Z�0H���Аb�R|Аb��       �                G e n e r a t o r . p h p     ��     h V     ��     �Аb� Z�0H���Аb��Аb�       @             
 M e t h o d . p h p   ��     � l     ��     s�Аb� Z�0H���Аb�j�Аb� @      4               M o c k C o n f i g u r a t i o n . p h p     ��     � z     ��     b�Аb� Z�0H�O�Аb�b�Аb�       �               M o c k C o n f i g u r a t i o n B u i l d e r . p h p       ��     x f     ��     ��Аb� Z�0H�J	ѐb���Аb�p      i               M o c k D e f i n i t i o n . p h p   ��     p \     ��     �ѐb� Z�0H��%ѐb��ѐb�       f
               P a r a m e  e r . p h p     ��     x f     ��     �2ѐb� �߁dJ���Ґb��2ѐb�                        S t r i n g M a n i p u l a t i o n   ��     � �     ��     d�Ґb� Z�0H�[�Ґb�\�Ґb�       
               S t r i n g M a n i p u l a t i o n G e n e r a t o r . p h p ��     p `     ��     4�Ґb� Z�0H��Ӑb�.�Ґb��      z               T a r g e t C l a s s . p h p ��     � r     ��     DӐb� Z�0H��,Ӑb�DӐb�       �               U n d e f i n e d T a r g e t C l a  s . p h p                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                --TEST--
https://github.com/sebastianbergmann/phpunit/issues/1348
--SKIPIF--
<?php
if (defined('HHVM_VERSION')) {
    print 'skip: PHP runtime required';
}
?>
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][]  = '--process-isolation';
$_SERVER['argv'][]  = 'Issue1348Test';
$_SERVER['argv'][]  = __DIR__ . '/1348/Issue1348Test.php';

require __DIR__ . '/../../bootstrap.php';
PHPUnit\TextUI\Command::main();
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

.
STDOUT does not break test result
E                                                                  2 / 2 (100%)

Time: %s, Memory: %s

There was 1 error:

1) Issue1348Test::testSTDERR
PHPUnit\Framework\Exception: STDERR works as usual.

ERRORS!
Tests: 2, Assertions: 1, Errors: 1.
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2017 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\Command;

use JakubOnderka\PhpConsoleHighlighter\Highlighter;
use Psy\Configuration;
use Psy\ConsoleColorFactory;
use Psy\Exception\RuntimeException;
use Psy\Formatter\CodeFormatter;
use Psy\Formatter\SignatureFormatter;
use Psy\Output\ShellOutput;
use Symfony\Component\Console\Formatter\OutputFormatter;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Show the code for an object, class, constant, method or property.
 */
class ShowCommand extends ReflectingCommand
{
    private $colorMode;
    private $highlighter;
    private $lastException;
    private $lastExceptionIndex;

    /**
     * @param null|string $colorMode (default: null)
     */
    public function __construct($colorMode = null)
    {
        $this->colorMode = $colorMode ?: Configuration::COLOR_MODE_AUTO;

        return parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('show')
            ->setDefinition(array(
                new InputArgument('value', InputArgument::OPTIONAL, 'Function, class, instance, constant, method or property to show.'),
                new InputOption('ex', null,  InputOption::VALUE_OPTIONAL, 'Show last exception context. Optionally specify a stack index.', 1),
            ))
            ->setDescription('Show the code for an object, class, constant, method or property.')
            ->setHelp(
                <<<HELP
Show the code for an object, class, constant, method or property, or the context
of the last exception.

<return>cat --ex</return> defaults to showing the lines surrounding the location of the last
exception. Invoking it more than once travels up the exception's stack trace,
and providing a number shows the context of the given index of the trace.

e.g.
<return>>>> show \$myObject</return>
<return>>>> show Psy\Shell::debug</return>
<return>>>> show --ex</return>
<return>>>> show --ex 3</return>
HELP
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // n.b. As far as I can tell, InputInterface doesn't want to tell me
        // whether an option with an optional value was actually passed. If you
        // call `$input->getOption('ex')`, it will return the default, both when
        // `--ex` is specified with no value, and when `--ex` isn't specified at
        // all.
        //
        // So we're doing something sneaky here. If we call `getOptions`, it'll
        // return the default value when `--ex` is not present, and `null` if
        // `--ex` is passed with no value. /shrug
        $opts = $input->getOptions();

        // Strict comparison to `1` (the default value) here, because `--ex 1`
        // will come in as `"1"`. Now we can tell the difference between
        // "no --ex present", because it's the integer 1, "--ex with no value",
        // because it's `null`, and "--ex 1", because it's the string "1".
        if ($opts['ex'] !== 1) {
            if ($input->getArgument('value')) {
                throw new \InvalidArgumentException('Too many arguments (supply either "value" or "--ex")');
            }

            return $this->writeExceptionContext($input, $output);
        }

        if ($input->getArgument('value')) {
            return $this->writeCodeContext($input, $output);
        }

        throw new RuntimeException('Not enough arguments (missing: "value").');
    }

    private function writeCodeContext(InputInterface $input, OutputInterface $output)
    {
        list($value, $reflector) = $this->getTargetAndReflector($input->getArgument('value'));

        // Set some magic local variables
        $this->setCommandScopeVariables($reflector);

        try {
            $output->page(CodeFormatter::format($reflector, $this->colorMode), ShellOutput::OUTPUT_RAW);
        } catch (RuntimeException $e) {
            $output->writeln(SignatureFormatter::format($reflector));
            throw $e;
        }
    }

    private function writeExceptionContext(InputInterface $input, OutputInterface $output)
    {
        $exception = $this->context->getLastException();
        if ($exception !== $this->lastException) {
            $this->lastException = null;
            $this->lastExceptionIndex = null;
        }

        $opts = $input->getOptions();
        if ($opts['ex'] === null) {
            if ($this->lastException && $this->lastExceptionIndex !== null) {
                $index = $this->lastExceptionIndex + 1;
            } else {
                $index = 0;
            }
        } else {
            $index = max(0, intval($input->getOption('ex')) - 1);
        }

        $trace = $exception->getTrace();
        array_unshift($trace, array(
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
        ));

        if ($index >= count($trace)) {
            $index = 0;
        }

        $this->lastException = $exception;
        $this->lastExceptionIndex = $index;

        $output->writeln($this->getApplication()->formatException($exception));
        $output->writeln('--');
        $this->writeTraceLine($output, $trace, $index);
        $this->writeTraceCodeSnippet($output, $trace, $index);

        $this->setCommandScopeVariablesFromContext($trace[$index]);
    }

    private function writeTraceLine(OutputInterface $output, array $trace, $index)
    {
        $file = isset($trace[$index]['file']) ? $this->replaceCwd($trace[$index]['file']) : 'n/a';
        $line = isset($trace[$index]['line']) ? $trace[$index]['line'] : 'n/a';

        $output->writeln(sprintf(
            'From <info>%s:%d</info> at <strong>level %d</strong> of backtrace (of %d).',
            OutputFormatter::escape($file),
            OutputFormatter::escape($line),
            $index + 1,
            count($trace)
        ));
    }

    private function replaceCwd($file)
    {
        if ($cwd = getcwd()) {
            $cwd = rtrim($cwd, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        }

        if ($cwd === false) {
            return $file;
        } else {
            return preg_replace('/^' . preg_quote($cwd, '/') . '/', '', $file);
        }
    }

    private function writeTraceCodeSnippet(OutputInterface $output, array $trace, $index)
    {
        if (!isset($trace[$index]['file'])) {
            return;
        }

        $file = $trace[$index]['file'];
        if ($fileAndLine = $this->extractEvalFileAndLine($file)) {
            list($file, $line) = $fileAndLine;
        } else {
            if (!isset($trace[$index]['line'])) {
                return;
            }

            $line = $trace[$index]['line'];
        }

        if (is_file($file)) {
            $code = @file_get_contents($file);
        }

        if (empty($code)) {
            return;
        }

        $output->write($this->getHighlighter()->getCodeSnippet($code, $line, 5, 5), ShellOutput::OUTPUT_RAW);
    }

    private function getHighlighter()
    {
        if (!$this->highlighter) {
            $factory = new ConsoleColorFactory($this->colorMode);
            $this->highlighter = new Highlighter($factory->getConsoleColor());
        }

        return $this->highlighter;
    }

    private function setCommandScopeVariablesFromContext(array $context)
    {
        $vars = array();

        // @todo __namespace?
        if (isset($context['class'])) {
            $vars['__class'] = $context['class'];
            if (isset($context['function'])) {
                $vars['__method'] = $context['function'];
            }
        } elseif (isset($context['function'])) {
            $vars['__function'] = $context['function'];
        }

        if (isset($context['file'])) {
            $file = $context['file'];
            if ($fileAndLine = $this->extractEvalFileAndLine($file)) {
                list($file, $line) = $fileAndLine;
            } elseif (isset($context['line'])) {
                $line = $context['line'];
            }

            if (is_file($file)) {
                $vars['__file'] = $file;
                if (isset($line)) {
                    $vars['__line'] = $line;
                }
                $vars['__dir'] = dirname($file);
            }
        }

        $this->context->setCommandScopeVariables($vars);
    }

    private function extractEvalFileAndLine($file)
    {
        if (preg_match('/(.*)\\((\\d+)\\) : eval\\(\\)\'d code$/', $file, $matches)) {
            return array($matches[1], $matches[2]);
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\DependencyInjection\LoggerPass;
use Symfony\Component\HttpKernel\Log\Logger;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class LoggerPassTest extends TestCase
{
    public function testAlwaysSetAutowiringAlias()
    {
        $container = new ContainerBuilder();
        $container->register('logger', 'Foo');

        (new LoggerPass())->process($container);

        $this->assertFalse($container->getAlias(LoggerInterface::class)->isPublic());
    }

    public function testDoNotOverrideExistingLogger()
    {
        $container = new ContainerBuilder();
        $container->register('logger', 'Foo');

        (new LoggerPass())->process($container);

        $this->assertSame('Foo', $container->getDefinition('logger')->getClass());
    }

    public function testRegisterLogger()
    {
        $container = new ContainerBuilder();
        $container->setParameter('kernel.debug', false);

        (new LoggerPass())->process($container);

        $definition = $container->getDefinition('logger');
        $this->assertSame(Logger::class, $definition->getClass());
        $this->assertFalse($definition->isPublic());
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php

abstract class Swift_Transport_StreamBuffer_AbstractStreamBufferAcceptanceTest extends \PHPUnit\Framework\TestCase
{
    protected $buffer;

    abstract protected function initializeBuffer();

    protected function setUp()
    {
        if (true == getenv('TRAVIS')) {
            $this->markTestSkipped(
                'Will fail on travis-ci if not skipped due to travis blocking '.
                'socket mailing tcp connections.'
             );
        }

        $this->buffer = new Swift_Transport_StreamBuffer(
            $this->getMockBuilder('Swift_ReplacementFilterFactory')->getMock()
        );
    }

    public function testReadLine()
    {
        $this->initializeBuffer();

        $line = $this->buffer->readLine(0);
        $this->assertRegExp('/^[0-9]{3}.*?\r\n$/D', $line);
        $seq = $this->buffer->write("QUIT\r\n");
        $this->assertTrue((bool) $seq);
        $line = $this->buffer->readLine($seq);
        $this->assertRegExp('/^[0-9]{3}.*?\r\n$/D', $line);
        $this->buffer->terminate();
    }

    public function testWrite()
    {
        $this->initializeBuffer();

        $line = $this->buffer->readLine(0);
        $this->assertRegExp('/^[0-9]{3}.*?\r\n$/D', $line);

        $seq = $this->buffer->write("HELO foo\r\n");
        $this->assertTrue((bool) $seq);
        $line = $this->buffer->readLine($seq);
        $this->assertRegExp('/^[0-9]{3}.*?\r\n$/D', $line);

        $seq = $this->buffer->write("QUIT\r\n");
        $this->assertTrue((bool) $seq);
        $line = $this->buffer->readLine($seq);
        $this->assertRegExp('/^[0-9]{3}.*?\r\n$/D', $line);
        $this->buffer->terminate();
    }

    public function testBindingOtherStreamsMirrorsWriteOperations()
    {
        $this->initializeBuffer();

        $is1 = $this->createMockInputStream();
        $is2 = $this->createMockInputStream();

        $is1->expects($this->at(0))
            ->method('write')
            ->with('x');
        $is1->expects($this->at(1))
            ->method('write')
            ->with('y');
        $is2->expects($this->at(0))
            ->method('write')
            ->with('x');
        $is2->expects($this->at(1))
            ->method('write')
            ->with('y');

        $this->buffer->bind($is1);
        $this->buffer->bind($is2);

        $this->buffer->write('x');
        $this->buffer->write('y');
    }

    public function testBindingOtherStreamsMirrorsFlushOperations()
    {
        $this->initializeBuffer();

        $is1 = $this->createMockInputStream();
        $is2 = $this->createMockInputStream();

        $is1->expects($this->once())
            ->method('flushBuffers');
        $is2->expects($this->once())
            ->method('flushBuffers');

        $this->buffer->bind($is1);
        $this->buffer->bind($is2);

        $this->buffer->flushBuffers();
    }

    public function testUnbindingStreamPreventsFurtherWrites()
    {
        $this->initializeBuffer();

        $is1 = $this->createMockInputStream();
        $is2 = $this->createMockInputStream();

        $is1->expects($this->at(0))
            ->method('write')
            ->with('x');
        $is1->expects($this->at(1))
            ->method('write')
            ->with('y');
        $is2->expects($this->once())
            ->method('write')
            ->with('x');

        $this->buffer->bind($is1);
        $this->buffer->bind($is2);

        $this->buffer->write('x');

        $this->buffer->unbind($is2);

        $this->buffer->write('y');
    }

    private function createMockInputStream()
    {
        return $this->getMockBuilder('Swift_InputByteStream')->getMock();
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php

namespace Illuminate\Mail\Transport;

use Psr\Log\LoggerInterface;
use Swift_Mime_SimpleMessage;
use Swift_Mime_SimpleMimeEntity;

class LogTransport extends Transport
{
    /**
     * The Logger instance.
     *
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * Create a new log transport instance.
     *
     * @param  \Psr\Log\LoggerInterface  $logger
     * @return void
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        $this->beforeSendPerformed($message);

        $this->logger->debug($this->getMimeEntityString($message));

        $this->sendPerformed($message);

        return $this->numberOfRecipients($message);
    }

    /**
     * Get a loggable string out of a Swiftmailer entity.
     *
     * @param  \Swift_Mime_SimpleMimeEntity $entity
     * @return string
     */
    protected function getMimeEntityString(Swift_Mime_SimpleMimeEntity $entity)
    {
        $string = (string) $entity->getHeaders().PHP_EOL.$entity->getBody();

        foreach ($entity->getChildren() as $children) {
            $string .= PHP_EOL.PHP_EOL.$this->getMimeEntityString($children);
        }

        return $string;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <?php

namespace Faker\Test\Provider;

use Faker\Calculator\Iban;
use Faker\Calculator\Luhn;
use Faker\Generator;
use Faker\Provider\Base as BaseProvider;
use Faker\Provider\DateTime as DateTimeProvider;
use Faker\Provider\Payment as PaymentProvider;
use Faker\Provider\Person as PersonProvider;

class PaymentTest extends \PHPUnit_Framework_TestCase
{
    private $faker;

    public function setUp()
    {
        $faker = new Generator();
        $faker->addProvider(new BaseProvider($faker));
        $faker->addProvider(new DateTimeProvider($faker));
        $faker->addProvider(new PersonProvider($faker));
        $faker->addProvider(new PaymentProvider($faker));
        $this->faker = $faker;
    }

    public function localeDataProvider()
    {
        $providerPath = realpath(__DIR__ . '/../../../src/Faker/Provider');
        $localePaths = array_filter(glob($providerPath . '/*', GLOB_ONLYDIR));
        foreach ($localePaths as $path) {
            $parts = explode('/', $path);
            $locales[] = array($parts[count($parts) - 1]);
        }

        return $locales;
    }

    public function loadLocalProviders($locale)
    {
        $providerPath = realpath(__DIR__ . '/../../../src/Faker/Provider');
        if (file_exists($providerPath.'/'.$locale.'/Payment.php')) {
            $payment = "\\Faker\\Provider\\$locale\\Payment";
            $this->faker->addProvider(new $payment($this->faker));
        }
    }

    public function testCreditCardTypeReturnsValidVendorName()
    {
        $this->assertTrue(in_array($this->faker->creditCardType, array('Visa', 'MasterCard', 'American Express', 'Discover Card')));
    }

    public function creditCardNumberProvider()
    {
        return array(
            array('Discover Card', '/^6011\d{12}$/'),
            array('Visa', '/^4\d{12,15}$/'),
            array('MasterCard', '/^(5[1-5]|2[2-7])\d{14}$/')
        );
    }

    /**
     * @dataProvider creditCardNumberProvider
     */
    public function testCreditCardNumberReturnsValidCreditCardNumber($type, $regexp)
    {
        $cardNumber = $this->faker->creditCardNumber($type);
        $this->assertRegExp($regexp, $cardNumber);
        $this->assertTrue(Luhn::isValid($cardNumber));
    }

    public function testCreditCardNumberCanFormatOutput()
    {
        $this->assertRegExp('/^6011-\d{4}-\d{4}-\d{4}$/', $this->faker->creditCardNumber('Discover Card', true));
    }

    public function testCreditCardExpirationDateReturnsValidDateByDefault()
    {
        $expirationDate = $this->faker->creditCardExpirationDate;
        $this->assertTrue(intval($expirationDate->format('U')) > strtotime('now'));
        $this->assertTrue(intval($expirationDate->format('U')) < strtotime('+36 months'));
    }

    public function testRandomCard()
    {
        $cardDetails = $this->faker->creditCardDetails;
        $this->assertEquals(count($cardDetails), 4);
        $this->assertEquals(array('type', 'number', 'name', 'expirationDate'), array_keys($cardDetails));
    }

    protected $ibanFormats = array(
        'AD' => '/^AD\d{2}\d{4}\d{4}[A-Z0-9]{12}$/',
        'AE' => '/^AE\d{2}\d{3}\d{16}$/',
        'AL' => '/^AL\d{2}\d{8}[A-Z0-9]{16}$/',
        'AT' => '/^AT\d{2}\d{5}\d{11}$/',
        'AZ' => '/^AZ\d{2}[A-Z]{4}[A-Z0-9]{20}$/',
        'BA' => '/^BA\d{2}\d{3}\d{3}\d{8}\d{2}$/',
        'BE' => '/^BE\d{2}\d{3}\d{7}\d{2}$/',
        'BG' => '/^BG\d{2}[A-Z]{4}\d{4}\d{2}[A-Z0-9]{8}$/',
        'BH' => '/^BH\d{2}[A-Z]{4}[A-Z0-9]{14}$/',
        'BR' => '/^BR\d{2}\d{8}\d{5}\d{10}[A-Z]{1}[A-Z0-9]{1}$/',
        'CH' => '/^CH\d{2}\d{5}[A-Z0-9]{12}$/',
        'CR' => '/^CR\d{2}\d{3}\d{14}$/',
        'CY' => '/^CY\d{2}\d{3}\d{5}[A-Z0-9]{16}$/',
        'CZ' => '/^CZ\d{2}\d{4}\d{6}\d{10}$/',
        'DE' => '/^DE\d{2}\d{8}\d{10}$/',
        'DK' => '/^DK\d{2}\d{4}\d{9}\d{1}$/',
        'DO' => '/^DO\d{2}[A-Z0-9]{4}\d{20}$/',
        'EE' => '/^EE\d{2}\d{2}\d{2}\d{11}\d{1}$/',
        'ES' => '/^ES\d{2}\d{4}\d{4}\d{1}\d{1}\d{10}$/',
        'FI' => '/^FI\d{2}\d{6}\d{7}\d{1}$/',
        'FR' => '/^FR\d{2}\d{5}\d{5}[A-Z0-9]{11}\d{2}$/',
        'GB' => '/^GB\d{2}[A-Z]{4}\d{6}\d{8}$/',
        'GE' => '/^GE\d{2}[A-Z]{2}\d{16}$/',
        'GI' => '/^GI\d{2}[A-Z]{4}[A-Z0-9]{15}$/',
        'GR' => '/^GR\d{2}\d{3}\d{4}[A-Z0-9]{16}$/',
        'GT' => '/^GT\d{2}[A-Z0-9]{4}[A-Z0-9]{20}$/',
        'HR' => '/^HR\d{2}\d{7}\d{10}$/',
        'HU' => '/^HU\d{2}\d{3}\d{4}\d{1}\d{15}\d{1}$/',
        'IE' => '/^IE\d{2}[A-Z]{4}\d{6}\d{8}$/',
        'IL' => '/^IL\d{2}\d{3}\d{3}\d{13}$/',
        'IS' => '/^IS\d{2}\d{4}\d{2}\d{6}\d{10}$/',
        'IT' => '/^IT\d{2}[A-Z]{1}\d{5}\d{5}[A-Z0-9]{12}$/',
        'KW' => '/^KW\d{2}[A-Z]{4}\d{22}$/',
        'KZ' => '/^KZ\d{2}\d{3}[A-Z0-9]{13}$/',
        'LB' => '/^LB\d{2}\d{4}[A-Z0-9]{20}$/',
        'LI' => '/^LI\d{2}\d{5}[A-Z0-9]{12}$/',
        'LT' => '/^LT\d{2}\d{5}\d{11}$/',
        'LU' => '/^LU\d{2}\d{3}[A-Z0-9]{13}$/',
        'LV' => '/^LV\d{2}[A-Z]{4}[A-Z0-9]{13}$/',
        'MC' => '/^MC\d{2}\d{5}\d{5}[A-Z0-9]{11}\d{2}$/',
        'MD' => '/^MD\d{2}[A-Z0-9]{2}[A-Z0-9]{18}$/',
        'ME' => '/^ME\d{2}\d{3}\d{13}\d{2}$/',
        'MK' => '/^MK\d{2}\d{3}[A-Z0-9]{10}\d{2}$/',
        'MR' => '/^MR\d{2}\d{5}\d{5}\d{11}\d{2}$/',
        'MT' => '/^MT\d{2}[A-Z]{4}\d{5}[A-Z0-9]{18}$/',
        'MU' => '/^MU\d{2}[A-Z]{4}\d{2}\d{2}\d{12}\d{3}[A-Z]{3}$/',
        'NL' => '/^NL\d{2}[A-Z]{4}\d{10}$/',
        'NO' => '/^NO\d{2}\d{4}\d{6}\d{1}$/',
        'PK' => '/^PK\d{2}[A-Z]{4}[A-Z0-9]{16}$/',
        'PL' => '/^PL\d{2}\d{8}\d{16}$/',
        'PS' => '/^PS\d{2}[A-Z]{4}[A-Z0-9]{21}$/',
        'PT' => '/^PT\d{2}\d{4}\d{4}\d{11}\d{2}$/',
        'RO' => '/^RO\d{2}[A-Z]{4}[A-Z0-9]{16}$/',
        'RS' => '/^RS\d{2}\d{3}\d{13}\d{2}$/',
        'SA' => '/^SA\d{2}\d{2}[A-Z0-9]{18}$/',
        'SE' => '/^SE\d{2}\d{3}\d{16}\d{1}$/',
        'SI' => '/^SI\d{2}\d{5}\d{8}\d{2}$/',
        'SK' => '/^SK\d{2}\d{4}\d{6}\d{10}$/',
        'SM' => '/^SM\d{2}[A-Z]{1}\d{5}\d{5}[A-Z0-9]{12}$/',
        'TN' => '/^TN\d{2}\d{2}\d{3}\d{13}\d{2}$/',
        'TR' => '/^TR\d{2}\d{5}\d{1}[A-Z0-9]{16}$/',
        'VG' => '/^VG\d{2}[A-Z]{4}\d{16}$/',
    );

    /**
     * @dataProvider localeDataProvider
     */
    public function testBankAccountNumber($locale)
    {
        $parts = explode('_', $locale);
        $countryCode = array_pop($parts);

        if (!isset($this->ibanFormats[$countryCode])) {
            // No IBAN format available
            return;
        }

        $this->loadLocalProviders($locale);

        try {
            $iban = $this->faker->bankAccountNumber;
        } catch (\InvalidArgumentException $e) {
            // Not implemented, nothing to test
            $this->markTestSkipped("bankAccountNumber not implemented for $locale");
            return;
        }

        // Test format
        $this->assertRegExp($this->ibanFormats[$countryCode], $iban);

        // Test checksum
        $this->assertTrue(Iban::isValid($iban), "Checksum for $iban is invalid");
    }

    public function ibanFormatProvider()
    {
        $return = array();
        foreach ($this->ibanFormats as $countryCode => $regex) {
            $return[] = array($countryCode, $regex);
        }
        return $return;
    }
    /**
     * @dataProvider ibanFormatProvider
     */
    public function testIban($countryCode, $regex)
    {
        $iban = $this->faker->iban($countryCode);

        // Test format
        $this->assertRegExp($regex, $iban);

        // Test checksum
        $this->assertTrue(Iban::isValid($iban), "Checksum for $iban is invalid");
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               INDX( 	                 (      �      ` l     t ���        :    x h     9    `+}�b� 8i�Ϯ��?}�b�`+}�b�                      A r r a y H a s K e y T e s t . p h p ;    x h     9    vI}�b� 8i�Ϯ��]}�b�tI}�b�       �               A r r a y S u b s e t T e s t . p h p <    x d     9    h}�b� 8i�Ϯ�|}�b� h}�b�       �               A t t r i b u t e T e s t . p h p     =    x b     9    ��}�b� 8i�Ϯ���}�b���}�b�       �               C a ` l b a c k T e s t . p h p       >    � t     9    t�}�b� 8i�Ϯ�ƹ}�b�r�}�b�       F               C l a s s H a s A t t r i b u t e T e s t . p h p     ?    � �     9    ��}�b� 8i�Ϯ���}�b�|�}�b�       E               C l a s s H a s S t a t i c A t t r i b u t e T e s t . p h p @    � n     9    �}�b� 8i�Ϯ���}�b��}�b�       �               C o n s t r a i n t T e s t C a s e . p h p   A    p \     9    R ~�b� 8i�Ϯ�k~�b�N ~�b�        {    `          C o u n t T e s t . p h p     B    � p     9    " ~�b� 8i�Ϯ�5~�b� ~�b�       �               D i r e c t o r y E x i s t s T e s t . p h p C    � ~     9    I?~�b� 8i�Ϯ�1X~�b�F?~�b�       �               E x c e p t i o n M e s s a g e R e g E x p T e s t . p h p   D    � r     9    c~�b� 8i�Ϯ�F{~�b��b~�b�       �               E x c e p t i o n M e s s a g e T e s t . p h p       E    x f     9    `�~�b� 8i�Ϯ��~�b�Z�~�b�     ` �               F i l e E x i s t s T e s t . p h p   F    x h     9    �~�b� 8i�Ϯ�ڷ~�b�ܣ~�b�       ?               G r e a t e r T h a n T e s t . p h p G    p `     9    ��~�b� 8i�Ϯ�X�~�b���~�b�       �               I s E m p t y T e s t . p h p H    p `     9    =�~�b� 8i�Ϯ�~�~�b�:�~�b�        �               I s E q u a l T e s t . p h p I    x h     9    C�b� 8i�Ϯ�G�b�B�b�        �               I s I d e n t i c a l T e s ` . p h p               9    '!�b� 8i�Ϯ��5�b�"!�b�                      I s J s o n T e s t . p h p   K    p ^     9    T?�b� 8i�Ϯ�"S�b�T?�b�       	               I s N u l l T e s t . p h p   L    x f     9    �]�b� 8i�Ϯ�s�b��]�b�                      I s R e a d a b l e T e s t . p h p   M    p ^     9    +}�b� 8i�Ϯ�U��b�*}�b�       
               I s T y p e T e s t . p h p   N    x f     9    j��b� 8i�Ϯ�;��b` j��b�                      I s W r i t a b l e T e s t . p h p   O    � �     9    1��b� 8i�Ϯ����b�(��b�       6              ' J s o n M a t c h e s E r r o r M e s s a g e P r o v i d e r T e s t . p h p P    x h     9    ���b� 8i�Ϯ�>��b����b�        �               J s o n M a t c h e s T e s t . p h p Q    x b     9    9��b� 8i�Ϯ����b�4��b�       '               L e s s T h a n T e s t . p h p       R    x f     9    	��b� 8i�Ϯ` �0��b���b�        �               L o g i c a l A n d T e s t . p h p   S    x d     9    �:��b� 8i�Ϯ�eP��b��:��b�        �               L o g i c a l O r T e s t . p h p     T    x f     9    �Z��b� 8i�Ϯ��m��b�~Z��b�       �               L o g i c a l X o r T e s t . p h p   U    � v     9    Qx��b� 8i�Ϯ�ǋ��b�Lx��b�       '               O b j e c t H a s A t t r i b u t e T e s t . p h p   V    � t     9    ҕ��b� 8i�Ϯ� ���b�ʕ��b`        �               R e g u l a r E x p r e s s i o n T e s t . p h p     W    x b     9    ����b� 8i�Ϯ�Ȁ�b�����b�       v               S a m e S i z e T e s t . p h p       X    � n     9    �р�b� 8i�Ϯ�)怚b��р�b�       [               S t r i n g C o n t a i n s T e s t . p h p   Y    � n     9    �b� 8i�Ϯ����b��b�       	               S t r i n g E n d s W i t h T e s t . p h p                                                       ` INDX( 	                (   8	  �       T l i o               K    p ^     9    T?�b� 8i�Ϯ�"S�b�T?�b�       	               I s N u l l T e s t . p h p   L    x f     9    �]�b� 8i�Ϯ�s�b��]�b�                      I s R e a d a b l e T e s t . p h p   M    p ^     9    +}�b� 8i�Ϯ�U��b�*}�b�       
               I s T y p e T e s t . p h p   N    x f     9    j��b� 8i�Ϯ�;��b�j��b�                      I s W r i t a b l e  e s t . p h p   O    � �     9    1��b� 8i�Ϯ����b�(��b�       6              ' J s o n M a t c h e s E r r o r M e s s a g e P r o v i d e r T e s t . p h p P    x h     9    ���b� 8i�Ϯ�>��b����b�        �               J s o n M a t c h e s T e s t . p h p Q    x b     9    9��b� 8i�Ϯ����b�4��b�       '               L e s s T h a n T e s t . p h p       R    x f     9    	��b� 8i�Ϯ��0��b���b�        �               L o g i c a  A n d T e s t . p h p   S    x d     9    �:��b� 8i�Ϯ�eP��b��:��b�        �               L o g i c a l O r T e s t . p h p     T    x f     9    �Z��b� 8i�Ϯ��m��b�~Z��b�       �               L o g i c a l X o r T e s t . p h p   U    � v     9    Qx��b� 8i�Ϯ�ǋ��b�Lx��b�       '               O b j e c t H a s A t t r i b u t e T e s t . p h p   V    � t     9    ҕ��b� 8i�Ϯ� ���b�ʕ��b�       �               R e g u l a r E x p r e s s  o n T e s t . p h p     W    x b     9    ����b� 8i�Ϯ�Ȁ�b�����b�       v               S a m e S i z e T e s t . p h p       X    � n     9    �р�b� 8i�Ϯ�)怚b��р�b�       [               S t r i n g C o n t a i n s T e s t . p h p   Y    � n     9    �b� 8i�Ϯ����b��b�       	               S t r i n g E n d s W i t h T e s t . p h p   Z    � �     9    ���b� 8i�Ϯ��"��b����b�                     & S t r i n g M a t c h e s F  r m a t D e s c r i p t i o n T e s t . p h p   [    � r     9    �,��b� 8i�Ϯ��@��b��,��b�       (	               S t r i n g S t a r t s W i t h T e s t . p h p       \    � x     9    cL��b� 8i�Ϯ�sb��b�^L��b�        �               T r a v e r s a b l e C o n t a i n s T e s t . p h p                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php

namespace Illuminate\Routing;

use Closure;
use ArrayObject;
use JsonSerializable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Container\Container;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\Routing\BindingRegistrar;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use Illuminate\Contracts\Routing\Registrar as RegistrarContract;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class Router implements RegistrarContract, BindingRegistrar
{
    use Macroable {
        __call as macroCall;
    }

    /**
     * The event dispatcher instance.
     *
     * @var \Illuminate\Contracts\Events\Dispatcher
     */
    protected $events;

    /**
     * The IoC container instance.
     *
     * @var \Illuminate\Container\Container
     */
    protected $container;

    /**
     * The route collection instance.
     *
     * @var \Illuminate\Routing\RouteCollection
     */
    protected $routes;

    /**
     * The currently dispatched route instance.
     *
     * @var \Illuminate\Routing\Route
     */
    protected $current;

    /**
     * The request currently being dispatched.
     *
     * @var \Illuminate\Http\Request
     */
    protected $currentRequest;

    /**
     * All of the short-hand keys for middlewares.
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * All of the middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [];

    /**
     * The priority-sorted list of middleware.
     *
     * Forces the listed middleware to always be in the given order.
     *
     * @var array
     */
    public $middlewarePriority = [];

    /**
     * The registered route value binders.
     *
     * @var array
     */
    protected $binders = [];

    /**
     * The globally available parameter patterns.
     *
     * @var array
     */
    protected $patterns = [];

    /**
     * The route group attribute stack.
     *
     * @var array
     */
    protected $groupStack = [];

    /**
     * All of the verbs supported by the router.
     *
     * @var array
     */
    public static $verbs = ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'];

    /**
     * Create a new Router instance.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @param  \Illuminate\Container\Container  $container
     * @return void
     */
    public function __construct(Dispatcher $events, Container $container = null)
    {
        $this->events = $events;
        $this->routes = new RouteCollection;
        $this->container = $container ?: new Container;
    }

    /**
     * Register a new GET route with the router.
     *
     * @param  string  $uri
     * @param  \Closure|array|string|null  $action
     * @return \Illuminate\Routing\Route
     */
    public function get($uri, $action = null)
    {
        return $this->addRoute(['GET', 'HEAD'], $uri, $action);
    }

    /**
     * Register a new POST route with the router.
     *
     * @param  string  $uri
     * @param  \Closure|array|string|null  $action
     * @return \Illuminate\Routing\Route
     */
    public function post($uri, $action = null)
    {
        return $this->addRoute('POST', $uri, $action);
    }

    /**
     * Register a new PUT route with the router.
     *
     * @param  string  $uri
     * @param  \Closure|array|string|null  $action
     * @return \Illuminate\Routing\Route
     */
    public function put($uri, $action = null)
    {
        return $this->addRoute('PUT', $uri, $action);
    }

    /**
     * Register a new PATCH route with the router.
     *
     * @param  string  $uri
     * @param  \Closure|array|string|null  $action
     * @return \Illuminate\Routing\Route
     */
    public function patch($uri, $action = null)
    {
        return $this->addRoute('PATCH', $uri, $action);
    }

    /**
     * Register a new DELETE route with the router.
     *
     * @param  string  $uri
     * @param  \Closure|array|string|null  $action
     * @return \Illuminate\Routing\Route
     */
    public function delete($uri, $action = null)
    {
        return $this->addRoute('DELETE', $uri, $action);
    }

    /**
     * Register a new OPTIONS route with the router.
     *
     * @param  string  $uri
     * @param  \Closure|array|string|null  $action
     * @return \Illuminate\Routing\Route
     */
    public function options($uri, $action = null)
    {
        return $this->addRoute('OPTIONS', $uri, $action);
    }

    /**
     * Register a new route responding to all verbs.
     *
     * @param  string  $uri
     * @param  \Closure|array|string|null  $action
     * @return \Illuminate\Routing\Route
     */
    public function any($uri, $action = null)
    {
        return $this->addRoute(self::$verbs, $uri, $action);
    }

    /**
     * Register a new Fallback route with the router.
     *
     * @param  \Closure|array|string|null  $action
     * @return \Illuminate\Routing\Route
     */
    public function fallback($action)
    {
        $placeholder = 'fallbackPlaceholder';

        return $this->addRoute(
            'GET', "{{$placeholder}}", $action
        )->where($placeholder, '.*')->fallback();
    }

    /**
     * Create a redirect from one URI to another.
     *
     * @param string  $uri
     * @param string  $destination
     * @param int  $status
     * @return \Illuminate\Routing\Route
     */
    public function redirect($uri, $destination, $status = 301)
    {
        return $this->any($uri, '\Illuminate\Routing\RedirectController')
                ->defaults('destination', $destination)
                ->defaults('status', $status);
    }

    /**
     * Register a new route that returns a view.
     *
     * @param  string  $uri
     * @param  string  $view
     * @param  array  $data
     * @return \Illuminate\Routing\Route
     */
    public function view($uri, $view, $data = [])
    {
        return $this->match(['GET', 'HEAD'], $uri, '\Illuminate\Routing\ViewController')
                ->defaults('view', $view)
                ->defaults('data', $data);
    }

    /**
     * Register a new route with the given verbs.
     *
     * @param  array|string  $methods
     * @param  string  $uri
     * @param  \Closure|array|string|null  $action
     * @return \Illuminate\Routing\Route
     */
    public function match($methods, $uri, $action = null)
    {
        return $this->addRoute(array_map('strtoupper', (array) $methods), $uri, $action);
    }

    /**
     * Register an array of resource controllers.
     *
     * @param  array  $resources
     * @return void
     */
    public function resources(array $resources)
    {
        foreach ($resources as $name => $controller) {
            $this->resource($name, $controller);
        }
    }

    /**
     * Route a resource to a controller.
     *
     * @param  string  $name
     * @param  string  $controller
     * @param  array  $options
     * @return \Illuminate\Routing\PendingResourceRegistration
     */
    public function resource($name, $controller, array $options = [])
    {
        if ($this->container && $this->container->bound(ResourceRegistrar::class)) {
            $registrar = $this->container->make(ResourceRegistrar::class);
        } else {
            $registrar = new ResourceRegistrar($this);
        }

        return new PendingResourceRegistration(
            $registrar, $name, $controller, $options
        );
    }

    /**
     * Route an api resource to a controller.
     *
     * @param  string  $name
     * @param  string  $controller
     * @param  array  $options
     * @return \Illuminate\Routing\PendingResourceRegistration
     */
    public function apiResource($name, $controller, array $options = [])
    {
        return $this->resource($name, $controller, array_merge([
            'only' => ['index', 'show', 'store', 'update', 'destroy'],
        ], $options));
    }

    /**
     * Create a route group with shared attributes.
     *
     * @param  array  $attributes
     * @param  \Closure|string  $routes
     * @return void
     */
    public function group(array $attributes, $routes)
    {
        $this->updateGroupStack($attributes);

        // Once we have updated the group stack, we'll load the provided routes and
        // merge in the group's attributes when the routes are created. After we
        // have created the routes, we will pop the attributes off the stack.
        $this->loadRoutes($routes);

        array_pop($this->groupStack);
    }

    /**
     * Update the group stack with the given attributes.
     *
     * @param  array  $attributes
     * @return void
     */
    protected function updateGroupStack(array $attributes)
    {
        if (! empty($this->groupStack)) {
            $attributes = RouteGroup::merge($attributes, end($this->groupStack));
        }

        $this->groupStack[] = $attributes;
    }

    /**
     * Merge the given array with the last group stack.
     *
     * @param  array  $new
     * @return array
     */
    public function mergeWithLastGroup($new)
    {
        return RouteGroup::merge($new, end($this->groupStack));
    }

    /**
     * Load the provided routes.
     *
     * @param  \Closure|string  $routes
     * @return void
     */
    protected function loadRoutes($routes)
    {
        if ($routes instanceof Closure) {
            $routes($this);
        } else {
            $router = $this;

            require $routes;
        }
    }

    /**
     * Get the prefix from the last group on the stack.
     *
     * @return string
     */
    public function getLastGroupPrefix()
    {
        if (! empty($this->groupStack)) {
            $last = end($this->groupStack);

            return $last['prefix'] ?? '';
        }

        return '';
    }

    /**
     * Add a route to the underlying route collection.
     *
     * @param  array|string  $methods
     * @param  string  $uri
     * @param  \Closure|array|string|null  $action
     * @return \Illuminate\Routing\Route
     */
    protected function addRoute($methods, $uri, $action)
    {
        return $this->routes->add($this->createRoute($methods, $uri, $action));
    }

    /**
     * Create a new route instance.
     *
     * @param  array|string  $methods
     * @param  string  $uri
     * @param  mixed  $action
     * @return \Illuminate\Routing\Route
     */
    protected function createRoute($methods, $uri, $action)
    {
        // If the route is routing to a controller we will parse the route action into
        // an acceptable array format before registering it and creating this route
        // instance itself. We need to build the Closure that will call this out.
        if ($this->actionReferencesController($action)) {
            $action = $this->convertToControllerAction($action);
        }

        $route = $this->newRoute(
            $methods, $this->prefix($uri), $action
        );

        // If we have groups that need to be merged, we will merge them now after this
        // route has already been created and is ready to go. After we're done with
        // the merge we will be ready to return the route back out to the caller.
        if ($this->hasGroupStack()) {
            $this->mergeGroupAttributesIntoRoute($route);
        }

        $this->addWhereClausesToRoute($route);

        return $route;
    }

    /**
     * Determine if the action is routing to a controller.
     *
     * @param  array  $action
     * @return bool
     */
    protected function actionReferencesController($action)
    {
        if (! $action instanceof Closure) {
            return is_string($action) || (isset($action['uses']) && is_string($action['uses']));
        }

        return false;
    }

    /**
     * Add a controller based route action to the action array.
     *
     * @param  array|string  $action
     * @return array
     */
    protected function convertToControllerAction($action)
    {
        if (is_string($action)) {
            $action = ['uses' => $action];
        }

        // Here we'll merge any group "uses" statement if necessary so that the action
        // has the proper clause for this property. Then we can simply set the name
        // of the controller on the action and return the action array for usage.
        if (! empty($this->groupStack)) {
            $action['uses'] = $this->prependGroupNamespace($action['uses']);
        }

        // Here we will set this controller name on the action array just so we always
        // have a copy of it for reference if we need it. This can be used while we
        // search for a controller name or do some other type of fetch operation.
        $action['controller'] = $action['uses'];

        return $action;
    }

    /**
     * Prepend the last group namespace onto the use clause.
     *
     * @param  string  $class
     * @return string
     */
    protected function prependGroupNamespace($class)
    {
        $group = end($this->groupStack);

        return isset($group['namespace']) && strpos($class, '\\') !== 0
                ? $group['namespace'].'\\'.$class : $class;
    }

    /**
     * Create a new Route object.
     *
     * @param  array|string  $methods
     * @param  string  $uri
     * @param  mixed  $action
     * @return \Illuminate\Routing\Route
     */
    protected function newRoute($methods, $uri, $action)
    {
        return (new Route($methods, $uri, $action))
                    ->setRouter($this)
                    ->setContainer($this->container);
    }

    /**
     * Prefix the given URI with the last prefix.
     *
     * @param  string  $uri
     * @return string
     */
    protected function prefix($uri)
    {
        return trim(trim($this->getLastGroupPrefix(), '/').'/'.trim($uri, '/'), '/') ?: '/';
    }

    /**
     * Add the necessary where clauses to the route based on its initial registration.
     *
     * @param  \Illuminate\Routing\Route  $route
     * @return \Illuminate\Routing\Route
     */
    protected function addWhereClausesToRoute($route)
    {
        $route->where(array_merge(
            $this->patterns, $route->getAction()['where'] ?? []
        ));

        return $route;
    }

    /**
     * Merge the group stack with the controller action.
     *
     * @param  \Illuminate\Routing\Route  $route
     * @return void
     */
    protected function mergeGroupAttributesIntoRoute($route)
    {
        $route->setAction($this->mergeWithLastGroup($route->getAction()));
    }

    /**
     * Return the response returned by the given route.
     *
     * @param  string  $name
     * @return mixed
     */
    public function respondWithRoute($name)
    {
        $route = tap($this->routes->getByName($name))->bind($this->currentRequest);

        return $this->runRoute($this->currentRequest, $route);
    }

    /**
     * Dispatch the request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function dispatch(Request $request)
    {
        $this->currentRequest = $request;

        return $this->dispatchToRoute($request);
    }

    /**
     * Dispatch the request to a route and return the response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function dispatchToRoute(Request $request)
    {
        return $this->runRoute($request, $this->findRoute($request));
    }

    /**
     * Find the route matching a given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Route
     */
    protected function findRoute($request)
    {
        $this->current = $route = $this->routes->match($request);

        $this->container->instance(Route::class, $route);

        return $route;
    }

    /**
     * Return the response for the given route.
     *
     * @param  Route  $route
     * @param  Request  $request
     * @return mixed
     */
    protected function runRoute(Request $request, Route $route)
    {
        $request->setRouteResolver(function () use ($route) {
            return $route;
        });

        $this->events->dispatch(new Events\RouteMatched($route, $request));

        return $this->prepareResponse($request,
            $this->runRouteWithinStack($route, $request)
        );
    }

    /**
     * Run the given route within a Stack "onion" instance.
     *
     * @param  \Illuminate\Routing\Route  $route
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function runRouteWithinStack(Route $route, Request $request)
    {
        $shouldSkipMiddleware = $this->container->bound('middleware.disable') &&
                                $this->container->make('middleware.disable') === true;

        $middleware = $shouldSkipMiddleware ? [] : $this->gatherRouteMiddleware($route);

        return (new Pipeline($this->container))
                        ->send($request)
                        ->through($middleware)
                        ->then(function ($request) use ($route) {
                            return $this->prepareResponse(
                                $request, $route->run()
                            );
                        });
    }

    /**
     * Gather the middleware for the given route with resolved class names.
     *
     * @param  \Illuminate\Routing\Route  $route
     * @return array
     */
    public function gatherRouteMiddleware(Route $route)
    {
        $middleware = collect($route->gatherMiddleware())->map(function ($name) {
            return (array) MiddlewareNameResolver::resolve($name, $this->middleware, $this->middlewareGroups);
        })->flatten();

        return $this->sortMiddleware($middleware);
    }

    /**
     * Sort the given middleware by priority.
     *
     * @param  \Illuminate\Support\Collection  $middlewares
     * @return array
     */
    protected function sortMiddleware(Collection $middlewares)
    {
        return (new SortedMiddleware($this->middlewarePriority, $middlewares))->all();
    }

    /**
     * Create a response instance from the given value.
     *
     * @param  \Symfony\Component\HttpFoundation\Request  $request
     * @param  mixed  $response
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function prepareResponse($request, $response)
    {
        return static::toResponse($request, $response);
    }

    /**
     * Static version of prepareResponse.
     *
     * @param  \Symfony\Component\HttpFoundation\Request  $request
     * @param  mixed  $response
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public static function toResponse($request, $response)
    {
        if ($response instanceof Responsable) {
            $response = $response->toResponse($request);
        }

        if ($response instanceof PsrResponseInterface) {
            $response = (new HttpFoundationFactory)->createResponse($response);
        } elseif (! $response instanceof SymfonyResponse &&
                   ($response instanceof Arrayable ||
                    $response instanceof Jsonable ||
                    $response instanceof ArrayObject ||
                    $response instanceof JsonSerializable ||
                    is_array($response))) {
            $response = new JsonResponse($response);
        } elseif (! $response instanceof SymfonyResponse) {
            $response = new Response($response);
        }

        if ($response->getStatusCode() === Response::HTTP_NOT_MODIFIED) {
            $response->setNotModified();
        }

        return $response->prepare($request);
    }

    /**
     * Substitute the route bindings onto the route.
     *
     * @param  \Illuminate\Routing\Route  $route
     * @return \Illuminate\Routing\Route
     */
    public function substituteBindings($route)
    {
        foreach ($route->parameters() as $key => $value) {
            if (isset($this->binders[$key])) {
                $route->setParameter($key, $this->performBinding($key, $value, $route));
            }
        }

        return $route;
    }

    /**
     * Substitute the implicit Eloquent model bindings for the route.
     *
     * @param  \Illuminate\Routing\Route  $route
     * @return void
     */
    public function substituteImplicitBindings($route)
    {
        ImplicitRouteBinding::resolveForRoute($this->container, $route);
    }

    /**
     * Call the binding callback for the given key.
     *
     * @param  string  $key
     * @param  string  $value
     * @param  \Illuminate\Routing\Route  $route
     * @return mixed
     */
    protected function performBinding($key, $value, $route)
    {
        return call_user_func($this->binders[$key], $value, $route);
    }

    /**
     * Register a route matched event listener.
     *
     * @param  string|callable  $callback
     * @return void
     */
    public function matched($callback)
    {
        $this->events->listen(Events\RouteMatched::class, $callback);
    }

    /**
     * Get all of the defined middleware short-hand names.
     *
     * @return array
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }

    /**
     * Register a short-hand name for a middleware.
     *
     * @param  string  $name
     * @param  string  $class
     * @return $this
     */
    public function aliasMiddleware($name, $class)
    {
        $this->middleware[$name] = $class;

        return $this;
    }

    /**
     * Check if a middlewareGroup with the given name exists.
     *
     * @param  string  $name
     * @return bool
     */
    public function hasMiddlewareGroup($name)
    {
        return array_key_exists($name, $this->middlewareGroups);
    }

    /**
     * Get all of the defined middleware groups.
     *
     * @return array
     */
    public function getMiddlewareGroups()
    {
        return $this->middlewareGroups;
    }

    /**
     * Register a group of middleware.
     *
     * @param  string  $name
     * @param  array  $middleware
     * @return $this
     */
    public function middlewareGroup($name, array $middleware)
    {
        $this->middlewareGroups[$name] = $middleware;

        return $this;
    }

    /**
     * Add a middleware to the beginning of a middleware group.
     *
     * If the middleware is already in the group, it will not be added again.
     *
     * @param  string  $group
     * @param  string  $middleware
     * @return $this
     */
    public function prependMiddlewareToGroup($group, $middleware)
    {
        if (isset($this->middlewareGroups[$group]) && ! in_array($middleware, $this->middlewareGroups[$group])) {
            array_unshift($this->middlewareGroups[$group], $middleware);
        }

        return $this;
    }

    /**
     * Add a middleware to the end of a middleware group.
     *
     * If the middleware is already in the group, it will not be added again.
     *
     * @param  string  $group
     * @param  string  $middleware
     * @return $this
     */
    public function pushMiddlewareToGroup($group, $middleware)
    {
        if (! array_key_exists($group, $this->middlewareGroups)) {
            $this->middlewareGroups[$group] = [];
        }

        if (! in_array($middleware, $this->middlewareGroups[$group])) {
            $this->middlewareGroups[$group][] = $middleware;
        }

        return $this;
    }

    /**
     * Add a new route parameter binder.
     *
     * @param  string  $key
     * @param  string|callable  $binder
     * @return void
     */
    public function bind($key, $binder)
    {
        $this->binders[str_replace('-', '_', $key)] = RouteBinding::forCallback(
            $this->container, $binder
        );
    }

    /**
     * Register a model binder for a wildcard.
     *
     * @param  string  $key
     * @param  string  $class
     * @param  \Closure|null  $callback
     * @return void
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function model($key, $class, Closure $callback = null)
    {
        $this->bind($key, RouteBinding::forModel($this->container, $class, $callback));
    }

    /**
     * Get the binding callback for a given binding.
     *
     * @param  string  $key
     * @return \Closure|null
     */
    public function getBindingCallback($key)
    {
        if (isset($this->binders[$key = str_replace('-', '_', $key)])) {
            return $this->binders[$key];
        }
    }

    /**
     * Get the global "where" patterns.
     *
     * @return array
     */
    public function getPatterns()
    {
        return $this->patterns;
    }

    /**
     * Set a global where pattern on all routes.
     *
     * @param  string  $key
     * @param  string  $pattern
     * @return void
     */
    public function pattern($key, $pattern)
    {
        $this->patterns[$key] = $pattern;
    }

    /**
     * Set a group of global where patterns on all routes.
     *
     * @param  array  $patterns
     * @return void
     */
    public function patterns($patterns)
    {
        foreach ($patterns as $key => $pattern) {
            $this->pattern($key, $pattern);
        }
    }

    /**
     * Determine if the router currently has a group stack.
     *
     * @return bool
     */
    public function hasGroupStack()
    {
        return ! empty($this->groupStack);
    }

    /**
     * Get the current group stack for the router.
     *
     * @return array
     */
    public function getGroupStack()
    {
        return $this->groupStack;
    }

    /**
     * Get a route parameter for the current route.
     *
     * @param  string  $key
     * @param  string  $default
     * @return mixed
     */
    public function input($key, $default = null)
    {
        return $this->current()->parameter($key, $default);
    }

    /**
     * Get the request currently being dispatched.
     *
     * @return \Illuminate\Http\Request
     */
    public function getCurrentRequest()
    {
        return $this->currentRequest;
    }

    /**
     * Get the currently dispatched route instance.
     *
     * @return \Illuminate\Routing\Route
     */
    public function getCurrentRoute()
    {
        return $this->current();
    }

    /**
     * Get the currently dispatched route instance.
     *
     * @return \Illuminate\Routing\Route
     */
    public function current()
    {
        return $this->current;
    }

    /**
     * Check if a route with the given name exists.
     *
     * @param  string  $name
     * @return bool
     */
    public function has($name)
    {
        $names = is_array($name) ? $name : func_get_args();

        foreach ($names as $value) {
            if (! $this->routes->hasNamedRoute($value)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the current route name.
     *
     * @return string|null
     */
    public function currentRouteName()
    {
        return $this->current() ? $this->current()->getName() : null;
    }

    /**
     * Alias for the "currentRouteNamed" method.
     *
     * @param  dynamic  $patterns
     * @return bool
     */
    public function is(...$patterns)
    {
        return $this->currentRouteNamed(...$patterns);
    }

    /**
     * Determine if the current route matches a pattern.
     *
     * @param  dynamic  $patterns
     * @return bool
     */
    public function currentRouteNamed(...$patterns)
    {
        return $this->current() && $this->current()->named(...$patterns);
    }

    /**
     * Get the current route action.
     *
     * @return string|null
     */
    public function currentRouteAction()
    {
        if ($this->current()) {
            return $this->current()->getAction()['controller'] ?? null;
        }
    }

    /**
     * Alias for the "currentRouteUses" method.
     *
     * @param  array  ...$patterns
     * @return bool
     */
    public function uses(...$patterns)
    {
        foreach ($patterns as $pattern) {
            if (Str::is($pattern, $this->currentRouteAction())) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if the current route action matches a given action.
     *
     * @param  string  $action
     * @return bool
     */
    public function currentRouteUses($action)
    {
        return $this->currentRouteAction() == $action;
    }

    /**
     * Register the typical authentication routes for an application.
     *
     * @return void
     */
    public function auth()
    {
        // Authentication Routes...
        $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
        $this->post('login', 'Auth\LoginController@login');
        $this->post('logout', 'Auth\LoginController@logout')->name('logout');

        // Registration Routes...
        $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        $this->post('register', 'Auth\RegisterController@register');

        // Password Reset Routes...
        $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        $this->post('password/reset', 'Auth\ResetPasswordController@reset');
    }

    /**
     * Set the unmapped global resource parameters to singular.
     *
     * @param  bool  $singular
     * @return void
     */
    public function singularResourceParameters($singular = true)
    {
        ResourceRegistrar::singularParameters($singular);
    }

    /**
     * Set the global resource parameter mapping.
     *
     * @param  array  $parameters
     * @return void
     */
    public function resourceParameters(array $parameters = [])
    {
        ResourceRegistrar::setParameters($parameters);
    }

    /**
     * Get or set the verbs used in the resource URIs.
     *
     * @param  array  $verbs
     * @return array|null
     */
    public function resourceVerbs(array $verbs = [])
    {
        return ResourceRegistrar::verbs($verbs);
    }

    /**
     * Get the underlying route collection.
     *
     * @return \Illuminate\Routing\RouteCollection
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Set the route collection instance.
     *
     * @param  \Illuminate\Routing\RouteCollection  $routes
     * @return void
     */
    public function setRoutes(RouteCollection $routes)
    {
        foreach ($routes as $route) {
            $route->setRouter($this)->setContainer($this->container);
        }

        $this->routes = $routes;

        $this->container->instance('routes', $this->routes);
    }

    /**
     * Dynamically handle calls into the router instance.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }

        return (new RouteRegistrar($this))->attribute($method, $parameters[0]);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

class Swift_Mailer_ArrayRecipientIteratorTest extends \PHPUnit\Framework\TestCase
{
    public function testHasNextReturnsFalseForEmptyArray()
    {
        $it = new Swift_Mailer_ArrayRecipientIterator([]);
        $this->assertFalse($it->hasNext());
    }

    public function testHasNextReturnsTrueIfItemsLeft()
    {
        $it = new Swift_Mailer_ArrayRecipientIterator(['foo@bar' => 'Foo']);
        $this->assertTrue($it->hasNext());
    }

    public function testReadingToEndOfListCausesHasNextToReturnFalse()
    {
        $it = new Swift_Mailer_ArrayRecipientIterator(['foo@bar' => 'Foo']);
        $this->assertTrue($it->hasNext());
        $it->nextRecipient();
        $this->assertFalse($it->hasNext());
    }

    public function testReturnedValueHasPreservedKeyValuePair()
    {
        $it = new Swift_Mailer_ArrayRecipientIterator(['foo@bar' => 'Foo']);
        $this->assertEquals(['foo@bar' => 'Foo'], $it->nextRecipient());
    }

    public function testIteratorMovesNextAfterEachIteration()
    {
        $it = new Swift_Mailer_ArrayRecipientIterator([
            'foo@bar' => 'Foo',
            'zip@button' => 'Zip thing',
            'test@test' => null,
            ]);
        $this->assertEquals(['foo@bar' => 'Foo'], $it->nextRecipient());
        $this->assertEquals(['zip@button' => 'Zip thing'], $it->nextRecipient());
        $this->assertEquals(['test@test' => null], $it->nextRecipient());
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php

namespace Illuminate\Http\Middleware;

use Closure;

class SetCacheHeaders
{
    /**
     * Add cache related HTTP headers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|array  $options
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \InvalidArgumentException
     */
    public function handle($request, Closure $next, $options = [])
    {
        $response = $next($request);

        if (! $request->isMethodCacheable() || ! $response->getContent()) {
            return $response;
        }

        if (is_string($options)) {
            $options = $this->parseOptions($options);
        }

        if (isset($options['etag']) && $options['etag'] === true) {
            $options['etag'] = md5($response->getContent());
        }

        $response->setCache($options);
        $response->isNotModified($request);

        return $response;
    }

    /**
     * Parse the given header options.
     *
     * @param  string  $options
     * @return array
     */
    protected function parseOptions($options)
    {
        return collect(explode(';', $options))->mapWithKeys(function ($option) {
            $data = explode('=', $option, 2);

            return [$data[0] => $data[1] ?? true];
        })->all();
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      INDX( 	                 (      �                            �K    h X     �K    B���b� ��F��
��b�<���b�        �               A d d r e s s . p h p �K    h X     �K    �,��b� ��F��CE��b��,��b�X      U               C o m p a n y . p h p �K    p Z     �K    bQ��b� ��F��wg��b�ZQ��b�H      H               I n t e r n e t . p h p       �K    h X     �K    �|��b� ��F��כ��b��|��b�       �               P a y m e n t . p h p �K    h V     �K    q���b� ��F���ʵ�b�h���b�        �              
 P e r s o n . p h p   �K    p `     �K    {ٵ�b� ��F����b�rٵ�b�       �               P h o n e N u m b e r . p h p �K    h R     �K    ���b� ��F�� ��b����b�`       [                T e x t . p h p                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      