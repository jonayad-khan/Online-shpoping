 else if (/\bsf-dump-ref\b/.test(elt.className) && (a = elt.getAttribute('href'))) {
            a = a.substr(1);
            elt.className += ' '+a;

            if (/[\[{]$/.test(elt.previousSibling.nodeValue)) {
                a = a != elt.nextSibling.id && doc.getElementById(a);
                try {
                    s = a.nextSibling;
                    elt.appendChild(a);
                    s.parentNode.insertBefore(a, s);
                    if (/^[@#]/.test(elt.innerHTML)) {
                        elt.innerHTML += ' <span>▶</span>';
                    } else {
                        elt.innerHTML = '<span>▶</span>';
                        elt.className = 'sf-dump-ref';
                    }
                    elt.className += ' sf-dump-toggle';
                } catch (e) {
                    if ('&' == elt.innerHTML.charAt(0)) {
                        elt.innerHTML = '…';
                        elt.className = 'sf-dump-ref';
                    }
                }
            }
        }
    }

    if (doc.evaluate && Array.from && root.children.length > 1) {
        root.setAttribute('tabindex', 0);

        SearchState = function () {
            this.nodes = [];
            this.idx = 0;
        };
        SearchState.prototype = {
            next: function () {
                if (this.isEmpty()) {
                    return this.current();
                }
                this.idx = this.idx < (this.nodes.length - 1) ? this.idx + 1 : 0;
        
                return this.current();
            },
            previous: function () {
                if (this.isEmpty()) {
                 