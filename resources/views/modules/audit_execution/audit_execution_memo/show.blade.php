<style>
    .tdd{
        width: 23%;
        font-weight: bold;
        background: #ace8ff;
    }
</style>
<div class="col-md-12">
    <div class="d-flex justify-content-end mb-2">
        <!-- <button title="ডাউনলোড করুন" data-scope="memo" data-memo-id="{{$memoInfoDetails['findings']['id']}}" data-directorate-id="{{$directorate_id}}"
                onclick="Show_Memo_Container.memoPDFDownload($(this))"
                class="btn btn-danger btn-sm btn-bold btn-square mr-2">
            <i class="far fa-download"></i> মেমো ডাউনলোড
        </button> -->

        <!-- @if(!empty($memoInfoDetails['findings']['ac_memo_porisishtos']))
            <button title="ডাউনলোড করুন" data-scope="porisistho" data-memo-id="{{$memoInfoDetails['findings']['id']}}" data-directorate-id="{{$directorate_id}}"
                    onclick="Show_Memo_Container.memoPDFDownload($(this))"
                    class="btn btn-danger btn-sm btn-bold btn-square">
                <i class="far fa-download"></i> পরিশিষ্ট ডাউনলোড
            </button>
        @endif -->

        <button title="Download" data-scope="findings" data-memo-id="{{$memoInfoDetails['findings']['id']}}" data-directorate-id="{{$directorate_id}}"
                onclick="Show_Memo_Container.memoPDFDownload($(this))"
                class="btn btn-danger btn-sm btn-bold btn-square">
            <i class="far fa-download"></i> Download
        </button>
    </div>
</div>

