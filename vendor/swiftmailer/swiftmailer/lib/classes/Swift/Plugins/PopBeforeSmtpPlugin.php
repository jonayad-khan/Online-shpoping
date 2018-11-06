e-code .frame-file {
      color: #a29d9d;
      padding: 12px 6px;

      border-bottom: none;
    }

    .code-block {
      padding: 10px;
      margin: 0;
      border-radius: 6px;
      box-shadow: 0 3px 0 rgba(0, 0, 0, .05),
                  0 10px 30px rgba(0, 0, 0, .05),
                  inset 0 0 1px 0 rgba(255, 255, 255, .07);
      -moz-tab-size: 4;
      -o-tab-size: 4;
      tab-size: 4;
    }

    .linenums {
      margin: 0;
      margin-left: 10px;
    }

    .frame-comments {
      border-top: none;
      margin-top: 15px;

      font-size: 12px;
    }

    .frame-comments.empty {
    }

    .frame-comments.empty:before {
      content: "No comments for this stack frame.";
      font-weight: 300;
      color: #a29d9d;
    }

    .frame-comment {
      padding: 10px;
      color: #e3e3e3;
      border-radius: 6px;
      background-color: rgba(255, 255, 255, .05);
    }
      .frame-comment a {
        font-weight: bold;
        text-decoration: none;
      }
        .frame-comment a:hover {
          color: #4bb1b1;
        }

    .frame-comment:not(:last-child) {
      border-bottom: 1px dotted rgba(0, 0, 0, .3);
    }

    .frame-comment-context {
      font-size: 10px;
      color: white;
    }

.delimiter {
  display: inline-block;
}

.data-table-container label {
  font-size: 16px;
  color: #303030;
  font-weight: bold;
  margin: 10px 0;

  display: block;

  margin-bottom: 5px;
  padding-bottom: 5px;
}
  .data-table {
    width: 100%;
    margin-bottom: 10px;
  }

  .data-table tbody {
    font: 13px "Inconsolata", "Fira Mono", "Source Code Pro", Monaco, Consolas, "Lucida Console", monospace;
  }

  .data-table thead {
    display: none;
  }

  .data-table tr {
    padding: 5px 0;
  }

  .data-table td:first-child {
    width: 20%;
    min-width: 130px;
    overflow: hidden;
    font-weight: bold;
    color: #463C54;
    padding-right: 5px;

  }

  .data-table td:last-child {
    width: 80%;
    -ms-word-break: break-all;
    word-break: break-all;
    word-break: break-word;
    -webkit-hyphens: auto;
    -moz-hyphens: auto;
    hyphens: auto;
  }

  .data-table span.empty {
    color: rgba(0, 0, 0, .3);
    font-weight: 300;
  }
  .data-table label.empty {
    display: inline;
  }

.handler {
  padding: 4px 0;
  font: 14px "Inconsolata", "Fira Mono", "Source Code Pro", Monaco, Consolas, "Lucida Console", monospace;
}

