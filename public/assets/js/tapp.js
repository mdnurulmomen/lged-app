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

function errorCallbackFunc(data){
    KTApp.unblock('#kt_wrapper');
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
}

function ajaxCallAsyncCallbackAPI(url, data, method, callback,errorCallback) {
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
           if (errorCallback){
               errorCallback(data);
           }
           else {
               errorCallbackFunc(data);
           }
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
function loadPage(element) {
    url = element.data('url');
    ajaxCallAsyncCallbackAPI(url, '', 'GET', function (response) {
        if (response.status === 'error') {
            toastr.error('Error');
        } else {
            $("#kt_content").html(response);
        }
    });
}


//Date picker
$(document).off('focus').on('focus', '.date', function () {
    $(this).datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
    });
})

$(document).off('focus').on('focus', '.datepicker-bottom', function () {
    $(this).datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        orientation: "bottom"
    });
})

$(document).off('focus').on('focus', '.year-picker', function () {
    $(this).datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        autoclose: true
    });
});

$(document).off('focus').on('focus', '.date-range-picker', function () {
    $(this).daterangepicker({
        format: 'dd/mm/yyyy',
        orientation: "bottom"
    });
});

$(document).off('focus').on('focus', '.year-range-picker', function () {
    $(this).daterangepicker({
        changeYear:true,
        yearRange: "2005:2015"
    });
});


function calcWorkingDays(fromDate, toDate) { // input given as Date objects
    dDate1 = new Date(fromDate);
    dDate2 = new Date(toDate);
    var iWeeks, iDateDiff, iAdjust = 0;
    if (dDate2 < dDate1) return -1; // error code if dates transposed
    var iWeekday1 = dDate1.getDay(); // day of week
    var iWeekday2 = dDate2.getDay();
    iWeekday1 = (iWeekday1 == 0) ? 7 : iWeekday1; // change Sunday from 0 to 7
    iWeekday2 = (iWeekday2 == 0) ? 7 : iWeekday2;
    if ((iWeekday1 > 5) && (iWeekday2 > 5)) iAdjust = 1; // adjustment if both days on weekend
    iWeekday1 = (iWeekday1 > 5) ? 5 : iWeekday1; // only count weekdays
    iWeekday2 = (iWeekday2 > 5) ? 5 : iWeekday2;

    // calculate differnece in weeks (1000mS  60sec  60min  24hrs  7 days = 604800000)
    iWeeks = Math.floor((dDate2.getTime() - dDate1.getTime()) / 604800000)

    if (iWeekday1 < iWeekday2) { //Equal to makes it reduce 5 days
        iDateDiff = (iWeeks * 5) + (iWeekday2 - iWeekday1)
    } else {
        iDateDiff = ((iWeeks + 1) * 5) - (iWeekday1 - iWeekday2)
    }

    iDateDiff -= iAdjust // take into account both days on weekend

    return (iDateDiff + 1); // add 1 because dates are inclusive
}

function dateDifferenceInDay(date1, date2) {
    dt1 = new Date(date1);
    dt2 = new Date(date2);
    return Math.floor(((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate())) / (1000 * 60 * 60 * 24)) + 1);
}

//text disable on contact filed
$(document).off('keypress paste').on('keypress paste', '.number-input', function (key) {
    if (key.charCode < 48 || key.charCode > 57) {
        return false;
    }
});


function formatDate(data) {
    day = data.split("/")[0];
    month = data.split("/")[1];
    year = data.split("/")[2];
    return year + '-' + ("0" + month).slice(-2) + '-' + ("0" + day).slice(-2);
}

function DmyFormat(data, splitter = '-') {
    year = data.split("-")[0];
    month = data.split("-")[1];
    day = data.split("-")[2];
    // console.log(year);
    return day + splitter + ("0" + month).slice(-2) + splitter + year;
}


$("#kt_quick_panel_close").on('click', function () {
    quick_panel = $("#kt_quick_panel");
    quick_panel.removeClass('offcanvas-on');
    quick_panel.css('opacity', 0);
    quick_panel.addClass('d-none');
    $("html").removeClass("side-panel-overlay");
    $(".offcanvas-wrapper").html('');
});

$(document).off('mouseenter').on('mouseenter', '#kt_content', function () {
    console.log('global enter')
    $('[data-toggle="tooltip"]').tooltip()
    $('[data-toggle="popover"]').popover()
})

$(document).off('input').on("input", ".integer_type_positive", function (event) {
    this.value = this.value.replace(/[^0-9]/g, '');
});


$(document).off('input').on("input", ".amount_number_format", function (event) {
    nStr = this.value.replace(/[^0-9]/g, '') + '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    this.value = x1 + x2;
});

function mFilerDrag(elem) {
    console.log(elem)
    $dropzone = elem;
    input = elem;

    $dropzone.ondragover = function (e) {
        e.preventDefault();
        this.classList.add('dragover');
    };
    $dropzone.ondragleave = function (e) {
        e.preventDefault();
        this.classList.remove('dragover');
    };
    $dropzone.ondrop = function (e) {
        e.preventDefault();
        this.classList.remove('dragover');
        input.files = e.dataTransfer.files;
        files = e.dataTransfer.files;
        console.log(files)
        // appendHtml = '';
        // $.each(files, function (k, file) {
        //     appendHtml += '<li class="jFiler-item"><div class="jFiler-item-container"><div class="jFiler-item-inner"><div class="jFiler-item-icon pull-left"><i></div><div class="jFiler-item-info pull-left"><div class="jFiler-item-title">' + file.name + '</div><div class="jFiler-item-others"><span>size: ' + file.size + '</span><span>type: ' + file.type + '</span><span class="jFiler-item-status"></span></div><div class="jFiler-item-assets"><ul class="list-inline"><li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li></ul></div></div></div></div></li>';
        // })
        // if ($('jFiler-dragged').length > 0) {
        //     appendWrap = '<div class="jFiler-items jFiler-row jFiler-dragged"><ul class="jFiler-dragged-ul jFiler-items-list jFiler-items-default">';
        //     appendWrap += appendHtml;
        //     appendWrap += '</ul></div>';
        // } else {
        //     appendWrap = '';
        //     appendWrap += appendHtml;
        // }
    }
}

function encryptStringToB64(str) {
    return btoa(encodeURIComponent(str));
}

function decryptStringFromB64(str) {
    return decodeURIComponent(atob(str));
}

function loaderStart(msg){
    KTApp.block('#kt_wrapper', {
        opacity: 0.1,
        message: msg,
        state: 'primary' // a bootstrap color
    });
}

function loaderStop(){
    KTApp.unblock("#kt_wrapper");
}

function downloadImage(elem) {
    url = elem.data('file-url');
    fetch(url, {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'mode' : 'no-cors'
    })
    .then(response => response.blob())
    .then(blob => {
        let blobUrl = window.URL.createObjectURL(blob);
        let a = document.createElement('a');
        a.download = url.replace(/^.*[\\\/]/, '');
        a.href = blobUrl;
        document.body.appendChild(a);
        a.click();
        a.remove();
    })
}
