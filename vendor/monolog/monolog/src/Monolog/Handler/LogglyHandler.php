}()|\[\]\/\\])/g,
    idRx = /\bsf-dump-\d+-ref[012]\w+\b/,
    keyHint = 0 <= navigator.platform.toUpperCase().indexOf('MAC') ? 'Cmd' : 'Ctrl',
    addEventListener = function (e, n, cb) {
        e.addEventListener(n, cb, false);
    };

(doc.documentElement.firstElementChild || doc.documentElement.children[0]).appendChild(refStyle);

if (!doc.addEventListener) {
    addEventListener = function (element, eventName, callback) {
        element.attachEvent('on' + eventName, function (e) {
            e.preventDefault = function () {e.returnValue = false;};
            e.target = e.srcElement;
            callback(e);
        });
    };
}

function toggle(a, recursive) {
    var s = a.nextSibling || {}, oldClass = s.className, arrow, newClass;

    if (/\bsf-dump-compact\b/.test(oldClass)) {
        arrow = '▼';
        newClass = 'sf-dump-expanded';
    } else if (/\bsf-dump-expanded\b/.test(oldClass)) {
        arrow = '▶';
        newClass = 'sf-dump-compact';
    } else {
        return false;
    }

    if (doc.createEvent && s.dispatchEvent) {
        var event = doc.createEvent('Event');
        event.initEvent('sf-dump-expanded' === newClass ? 'sfbeforedumpexpand' : 'sfbeforedumpcollapse', true, false);

        s.dispatchEvent(event);
    }

    a.lastChild.innerHTML = arrow;
    s.className = s.className.replace(/\bsf-dump-(compact|expanded)\b/, newClass);

    if (recursive) {
        try {
            a = s.querySelectorAll('.'+oldClass);
            for (s = 0; s < a.length; ++s) {
                if (-1 == a[s].className.indexOf(newClass)) {
                    a[s].className = newClass;
                    a[s].previousSibling.lastChild.innerHTML = arrow;
                }
            }
        } catch (e) {
        }
    }

    return true;
};

function collapse(a, recursive) {
    var s = a.nextSibling || {}, oldClass = s.className;

    if (/\bsf-dump-expanded\b/.test(oldClass)) {
        toggle(a, recursive);

        return true;
    }

    return false;
};

function expand(a, recursive) {
    var s = a.nextSibling || {}, oldClass = s.className;

    if (/\bsf-dump-compact\b/.test(oldClass)) {
        toggle(a, recursive);

        return true;
    }

    return false;
};

function collapseAll(root) {
    var a = root.querySelector('a.sf-dump-toggle');
    if (a) {
        collapse(a, true);
        expand(a);

        return true;
    }

    return false;
}

function reveal(node) {
    var previous, parents = [];

    while ((node = node.parentNode || {}) && (previous = node.previousSibling) && 'A' === previous.tagName) {
        parents.push(previo