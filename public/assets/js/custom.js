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

function submitModalData(url, data, method, modal_id) {
    ajaxCallAsyncCallbackAPI(url, data, method, function (response) {
        if (response.status === 'success') {
            toastr.success('Success')
            $('#' + modal_id).modal('hide');
        } else {
            toastr.error(response.data.message)
            if (response.data.errors) {
                $.each(response.data.errors, function (k, v) {
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
            console.log(response.data)
        }
    })
}

function emptyModalData(modal_id) {
    $('#' + modal_id + ' :input').val('')
    $('#' + modal_id + ' select').val('').trigger('change')
    $('#' + modal_id + ' input[type=checkbox]').prop('checked', false);
}

function jsTreeInit(jstree_class = 'jstree-init') {
    $(`.${jstree_class}`).jstree({
        "core": {
            "themes": {
                "responsive": true
            }
        },
        "types": {
            "default": {
                "icon": "fal fa-folder"
            },
            "person": {
                "icon": "fal fa-file "
            }
        },
        "plugins": ["types", "checkbox",]
    });
}

function setUserIndividualEvent(local_storage_key, value) {
    local_storage_key = 'cag_amms_web_' + local_storage_key;
    localStorage.setItem(local_storage_key, value)
}

function getUserIndividualEvent(local_storage_key) {
    local_storage_key = 'cag_amms_web_' + local_storage_key;
    return localStorage.getItem(local_storage_key)
}

function destroyUserIndividualEvents() {
    i = 0;
    sKey;

    for (; sKey = window.localStorage.key(i); i++) {
        is_amms_local_storage_key = sKey.includes('cag_amms_web_')
        if (is_amms_local_storage_key) {
            localStorage.removeItem(sKey);
        }
    }
}

$(document).off('change').on("change", "select#activity_id", function (event) {
    setUserIndividualEvent('activity_id', this.value)
});
