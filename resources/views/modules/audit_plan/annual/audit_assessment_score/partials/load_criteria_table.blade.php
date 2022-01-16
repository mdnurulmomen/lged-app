<table width="100%" class="table table-bordered table-striped table-hover table-condensed table-sm"
       id="tblAuditAssessmentScore">
    <thead>
    <tr>
        <th width="40%">Criteria</th>
        <th width="35%">Value</th>
        <th width="25%">Score(0-5)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($criteriaList as $criteria)
        <tr class="criteria_row">
            <td>
                <input type="hidden" name="criteria_ids[]" value="{{$criteria['id']}}" class="criteria_id">
                {{$criteria['name_bn']}}
            </td>
            <td><input type="text" name="values[]" class="form-control"></td>
            <td><input type="number" min="0" max="5" name="scores[]" onkeyup="if(this.value > 5 || this.value < 0) this.value = null;" class="form-control score"></td>
        </tr>
    @endforeach
    <tr>
        <th>Total</th>
        <th></th>
        <th><span id="finalTotalScore"></span></th>
    </tr>
    </tbody>
</table>

<script>
    $(".score").change(calculateTotal);

    function calculateTotal() {
        let finalTotalScore = 0;
        let totalData = $("tr.criteria_row").length * 5;
        $("tr.criteria_row").each(function () {
            let score = $('.score', this).val() == ''?0:parseInt($('.score', this).val());
            finalTotalScore += score;
        });
        let totalPoint = parseFloat(finalTotalScore/totalData).toFixed(2);
        $("#finalTotalScore").text(finalTotalScore+' ('+totalPoint+')');
        $("#totalPoint").val(totalPoint);
    }
</script>