<!-- <div style="height: 100%">
    <div style="text-align: center;color: black">
        মহাপরিচালকের কার্যালয়<br>
    </div>
        <x-office-header-details officeid="{{$directorate_id}}" onlyofficename="false"  />
    <br>
    @if($memoInfoDetails['findings']['memo_sharok_no'])
        <table width="100%">
            <tr>
                <td>স্মারক নং - {{enTobn($memoInfoDetails['findings']['memo_sharok_no'])}}</td>
                <td style="text-align: right">তারিখ: {{formatDate($memoInfoDetails['findings']['memo_send_date'],'bn','/')}}</td>
            </tr>
        </table>
    @endif

    <div style="text-align: center;">
        <u>অডিট মেমো</u>
    </div>

    <div style="font-weight: bold">অডিট মেমো নং-{{enTobn($memoInfoDetails['findings']['onucched_no'])}}</div>
    <br>
    <div  style="font-weight: bold">
        <p style="font-weight: bold">শিরোনামঃ </p>
        {{$memoInfoDetails['findings']['memo_title_bn']}}
    </div>

    <div style="text-align:justify;margin-top: 10px">
        <span style="font-weight: bold">বিবরণঃ</span>
        {!! $memoInfoDetails['findings']['memo_description_bn'] !!}
    </div>

    @if($memoInfoDetails['findings']['irregularity_cause'])
        <div style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
            <span style="font-weight: bold">অনিয়মের কারণঃ</span>
            {{$memoInfoDetails['findings']['irregularity_cause']}}
        </div>
    @endif

   

    @if($memoInfoDetails['findings']['irregularity_cause'])
        <div  style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
            <span style="font-weight: bold">অডিটি প্রতিষ্ঠানের জবাবঃ</span>
            {{$memoInfoDetails['findings']['response_of_rpu']}}
        </div>
    @endif
    <br><br>
    <table width="100%" style="color: black">
        <tr>
            <td  width="33%" style="text-align: left"></td>
            <td  width="33%" style="text-align: left"></td>
            <td  width="33%" style="text-align: center">
                @if($memoInfoDetails['findings']['issued_by'] == 'sub_team_leader')
                    <p>({{$memoInfoDetails['findings']['sub_team_leader_name']}})</p>
                    <p>{{$memoInfoDetails['findings']['sub_team_leader_designation']}} ও উপদলনেতা</p>
                    <x-office-header-details officeid="{{$directorate_id}}" onlyofficename="true"/>
                @else
                    <p>({{$memoInfoDetails['findings']['team_leader_name']}})</p>
                    <p>{{$memoInfoDetails['findings']['team_leader_designation']}} ও দলনেতা</p>
                    <x-office-header-details officeid="{{$directorate_id}}" onlyofficename="true"/>
                @endif
            </td>
        </tr>
    </table>
    <table width="100%" style="color: black">
        <tr>
            <td  width="33%" style="text-align: left">
                <br><br>
                <p style="margin: 0">{{$memoInfoDetails['findings']['rpu_acceptor_designation_name_bn']}}</p>
                <p>{{$memoInfoDetails['findings']['cost_center_name_bn']}}</p>
            </td>
            <td  width="33%" style="text-align: left"></td>
            <td  width="33%" style="text-align: center"></td>
        </tr>
    </table>
    <br>
    @if($memoInfoDetails['findings']['memo_sharok_no'])
        <table  width="100%" style="color: black">
            <tr>
                <td>স্মারক নং - {{enTobn($memoInfoDetails['findings']['memo_sharok_no'])}}</td>
                <td style="text-align: right">তারিখ: {{formatDate($memoInfoDetails['findings']['memo_send_date'],'bn','/')}}</td>
            </tr>
        </table>
    @endif
    <br>
    @if($memoInfoDetails['findings']['memo_cc'])
        <table  width="100%" style="color: black">
            <tr>
                <td style="padding-bottom: 10px">সদয় অবগতি ও প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য:-</td>
            </tr>
            <tr>
                <td>
                    @if($memoInfoDetails['findings']['memo_cc'])
                        {!! nl2br($memoInfoDetails['findings']['memo_cc']) !!}
                    @endif

                </td>
            </tr>
        </table>
    @endif()
    <br>
    <table  width="100%" style="color: black">
        <tr>
            <td width="33%"></td>
            <td width="33%"></td>
            <td width="34%" style="text-align: center">
                @if($memoInfoDetails['findings']['issued_by'] == 'sub_team_leader')
                    <p>({{$memoInfoDetails['findings']['sub_team_leader_name']}})</p>
                    <p>{{$memoInfoDetails['findings']['sub_team_leader_designation']}} ও উপদলনেতা</p>
                    <x-office-header-details officeid="{{$directorate_id}}" onlyofficename="true"/>
                @else
                    <p>({{$memoInfoDetails['findings']['team_leader_name']}})</p>
                    <p>{{$memoInfoDetails['findings']['team_leader_designation']}} ও দলনেতা</p>
                    <x-office-header-details officeid="{{$directorate_id}}" onlyofficename="true"/>
                @endif
            </td>
        </tr>
    </table>
    <br>


    {{--porisishto--}}
    {{--@foreach($memoInfoDetails['findings']['ac_memo_porisishtos'] as $porisishto)
        <div style="height: 100%">{!! $porisishto['details'] !!}</div>
    @endforeach--}}
</div> -->

