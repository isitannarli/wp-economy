var dovizApi = 'https://www.doviz.com/api/v1/currencies/all/latest';
var altinApi = 'https://www.doviz.com/api/v1/golds/all/latest';
var stocksApi = 'https://www.doviz.com/api/v1/stocks/all/latest';
var parityApi = 'https://anapara.com/export/json.php?s=EURTRY,USDTRY,EURUSD,GBPTRY,EURUSD,USDJPY,EURTRY,USDTRY,GBPUSD,GBPTRY';
var parityShortcodeApi = 'https://anapara.com/export/json.php?s=';

var time = 10000;

function getCurrency(url, typeName, objectName, list, element) {
    var array = [];

    getInfo(url).then(function(res) {
        var content = '';

        content += '<table class="wp-economy-parity">';
        content += '<thead>';
        content += '<tr class="head">';
        content += '<td class="item" colspan="2">' + typeName + '</td>';
        content += '<td class="item">Alış</td>';
        content += '<td class="item">Satış</td>';
        content += '</tr>';
        content += '</head>';
        content += '<tbody>';

        for (i = 0; i < res.length; i++) {

            var result = res[i];

            if(list.search(result[objectName]) > -1) {
                array.push(result);

                content += '<tr class="items">';
                content += '<td class="item" title="' + result.full_name + '"><b>' + result[objectName] + '</b></td>';

                if(result.change_rate.toString().search("-") > -1) {
                    content += '<td class="item"><i class="arrown-down" ></i></td>';
                } else {
                    content += '<td class="item"><i class="arrown-up" ></i></td>';
                }

                content += '<td class="item">' + result.buying  + '</td>';
                content += '<td class="item">' + result.selling  + '</td>';
                content += '</tr>';

            }
        }

        content += '</tbody>';
        content += '</table>';

        jQuery(element).html(content);

    });
}

function currency (type, list, element) {

    if(type == "doviz") {
        var typeName = 'Döviz';
        var url = dovizApi;
        var objectName = 'code';
    } else if(type == 'altin') {
        var typeName = 'Altın';
        var url = altinApi;
        var objectName = 'short_name';
    }

    getCurrency(url, typeName, objectName, list, element);

    setInterval(function(){
        getCurrency(url, typeName, objectName, list, element);
    }, time);

}


function getStocks(list, element) {
    var array = [];

    getInfo(stocksApi).then(function(res) {

        res = _.orderBy(res, ['capital_stock'], ['desc']);

        var content = '';

        content += '<table class="wp-economy-parity">';
        content += '<thead>';
        content += '<tr class="head">';
        content += '<td class="item" colspan="2">Hisse</td>';
        content += '<td class="item">Son</td>';
        content += '<td class="item">Değişim(%)</td>';
        content += '</tr>';
        content += '</head>';
        content += '<tbody>';

        for (i = 0; i < res.length; i++) {

            var result = res[i];

            if(list.search(result.name) > -1) {
                array.push(result);

                content += '<tr class="items">';
                content += '<td class="item" title="' + result.full_name + '"><b>' + result.name + '</b></td>';

                if(result.change_rate.toString().search("-") > -1) {
                    content += '<td class="item"><i class="arrown-down" ></i></td>';
                } else {
                    content += '<td class="item"><i class="arrown-up" ></i></td>';
                }

                content += '<td class="item">' + result.latest  + '</td>';
                content += '<td class="item">' + result.change_rate  + '</td>';
                content += '</tr>';

            }
        }

        content += '</tbody>';
        content += '</table>';

        jQuery(element).html(content);

    });
}

function stocks(list, element) {
    getStocks(list, element);

    setInterval(function(){
        getStocks(list, element);
    }, time);
}

function getParity(list, element) {
    var array = [];

    getInfo(parityApi).then(function(res) {

        res = res.feeds;

        var content = '';

        content += '<table class="wp-economy-parity">';
        content += '<thead>';
        content += '<tr class="head">';
        content += '<td class="item" colspan="2">Enstrüman</td>';
        content += '<td class="item">Fiyat</td>';
        content += '<td class="item">Değişim(%)</td>';
        content += '</tr>';
        content += '</head>';
        content += '<tbody>';

        for (i = 0; i < res.length; i++) {

            var result = res[i];

            if(list.search(result.f_Symbol) > -1) {
                array.push(result);

                content += '<tr class="items">';
                content += '<td class="item" title="' + result.f_Symbol + '"><b>' + result.f_Symbol + '</b></td>';

                if(result.f_ChangeinPercent.search("-") > -1) {
                    content += '<td class="item"><i class="arrown-down" ></i></td>';
                } else {
                    content += '<td class="item"><i class="arrown-up" ></i></td>';
                }

                content += '<td class="item">' + result.f_Ask  + '</td>';
                content += '<td class="item">' + result.f_ChangeinPercent  + '</td>';
                content += '</tr>';

            }
        }

        content += '</tbody>';
        content += '</table>';

        jQuery(element).html(content);

    });
}

function parity(list, element) {
    getParity(list, element);

    setInterval(function(){
        getParity(list, element);
    }, time);
}

function getParityShortcode(name) {
    getInfo(parityShortcodeApi + name).then(function(res) {

        res = res.feeds[0];

        jQuery('#parityPrice').html(res.f_LastTradePriceOnly);

        if(res.f_ChangeinPercent.search("-") > -1) {
            jQuery('#parityIcon').html('<i class="parityIcon arrown-down" ></i>');
            jQuery('#parityChangeRate').html('<span class="parityChangeRate red">(' + res.f_ChangeinPercent + ')</span>');
        } else {
            jQuery('#parityIcon').html('<i class="parityIcon arrown-up" ></i>');
            jQuery('#parityChangeRate').html('<span class="parityChangeRate green">(' + res.f_ChangeinPercent + ')</span>');
        }
        jQuery('#paritySymbol').html(res.f_Symbol);

        jQuery('#paritySelling').html(res.f_Ask);

        jQuery('#parityDailyHight').html(res.f_DaysHigh);

        jQuery('#parityClosePrice').html(res.f_PreviousClose);

        jQuery('#parityLast').html(res.f_LastTradePriceOnly);

        jQuery('#parityDailyLow').html(res.f_DaysLow);

        var difference = eval(res.f_DaysHigh) - eval(res.f_DaysLow);

        jQuery('#parityOpenPrice').html(eval(res.f_Ask) + difference);

    });
}

function parityShortcode(name) {

    getParityShortcode(name);

    setInterval(function(){
        getParityShortcode(name);
    }, time);
}