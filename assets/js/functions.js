function getInfo (url) {

    return new Promise(function(resolve, reject) {

        jQuery.ajax({
            url: url,
            method: 'get',
            crossDomain: true,
            success: function (res) {
                resolve(res);
            },
            error: function (err) {
                reject(err);
            }
        })
    });


}

function objectFilterKey(item) {
    var result = _.pickBy(thing, function(value, key) {
        return _.startsWith(key, item);
    });

    return result[item];
}

