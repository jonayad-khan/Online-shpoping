ddEventListener(searchInput, 'keyup', function (e) {
            var searchQuery = e.target.value;
            /* Don't perform anything if the pressed key didn't change the query */
            if (searchQuery === previousSearchQuery) {
                return;
            }
            previousSearchQuery = searchQuery;
            clearTimeout(searchInputTimer);
            searchInputTimer = setTimeout(function () {
                state.reset();
                collapseAll(root);
                resetHighlightedNodes(root);
                if ('' === searchQuery) {
                    counter.textContent = '0 of 0';

                    return;
    