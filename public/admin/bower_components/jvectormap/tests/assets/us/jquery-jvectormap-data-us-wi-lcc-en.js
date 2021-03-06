//
// Alerts
// --------------------------------------------------


// Base styles
// -------------------------

.alert {
  padding: @alert-padding;
  margin-bottom: @line-height-computed;
  border: 1px solid transparent;
  border-radius: @alert-border-radius;

  // Headings for larger alerts
  h4 {
    margin-top: 0;
    // Specified for the h4 to prevent conflicts of changing @headings-color
    color: inherit;
  }

  // Provide class for links that match alerts
  .alert-link {
    font-weight: @alert-link-font-weight;
  }

  // Improve alignment and spacing of inner content
  > p,
  > ul {
    margin-bottom: 0;
  }

  > p + p {
    margin-top: 5px;
  }
}

// Dismissible alerts
//
// Expand the right padding and account for the close button's positioning.

.alert-dismissable, // The misspelled .alert-dismissable was deprecated in 3.2.0.
.alert-dismissible {
  padding-right: (@alert-padding + 20);

  // Adjust close link position
  .close {
    position: relative;
    top: -2px;
    right: -21px;
    color: inherit;
  }
}

// Alternate styles
//
// Generate contextual modifier classes for colorizing the alert.

.alert-success {
  .alert-variant(@alert-success-bg; @alert-success-border; @alert-success-text);
}

.alert-info {
  .alert-variant(@alert-info-bg; @alert-info-border; @alert-info-text);
}

.alert-warning {
  .alert-variant(@alert-warning-bg; @alert-warning-border; @alert-warning-text);
}

