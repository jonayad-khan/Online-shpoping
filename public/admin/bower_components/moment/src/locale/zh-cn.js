 inherit their parent's `cursor`.\n//\n// Note: Neither radios nor checkboxes can be readonly.\ninput[type=\"radio\"],\ninput[type=\"checkbox\"] {\n  &[disabled],\n  &.disabled,\n  fieldset[disabled] & {\n    cursor: @cursor-disabled;\n  }\n}\n// These classes are used directly on <label>s\n.radio-inline,\n.checkbox-inline {\n  &.disabled,\n  fieldset[disabled] & {\n    cursor: @cursor-disabled;\n  }\n}\n// These classes are used on elements with <label> descendants\n.radio,\n.checkbox {\n  &.disabled,\n  fieldset[disabled] & {\n    label {\n      cursor: @cursor-disabled;\n    }\n  }\n}\n\n\n// Static form control text\n//\n// Apply class to a `p` element to make any string of text align with labels in\n// a horizontal form layout.\n\n.form-control-static {\n  // Size it appropriately next to real form controls\n  padding-top: (@padding-base-vertical + 1);\n  padding-bottom: (@padding-base-vertical + 1);\n  // Remove default margin from `p`\n  margin-bottom: 0;\n  min-height: (@line-height-computed + @font-size-base);\n\n  &.input-lg,\n  &.input-sm {\n    padding-left: 0;\n    padding-right: 0;\n  }\n}\n\n\n// Form control sizing\n//\n// Build on `.form-control` with modifier classes to decrease or increase the\n// height and font-size of form controls.\n//\n// The `.form-group-* form-control` variations are sadly duplicated to avoid the\n// issue documented in https://github.com/twbs/bootstrap/issues/15074.\n\n.input-sm {\n  .input-size(@input-height-small; @padding-small-vertical; @padding-small-horizontal; @font-size-small; @line-height-small; @input-border-radius-small);\n}\n.form-group-sm {\n  .form-control {\n    height: @input-height-small;\n    padding: @padding-small-vertical @padding-small-horizontal;\n    font-size: @font-size-small;\n    line-height: @line-height-small;\n    border-radius: @input-border-radius-small;\n  }\n  select.form-control {\n    height: @input-height-small;\n    line-height: @input-height-small;\n  }\n  textarea.form-control,\n  select[multiple].form-control {\n    height: auto;\n  }\n  .form-control-static {\n    height: @input-height-small;\n    min-height: (@line-height-computed + @font-size-small);\n    padding: (@padding-small-vertical + 1) @padding-small-horizontal;\n    font-size: @font-size-small;\n    line-height: @line-height-small;\n  }\n}\n\n.input-lg {\n  .input-size(@input-height-large; @padding-large-vertical; @padding-large-horizontal; @font-size-large; @line-height-large; @input-border-radius-large);\n}\n.form-group-lg {\n  .form-control {\n    height: @input-height-large;\n    padding: @padding-large-vertical @padding-large-horizontal;\n    font-size: @font-size-large;\n    line-height: @line-height-large;\n    border-radius: @input-border-radius-large;\n  }\n  select.form-control {\n    height: @input-height-large;\n    line-height: @input-height-large;\n  }\n  textarea.form-control,\n  select[multiple].form-control {\n    height: auto;\n  }\n  .form-control-static {\n    height: @input-height-large;\n    min-height: (@line-height-computed + @font-size-large);\n    padding: (@padding-large-vertical + 1) @padding-large-horizontal;\n    font-size: @font-size-large;\n    line-height: @line-height-large;\n  }\n}\n\n\n// Form control feedback states\n//\n// Apply contextual and semantic 