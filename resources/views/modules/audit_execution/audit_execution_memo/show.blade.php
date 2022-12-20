<style>
    .tdd{
        width: 23%;
        font-weight: bold;
        background: #ace8ff;
    }
</style>
<div class="col-md-12">
    <div class="d-flex justify-content-end mb-2">
        <!-- <button title="ডাউনলোড করুন" data-scope="memo" data-memo-id="{{$memoInfoDetails['memo']['id']}}" data-directorate-id="{{$directorate_id}}"
                onclick="Show_Memo_Container.memoPDFDownload($(this))"
                class="btn btn-danger btn-sm btn-bold btn-square mr-2">
            <i class="far fa-download"></i> মেমো ডাউনলোড
        </button> -->

        <!-- @if(!empty($memoInfoDetails['memo']['ac_memo_porisishtos']))
            <button title="ডাউনলোড করুন" data-scope="porisistho" data-memo-id="{{$memoInfoDetails['memo']['id']}}" data-directorate-id="{{$directorate_id}}"
                    onclick="Show_Memo_Container.memoPDFDownload($(this))"
                    class="btn btn-danger btn-sm btn-bold btn-square">
                <i class="far fa-download"></i> পরিশিষ্ট ডাউনলোড
            </button>
        @endif -->

        <button title="Download" data-scope="memo" data-memo-id="{{$memoInfoDetails['memo']['id']}}" data-directorate-id="{{$directorate_id}}"
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
    @if($memoInfoDetails['memo']['memo_sharok_no'])
        <table width="100%">
            <tr>
                <td>স্মারক নং - {{enTobn($memoInfoDetails['memo']['memo_sharok_no'])}}</td>
                <td style="text-align: right">তারিখ: {{formatDate($memoInfoDetails['memo']['memo_send_date'],'bn','/')}}</td>
            </tr>
        </table>
    @endif

    <div style="text-align: center;">
        <u>অডিট মেমো</u>
    </div>

    <div style="font-weight: bold">অডিট মেমো নং-{{enTobn($memoInfoDetails['memo']['onucched_no'])}}</div>
    <br>
    <div  style="font-weight: bold">
        <p style="font-weight: bold">শিরোনামঃ </p>
        {{$memoInfoDetails['memo']['memo_title_bn']}}
    </div>

    <div style="text-align:justify;margin-top: 10px">
        <span style="font-weight: bold">বিবরণঃ</span>
        {!! $memoInfoDetails['memo']['memo_description_bn'] !!}
    </div>

    @if($memoInfoDetails['memo']['irregularity_cause'])
        <div style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
            <span style="font-weight: bold">অনিয়মের কারণঃ</span>
            {{$memoInfoDetails['memo']['irregularity_cause']}}
        </div>
    @endif

    <div style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
        <b>সংযুক্তিঃ পরিশিষ্ট</b>
        <div class="attachment_list_items pb-7">
            <ul class="list-group">
                @foreach($memoInfoDetails['porisishto_list'] as $attachment)
                    @if($attachment['file_extension'] == 'pdf')
                        @php $fileIcon = 'fa-file-pdf'; @endphp
                    @elseif($attachment['file_extension']  == 'excel')
                        @php $fileIcon = 'fa-file-excel'; @endphp
                    @elseif($attachment['file_extension']  == 'docx')
                        @php $fileIcon = 'fa-file-word'; @endphp
                    @else
                        @php $fileIcon = 'fa-file-image'; @endphp
                    @endif

                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 rounded-0 border-left-0 border-right-0">
                        <div class="position-relative w-100 d-flex align-items-start">
                            <a title="" href="{{$attachment['file_path']}}" download class="d-inline-block text-dark‌‌">
                                <span class="viewer_trigger d-flex align-items-start">
                                    <i class="text-warning fas {{$fileIcon}} fa-lg px-3"></i>
                                    <span class="ml-2 d-flex align-items-start">{{$attachment['file_user_define_name']}}</span>
                                </span>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    @if($memoInfoDetails['memo']['irregularity_cause'])
        <div  style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
            <span style="font-weight: bold">অডিটি প্রতিষ্ঠানের জবাবঃ</span>
            {{$memoInfoDetails['memo']['response_of_rpu']}}
        </div>
    @endif
    <br><br>
    <table width="100%" style="color: black">
        <tr>
            <td  width="33%" style="text-align: left"></td>
            <td  width="33%" style="text-align: left"></td>
            <td  width="33%" style="text-align: center">
                @if($memoInfoDetails['memo']['issued_by'] == 'sub_team_leader')
                    <p>({{$memoInfoDetails['memo']['sub_team_leader_name']}})</p>
                    <p>{{$memoInfoDetails['memo']['sub_team_leader_designation']}} ও উপদলনেতা</p>
                    <x-office-header-details officeid="{{$directorate_id}}" onlyofficename="true"/>
                @else
                    <p>({{$memoInfoDetails['memo']['team_leader_name']}})</p>
                    <p>{{$memoInfoDetails['memo']['team_leader_designation']}} ও দলনেতা</p>
                    <x-office-header-details officeid="{{$directorate_id}}" onlyofficename="true"/>
                @endif
            </td>
        </tr>
    </table>
    <table width="100%" style="color: black">
        <tr>
            <td  width="33%" style="text-align: left">
                <br><br>
                <p style="margin: 0">{{$memoInfoDetails['memo']['rpu_acceptor_designation_name_bn']}}</p>
                <p>{{$memoInfoDetails['memo']['cost_center_name_bn']}}</p>
            </td>
            <td  width="33%" style="text-align: left"></td>
            <td  width="33%" style="text-align: center"></td>
        </tr>
    </table>
    <br>
    @if($memoInfoDetails['memo']['memo_sharok_no'])
        <table  width="100%" style="color: black">
            <tr>
                <td>স্মারক নং - {{enTobn($memoInfoDetails['memo']['memo_sharok_no'])}}</td>
                <td style="text-align: right">তারিখ: {{formatDate($memoInfoDetails['memo']['memo_send_date'],'bn','/')}}</td>
            </tr>
        </table>
    @endif
    <br>
    @if($memoInfoDetails['memo']['memo_cc'])
        <table  width="100%" style="color: black">
            <tr>
                <td style="padding-bottom: 10px">সদয় অবগতি ও প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য:-</td>
            </tr>
            <tr>
                <td>
                    @if($memoInfoDetails['memo']['memo_cc'])
                        {!! nl2br($memoInfoDetails['memo']['memo_cc']) !!}
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
                @if($memoInfoDetails['memo']['issued_by'] == 'sub_team_leader')
                    <p>({{$memoInfoDetails['memo']['sub_team_leader_name']}})</p>
                    <p>{{$memoInfoDetails['memo']['sub_team_leader_designation']}} ও উপদলনেতা</p>
                    <x-office-header-details officeid="{{$directorate_id}}" onlyofficename="true"/>
                @else
                    <p>({{$memoInfoDetails['memo']['team_leader_name']}})</p>
                    <p>{{$memoInfoDetails['memo']['team_leader_designation']}} ও দলনেতা</p>
                    <x-office-header-details officeid="{{$directorate_id}}" onlyofficename="true"/>
                @endif
            </td>
        </tr>
    </table>
    <br>


    {{--porisishto--}}
    {{--@foreach($memoInfoDetails['memo']['ac_memo_porisishtos'] as $porisishto)
        <div style="height: 100%">{!! $porisishto['details'] !!}</div>
    @endforeach--}}
