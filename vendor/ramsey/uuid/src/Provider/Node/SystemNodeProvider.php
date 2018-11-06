 day');
        m.hours(23).minutes(59).seconds(59).milliseconds(999);
        assert.equal(m.calendar(),       m.format('[' + nextDay + '] [v] LT'),  'Today + ' + i + ' days end of day');
    }
});

test('calendar last week', function (assert) {
    var i, m, lastDay;
    for (i = 2; i < 7; i++) {
        m = moment().subtract({d: i});
        lastDay = '';
        switch (m.day()) {
            case 0:
                lastDay = 'minulou neděli';
                break;
            case 1:
                lastDay = 'minulé pondělí';
                break;
            case 2:
                lastDay = 'minulé úterý';
                break;
            case 3:
                lastDay = 'minulou středu';
                break;
            case 4:
                lastDay = 'minulý čtvrtek';
                break;
            case 5:
                lastDay = 'minulý pátek';
                break;
            case 6:
                lastDay = 'minulou sobotu';
                break;
        }
        assert.equal(m.calendar(),       m.format('[' + lastDay + '] [v] LT'),  'Today - ' + i + ' days current time');
        m.hours(0).minutes(0).seconds(0).milliseconds(0);
        assert.equal(m.calendar(),       m.format('[' + lastDay + '] [v] LT'),  'Today - ' + i + ' days beginning of day');
        m.hours(23).minutes(59).seconds(59).milliseconds(999);
        assert.equal(m.calendar(),       m.format('[' + lastDay + '] [v] LT'),  'Today - ' + i + ' days end of day');
    }
});

test('calendar all else', function (assert) {
    var weeksAgo = moment().subtract({w: 1}),
        weeksFromNow = moment().add({w: 1});

    assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '1 week ago');
    assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 1 week');

    weeksAgo = moment().subtract({w: 2});
    weeksFromNow = moment().add({w: 2});

    assert.equal(weeksAgo.calendar(),       weeksAgo.format('L'),  '2 weeks ago');
    assert.equal(weeksFromNow.calendar(),   weeksFromNow.format('L'),  'in 2 weeks');
});

test('humanize duration', function (assert) 