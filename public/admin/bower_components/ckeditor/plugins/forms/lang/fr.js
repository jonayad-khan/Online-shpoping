d({h: 3}).fromNow(), 'za 3 hodiny', 'in 3 hours');
    assert.equal(moment().add({h: 10}).fromNow(), 'za 10 hodin', 'in 10 hours');
    assert.equal(moment().add({d: 1}).fromNow(), 'za den', 'in a day');
    assert.equal(moment().add({d: 3}).fromNow(), 'za 3 dny', 'in 3 days');
    assert.equal(moment().add({d: 10}).fromNow(), 'za 10 dní', 'in 10 days');
    assert.equal(moment().add({M: 1}).fromNow(), 'za měsíc', 'in a month');
    assert.equal(moment().add({M: 3}).fromNow(), 'za 3 měsíce', 'in 3 months');
    assert.equal(moment().add({M: 10}).fromNow(), 'za 10 měsíců', 'in 10 months');
    assert.equal(moment().add({y: 1}).fromNow(), 'za rok', 'in a year');
    assert.equal(moment().add({y: 3}).fromNow(), 'za 3 roky', 'in 3 years');
    assert.equal(moment().add({y: 10}).fromNow(), 'za 10 let', 'in 10 years');
});

test('fromNow (past)', function (assert) {
    assert.equal(moment().subtract({s: 30}).fromNow(), 'před pár sekundami', 'a few seconds ago');
    assert.equal(moment().subtract({m: 1}).fromNow(), 'před minutou', 'a minute ago');
    assert.equal(moment().subtract({m: 3}).fromNow(), 'před 3 minutami', '3 minutes ago');
    assert.equal(moment().subtract({m: 10}).fromNow(), 'před 10 minutami', '10 minutes ago');
    assert.equal(moment().subtract({h: 1}).fromNow(), 'před hodinou', 'an hour ago');
    asse