<div style="height: 100%;">
    <table class="table table-bordered" style="border: 2px solid black;">
        <tr>
            <td class="tdd">Audit Observation :</td>
            <td>{{$memoInfoDetails['findings']['audit_observation']}}</td>
        </tr>
    </table>

    <table class="table table-bordered" style="border: 2px solid black;">
        <tr>
            <td class="tdd">Heading :</td>
            <td>{{$memoInfoDetails['findings']['heading']}}</td>
        </tr>
        <tr>
            <td class="tdd">Criteria :</td>
            <td>{{$memoInfoDetails['findings']['criteria']}}</td>
        </tr>
        <tr>
            <td class="tdd">Condition :</td>
            <td>{{$memoInfoDetails['findings']['condition']}}</td>
        </tr>
    </table>

    <table class="table table-bordered" style="border: 2px solid black;">
        @php
            if(!empty($memoInfoDetails['findings']['cause'])){
                $causes = json_decode($memoInfoDetails['findings']['cause']);
            }
        @endphp
        @if (!empty($causes))
            @foreach ($causes as $key=>$cause)
                <tr>
                    <td class="tdd">Cause {{$key+1}} :</td>
                    <td>{{$cause}}</td>
                </tr>
            @endforeach
        @endif
    </table>

    <table class="table table-bordered" style="border: 2px solid black;">
        <tr>
            <td class="tdd">Recommendation :</td>
            <td>{{$memoInfoDetails['findings']['recommendation']}}</td>
        </tr>
    </table>

    <table class="table table-bordered" style="border: 2px solid black;">
        <tr>
            <td class="tdd">Agree :</td>
            <td> 
                @if ($memoInfoDetails['findings']['agree_type'] == 'agree')
                    <i class="fas fa-check-circle" style="font-size:4.5vh;color:green"></i>
                @endif 
            </td>
        </tr>
        <tr>
            <td class="tdd">Disagree :</td>
            <td>
                @if ($memoInfoDetails['findings']['agree_type'] == 'disagree')
                    <i class="fas fa-check-circle" style="font-size:4.5vh;color:red"></i>
                @endif
            </td>
        </tr>
        <tr>
            <td class="tdd">Agree In Part :</td>
            <td>{{$memoInfoDetails['findings']['agree_in_part']}}</td>
        </tr>
    </table>

    <table class="table table-bordered" style="border: 2px solid black;">
        <tr>
            <td class="tdd">Instances :</td>
            <td>{{$memoInfoDetails['findings']['recommendation']}}</td>
        </tr>
    </table>

    <table class="table table-bordered" style="border: 2px solid black;">
        <tr>
            <td class="tdd">Residual Risk Rating :</td>
            <td>{{$memoInfoDetails['findings']['residual_risk_rating']}}</td>
        </tr>
    </table>

    <table class="table table-bordered" style="border: 2px solid black;">
        <tr>
            <td class="tdd">Recommended Control :</td>
            <td>{{$memoInfoDetails['findings']['recommended_control']}}</td>
        </tr>
    </table>

    <table class="table table-bordered" style="border: 2px solid black;">
        <tr>
            <td class="tdd">Agreed Action Plan :</td>
            <td>{{$memoInfoDetails['findings']['agreed_action_plan']}}</td>
        </tr>
        <tr>
            <td class="tdd">Types of Action :</td>
            <td>{{$memoInfoDetails['findings']['action_type']}}</td>
        </tr>
        <tr>
            <td class="tdd">Any Challenges To Implement The Action :</td>
            <td>{{$memoInfoDetails['findings']['challenges']}}</td>
        </tr>
    </table>

    <table class="table table-bordered" style="border: 2px solid black;">
        <tr>
            <td class="tdd">Responsible Person :</td>
            <td>{{$memoInfoDetails['findings']['responsible_person']}}</td>
        </tr>
        <tr>
            <td class="tdd">Date To Be Implemented :</td>
            <td>{{$memoInfoDetails['findings']['date_to_be_implemented']}}</td>
        </tr>
    </table>
</div>

<script>
    var Show_Memo_Container = {
        memoPDFDownload: function (elem) {
            url = '{{route('audit.execution.memo.download')}}';
            scope = elem.data('scope');
            memo_id = elem.data('memo-id');
            data = {scope,memo_id};

            KTApp.block('#kt_wrapper', {
                opacity: 0.1,
                message: 'Downloading Please Wait...',
                state: 'primary' // a bootstrap color
            });

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (response) {
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = scope+".pdf";
                    link.click();
                    KTApp.unblock('#kt_wrapper');
                },
                error: function (blob) {
                    toastr.error('Failed to generate PDF.')
                    console.log(blob);
                }
            });
        },
    }
</script>