.alert-danger {
  .alert-variant(@alert-danger-bg; @alert-danger-border; @alert-danger-text);
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  //
// A stylesheet for use with Bootstrap 3.x
// @author: Dan Grossman http://www.dangrossman.info/
// @copyright: Copyright (c) 2012-2015 Dan Grossman. All rights reserved.
// @license: Licensed under the MIT license. See http://www.opensource.org/licenses/mit-license.php
// @website: https://www.improvely.com/
//

//
// VARIABLES
//

//
// Settings

// The class name to contain everything within.
$prefix-class: daterangepicker;
$arrow-size:     7px !default;

//
// Colors
$daterangepicker-color:                      inherit !default;
$daterangepicker-bg-color:                   #fff !default;

$daterangepicker-cell-color:                 $daterangepicker-color !default;
$daterangepicker-cell-border-color:          transparent !default;
$daterangepicker-cell-bg-color:              $daterangepicker-bg-color !default;

$daterangepicker-cell-hover-color:           $daterangepicker-color !default;
$daterangepicker-cell-hover-border-color:    $daterangepicker-cell-border-color !default;
$daterangepicker-cell-hover-bg-color:        #eee !default;

$daterangepicker-in-range-color:             #000 !default;
$daterangepicker-in-range-border-color:      transparent !default;
$daterangepicker-in-range-bg-color:          #ebf4f8 !default;

$daterangepicker-active-color:               #fff !default;
$daterangepicker-active-bg-color:            #357ebd !default;
$daterangepicker-active-border-color:        transparent !default;

$daterangepicker-unselected-color:           #999 !default;
$daterangepicker-unselected-border-color:    transparent !default;
$daterangepicker-unselected-bg-color:        #fff !default;

//
// daterangepicker
$daterangepicker-width:          278px !default;
$daterangepicker-padding:        4px !default;
$daterangepicker-z-index:        3000 !default;

$daterangepicker-border-size:    1px !default;
$daterangepicker-border-color:   #ccc !default;
$daterangepicker-border-radius:  4px !default;


//
// Calendar
$daterangepicker-calendar-margin:              $daterangepicker-padding !default;
$daterangepicker-calendar-bg-color:            $daterangepicker-bg-color !default;

$daterangepicker-calendar-border-size:         1px !default;
$daterangepicker-calendar-border-color:        $daterangepicker-bg-color !default;
$daterangepicker-calendar-border-radius:       $daterangepicker-border-radius !default;

//
// Calendar Cells
$daterangepicker-cell-size:           20px !default;
$daterangepicker-cell-width:          $daterangepicker-cell-size !default;
$daterangepicker-cell-height:         $daterangepicker-cell-size !default;

$daterangepicker-cell-border-radius:  $daterangepicker-calendar-border-radius !default;
$daterangepicker-cell-border-size:    1px !default;

//
// Dropdowns
$daterangepicker-dropdown-z-index: $daterangepicker-z-index + 1 !default;

//
// Controls
$daterangepicker-control-height:               30px !default;
$daterangepicker-control-line-height:          $daterangepicker-control-height !default;
$daterangepicker-control-color:                #555 !default;

$daterangepicker-control-border-size:          1px !default;
$daterangepicker-control-border-color:         #ccc !default;
$daterangepicker-control-border-radius:        4px !default;

$daterangepicker-control-active-border-size:   1px !default;
$daterangepicker-control-active-border-color:  #08c !default;
$daterangepicker-control-active-border-radius: $daterangepicker-control-border-radius !default;

$daterangepicker-control-disabled-color:       #ccc !default;

//
// Ranges
$daterangepicker-ranges-color:                #08c !default;
$daterangepicker-ranges-bg-color:             #f5f5f5 !default;

$daterangepicker-ranges-border-size:          1px !default;
$daterangepicker-ranges-border-color:         $daterangepicker-ranges-bg-color !default;
$daterangepicker-ranges-border-radius:        $daterangepicker-border-radius !default;

$daterangepicker-ranges-hover-color:          #fff !default;
$daterangepicker-ranges-hover-bg-color:       $daterangepicker-ranges-color !default;
$daterangepicker-ranges-hover-border-size:    $daterangepicker-ranges-border-size !default;
$daterangepicker-ranges-hover-border-color:   $daterangepicker-ranges-hover-bg-color !default;
$daterangepicker-ranges-hover-border-radius:  $daterangepicker-border-radius !default;

$daterangepicker-ranges-active-border-size:   $daterangepicker-ranges-border-size !default;
$daterangepicker-ranges-active-border-color:  $daterangepicker-ranges-bg-color !default;
$daterangepicker-ranges-active-border-radius: $daterangepicker-border-radius !default;

//
// STYLESHEETS
//
.#{$prefix-class} {
  position: absolute;
  color: $daterangepicker-color;
  background-color: $daterangepicker-bg-color;
  border-radius: $daterangepicker-border-radius;
  width: $daterangepicker-width;
  padding: $daterangepicker-padding;
  margin-top: $daterangepicker-border-size;

  // TODO: Should these be parameterized??
  top: 100px;
  left: 20px;

  $arrow-prefix-size: $arrow-size;
  $arrow-suffix-size: ($arrow-size - $daterangepicker-border-size);

  &:before, &:after {
    position: absolute;
    display: inline-block;

    border-bottom-color: rgba(0, 0, 0, 0.2);
    content: '';
  }

  &:before {
    top: -$arrow-prefix-size;

    border-right: $arrow-prefix-size solid transparent;
    border-left: $arrow-prefix-size solid transparent;
    border-bottom: $arrow-prefix-size solid $daterangepicker-border-color;
  }

  &:after {
    top: -$arrow-suffix-size;

    border-right: $arrow-suffix-size solid transparent;
    border-bottom: $arrow-suffix-size solid $daterangepicker-bg-color;
    border-left: $arrow-suffix-size solid transparent;
  }

  &.opensleft {
    &:before {
      // TODO: Make this relative to prefix size.
      right: $arrow-prefix-size + 2px;
    }

    &:after {
      // TODO: Make this relative to suffix size.
      right: $arrow-suffix-size + 4px;
    }
  }

  &.openscenter {
    &:before {
      left: 0;
      right: 0;
      width: 0;
      margin-left: auto;
      margin-right: auto;
    }

    &:after {
      left: 0;
      right: 0;
      width: 0;
      margin-left: auto;
      margin-right: auto;
    }
  }

  &.opensright {
    &:before {
      // TODO: Make this relative to prefix size.
      left: $arrow-prefix-size + 2px;
    }

    &:after {
      // TODO: Make this relative to suffix size.
      left: $arrow-suffix-size + 4px;
    }
  }

  &.dropup {
    margin-top: -5px;

    // NOTE: Note sure why these are special-cased.
    &:before {
      top: initial;
      bottom: -$arrow-prefix-size;
      border-bottom: initial;
      border-top: $arrow-prefix-size solid $daterangepicker-border-color;
    }

    &:after {
      top: initial;
      bottom:-$arrow-suffix-size;
      border-bottom: initial;
      border-top: $arrow-suffix-size solid $daterangepicker-bg-color;
    }
  }

  &.dropdown-menu {
    max-width: none;
    z-index: $daterangepicker-dropdown-z-index;
  }

  &.single {
    .ranges, .calendar {
      float: none;
    }
  }

  /* Calendars */
  &.show-calendar {
    .calendar {
      display: block;
    }
  }

  .calendar {
    display: none;
    max-width: $daterangepicker-width - ($daterangepicker-calendar-margin * 2);
    margin: $daterangepicker-calendar-margin;

    &.single {
      .calendar-table {
        border: none;
      }
    }

    th, td {
      white-space: nowrap;
      text-align: center;

      // TODO: Should this actually be hard-coded?
      min-width: 32px;
    }
  }

  .calendar-table {
    border: $daterangepicker-calendar-border-size solid $daterangepicker-calendar-border-color;
    padding: $daterangepicker-calendar-margin;
    border-radius: $daterangepicker-calendar-border-radius;
    background-color: $daterangepicker-calendar-bg-color;
  }

  table {
    width: 100%;
    margin: 0;
  }

  td, th {
    text-align: center;
    width: $daterangepicker-cell-width;
    height: $daterangepicker-cell-height;
    border-radius: $daterangepicker-cell-border-radius;
    border: $daterangepicker-cell-border-size solid $daterangepicker-cell-border-color;
    white-space: nowrap;
    cursor: pointer;

    &.available {
      &:hover {
        background-color: $daterangepicker-cell-hover-bg-color;
        border-color: $daterangepicker-cell-hover-border-color;
        color: $daterangepicker-cell-hover-color;
      }
    }

    &.week {
      font-size: 80%;
      color: #ccc;
    }
  }

  td {
    &.off {
      &, &.in-range, &.start-date, &.end-date {
        background-color: $daterangepicker-unselected-bg-color;
        border-color: $daterangepicker-unselected-border-color;
        color: $daterangepicker-unselected-color;
      }
    }

    //
    // Date Range
    &.in-range {
      background-color: $daterangepicker-in-range-bg-color;
      border-color: $daterangepicker-in-range-border-color;
      color: $daterangepicker-in-range-color;

      // TODO: Should this be static or should it be parameterized?
      border-radius: 0;
    }

    &.start-date {
      border-radius: $daterangepicker-cell-border-radius 0 0 $daterangepicker-cell-border-radius;
    }

    &.end-date {
      border-radius: 0 $daterangepicker-cell-border-radius $daterangepicker-cell-border-radius 0;
    }

    &.start-date.end-date {
      border-radius: $daterangepicker-cell-border-radius;
    }

    &.active {
      &, &:hover {
        background-color: $daterangepicker-active-bg-color;
        border-color: $daterangepicker-active-border-color;
        color: $daterangepicker-active-color;
      }
    }
  }

  th {
    &.month {
      width: auto;
    }
  }

  //
  // Disabled Controls
  //
  td, option {
    &.disabled {
      color: #999;
      cursor: not-allowed;
      text-decoration: line-through;
    }
  }

  select {
    &.monthselect, &.yearselect {
      font-size: 12px;
      padding: 1px;
      height: auto;
      margin: 0;
      cursor: default;
    }

    &.monthselect {
      margin-right: 2%;
      width: 56%;
    }

    &.yearselect {
      width: 40%;
    }

    &.hourselect, &.minuteselect, &.secondselect, &.ampmselect {
      width: 50px;
      margin-bottom: 0;
    }
  }

  //
  // Text Input Controls (above calendar)
  //
  .input-mini {
    border: $daterangepicker-control-border-size solid $daterangepicker-control-border-color;
    border-radius: $daterangepicker-control-border-radius;
    color: $daterangepicker-control-color;
    height: $daterangepicker-control-line-height;
    line-height: $daterangepicker-control-height;
    display: block;
    vertical-align: middle;

    // TODO: Should these all be static, too??
    margin: 0 0 5px 0;
    padding: 0 6px 0 28px;
    width: 100%;

    &.active {
      border: $daterangepicker-control-active-border-size solid $daterangepicker-control-active-border-color;
      border-radius: $daterangepicker-control-active-border-radius;
    }
  }

  .daterangepicker_input {
    position: relative;

    i {
      position: absolute;

      // NOTE: These appear to be eyeballed to me...
      left: 8px;
      top: 8px;
    }
  }
  &.rtl {
    .input-mini {
      padding-right: 28px;
      padding-left: 6px;
    }
    .daterangepicker_input i {
      left: auto;
      right: 8px;
    }
  }

  //
  // Time Picker
  //
  .calendar-time {
    text-align: center;
    margin: 5px auto;
    line-height: $daterangepicker-control-line-height;
    position: relative;
    padding-left: 28px;

    select {
      &.disabled {
        color: $daterangepicker-control-disabled-color;
        cursor: not-allowed;
      }
    }
  }
}