</div> -->

<div style="height: 100%;">
    <table class="table table-bordered" style="border: 2px solid black;">
        <tr>
            <td class="tdd">Audit Observation :</td>
            <td>{{$memoInfoDetails['memo']['audit_observation']}}</td>
        </tr>
    </table>

    <table class="table table-bordered" style="border: 2px solid black;">
        <tr>
            <td class="tdd">Heading :</td>
            <td>{{$memoInfoDetails['memo']['heading']}}</td>
        </tr>
        <tr>
            <td class="tdd">Criteria :</td>
            <td>{{$memoInfoDetails['memo']['criteria']}}</td>
        </tr>
        <tr>
            <td class="tdd">Condition :</td>
            <td>{{$memoInfoDetails['memo']['condition']}}</td>
        </tr>
    </table>

    <table class="table table-bordered" style="border: 2px solid black;">
        @php
            if(!empty($memoInfoDetails['memo']['cause'])){
                $causes = json_decode($memoInfoDetails['memo']['cause']);
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
            <td>{{$memoInfoDetails['memo']['recommendation']}}</td>
        </tr>
    </table>

    <table class="table table-bordered" style="border: 2px solid black;">
        <tr>
            <td class="tdd">Agree :</td>
            <td> 
                @if ($memoInfoDetails['memo']['agree_type'] == 'agree')
                    <i class="fas fa-check-circle" style="font-size:4.5vh;color:green"></i>
                @endif 
            </td>
        </tr>
        <tr>
            <td class="tdd">Disagree :</td>
            <td>
                @if ($memoInfoDetails['memo']['agree_type'] == 'disagree')
                    <i class="fas fa-check-circle" style="font-size:4.5vh;color:red"></i>
                @endif
            </td>
        </tr>
        <tr>
            <td class="tdd">Agree In Part :</td>
            <td>{{$memoInfoDetails['memo']['agree_in_part']}}</td>
        </tr>
    </table>

    <table class="table table-bordered" style="border: 2px solid black;">
        <tr>
            <td class="tdd">Instances :</td>
            <td>{{$memoInfoDetails['memo']['recommendation']}}</td>
        </tr>
    </table>

    <table class="table table-bordered" style="border: 2px solid black;">
        <tr>
            <td class="tdd">Residual Risk Rating :</td>
            <td>{{$memoInfoDetails['memo']['residual_risk_rating']}}</td>
        </tr>
    </table>

    <table class="table table-bordered" style="border: 2px solid black;">
        <tr>
            <td class="tdd">Recommended Control :</td>
            <td>{{$memoInfoDetails['memo']['recommended_control']}}</td>
        </tr>
    </table>

    <table class="table table-bordered" style="border: 2px solid black;">
        <tr>
            <td class="tdd">Agreed Action Plan :</td>
            <td>{{$memoInfoDetails['memo']['agreed_action_plan']}}</td>
        </tr>
        <tr>
            <td class="tdd">Types of Action :</td>
            <td>{{$memoInfoDetails['memo']['action_type']}}</td>
        </tr>
        <tr>
            <td class="tdd">Any Challenges To Implement The Action :</td>
            <td>{{$memoInfoDetails['memo']['challenges']}}</td>
        </tr>
    </table>

    <table class="table table-bordered" style="border: 2px solid black;">
        <tr>
            <td class="tdd">Responsible Person :</td>
            <td>{{$memoInfoDetails['memo']['responsible_person']}}</td>
        </tr>
        <tr>
            <td class="tdd">Date To Be Implemented :</td>
            <td>{{$memoInfoDetails['memo']['date_to_be_implemented']}}</td>
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
