format('DDDo'), '4-мӗш', '4-мӗш');
    assert.equal(moment([2011, 0, 5]).format('DDDo'), '5-мӗш', '5-мӗш');
    assert.equal(moment([2011, 0, 6]).format('DDDo'), '6-мӗш', '6-мӗш');
    assert.equal(moment([2011, 0, 7]).format('DDDo'), '7-мӗш', '7-мӗш');
    assert.equal(moment([2011, 0, 8]).format('DDDo'), '8-мӗш', '8-мӗш');
    assert.equal(moment([2011, 0, 9]).format('DDDo'), '9-мӗш', '9-мӗш');
    assert.equal(moment([2011, 0, 10]).format('DDDo'), '10-мӗш', '10-мӗш');

    assert.equal(moment([2011, 0, 11]).format('DDDo'), '11-мӗш', '11-мӗш');
    assert.equal(moment([2011, 0, 12]).format('DDDo'), '12-мӗш', '12-мӗш');
    assert.equal(moment([2011, 0, 13]).format('DDDo'), '13-мӗш', '13-мӗш');
    assert.equal(moment([2011, 0, 14]).format('DDDo'), '14-мӗш', '14-мӗш');
    assert.equal(moment([2011, 0, 15]).format('DDDo'), '15-мӗш', '15-мӗш');
    assert.equal(moment([2011, 0, 16]).format('DDDo'), '16-мӗш', '16-мӗш');
    assert.equal(moment([2011, 0, 17]).format('DDDo'), '17-мӗш', '17-мӗш');
    assert.equal(moment([2011, 0, 18]).format('DDDo'), '18-мӗш', '18-мӗш');
    assert.equal(moment([2011, 0, 19]).format('DDDo'), '19-мӗш', '19-мӗш');
    assert.equal(moment([2011, 0, 20]).format('DDDo'), '20-мӗш', '20-мӗш');

    assert.equal(moment([2011, 0, 21]).format('DDDo'), '21-мӗш', '21-мӗш');
    assert.equal(moment([2011, 0, 22]).format('DDDo'), '22-мӗш', '22-мӗш');
    assert.equal(moment([2011, 0, 23]).format('DDDo'), '23-мӗш', '23-мӗш');
    assert.equal(moment([2011, 0, 24]).format('DDDo'), '24-мӗш', '24-мӗш');
    assert.equal(moment([2011, 0, 25]).format('DDDo'), '25-мӗш', '25-мӗш');
    assert.equal(moment([2011, 0, 26]).format('DDDo'), '26-мӗш', '26-мӗш');
    assert.equal(moment([2011, 0, 27]).format('DDDo'), '27-мӗш', '27-мӗш');
    assert.equal(moment([2011, 0, 28]).format('DDDo'), '28-мӗш', '28-мӗш');
    assert.equal(moment([2011, 0, 29]).format('DDDo'), '29-мӗш', '29-мӗш');
    assert.equal(moment([2011, 0, 30]).format('DDDo'), '30-мӗш', '30-мӗш');

    assert.equal(moment([2011, 0, 31]).format('DDDo'), '31-мӗш', '31-мӗш');
});

test('format month', function (assert) {
    var expected = 'кӑрлач кӑр_нарӑс нар_пуш пуш_ака ака_май май_ҫӗртме ҫӗр_утӑ утӑ_ҫурла ҫур_авӑн авн_юпа юпа_чӳк чӳк_раштав раш'.split('_'), i;
    for (i = 0; i < expected.length; i++) {
        assert.equal(moment([2011, i, 1]).format('MMMM MMM'), expected[i], expected[i]);
    }
});

test('format week', function (assert) {
    var expected = 'вырсарникун выр вр_тунтикун тун тн_ытларикун ытл ыт_юнкун юн ю