{{--search area start--}}
<div class="search-all position-relative d-none">
    <div class="row">
        <div class="col align-self-start">
            <div class="input-group-append">
                <button class="btn btn-icon btn-light-info btn-square advanced_button" type="button"><i
                        class="fa fa-caret-down"></i>
                </button>
                <input type="text" placeholder="বিষয় দিয়ে খুঁজুন" name="list_daak_subject"
                       title="বিষয় দিয়ে খুঁজুন" id="list_daak_subject" class="form-control rounded-0">
                <button data-toggle="tooltip" data-placement="left" title="খুঁজুন"
                        class="btn btn-icon btn-light-success btn-square daak_list_subject_search" type="button"><i
                        class="fad fa-search"></i></button>
                <button data-toggle="tooltip" data-placement="left" title="রিসেট"
                        class="btn btn-icon btn-light-danger btn-square" id="reset_btn" type="reset"><i
                        class="fad fa-recycle"></i></button>
                <button data-content=""
                        class="d-none btn btn-info btn-sm btn-square btn-nothi-list cd-btn js-cd-panel-trigger"
                        data-panel="main"><i class="fad fa-book"></i> নথিসমূহ
                </button>
            </div>
        </div>
    </div>
</div>
{{--search area end--}}

<div class="row">
    <div class="col-md-12">
        <div class="row pb-4">
            <div class="col-md-6">
                <button class="btn_annual_plan_submit_to_ocag btn-sm btn-primary btn-square"
                        onclick="Memo_Container.createMemo($(this))">
                   Create Memo
                </button>
            </div>
        </div>
    </div>

</div>

<script>
    var Memo_Container = {
        createMemo: function (elem) {
            data = {};
            let url = '{{route('audit.execution.memo.create')}}'
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    $('#kt_content').html(response)
                }
            });
        },
    };
</script>
