$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
AJAX_LOADER = "#ajax-loader";

function ajax_start() {
    $(AJAX_LOADER).show();
    $("#modal_loader").show();
    $('button[type=submit]').attr('disabled', true);
}

function ajax_stop() {
    $(AJAX_LOADER).hide();
    $("#modal_loader").hide();
    $('button[type=submit]').attr('disabled', false);
}

function ajaxCallAsyncCallback(url, data, datatype, method, callback) {
    $.ajax({
        async: true,
        type: method,
        url: url,
        dataType: datatype,
        data: data,
        cache: false,
        // beforeSend: function (XMLHttpRequest) {
        //     ajax_start();
        // },
        success: function (data, textStatus) {
            callback(data);
            // ajax_stop();
        },
        error: function (data) {
            if (data.data.errors) {
                $.each(data.data.errors, function (k, v) {
                    if (isArray(v)) {
                        $.each(v, function (n, m) {
                            toastr.error(m)
                        })
                    } else {
                        if (v !== '') {
                            toastr.error(v);
                        }
                    }
                });
            }
            // ajax_stop();
        },
    });
}

function ajaxCallAsyncCallbackAPI(url, data, method, callback) {
    $.ajax({
        async: true,
        type: method,
        url: url,
        data: data,
        cache: false,
        success: function (data, textStatus) {
            callback(data);
        },
        error: function (data) {
            if (data.responseJSON.errors) {
                $.each(data.responseJSON.errors, function (k, v) {
                    if (isArray(v)) {
                        $.each(v, function (n, m) {
                            toastr.error(m)
                        })
                    } else {
                        if (v !== '') {
                            toastr.error(v);
                        }
                    }
                });
            }
            // ajax_stop();
        },
    });
}

function ajaxCallUnsyncCallback(url, data, datatype, method, callback) {
    $.ajax({
        async: false,
        type: method,
        url: url,
        dataType: datatype,
        data: data,
        cache: false,
        error: function (data) {
            var errors = data.responseJSON;
            $.each(errors.errors, function (k, v) {
                if (v !== '') {
                    toastr.error(v);
                }
            });
        },
        success: function (data, textStatus) {
            callback(data);
        }
    });
}

function clearForm(form_id) {
    $(form_id).find('input:text, input:password, input:file, select, textarea').val('');
    $(form_id).find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
}


function isUnicode(string) {
    for (var i = 0; i < string.length; i++) {
        if (string.charCodeAt(i) > 127) return true;
    }
    return false;
}

function isEmpty(value) {
    return typeof (value) == 'undefined' || value === '' || value == null || value === 0;
}

function enTobn(input) {
    return BnFromEng(input);
}

function bnToen(input) {
    return EngFromBn(input);
}

function BnFromEng(input) {
    var numbers = {
        0: '০',
        1: '১',
        2: '২',
        3: '৩',
        4: '৪',
        5: '৫',
        6: '৬',
        7: '৭',
        8: '৮',
        9: '৯'
    };
    var output = '';

    if (typeof (input) == 'number') {
        input = input.toString();
    }
    if (isEmpty(input.length)) {
        return input;
    }
    for (var i = 0; i < input.length; ++i) {
        if (numbers.hasOwnProperty(input[i])) {
            output += numbers[input[i]];
        } else {
            output += input[i];
        }
    }
    return output;
}

function EngFromBn(input) {
    var numbers = {
        '০': 0,
        '১': 1,
        '২': 2,
        '৩': 3,
        '৪': 4,
        '৫': 5,
        '৬': 6,
        '৭': 7,
        '৮': 8,
        '৯': 9
    };
    var output = '';

    if (typeof (input) == 'number') {
        input = input.toString();
    }
    if (isEmpty(input)) {
        return input;
    }
    for (var i = 0; i < input.length; ++i) {
        if (numbers.hasOwnProperty(input[i])) {
            output += numbers[input[i]];
        } else {
            output += input[i];
        }
    }
    return output;
}

$('.bangla').on('keyup', function () {
    var bangla = $(this).val();
    if (isUnicode(bangla) === false) {
        $(this).val('');
        toastr.warning('অনুগ্রহ করে বাংলা শব্দ ব্যবহার করুন |');
        return false
    }
});

$('.english').on('keyup', function () {
    var english = $(this).val();
    if (isUnicode(english) === true) {
        $(this).val('');
        toastr.warning('অনুগ্রহ করে ইংরেজি শব্দ ব্যবহার করুন |');
        return false
    }
});


//for load page
function loadPage(element){
    url = element.data('url');
    ajaxCallAsyncCallbackAPI(url,'', 'GET', function (response) {
        if (response.status === 'error') {
            toastr.error('Error');
        } else {
            $("#kt_content").html(response);
        }
    });
}


//Date picker
$(document).off('focus').on('focus', '.date', function() {
    $(this).datepicker({
        autoclose: true,
        format:'d/m/yyyy'
    });
})

$(document).off('focus').on('focus', '.year-picker', function() {
    $(this).datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        autoclose:true
    });
})
// $('.date').datepicker({
//     format:'d/m/yyyy'
// });

function dateDifferenceInDay(date1, date2) {
    dt1 = new Date(date1);
    dt2 = new Date(date2);
    return Math.floor(((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate()) ) /(1000 * 60 * 60 * 24))+1);
}

//text disable on contact filed
$(document).off('keypress').on('keypress', '.number-input', function() {
    if(key.charCode < 48 || key.charCode > 57) {
        return false;
    }
});



function formatDate(data) {
  var day  = data.split("/")[0];
  var month  = data.split("/")[1];
  var year  = data.split("/")[2];

  //console.log(day,month,year);

  return year + '-' + ("0"+month).slice(-2) + '-' + ("0"+day).slice(-2);
  // Utilizo o .slice(-2) para garantir o formato com 2 digitos.
}
