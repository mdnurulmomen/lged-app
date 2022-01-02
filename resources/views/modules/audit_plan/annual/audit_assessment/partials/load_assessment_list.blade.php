<style>
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
        box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
</style>

<form id="score_create_form" autocomplete="off">
    <div class="row">
        <div class="col-md-12">
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">
                    ডাটাসমূহ
                </legend>
                <table width="100%" class="table table-bordered table-striped table-hover table-condensed table-sm"
                       id="tblAuditAssessmentScore">
                    <thead>
                    <tr>
                        <th width="25%">মন্ত্রণালয়</th>
                        <th width="25%">এনটিটি</th>
                        <th width="10%">Score</th>
                        <th width="15%">Last Audit Year</th>
                        <th width="10%">1s Half</th>
                        <th width="10%">2nd Half</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($entities as $entity)
                        <tr class="criteria_row">
                            <td>{{$entity['ministry_name_bn']}}</td>
                            <td>{{$entity['entity_name_bn']}}</td>
                            <td>0</td>
                            <td>2019</td>
                            <td><input type="checkbox" name="firstHalf[]"></td>
                            <td><input type="checkbox" name="firstHalf[]"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </fieldset>
        </div>
    </div>

    <button type="button" class="btn btn-success btn-sm btn-bold btn-square"
            onclick="">
        <i class="far fa-save mr-1"></i> Save
    </button>
</form>
