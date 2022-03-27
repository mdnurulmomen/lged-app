//theeMahmud

var final_text_input = "";
var final_text = "";
var input_type = 'text';
var stt_selected_select2 = "";

function setContentType(elem) {
    final_text_input = $(elem);
    if (final_text_input.is('input')) {
        input_type = 'text';
        if (final_text_input.hasClass('select2-search__field')) {
            input_type = 'select_search';
        }
    } else if (final_text_input.is('textarea')) {
        input_type = 'textarea';
    } else if (final_text_input.is('select')) {
        input_type = 'select';
    } else {
        input_type = 'iframe';
    }
}

window.addEventListener("DOMContentLoaded", () => {
    const button = document.getElementById("voice2text");
    const result = document.getElementById("stt_result");
    var listening = false;
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    if (typeof SpeechRecognition !== "undefined") {
        const recognition = new SpeechRecognition();
        console.log(recognition)
        const stop = () => {
            $("button[data-cmd=voice2text]").removeClass('listening');
            $(".startListening").removeClass('fa-microphone').addClass('fa-microphone-slash').css({
                'color': 'red',
                'background': 'white'
            });
            recognition.stop();
            result.innerHTML = "";
            final_text = final_text_input.value;
        };
        const start = () => {
            $("button[data-cmd=voice2text]").addClass('listening');
            $(".startListening").removeClass('fa-microphone-slash').addClass('fa-microphone').css({
                'color': 'white',
                'background': 'red',
                'padding': '3px 5px'
            });
            recognition.start();
        };
        recognition.onspeechend = function () {
            $("button[data-cmd=voice2text]").removeClass('listening');
            $(".startListening").removeClass('fa-microphone').addClass('fa-microphone-slash').css({
                'color': 'red',
                'background': 'white'
            });
            recognition.stop();
            result.innerHTML = "";
            final_text = final_text_input.value;
        }

        recognition.onerror = function (event) {
            if (event.error == 'no-speech') {
                toastr.info('দুঃখিত! আপনার কথা স্পষ্ট নয়, আবার চেষ্টা করুন।');
                $("button[data-cmd=voice2text]").removeClass('listening');
                $(".startListening").removeClass('fa-microphone').addClass('fa-microphone-slash').css({
                    'color': 'red',
                    'background': 'white'
                });
                recognition.stop();
                result.innerHTML = "";
                final_text = final_text_input.value;
            }
        }
        recognition.onnomatch = function () {
            console.log('Speech not recognized');
        }

        const onResult = event => {
            console.log(event.results)
            result.innerHTML = "";
            for (const res of event.results) {
                const text = document.createTextNode(res[0].transcript);
                const span = document.createElement("span");
                if (res.isFinal) {
                    span.classList.add("stt_final");
                }
                span.appendChild(text);
                result.appendChild(span);
                if (res.isFinal) {
                    span.classList.add("stt_final");
                }
            }
            setInputText(result);
        };
        recognition.lang = 'bn-BD';
        recognition.continuous = true;
        recognition.interimResults = false;
        recognition.addEventListener("result", onResult);
        console.log(onResult)
        button.addEventListener("click", event => {
            if ('1' == 0) {
                toastr.error('দুঃখিত! এই ফিচারটি আপনার অফিসের জন‍্য এখনও সক্রিয় করা হয়নি।');
                return false;
            }
            var iframe_id = $("div").contents().filter("iframe").attr("id");
            if (iframe_id) {
                inputField = 'inputIframe';
            }
            listening ? stop() : start();
            listening = !listening;
        });
    }
});

function setInputText(result) {
    var stt_final = document.querySelectorAll(".stt_final:last-child");
    if (stt_final.length == 0) {
        return;
    }
    var result_text = $.trim(document.querySelectorAll(".stt_final:last-child")[0].innerText);
    var inputAreaTxt = "";
    if (input_type != 'iframe') {
        if (final_text_input) {
            var caretPos = final_text_input[0].selectionStart;
            if (input_type === 'text' || input_type == 'select_search') {
                inputAreaTxt = final_text_input.val();
            } else if (input_type === 'textarea') {
                inputAreaTxt = final_text_input.text();
            }
            var final_input_value = inputAreaTxt.substring(0, caretPos) + "" + result_text + "" + inputAreaTxt.substring(caretPos);
            if (input_type === 'text' || input_type == 'select_search') {
                final_text_input.val(final_input_value);
                if (input_type == 'select_search') {
                    final_text_input.trigger('keydown');
                }
            } else if (input_type === 'textarea') {
                final_text_input.text(final_input_value);
                tinymce.activeEditor.execCommand('mceInsertContent', false, result_text);
            } else {
                console.log("Not Supported Input Element: Nothi")
            }
            var new_caret_pos = caretPos + (result_text.length);
            setCaretPosition(new_caret_pos);
        }
    } else {
        tinymce.activeEditor.execCommand('mceInsertContent', false, result_text);
    }
}

$(document).on('focus', 'input[type=text], textarea, .select2-search__field', function () {
    setContentType(this);
})
$(document).on('keyup', 'input[type=text],textarea, .select2-search__field', function () {
    setContentType(this);
})
$(document).on('select2:open', function (e) {
    stt_selected_select2 = $('#' + $(e.target).attr('id'));
    setContentType('[aria-controls="select2-' + $(e.target).attr('id') + '-results"]');
})

function getCaretPosition(node, callback) {
    if (window.getSelection && window.getSelection().getRangeAt) {
        if (window.getSelection() && window.getSelection().rangeCount > 0) {
            var range = window.getSelection().getRangeAt(0);
            var selectedObj = window.getSelection();
            var rangeCount = 0;
            var childNodes = selectedObj.anchorNode.parentNode.childNodes;
            for (var i = 0; i < childNodes.length; i++) {
                if (childNodes[i] == selectedObj.anchorNode) {
                    break;
                }
                if (childNodes[i].outerHTML)
                    rangeCount += childNodes[i].outerHTML.length;
                else if (childNodes[i].nodeType == 3) {
                    rangeCount += childNodes[i].textContent.length;
                }
            }
            return callback(range.startOffset + rangeCount);
        }
    }
    callback(-1);
}

function setCaretPosition(caretPos) {
    var elem = final_text_input[0];
    if (elem != null) {
        if (elem.createTextRange) {
            var range = elem.createTextRange();
            range.move('character', caretPos);
            range.select();
        } else {
            if (elem.selectionStart) {
                elem.focus();
                elem.setSelectionRange(caretPos, caretPos);
            } else
                elem.focus();
        }
    }

}