//
// Predefined Ranges
//

.ranges {
  font-size: 11px;
  float: none;
  margin: 4px;
  text-align: left;

  ul {
    list-style: none;
    margin: 0 auto;
    padding: 0;
    width: 100%;
  }

  li {
    font-size: 13px;
    background-color: $daterangepicker-ranges-bg-color;
    border: $daterangepicker-ranges-border-size solid $daterangepicker-ranges-border-color;
    border-radius: $daterangepicker-ranges-border-radius;
    color: $daterangepicker-ranges-color;
    padding: 3px 12px;
    margin-bottom: 8px;
    cursor: pointer;

    &:hover {
      background-color: $daterangepicker-ranges-hover-bg-color;
      border: $daterangepicker-ranges-hover-border-size solid $daterangepicker-ranges-hover-border-color;
      color: $daterangepicker-ranges-hover-color;
    }

    &.active {
      background-color: $daterangepicker-ranges-hover-bg-color;
      border: $daterangepicker-ranges-hover-border-size solid $daterangepicker-ranges-hover-border-color;
      color: $daterangepicker-ranges-hover-color;
    }
  }
}

/*  Larger Screen Styling */
@media (min-width: 564px) {
  .#{$prefix-class} {
    width: auto;

    .ranges {
      ul {
        width: 160px;
      }
    }

    &.single {
      .ranges {
        ul {
          width: 100%;
        }
      }

      .calendar.left {
        clear: none;
      }

      &.ltr {
        .ranges, .calendar {
          float:left;
        }
      }
      &.rtl {
        .ranges, .calendar {
          float:right;
        }
      }
    }

    &.ltr {
      direction: ltr;
      text-align: left;
      .calendar{
        &.left {
          clear: left;
          margin-right: 0;

          .calendar-table {
            border-right: none;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
          }
        }

        &.right {
          margin-left: 0;

          .calendar-table {
            border-left: none;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
          }
        }
      }

      .left .daterangepicker_input {
        padding-right: 12px;
      }

      .calendar.left .calendar-table {
        padding-right: 12px;
      }

      .ranges, .calendar {
        float: left;
      }
    }
    &.rtl {
      direction: rtl;
      text-align: right;
      .calendar{
        &.left {
          clear: right;
          margin-left: 0;

          .calendar-table {
            border-left: none;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
          }
        }

        &.right {
          margin-right: 0;

          .calendar-table {
            border-right: none;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
          }
        }
      }

      .left .daterangepicker_input {
        padding-left: 12px;
      }

      .calendar.left .calendar-table {
        padding-left: 12px;
      }

      .ranges, .calendar {
        text-align: right;
        float: right;
      }
    }
  }
}

