olor: darken(@border, 25%);\n  }\n  &:hover {\n    color: @color;\n    background-color: darken(@background, 10%);\n        border-color: darken(@border, 12%);\n  }\n  &:active,\n  &.active,\n  .open > .dropdown-toggle& {\n    color: @color;\n    background-color: darken(@background, 10%);\n        border-color: darken(@border, 12%);\n\n    &:hover,\n    &:focus,\n    &.focus {\n      color: @color;\n      background-color: darken(@background, 17%);\n          border-color: darken(@border, 25%);\n    }\n  }\n  &:active,\n  &.active,\n  .open > .dropdown-toggle& {\n    background-image: none;\n  }\n  &.disabled,\n  &[disabled],\n  fieldset[disabled] & {\n    &:hover,\n    &:focus,\n    &.focus {\n      background-color: @background;\n          border-color: @border;\n    }\n  }\n\n  .badge {\n    color: @background;\n    background-color: @color;\n  }\n}\n\n// Button sizes\n.button-size(@padding-vertical; @padding-horizontal; @font-size; @line-height; @border-radius) {\n  padding: @padding-vertical @padding-horizontal;\n  font-size: @font-size;\n  line-height: @line-height;\n  border-radius: @border-radius;\n}\n","// Opacity\n\n.opacity(@opacity) {\n  opacity: @opacity;\n  // IE8 filter\n  @opacity-ie: (@opacity * 100);\n  filter: ~\"alpha(opacity=@{opacity-ie})\";\n}\n","//\n// Component animations\n// --------------------------------------------------\n\n// Heads up!\n//\n// We don't use the `.opacity()` mixin here since it causes a bug with text\n// fields in IE7-8. Source: https://github.com/twbs/bootstrap/pull/3552.\n\n.fade {\n  opacity: 0;\n  .transition(opacity .15s linear);\n  &.in {\n    opacity: 1;\n  }\n}\n\n.collapse {\n  display: none;\n\n  &.in      { display: block; }\n  tr&.in    { display: table-row; }\n  tbody&.in { display: table-row-group; }\n}\n\n.collapsing {\n  position: relative;\n  height: 0;\n  overflow: hidden;\n  .transition-property(~\"height, visibility\");\n  .transition-duration(.35s);\n  .transition-timing-function(ease);\n}\n","//\n// Dropdown menus\n// --------------------------------------------------\n\n\n// Dropdown arrow/caret\n.caret {\n  display: inline-block;\n  width: 0;\n  height: 0;\n  margin-left: 2px;\n  vertical-align: middle;\n  border-top:   @caret-width-base dashed;\n  border-top:   @caret-width-base solid ~\"\\9\"; // IE8\n  border-right: @caret-width-base solid transparent;\n  border-left:  @caret-width-base solid transparent;\n}\n\n// The dropdown wrapper (div)\n.dropup,\n.dropdown {\n  position: relative;\n}\n\n// Prevent the focus on the dropdown toggle when closing dropdowns\n.dropdown-toggle:focus {\n  outline: 0;\n}\n\n// The dropdown menu (ul)\n.dropdown-menu {\n  position: absolute;\n  top: 100%;\n  left: 0;\n  z-index: @zindex-dropdown;\n  display: none; // none by default, but block on \"open\" of the menu\n  float: left;\n  min-width: 160px;\n  padding: 5px 0;\n  margin: 2px 0 0; // override default ul\n  list-style: none;\n  font-size: @font-size-base;\n  text-align: left; // Ensures proper alignment if parent has it changed (e.g., modal footer)\n  background-color: @dropdown-bg;\n  border: 1px solid @dropdown-fallback-border; // IE8 fallback\n  border: 1px solid @dropdown-border;\n  border-radius: @border-radius-base;\n  .box-shadow(0 6px 12px rgba(0,0,0,.175));\n  background-clip: padding-box;\n\n  // Aligns the dropdown menu to right\n  //\n  // Deprecated as of 3.1.0 in favor of `.dropdown-menu-[dir]`\n  &.pull-right {\n    right: 0;\n    left: auto;\n  }\n\n  // Dividers (basically an hr) within the dropdown\n  .divider {\n    .nav-divider(@dropdown-divider-bg);\n  }\n\n  // Links within the dropdown menu\n  > li > a {\n    display: block;\n    padding: 3px 20px;\n    clear: both;\n    font-weight: normal;\n    line-height: @line-height-base;\n    color: @dropdown-link-color;\n    white-space: nowrap; // prevent links from randomly breaking onto new lines\n  }\n}\n\n// Hover/Focus state\n.dropdown-menu > li > a {\n  &:hover,\n  &:focus {\n    text-decoration: none;\n    color: @dropdown-link-hover-color;\n    background-color: @dropdown-link-hover-bg;\n  }\n}\n\n// Active state\n.dropdown-menu > .active > a {\n  &,\n  &:hover,\n  &:focus {\n    color: @dropdown-link-active-color;\n    text-decoration: none;\n    outline: 0;\n    background-color: @dropdown-link-active-bg;\n  }\n}\n\n// Disabled state\n//\n// Gray out text and ensure the hover/focus state remains gray\n\n.dropdown-menu > .disabled > a {\n  &,\n  &:hover,\n  &:focus {\n    color: @dropdown-link-disabled-color;\n  }\n\n  // Nuke hover/focus effects\n  &:hover,\n  &:focus {\n    text-decoration: none;\n    background-color: transparent;\n    background-image: none; // Remove CSS gradient\n    .reset-filter();\n    cursor: @cursor-disabled;\n  }\n}\n\n// Open state for the dropdown\n.open {\n  // Show the menu\n  > .dropdown-menu {\n    display: block;\n  }\n\n  // Remove the outline when :focus is triggered\n  > a {\n    outline: 0;\n  }\n}\n\n// Menu positioning\n//\n// Add extra class to `.dropdown-menu` to flip the alignment of the dropdown\n// menu with the parent.\n.dropdown-menu-right {\n  left: auto; // Reset the default from `.dropdown-menu`\n  right: 0;\n}\n// With v3, we enabled auto-flipping if you have a dropdown within a right\n// aligned nav component. To enable the undoing of that, we provide an override\n// to restore the default dropdown menu alignment.\n//\n// This is only for left-aligning a dropdown menu within a `.navbar-right` or\n// `.pull-right` nav component.\n.dropdown-menu-left {\n  left: 0;\n  right: auto;\n}\n\n// Dropdown section headers\n.dropdown-header {\n  display: block;\n  padding: 3px 20px;\n  font-size: @font-size-small;\n  line-height: @line-height-base;\n  color: @dropdown-header-color;\n  white-space: nowrap; // as with > li > a\n}\n\n// Backdrop to catch body clicks on mobile, etc.\n.dropdown-backdrop {\n  position: fixed;\n  left: 0;\n  right: 0;\n  bottom: 0;\n  top: 0;\n  z-index: (@zindex-dropdown - 10);\n}\n\n// Right aligned dropdowns\n.pull-right > .dropdown-menu {\n  right: 0;\n  left: auto;\n}\n\n// Allow for dropdowns to go bottom up (aka, dropup-menu)\n//\n// Just add .dropup after the standard .dropdown class and you're set, bro.\n// TODO: abstract this so that the navbar fixed styles are not placed here?\n\n.dropup,\n.navbar-fixed-bottom .dropdown {\n  // Reverse the caret\n  .caret {\n    border-top: 0;\n    border-bottom: @caret-width-base dashed;\n    border-bottom: @caret-width-base solid ~\"\\9\"; // IE8\n    content: \"\";\n  }\n  // Different positioning for bottom up menu\n  .dropdown-menu {\n    top: auto;\n    bottom: 100%;\n    margin-bottom: 2px;\n  }\n}\n\n\n// Component alignment\n//\n// Reiterate per navbar.less and the modified component alignment there.\n\n@media (min-width: @grid-float-breakpoint) {\n  .navbar-right {\n    .dropdown-menu {\n      .dropdown-menu-right();\n    }\n    // Necessary for overrides of the default right aligned menu.\n    // Will remove come v4 in all likelihood.\n    .dropdown-menu-left {\n      .dropdown-menu-left();\n    }\n  }\n}\n","// Horizontal dividers\n//\n// Dividers (basically an hr) within dropdowns and nav lists\n\n.nav-divider(@color: #e5e5e5) {\n  height: 1px;\n  margin: ((@line-height-computed / 2) - 1) 0;\n  overflow: hidden;\n  background-color: @color;\n}\n","// Reset filters for IE\n//\n// When you need to remove a gradient background, do not forget to use this to reset\n// the IE filter for IE9 and below.\n\n.reset-filter() {\n  filter: e(%(\"progid:DXImageTransform.Microsoft.gradient(enabled = false)\"));\n}\n","//\n// Button groups\n// --------------------------------------------------\n\n// Make the div behave like a button\n.btn-group,\n.btn-group-vertical {\n  position: relative;\n  display: inline-block;\n  vertical-align: middle; // match .btn alignment given font-size hack above\n  > .btn {\n    position: relative;\n    float: left;\n    // Bring the \"active\" button to the front\n    &:hover,\n    &:focus,\n    &:active,\n    &.active {\n      z-index: 2;\n    }\n  }\n}\n\n// Prevent double borders when buttons are next to each other\n.btn-group {\n  .btn + .btn,\n  .btn + .btn-group,\n  .btn-group + .btn,\n  .btn-group + .btn-group {\n    margin-left: -1px;\n  }\n}\n\n// Optional: Group multiple button groups together for a toolbar\n.btn-toolbar {\n  margin-left: -5px; // Offset the first child's margin\n  &:extend(.clearfix all);\n\n  .btn,\n  .btn-group,\n  .input-group {\n    float: left;\n  }\n  > .btn,\n  > .btn-group,\n  > .input-group {\n    margin-left: 5px;\n  }\n}\n\n.btn-group > .btn:not(:first-child):not(:last-child):not(.dropdown-toggle) {\n  border-radius: 0;\n}\n\n// Set corners individual because sometimes a single button can be in a .btn-group and we need :first-child and :last-child to both match\n.btn-group > .btn:first-child {\n  margin-left: 0;\n  &:not(:last-child):not(.dropdown-toggle) {\n    .border-right-radius(0);\n  }\n}\n// Need .dropdown-togg