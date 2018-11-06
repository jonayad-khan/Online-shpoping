, 'text/html', 1.0);
        yield array('text/plain;q=0.5, text/html, text/x-dvi;q=0.8, */*;q=0.3', 'text/plain', 0.5);
        yield array('text/plain;q=0.5, text/html, text/x-dvi;q=0.8, */*;q=0.3', '*', 0.3);
        yield array('text/plain;q=0.5, text/html, text/x-dvi;q=0.8, */*', '*', 1.0);
        yield array('text/plain;q=0.5, text/html, text/x-dvi;q=0.8, */*', 'text/xml', 1.0);
        yield array('text/plain;q=0.5, text/html, text/x-dvi;q=0.8, */*', 'text/*', 1.0);
        yield array('text/plain;q=0.5, text/html, text/*;q=0.8, */*', 'text/*', 0.8);
        yield array('text/plain;q=0.5, text/html, text/*;q=0.8, */*', 'text/html', 1.0);
        yield 