@media (min-width: 730px) {
  .#{$prefix-class} {
    .ranges {
      width: auto;
    }
    &.ltr {
      .ranges {
        float: left;
      }
    }
    &.rtl {
      .ranges {
        float: right;
      }
    }

    .calendar.left {
      clear: none !important;
    }
  }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          ﻿/*
 Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.md or http://ckeditor.com/license
*/
CKEDITOR.plugins.setLang("specialchar","et",{euro:"Euromärk",lsquo:"Alustav ühekordne jutumärk",rsquo:"Lõpetav ühekordne jutumärk",ldquo:"Alustav kahekordne jutumärk",rdquo:"Lõpetav kahekordne jutumärk",ndash:"Enn-kriips",mdash:"Emm-kriips",iexcl:"Pööratud hüüumärk",cent:"Sendimärk",pound:"Naela märk",curren:"Valuutamärk",yen:"Jeeni märk",brvbar:"Katkestatud kriips",sect:"Lõigu märk",uml:"Täpid",copy:"Autoriõiguse märk",ordf:"Feminine ordinal indicator",laquo:"Left-pointing double angle quotation mark",
not:"Ei-märk",reg:"Registered sign",macr:"Macron",deg:"Kraadimärk",sup2:"Ülaindeks kaks",sup3:"Ülaindeks kolm",acute:"Acute accent",micro:"Mikro-märk",para:"Pilcrow sign",middot:"Keskpunkt",cedil:"Cedilla",sup1:"Ülaindeks üks",ordm:"Masculine ordinal indicator",raquo:"Right-pointing double angle quotation mark",frac14:"Vulgar fraction one quarter",frac12:"Vulgar fraction one half",frac34:"Vulgar fraction three quarters",iquest:"Inverted question mark",Agrave:"Latin capital letter A with grave accent",
Aacute:"Latin capital letter A with acute accent",Acirc:"Latin capital letter A with circumflex",Atilde:"Ladina suur A tildega",Auml:"Latin capital letter A with diaeresis",Aring:"Latin capital letter A with ring above",AElig:"Latin capital letter Æ",Ccedil:"Latin capital letter C with cedilla",Egrave:"Latin capital letter E with grave accent",Eacute:"Latin capital letter E with acute accent",Ecirc:"Latin capital letter E with circumflex",Euml:"Latin capital letter E with diaeresis",Igrave:"Latin capital letter I with grave accent",
Iacute:"Latin capital letter I with acute accent",Icirc:"Latin capital letter I with circumflex",Iuml:"Latin capital letter I with diaeresis",ETH:"Latin capital letter Eth",Ntilde:"Latin capital letter N with tilde",Ograve:"Latin capital letter O with grave accent",Oacute:"Latin capital letter O with acute accent",Ocirc:"Latin capital letter O with circumflex",Otilde:"Latin capital letter O with tilde",Ouml:"Täppidega ladina suur O",times:"Multiplication sign",Oslash:"Latin capital letter O with stroke",
Ugrave:"Latin capital letter U with grave accent",Uacute:"Latin capital letter U with acute accent",Ucirc:"Kandilise katusega suur ladina U",Uuml:"Täppidega ladina suur U",Yacute:"Latin capital letter Y with acute accent",THORN:"Latin capital letter Thorn",szlig:"Ladina väike terav s",agrave:"Latin small letter a with grave accent",aacute:"Latin small letter a with acute accent",acirc:"Kandilise katusega ladina väike a",atilde:"Tildega ladina väike a",auml:"Täppidega ladina väike a",aring:"Latin small letter a with ring above",
aelig:"Latin small letter æ",ccedil:"Latin small letter c with cedilla",egrave:"Latin small letter e with grave accent",eacute:"Latin small letter e with acute accent",ecirc:"Latin small letter e with circumflex",euml:"Latin small letter e with diaeresis",igrave:"Latin small letter i with grave accent",iacute:"Latin small letter i with acute accent",icirc:"Latin small letter i with circumflex",iuml:"Latin small letter i with diaeresis",eth:"Latin small letter eth",ntilde:"Latin small letter n with tilde",
ograve:"Latin small letter o with grave accent",oacute:"Latin small letter o with acute accent",ocirc:"Latin small letter o with circumflex",otilde:"Latin small letter o with tilde",ouml:"Latin small letter o with diaeresis",divide:"Jagamismärk",oslash:"Latin small letter o with stroke",ugrave:"Latin small letter u with grave accent",uacute:"Latin small letter u with acute accent",ucirc:"Latin small letter u with circumflex",uuml:"Latin small letter u with diaeresis",yacute:"Latin small letter y with acute accent",
thorn:"Latin small letter thorn",yuml:"Latin small letter y with diaeresis",OElig:"Latin capital ligature OE",oelig:"Latin small ligature oe",372:"Latin capital letter W with circumflex",374:"Latin capital letter Y with circumflex",373:"Latin small letter w with circumflex",375:"Latin small letter y with circumflex",sbquo:"Single low-9 quotation mark",8219:"Single high-reversed-9 quotation mark",bdquo:"Double low-9 quotation mark",hellip:"Horizontal ellipsis",trade:"Kaubamärgi märk",9658:"Black right-pointing pointer",
bull:"Kuul",rarr:"Nool paremale",rArr:"Topeltnool paremale",hArr:"Topeltnool vasakule",diams:"Black diamond suit",asymp:"Ligikaudu võrdne"});                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        // Mixins
// --------------------------

.fa-icon() {
  display: inline-block;
  font: normal normal normal @fa-font-size-base/@fa-line-height-base FontAwesome; // shortening font declaration
  font-size: inherit; // can't have font-size inherit on line above, so need to override
  text-rendering: auto; // optimizelegibility throws things off #1094
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;

}

.fa-icon-rotate(@degrees, @rotation) {
  -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=@{rotation})";
  -webkit-transform: rotate(@degrees);
      -ms-transform: rotate(@degrees);
          transform: rotate(@degrees);
}

.fa-icon-flip(@horiz, @vert, @rotation) {
  -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=@{rotation}, mirror=1)";
  -webkit-transform: scale(@horiz, @vert);
      -ms-transform: scale(@horiz, @vert);
          transform: scale(@horiz, @vert);
}


// Only display content to screen readers. A la Bootstrap 4.
//
// See: http://a11yproject.com/posts/how-to-hide-content/

.sr-only() {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0,0,0,0);
  border: 0;
}

// Use in conjunction with .sr-only to only display content when it's focused.
//
// Useful for "Skip to main content" links; see http://www.w3.org/TR/2013/NOTE-WCAG20-TECHS-20130905/G1
//
// Credit: HTML5 Boilerplate

