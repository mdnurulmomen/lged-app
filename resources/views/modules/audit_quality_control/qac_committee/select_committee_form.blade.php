<form id="air_committee_form">
    <div class="row">
        <input type="hidden" name="fiscal_year_id"  value="{{$fiscal_year_id}}">
        <input type="hidden" name="qac_type" value="{{$qac_type}}">
        <input type="hidden" name="air_report_id" value="{{$air_report_id}}">
        <div class="col-md-12">
            <label>কমিটি</label>
            <select class="form-control select-selec2" id="qac_committee" name="qac_committee_id">
                <option value="">--কমিটি বাছাই করুন--</option>
                @foreach($committee_list as $comittee)
                    <option value="{{$comittee['id']}}">{{$comittee['title_bn']}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="load_members"></div>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-md-12">
        <button class="btn btn-sm btn-square btn-outline-primary mt-2"
                onclick="Qac_Container.submitAirCommittee($(this))"><i class="fa fa-save"></i> সংরক্ষণ
        </button>
    </div>
</div>

<script>
    $('#qac_committee').change(function (){

        url = '{{route('audit.qac.get-qac-committee-wise-members')}}';

        qac_committee_id = $(this).val();

        data = {qac_committee_id};

        ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
            $('.load_members').html(response);
        })
    });
</script>
