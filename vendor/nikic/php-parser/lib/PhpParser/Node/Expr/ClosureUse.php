 (e) {
            if ('A' == e.target.tagName) {
                f(e.target, e);
            } else if ('A' == e.target.parentNode.tagName) {
                f(e.target.parentNode, e);
            } else if (e.target.nextElementSibling && 'A' == e.target.nextElementSibling.tagName) {
                f(e.target.nextElementSibling, e, true);
            }
        });
    };
    function isCtrlKey(e) {
        return e.ctrlKey || e.metaKey;
    }
    function xpathString(str) {
        var parts = str.match(/[^'"]+|['"]/g).map(function (part) {
            if ("'" == part)  {
                return '"\'"';
            }
            if ('"' == part) {
                return "'\"'";
            }

            return "'" + part + "'";
   