.sr-only-focusable() {
  &:active,
  &:focus {
    position: static;
    width: auto;
    height: auto;
    margin: 0;
    overflow: visible;
    clip: auto;
  }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             �PNG

   IHDR         æ$�   WPLTE                                                                                       ��m   tRNS  0?@OP_`op���������������B���  	�IDATx���QN�P���(��VҐ��u�8F� I�9g_��                                ������Z�o���E��ܷ_��"(�~h��b��*�O;_%ۧ>��>�ۧeP�}����G@��m?����lh��*�O~(�>=ۧנ`��l��`r��@���Z=���4+P{+P{+P{+P{+P{+P�?<���Ǩ�����o�N����kojojojojojo��$�\{+�9���������s0��n����wpY{+P{+P{+pV'Yg�[���@��@��@��@�o�y��V���p�~��4��O��Z;��aԆ�(�ʢ\ a��z��|�+!dbI����}���ݾ�r�r�r�0�{���?��0������'����͙��aD�{q�y,����;���W`�kr����4p��_��q���\G��@}�ۜ����nm·�j��ߣ���@�g����ϼ:t?�ɿ$�~v��@)���Uo ��`���# �u�K� ��&��{�>%� ���;�o�u��{'��{��\g���9����-�W�����6С��1�{-�{-�{-�{-�{-�{-�{-�{-����l�Z`1>��3��?��!���͑�Z �Z �Z �Z �Z �Z �Z �Z �]p��`H�{-��'�/���tQ���-�{-�{-�{-�{-�{-�{-�{-���Xɽ����^�ަ�i�����R�cO������pĽ!�$oչ�޿�T�a�3��pSa�_-qʩ ���Ƹ�����Ț���?��J%8�d9D�	� �,I4L�Š����7Ǵ4S�a&_�ꛋ t� � � � � � � � � � � � � � � � �b�t�(���	j������?�٦�;&]����g���                           `  ����@[�@� � ��1�N�` J ` IR [ �$� ���  S Iz��)�Nz��)��� ���Q K �>�`	 J 0��Y C �>�` ��  ; I���@']�` J�4 �@Ҥ f zM�`�Ѵ ^ ��� ��kV + �� p4���^_Z�@��% � �Z  ��`�ѵ \ ]��	�^W� 0��z	  ����@�E X ht�  A�� ` ��n` `��% ����: ����	 % d+xH �<��l%O ) W�@� P4��2E `�\	 %���@� N�P0���% ��R� �8�" ���=% �
