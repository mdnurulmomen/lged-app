$(document).ready(function () {
    if ($('.select-select2').length > 0) {
        $('.select-select2').select2();
    }
});

$(document).ajaxComplete(function () {
    $('.select-select2').select2();
});

function pad(str, max) {
    str = str.toString();
    return str.length < max ? pad("0" + str, max) : str;
}

function getUsername(value) {
    var inputVal = value;
    var firstPart = inputVal.substr(0, 1);
    var username = pad(inputVal.substr(1, inputVal.length), 11);
    username = firstPart + username;
    return username;
}

$(document).on('blur', "input[name=username]", function () {
    if ($.isNumeric($(this).val())) {
        $(this).val(getUsername($(this).val()));
    }
})

function makeAreaResizable(element) {
    var resizeOpts = {
        handles: 'e, w'
    };

    $(`${element}`).css("overflow-x", 'hidden');
    $(`${element}`).resizable(resizeOpts);
    $(`${element}`).removeClass('ui-resizable');
    $(`${element}`).resize(function () {
        $(`${element}`).css("left", 'auto');
        $(`${element}`).css("overflow-x", 'hidden');
        $(`${element}`).css("min-width", '500px !important');
    });
}
