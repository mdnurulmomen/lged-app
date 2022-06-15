<div class="form-group">
    <label for="">অনুচ্ছেদ নং</label>
    <input type="text" readonly class="form-control" value="{{enTobn($apotti_info['onucched_no'])}}">
</div>

<div class="form-group">
    <label for="">শিরোনাম</label>
    <textarea class="form-control" readonly cols="30" rows="3">{{$apotti_info['apotti_title']}}</textarea>
</div>

{{--<div class="form-group">
    <label for="">বিবরণ</label>
    <textarea class="form-control" cols="30" rows="6">{{$apotti_info['apotti_description']}}</textarea>
</div>--}}

<div class="form-group">
    <label for="">জড়িত অর্থ (টাকা)</label>
    <input type="text" readonly class="form-control" value="{{enTobn(currency_format($apotti_info['total_jorito_ortho_poriman']))}}">
</div>

<div class="form-group">
    <label for="is_delete">আপনি কী বাদ দিতে চান?</label>
    <select id="is_delete">
        <option value="0">না</option>
        <option value="1">হ্যাঁ</option>
    </select>
</div>

<div class="form-group">
    <label for="comments">কমেন্ট</label>
    <textarea class="form-control" id="comments" cols="30" rows="3"></textarea>
</div>

<button class="btn btn-primary">সংরক্ষণ করুন</button>

<script>
    var QAC_Delete_View_Container = {
        store: function (){
            air_report_id = '{{$air_report_id}}';
            apotti_id = '{{$apotti_id}}';
            is_delete = $("#is_delete").val();
            comments = $("#comments").val();
            data = {air_report_id,apotti_id,is_delete, comments};
            let url = '{{route('audit.report.air.qac.delete-air-report-wise-apotti')}}';
            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                if (response.status === 'error') {
                    toastr.error(response.data)
                } else {
                    toastr.success(response.data);
                    $('#kt_quick_panel_close').click();
                }
            });
        },
    }
</script>

