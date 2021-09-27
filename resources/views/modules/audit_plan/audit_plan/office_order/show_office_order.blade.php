<x-title-wrapper>Office Order</x-title-wrapper>

<div class="col-md-12">
    <div class="d-flex justify-content-end">
        <button data-audit-plan-id="{{$office_order['audit_plan_id']}}" onclick="Show_Office_Order_Container.printOfficeOrder($(this))" class="btn btn-info btn-sm btn-bold btn-square mr-2">
            <i class="far fa-print mr-1"></i> Print
        </button>
    </div>
</div>

<div class="col-lg-12 p-0 mt-3">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Body-->
        <div class="card-body">
            <div style="font-family:SolaimanLipi,serif !important;text-align: center">
                গণপ্রজাতন্ত্রী বাংলাদেশ সরকার <br>
                <b>বাণিজ্যিক অডিট অধিদপ্তর</b> <br>
                অডিট কমপ্লেক্স (৮ম ও ৯ম তলা) <br>
                সেগুনবাগিচা, ঢাকা -১০০০।
            </div>

            <div style="font-family:SolaimanLipi,serif !important;width: 100%;margin-top: 10px">
            <span style="width: 85%;float: left">
                {{$office_order['memorandum_no']}}
            </span>
                <span style="width: 15%;float: right">
                তারিখঃ  {{enTobn(date('d/m/Y',strtotime($office_order['memorandum_date'])))}} খ্রি।
            </span>
            </div>

            <div style="font-family:SolaimanLipi,serif !important;text-align: center">
                <b><u>অফিস আদেশ</u></b>
            </div>
            <div style="font-family:SolaimanLipi,serif !important;text-align: justify">
                {{$office_order['heading_details']}}
            </div>

            <div style="font-family:SolaimanLipi,serif !important;text-align: center">
                <b><u>নিরীক্ষা দল নং-০১</u></b>
            </div>

            <div style="margin-top: 5px">
                <table width="100%" border="1">
                    <thead>
                    <tr>
                        <th style="text-align: center" width="5%">ক্রমিক নং</th>
                        <th style="text-align: center" width="45%">নাম</th>
                        <th style="text-align: center" width="20%">পদবী</th>
                        <th style="text-align: center" width="15%">নিরীক্ষা দলের অবস্থান</th>
                        <th style="text-align: center" width="15%">মোবাইল নং</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="text-align: center">১</td>
                        <td style="text-align: left">জনাব নিতাই কুমার বিশ্বাস</td>
                        <td style="text-align: center">উপপরিচালক</td>
                        <td style="text-align: center">দলনেতা</td>
                        <td style="text-align: center">০১৭১৬৬৩৬৬১৫</td>
                    </tr>
                    <tr>
                        <td style="text-align: center">২</td>
                        <td style="text-align: left">জনাব সৈয়দ শাখাওয়াত হোসেন</td>
                        <td style="text-align: center">নিরীক্ষা ও হিসাবরক্ষণ কর্মকর্তা</td>
                        <td style="text-align: center">উপ দলনেতা</td>
                        <td style="text-align: center">০১৭১৬৬৩৬৬১৫</td>
                    </tr>
                    <tr>
                        <td style="text-align: center">৩</td>
                        <td style="text-align: left">জনাব জুয়েল রানা</td>
                        <td style="text-align: center">এসএএস সুপার</td>
                        <td style="text-align: center">সদস্য</td>
                        <td style="text-align: center">০১৭১৬৬৩৬৬১৫</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div style="font-family:SolaimanLipi,serif !important;text-align: center;margin-top: 10px">
                <b><u>উপ দল নং-০১ (ক)</u></b>
            </div>

            <div style="margin-top: 5px">
                <table width="100%" border="1">
                    <thead>
                    <tr>
                        <th style="text-align: center" width="5%">ক্রমিক নং</th>
                        <th style="text-align: center" width="45%">নাম</th>
                        <th style="text-align: center" width="20%">পদবী</th>
                        <th style="text-align: center" width="15%">মোবাইল নং</th>
                        <th style="text-align: center" width="15%">মন্তব্য</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="text-align: center">১</td>
                        <td style="text-align: left">জনাব সৈয়দ শাখাওয়াত হোসেন</td>
                        <td style="text-align: center">নিরীক্ষা ও হিসাবরক্ষণ কর্মকর্তা</td>
                        <td style="text-align: center">০১৭১৬৬৩৬৬১৫</td>
                        <td style="text-align: center"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center">২</td>
                        <td style="text-align: left">জনাব জুয়েল রানা</td>
                        <td style="text-align: center">এসএএস সুপার</td>
                        <td style="text-align: center">০১৭১৬৬৩৬৬১৫</td>
                        <td style="text-align: center"></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 15px">
                <table width="100%" border="1">
                    <tbody>
                    <tr>
                        <td style="text-align: center" width="5%">ক্রমিক নং</td>
                        <td style="text-align: center" width="45%">শাখার নাম</td>
                        <td style="text-align: center" width="20%">নিরীক্ষা বছর</td>
                        <td style="text-align: center" width="15%">নিরীক্ষা সময়কাল</td>
                        <td style="text-align: center" width="15%">মোট কর্ম দিবস</td>
                    </tr>
                    <tr>
                        <td style="text-align: center" width="5%">১</td>
                        <td style="text-align: center" width="45%">২</td>
                        <td style="text-align: center" width="20%">৩</td>
                        <td style="text-align: center" width="15%">৪</td>
                        <td style="text-align: center" width="15%">৫</td>
                    </tr>
                    <tr>
                        <td style="text-align: center">১.</td>
                        <td style="text-align: left">বাংলাদেশ ব্যাংক, প্রধান কার্যালয়, ঢাকা</td>
                        <td style="text-align: center">২০১৯-২০ ও ২০২০-২১</td>
                        <td style="text-align: center">০৯/০৯/২০২১ খ্রি. হতে ০৯/০৯/২০২১ খ্রি.</td>
                        <td style="text-align: center">০১ কর্ম দিবস</td>
                    </tr>
                    <tr>
                        <td style="text-align: center">২.</td>
                        <td colspan="3" style="text-align: center">১১/০৯/২০২১ খ্রি ঢাকা থেকে চট্টগ্রামের উদ্দেশ্যে যাত্রা</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: right">সর্বমোট</td>
                        <td style="text-align: center">০১ কর্ম দিবস</td>
                    </tr>
                    </tbody>
                </table>
            </div>


            {{--for audit advice--}}
            <div style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
                <u>নিরীক্ষা দলের প্রতি নির্দেশনা:</u>
            </div>

            <div style="font-family:SolaimanLipi,serif !important;text-align: justify">
                {!! nl2br($office_order['advices']) !!}
            </div>

            <div style="font-family:SolaimanLipi,serif !important;text-align: center;float: right">
                (নাসিমুল ইসলাম) <br>
                পরিচালক <br>
                ফোন: ৪৮৩২১১৫৯
            </div>

            <div style="font-family:SolaimanLipi,serif !important;width: 100%;margin-top: 70px">
                <span style="width: 85%;float: left">
                    {{$office_order['memorandum_no']}}
                </span>
                    <span style="width: 15%;float: right">
                    তারিখঃ  {{enTobn(date('d/m/Y',strtotime($office_order['memorandum_date'])))}} খ্রি।
                </span>
            </div>
            <br>

            {{--for audit advice--}}
            <div style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
                <u>সদয় অবগতি ও প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য অনুলিপি প্রেরণ করা হলো :(জ্যেষ্ঠতার ক্রমানুসারে নয় )</u>
            </div>

            <div style="font-family:SolaimanLipi,serif !important;text-align: justify">
                {!! nl2br($office_order['order_cc_list']) !!}
            </div>

            <div style="font-family:SolaimanLipi,serif !important;text-align: center;float: right">
                (নাহিদ আক্তার) <br>
                নিরীক্ষা ও হিসাবরক্ষণ কর্মকর্তা <br>
                প্রশাসন-৩ শাখা <br>
                ফোন: ৪৮৩২১১৫৯
            </div>
        </div>
    </div>
</div>

<script>
    var Show_Office_Order_Container={
        printOfficeOrder: function (elem) {
            url = '{{route('audit.plan.audit.office-orders.print-office-order')}}';
            audit_plan_id = elem.data('audit-plan-id');
            data = {audit_plan_id};

            ajaxCallAsyncCallbackAPI(url, data, 'post', function (response) {
                var newDoc = document.open("text/html", "replace");
                newDoc.write(response);
                newDoc.close();
                /* myWindow = window.open("data:text/html," + encodeURIComponent(response),
                     "_blank", "width=200,height=100");
                 myWindow.focus();*/
            });
        },
    }
</script>