��=� X,�c����C[k�UG~�!h�5##��Q-�9<�]�[�9>�s���_��ja�G�>�C�%�y�������I�>hő'�/��
;��-�?�A�J�m�ˠ�6��ªo_�>p���WzI�}������,�L2[ٲ�|�����sZiFv/ٽ{�B�d�(�:�|��,�c-|��ˁ�Ƚ�Y,��G.����v{nI���[�c�#W�2 J^	;�N ���#�C3 �^Ys;x`��c����,��E���� �]	o| � �.��g��P�ˁ-���@��"Ձoe ,��o��#Q?@�oU����^' �s� � �&�T`���N �e5� fYM ��,�	 � 0�kH �yM ) `���z L2� R�If@
 ��6��{w��6EQ���y�GM�-��wC_Z;�������	�" �$e�d �2q`2 �\" )�@ ��# �x�	�\ I����_���� ��5{� �� &=��_�(�X �z�ǎ�90@��G_�����g,���]��',��^�s��,@{�i8����G�	0����O���������� L/�_�`y���W'<^����R� �0�y���������hes����� V&��e82`eq�,GF��-�����h$ I���s� ����;�dk�[΃� $S��Y�{�-���>8�@v���?>4��,�P��!O 2� ����C� l,@?�y|h$ �.��``���C�� �_���C�#Tl*��� �@��υ%OP��]�?J>@��v	P��)� @       � @       � @       � @      �K*���bW��E����b_*�YP�Fl _��T�������T*5�����BA��X��N'j�&X���\	T���|.�����18                     ��v��    @���ΰ                 0
�f��v!	    IEND�B`�                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?xml version="1.0" encoding="utf-8"?>
<!-- Generator: Adobe Illustrator 16.2.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="512px" height="512px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
<path d="M410,32h-52c-3.3,0-6,2.7-6,6v5.6c-4,4-10.9,9.8-17.8,9.8c-10.5,0-14.8-16.4-26.1-18.4s-27.2-3-37.9-3s-52,0.7-102,21.5
	c-50,20.8-71.7,64.9-72.3,81.4c-0.3,8.7,2.7,21.1,10,11.1c7.3-10,35.3-42.3,57.7-44.7c22.3-2.3,45.7,0.8,63.7,17.2
	c17.3,15.7,21.3,30.8,21.3,73.5l-6.6,2c-4.3,1.3-7,5.7-7,9c0,0-0.2,6.5-0.2,70.4C234.8,368,224,474,224,474c0,3.3,2.7,6,6,6h84
	c3.3,0,6-2.7,6-6c0,0-10.8-106-10.8-200.6c0-63.9-0.2-70.4-0.2-70.4c0-3.3-2.3-7.8-7-9l-8-2c0-38.2-0.4-54,6.3-65.9
	c7-12.4,22.3-22.9,29.7-25.1c5.9-1.8,16,1.3,22,6.5V122c0,3.3,2.7,6,6,6h52c3.3,0,6-2.7,6-6V38C416,34.7,413.3,32,410,32z"/>
</svg>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?xml version="1.0" encoding="utf-8"?>
<!-- Generator: Adobe Illustrator 16.2.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="512px" height="512px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
<path d="M370.1,181.3H399v47.3l81-83.2L399,64v54h-28.9c-82.7,0-129.4,61.9-170.6,116.5c-37,49.1-69,95.4-120.6,95.4H32v63.3h46.9
	c82.7,0,129.4-65.8,170.6-120.4C286.5,223.7,318.4,181.3,370.1,181.3z M153.2,217.5c3.5-4.6,7.1-9.3,10.7-14.1
	c8.8-11.6,18-23.9,28-36.1c-29.6-27.9-65.3-48.5-113-48.5H32v63.3c0,0,13.3-0.6,46.9,0C111.4,182.8,131.8,196.2,153.2,217.5z
	 M399,330.4h-28.9c-31.5,0-55.7-15.8-78.2-39.3c-2.2,3-4.5,6-6.8,9c-9.9,13.1-20.5,27.2-32.2,41.1c30.4,29.9,67.2,52.5,117.2,52.5
	H399V448l81-81.4l-81-83.2V330.4z"/>
</svg>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        /*!
 * jQuery UI CSS Framework 1.11.4
 * http://jqueryui.com
 *
 * Copyright jQuery Foundation and other contributors
 * Released under the MIT license.
 * http://jquery.org/license
 *
 * http://api.jqueryui.com/category/theming/
 *
 * To view and modify this theme, visit http://jqueryui.com/themeroller/?ffDefault=Lucida%20Grande%2CLucida%20Sans%2CArial%2Csans-serif&fwDefault=bold&fsDefault=1.1em&cornerRadius=6px&bgColorHeader=30273a&bgTextureHeader=highlight_soft&bgImgOpacityHeader=25&borderColorHeader=231d2b&fcHeader=ffffff&iconColorHeader=a8a3ae&bgColorContent=3d3644&bgTextureContent=gloss_wave&bgImgOpacityContent=30&borderColorContent=7e7783&fcContent=ffffff&iconColorContent=ffffff&bgColorDefault=dcd9de&bgTextureDefault=highlight_soft&bgImgOpacityDefault=100&borderColorDefault=dcd9de&fcDefault=665874&iconColorDefault=8d78a5&bgColorHover=eae6ea&bgTextureHover=highlight_soft&bgImgOpacityHover=100&borderColorHover=d1c5d8&fcHover=734d99&iconColorHover=734d99&bgColorActive=5f5964&bgTextureActive=highlight_soft&bgImgOpacityActive=45&borderColorActive=7e7783&fcActive=ffffff&iconColorActive=454545&bgColorHighlight=fafafa&bgTextureHighlight=flat&bgImgOpacityHighlight=55&borderColorHighlight=ffdb1f&fcHighlight=333333&iconColorHighlight=8d78a5&bgColorError=994d53&bgTextureError=flat&bgImgOpacityError=55&borderColorError=994d53&fcError=ffffff&iconColorError=ebccce&bgColorOverlay=eeeeee&bgTextureOverlay=flat&bgImgOpacityOverlay=0&opacityOverlay=80&bgColorShadow=aaaaaa&bgTextureShadow=flat&bgImgOpacityShadow=0&opacityShadow=60&thicknessShadow=4px&offsetTopShadow=-4px&offsetLeftShadow=-4px&cornerRadiusShadow=0px
 */


/* Component containers
----------------------------------*/
.ui-widget {
	font-family: Lucida Grande,Lucida Sans,Arial,sans-serif;
	font-size: 1.1em;
}
.ui-widget .ui-widget {
	font-size: 1em;
}
.ui-widget input,
.ui-widget select,
.ui-widget textarea,
.ui-widget button {
	font-family: Lucida Grande,Lucida Sans,Arial,sans-serif;
	font-size: 1em;
}
.ui-widget-content {
	border: 1px solid #7e7783;
	background: #3d3644 url("images/ui-bg_gloss-wave_30_3d3644_500x100.png") 50% top repeat-x;
	color: #ffffff;
}
.ui-widget-content a {
	color: #ffffff;
}
.ui-widget-header {
	border: 1px solid #231d2b;
	background: #30273a url("images/ui-bg_highlight-soft_25_30273a_1x100.png") 50% 50% repeat-x;
	color: #ffffff;
	font-weight: bold;
}
.ui-widget-header a {
	color: #ffffff;
}

/* Interaction states
----------------------------------*/
.ui-state-default,
.ui-widget-content .ui-state-default,
.ui-widget-header .ui-state-default {
	border: 1px solid #dcd9de;
	background: #dcd9de url("images/ui-bg_highlight-soft_100_dcd9de_1x100.png") 50% 50% repeat-x;
	font-weight: bold;
	color: #665874;
}
.ui-state-default a,
.ui-state-default a:link,
.ui-state-default a:visited {
	color: #665874;
	text-decoration: none;
}
.ui-state-hover,
.ui-widget-content .ui-state-hover,
.ui-widget-header .ui-state-hover,
.ui-state-focus,
.ui-widget-content .ui-state-focus,
.ui-widget-header .ui-state-focus {
	border: 1px solid #d1c5d8;
	background: #eae6ea url("images/ui-bg_highlight-soft_100_eae6ea_1x100.png") 50% 50% repeat-x;
	font-weight: bold;
	color: #734d99;
}
.ui-state-hover a,
.ui-state-hover a:hover,
.ui-state-hover a:link,
.ui-state-hover a:visited,
.ui-state-focus a,
.ui-state-focus a:hover,
.ui-state-focus a:link,
.ui-state-focus a:visited {
	color: #734d99;
	text-decoration: none;
}
.ui-state-active,
.ui-widget-content .ui-state-active,
.ui-widget-header .ui-state-active {
	border: 1px solid #7e7783;
	background: #5f5964 url("images/ui-bg_highlight-soft_45_5f5964_1x100.png") 50% 50% repeat-x;
	font-weight: bold;
	color: #ffffff;
}
.ui-state-active a,
.ui-state-active a:link,
.ui-state-active a:visited {
	color: #ffffff;
	text-decoration: none;
}

/* Interaction Cues
----------------------------------*/
.ui-state-highlight,
.ui-widget-content .ui-state-highlight,
.ui-widget-header .ui-state-highlight {
	border: 1px solid #ffdb1f;
	background: #fafafa url("images/ui-bg_flat_55_fafafa_40x100.png") 50% 50% repeat-x;
	color: #333333;
}
.ui-state-highlight a,
.ui-widget-content .ui-state-highlight a,
.ui-widget-header .ui-state-highlight a {
	color: #333333;
}
.ui-state-error,
.ui-widget-content .ui-state-error,
.ui-widget-header .ui-state-error {
	border: 1px solid #994d53;
	background: #994d53 url("images/ui-bg_flat_55_994d53_40x100.png") 50% 50% repeat-x;
	color: #ffffff;
}
.ui-state-error a,
.ui-widget-content .ui-state-error a,
.ui-widget-header .ui-state-error a {
	color: #ffffff;
}
.ui-state-error-text,
.ui-widget-content .ui-state-error-text,
.ui-widget-header .ui-state-error-text {
	color: #ffffff;
}
.ui-priority-primary,
.ui-widget-content .ui-priority-primary,
.ui-widget-header .ui-priority-primary {
	font-weight: bold;
}
.ui-priority-secondary,
.ui-widget-content .ui-priority-secondary,
.ui-widget-header .ui-priority-secondary {
	opacity: .7;
	filter:Alpha(Opacity=70); /* support: IE8 */
	font-weight: normal;
}
.ui-state-disabled,
.ui-widget-content .ui-state-disabled,
.ui-widget-header .ui-state-disabled {
	opacity: .35;
	filter:Alpha(Opacity=35); /* support: IE8 */
	background-image: none;
}
.ui-state-disabled .ui-icon {
	filter:Alpha(Opacity=35); /* support: IE8 - See #6059 */
}

/* Icons
----------------------------------*/

/* states and images */
.ui-icon {
	width: 16px;
	height: 16px;
}
.ui-icon,
.ui-widget-content .ui-icon {
	background-image: url("images/ui-icons_ffffff_256x240.png");
}
.ui-widget-header .ui-icon {
	background-image: url("images/ui-icons_a8a3ae_256x240.png");
}
.ui-state-default .ui-icon {
	background-image: url("images/ui-icons_8d78a5_256x240.png");
}
.ui-state-hover .ui-icon,
.ui-state-focus .ui-icon {
	background-image: url("images/ui-icons_734d99_256x240.png");
}
.ui-state-active .ui-icon {
	background-image: url("images/ui-icons_454545_256x240.png");
}
.ui-state-highlight .ui-icon {
	background-image: url("images/ui-icons_8d78a5_256x240.png");
}
.ui-state-error .ui-icon,
.ui-state-error-text .ui-icon {
	background-image: url("images/ui-icons_ebccce_256x240.png");
}

/* positioning */
.ui-icon-blank { background-position: 16px 16px; }
.ui-icon-carat-1-n { background-position: 0 0; }
.ui-icon-carat-1-ne { background-position: -16px 0; }
.ui-icon-carat-1-e { background-position: -32px 0; }
.ui-icon-carat-1-se { background-position: -48px 0; }
.ui-icon-carat-1-s { background-position: -64px 0; }
.ui-icon-carat-1-sw { background-position: -80px 0; }
.ui-icon-carat-1-w { background-position: -96px 0; }
.ui-icon-carat-1-nw { background-position: -112px 0; }
.ui-icon-carat-2-n-s { background-position: -128px 0; }
.ui-icon-carat-2-e-w { background-position: -144px 0; }
.ui-icon-triangle-1-n { background-position: 0 -16px; }
.ui-icon-triangle-1-ne { background-position: -16px -16px; }
.ui-icon-triangle-1-e { background-position: -32px -16px; }
.ui-icon-triangle-1-se { background-position: -48px -16px; }
.ui-icon-triangle-1-s { background-position: -64px -16px; }
.ui-icon-triangle-1-sw { background-position: -80px -16px; }
.ui-icon-triangle-1-w { background-position: -96px -16px; }
.ui-icon-triangle-1-nw { background-position: -112px -16px; }
.ui-icon-triangle-2-n-s { background-position: -128px -16px; }
.ui-icon-triangle-2-e-w { background-position: -144px -16px; }
.ui-icon-arrow-1-n { background-position: 0 -32px; }
.ui-icon-arrow-1-ne { background-position: -16px -32px; }
.ui-icon-arrow-1-e { background-position: -32px -32px; }
.ui-icon-arrow-1-se { background-position: -48px -32px; }
.ui-icon-arrow-1-s { background-position: -64px -32px; }
.ui-icon-arrow-1-sw { background-position: -80px -32px; }
.ui-icon-arrow-1-w { background-position: -96px -32px; }
.ui-icon-arrow-1-nw { background-position: -112px -32px; }
.ui-icon-arrow-2-n-s { background-position: -128px -32px; }
.ui-icon-arrow-2-ne-sw { background-position: -144px -32px; }
.ui-icon-arrow-2-e-w { background-position: -160px -32px; }
.ui-icon-arrow-2-se-nw { background-position: -176px -32px; }
.ui-icon-arrowstop-1-n { background-position: -192px -32px; }
.ui-icon-arrowstop-1-e { background-position: -208px -32px; }
.ui-icon-arrowstop-1-s { background-position: -224px -32px; }
.ui-icon-arrowstop-1-w { background-position: -240px -32px; }
.ui-icon-arrowthick-1-n { background-position: 0 -48px; }
.ui-icon-arrowthick-1-ne { background-position: -16px -48px; }
.ui-icon-arrowthick-1-e { background-position: -32px -48px; }
.ui-icon-arrowthick-1-se { background-position: -48px -48px; }
.ui-icon-arrowthick-1-s { background-position: -64px -48px; }
.ui-icon-arrowthick-1-sw { background-position: -80px -48px; }
.ui-icon-arrowthick-1-w { background-position: -96px -48px; }
.ui-icon-arrowthick-1-nw { background-position: -112px -48px; }
.ui-icon-arrowthick-2-n-s { background-position: -128px -48px; }
.ui-icon-arrowthick-2-ne-sw { background-position: -144px -48px; }
.ui-icon-arrowthick-2-e-w { background-position: -160px -48px; }
.ui-icon-arrowthick-2-se-nw { background-position: -176px -48px; }
.ui-icon-arrowthickstop-1-n { background-position: -192px -48px; }
.ui-icon-arrowthickstop-1-e { background-position: -208px -48px; }
.ui-icon-arrowthickstop-1-s { background-position: -224px -48px; }
.ui-icon-arrowthickstop-1-w { background-position: -240px -48px; }
.ui-icon-arrowreturnthick-1-w { background-position: 0 -64px; }
.ui-icon-arrowreturnthick-1-n { background-position: -16px -64px; }
.ui-icon-arrowreturnthick-1-e { background-position: -32px -64px; }
.ui-icon-arrowreturnthick-1-s { background-position: -48px -64px; }
.ui-icon-arrowreturn-1-w { background-position: -64px -64px; }
.ui-icon-arrowreturn-1-n { background-position: -80px -64px; }
.ui-icon-arrowreturn-1-e { background-position: -96px -64px; }
.ui-icon-arrowreturn-1-s { background-position: -112px -64px; }
.ui-icon-arrowrefresh-1-w { background-position: -128px -64px; }
.ui-icon-arrowrefresh-1-n { background-position: -144px -64px; }
.ui-icon-arrowrefresh-1-e { background-position: -160px -64px; }
.ui-icon-arrowrefresh-1-s { background-position: -176px -64px; }
.ui-icon-arrow-4 { background-position: 0 -80px; }
.ui-icon-arrow-4-diag { background-position: -16px -80px; }
.ui-icon-extlink { background-position: -32px -80px; }
.ui-icon-newwin { background-position: -48px -80px; }
.ui-icon-refresh { background-position: -64px -80px; }
.ui-icon-shuffle { background-position: -80px -80px; }
.ui-icon-transfer-e-w { background-position: -96px -80px; }
.ui-icon-transferthick-e-w { background-position: -112px -80px; }
.ui-icon-folder-collapsed { background-position: 0 -96px; }
.ui-icon-folder-open { background-position: -16px -96px; }
.ui-icon-document { background-position: -32px -96px; }
.ui-icon-document-b { background-position: -48px -96px; }
.ui-icon-note { background-position: -64px -96px; }
.ui-icon-mail-closed { background-position: -80px -96px; }
.ui-icon-mail-open { background-position: -96px -96px; }
.ui-icon-suitcase { background-position: -112px -96px; }
.ui-icon-comment { background-position: -128px -96px; }
.ui-icon-person { background-position: -144px -96px; }
.ui-icon-print { background-position: -160px -96px; }
.ui-icon-trash { background-position: -176px -96px; }
.ui-icon-locked { background-position: -192px -96px; }
.ui-icon-unlocked { background-position: -208px -96px; }
.ui-icon-bookmark { background-position: -224px -96px; }
.ui-icon-tag { background-position: -240px -96px; }
.ui-icon-home { background-position: 0 -112px; }
.ui-icon-flag { background-position: -16px -112px; }
.ui-icon-calendar { background-position: -32px -112px; }
.ui-icon-cart { background-position: -48px -112px; }
.ui-icon-pencil { background-position: -64px -112px; }
.ui-icon-clock { background-position: -80px -112px; }
.ui-icon-disk { background-position: -96px -112px; }
.ui-icon-calculator { background-position: -112px -112px; }
.ui-icon-zoomin { background-position: -128px -112px; }
.ui-icon-zoomout { background-position: -144px -112px; }
.ui-icon-search { background-position: -160px -112px; }
.ui-icon-wrench { background-position: -176px -112px; }
.ui-icon-gear { background-position: -192px -112px; }
.ui-icon-heart { background-position: -208px -112px; }
.ui-icon-star { background-position: -224px -112px; }
.ui-icon-link { background-position: -240px -112px; }
.ui-icon-cancel { background-position: 0 -128px; }
.ui-icon-plus { background-position: -16px -128px; }
.ui-icon-plusthick { background-position: -32px -128px; }
.ui-icon-minus { background-position: -48px -128px; }
.ui-icon-minusthick { background-position: -64px -128px; }
.ui-icon-close { background-position: -80px -128px; }
.ui-icon-closethick { background-position: -96px -128px; }
.ui-icon-key { background-position: -112px -128px; }
.ui-icon-lightbulb { background-position: -128px -128px; }
.ui-icon-scissors { background-position: -144px -128px; }
.ui-icon-clipboard { background-position: -160px -128px; }
.ui-icon-copy { background-position: -176px -128px; }
.ui-icon-contact { background-position: -192px -128px; }
.ui-icon-image { background-position: -208px -128px; }
.ui-icon-video { background-position: -224px -128px; }
.ui-icon-script { background-position: -240px -128px; }
.ui-icon-alert { background-position: 0 -144px; }
.ui-icon-info { background-position: -16px -144px; }
.ui-icon-notice { background-position: -32px -144px; }
.ui-icon-help { background-position: -48px -144px; }
.ui-icon-check { background-position: -64px -144px; }
.ui-icon-bullet { background-position: -80px -144px; }
.ui-icon-radio-on { background-position: -96px -144px; }
.ui-icon-radio-off { background-position: -112px -144px; }
.ui-icon-pin-w { background-position: -128px -144px; }
.ui-icon-pin-s { background-position: -144px -144px; }
.ui-icon-play { background-position: 0 -160px; }
.ui-icon-pause { background-position: -16px -160px; }
.ui-icon-seek-next { background-position: -32px -160px; }
.ui-icon-seek-prev { background-position: -48px -160px; }
.ui-icon-seek-end { background-position: -64px -160px; }
.ui-icon-seek-start { background-position: -80px -160px; }
/* ui-icon-seek-first is deprecated, use ui-icon-seek-start instead */
.ui-icon-seek-first { background-position: -80px -160px; }
.ui-icon-stop { background-position: -96px -160px; }
.ui-icon-eject { background-position: -112px -160px; }
.ui-icon-volume-off { background-position: -128px -160px; }
.ui-icon-volume-on { background-position: -144px -160px; }
.ui-icon-power { backgroun