/* prettify code style
Uses the Doxy theme as a base */
pre .str, code .str { color: #BCD42A; }  /* string  */
pre .kwd, code .kwd { color: #4bb1b1;  font-weight: bold; }  /* keyword*/
pre .com, code .com { color: #888; font-weight: bold; } /* comment */
pre .typ, code .typ { color: #ef7c61; }  /* type  */
pre .lit, code .lit { color: #BCD42A; }  /* literal */
pre .pun, code .pun { color: #fff; font-weight: bold;  } /* punctuation  */
pre .pln, code .pln { color: #e9e4e5; }  /* plaintext  */
pre .tag, code .tag { color: #4bb1b1; }  /* html/xml tag  */
pre .htm, code .htm { color: #dda0dd; }  /* html tag */
pre .xsl, code .xsl { color: #d0a0d0; }  /* xslt tag */
pre .atn, code .atn { color: #ef7c61; font-weight: normal;} /* html/xml attribute name */
pre .atv, code .atv { color: #bcd42a; }  /* html/xml attribute value  */
pre .dec, code .dec { color: #606; }  /* decimal  */
pre.code-block, code.code-block, .frame-args.code-block, .frame-args.code-block samp {
  font-family: "Inconsolata", "Fira Mono", "Source Code Pro", Monaco, Consolas, "Lucida Console", monospace;
  background: #333;
  color: #e9e4e5;
}
  pre.code-block {
    white-space: pre-wrap;
  }

  pre.code-block a, code.code-block a {
    text-decoration:none;
  }

  .linenums li {
    color: #A5A5A5;
  }

  .linenums li.current{
    background: rgba(255, 100, 100, .07);
  }
    .linenums li.current.active {
      background: rgba(255, 100, 100, .17);
    }

pre:not(.prettyprinted) {
  padding-left: 60px;
}

#plain-exception {
  display: none;
}

#copy-button {
  cursor: pointer;
  border: 0;
}

.clipboard {
  opacity: .8;
  background: none;

  color: rgba(255, 255, 255, 0.1);
  box-shadow: inset 0 0 0 2px rgba(255, 255, 255, 0.1);

  border-radius: 3px;

  outline: none !important;
}

  .clipboard:hover {
    box-shadow: inset 0 0 0 2px rgba(255, 255, 255, 0.3);
    color: rgba(255, 255, 255, 0.3);
  }

/* inspired by githubs kbd styles */
kbd {
  -moz-border-bottom-colors: none;
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
  background-color: #fcfcfc;
  border-color: #ccc #ccc #bbb;
  border-image: none;
  border-style: solid;
  border-width: 1px;
  color: #555;
  display: inline-block;
  font-size: 11px;
  line-height: 10px;
  padding: 3px 5px;
  vertical-align: middle;
}


/* == Media queries */

/* Expand the spacing in the details section */
@media (min-width: 1000px) {
  .details, .frame-code {
    padding: 20px 40px;
  }

  .details-container {
    left: 32%;
    width: 68%;
  }

  .frames-container {
    margin: 5px;
  }

  .left-panel {
    width: 32%;
  }
}

.tooltipped {
  position: relative
}
.tooltipped:after {
  position: absolute;
  z-index: 1000000;
  display: none;
  padding: 5px 8px;
  color: #fff;
  text-align: center;
  text-decoration: none;
  text-shadow: none;
  text-transform: none;
  letter-spacing: normal;
  word-wrap: break-word;
  white-space: pre;
  pointer-events: none;
  content: attr(aria-label);
  background: rgba(0, 0, 0, 0.8);
  border-radius: 3px;
  -webkit-font-smoothing: subpixel-antialiased
}
.tooltipped:before {
  position: absolute;
  z-index: 1000001;
  display: none;
  width: 0;
  height: 0;
  color: rgba(0, 0, 0, 0.8);
  pointer-events: none;
  content: "";
  border: 5px solid transparent
}
.tooltipped:hover:before,
.tooltipped:hover:after,
.tooltipped:active:before,
.tooltipped:active:after,
.tooltipped:focus:before,
.tooltipped:focus:after {
  display: inline-block;
  text-decoration: none
}
.tooltipped-s:after {
  top: 100%;
  right: 50%;
  margin-top: 5px
}
.tooltipped-s:before {
  top: auto;
  right: 50%;
  bottom: -5px;
  margin-right: -5px;
  border-bottom-color: rgba(0, 0, 0, 0.8)
}

pre.sf-dump {
  padding: 0px !important;
  margin: 0px !important;
}

.search-for-help {
  width: 85%;
  padding: 0;
  margin: 10px 0;
  list-style-type: none;
  display: inline-block;
}
  .search-for-help li {
    display: inline-block;
    margin-right: 5px;
  }
  .search-for-help li:last-child {
    margin-right: 0;
  }
    .sea