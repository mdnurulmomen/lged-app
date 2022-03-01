<table class="table table-striped">
    <tbody>
    <thead class="thead-light">
        <tr>
            <td  style="text-align: center" width="8%">কস্ট সেন্টার/ইউনিট</td>
            <td  style="text-align: center" width="8%">অর্থ বছর</td>
            <td  style="text-align: center" width="8%">নিরীক্ষা বছর</td>
            <td  style="text-align: center" width="5%">অনুচ্ছেদ নং</td>
            <td  style="text-align: center" width="5%">আপত্তি ক্যাটাগরি</td>
            <td  style="text-align: center" width="25%">শিরোনাম ও বিবরণ</td>
            <td  style="text-align: center" width="9%">জড়িত টাকার পরিমাণ</td>
            <td  style="text-align: center" width="25%">স্থানীয় অফিসের জবাব</td>
            <td  style="text-align: center" width="10%">উর্দ্ধতন কর্তৃপক্ষের সুপারিশ</td>
            <td  style="text-align: center" width="10%">মন্ত্রণালয়/বিভাগ/অন্যান্য এর সুপারিশ</td>
            <td  style="text-align: center" width="10%">
                কার্যক্রম
            </td>
        </tr>
    </thead>
    {{--                <tr>--}}
    {{--                    <td class="bangla-font" style="text-align: center">১</td>--}}
    {{--                    <td class="bangla-font" style="text-align: center">২</td>--}}
    {{--                    <td class="bangla-font" style="text-align: center">৩</td>--}}
    {{--                    <td class="bangla-font" style="text-align: center">৪</td>--}}
    {{--                    <td class="bangla-font" style="text-align: center">৫</td>--}}
    {{--                    <td class="bangla-font" style="text-align: center">৬</td>--}}
    {{--                    <td class="bangla-font" style="text-align: center">৭</td>--}}
    {{--                    <td class="bangla-font" style="text-align: center">৮</td>--}}
    {{--                </tr>--}}
    @foreach($broadSheetItem as $broadSheet)
        <tr>
            <td style="text-align: center;vertical-align: top;">{{enTobn($broadSheet['apotti']['cost_center_name_bn'])}}</td>
            <td style="text-align: center;vertical-align: top;">{{enTobn($broadSheet['apotti']['fiscal_year']['start']).'-'.enTobn($broadSheet['apotti']['fiscal_year']['end'])}}</td>
            <td style="text-align: center;vertical-align: top;">{{enTobn($broadSheet['apotti']['audit_year_start']).'-'.enTobn($broadSheet['apotti']['audit_year_end'])}}</td>
            <td style="text-align: center;vertical-align: top;">{{enTobn($broadSheet['apotti']['onucched_no'])}}</td>
            <td style="text-align: center;vertical-align: top;">
                @if($broadSheet['apotti']['memo_type'] == 'sfi')
                    @php $apottiType = 'এসএফআই'; @endphp
                @else
                    @php $apottiType = 'নন-এসএফআই'; @endphp
                @endif
                {{$apottiType}}
            </td>
            <td  style="text-align: justify;">
                <span style="padding:5px; margin-bottom: 5px"><b>শিরোনামঃ</b> <br> {{$broadSheet['apotti']['memo_title_bn']}}</span>
                <br>
                <br>
                <span style="padding:5px;"><b>বিবরণঃ</b> {!! $broadSheet['apotti']['memo_description_bn'] !!}</span>
            </td>
            <td style="text-align: center;vertical-align: top;">{{enTobn(number_format($broadSheet['apotti']['jorito_ortho_poriman'],0))}}/-</td>
            <td style="text-align: left;vertical-align: top;padding:5px;">{{$broadSheet['apotti']['unit_response']}}</td>
            <td style="text-align: left;vertical-align: top;padding:5px;">{{$broadSheet['apotti']['entity_response']}}</td>
            <td style="text-align: left;vertical-align: top;padding:5px;">{{$broadSheet['apotti']['ministry_response']}}</td>
            <td>
                <button class="mr-1 btn btn-sm btn-primary btn-square" title="সম্পাদন করুন"
                        data-apotti-id=""
                        onclick="">
                        সম্পাদন
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{--<script>--}}
{{--    $('.btn_edit_audit_query').click(function () {--}}
{{--        quick_panel = $("#kt_quick_panel");--}}
{{--        $('.offcanvas-wrapper').html('');--}}
{{--        quick_panel.addClass('offcanvas-on');--}}
{{--        quick_panel.css('opacity', 1);--}}
{{--        quick_panel.css('width', '500px');--}}
{{--        $('.offcanvas-footer').hide();--}}
{{--        quick_panel.removeClass('d-none');--}}
{{--        $("html").addClass("side-panel-overlay");--}}
{{--        $('.offcanvas-title').html('Edit Query');--}}

{{--        audit_query_id = $(this).data('audit-query-id');--}}
{{--        audit_query_cost_center_type = $(this).data('audit-query-cost-center-type');--}}
{{--        audit_query_title_en =$(this).data('audit-query-title-en');--}}
{{--        audit_query_title_bn = $(this).data('audit-query-title-bn');--}}

{{--        url = '{{route('settings.audit-query.edit')}}';--}}
{{--        var data = {audit_query_id,audit_query_cost_center_type,audit_query_title_en,audit_query_title_bn};--}}
{{--        ajaxCallAsyncCallbackAPI(url, data, 'POST', function (resp) {--}}
{{--            if (resp.status === 'error') {--}}
{{--                toastr.error('no');--}}
{{--                console.log(resp.data)--}}
{{--            } else {--}}
{{--                $('#audit_query_id').val(audit_query_id);--}}
{{--                $('#cost_center_type_id').val(audit_query_cost_center_type);--}}
{{--                $('#audit_query_title_en').text(audit_query_title_en);--}}
{{--                $('#audit_query_title_bn').text(audit_query_title_bn);--}}
{{--                $('.offcanvas-wrapper').html(resp);--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}

{{--    $(".delete_audit_query").click(function () {--}}

{{--        id = $(this).data('audit-query-id');--}}
{{--        url = $(this).data('url');--}}

{{--        swal.fire({--}}
{{--            title: 'আপনি কি তথ্যটি মুছে ফেলতে চান?',--}}
{{--            text: "",--}}
{{--            type: 'warning',--}}
{{--            showCancelButton: true,--}}
{{--            confirmButtonText: 'হ্যাঁ',--}}
{{--            cancelButtonText: 'না'--}}
{{--        }).then(function (result) {--}}
{{--            if (result.value) {--}}
{{--                ajaxCallAsyncCallbackAPI(url, {}, 'delete', function (resp) {--}}
{{--                    if (resp.status === 'error') {--}}
{{--                        toastr.error('no');--}}
{{--                        console.log(resp.data)--}}
{{--                    } else {--}}
{{--                        toastr.success('Delete Successfully');--}}
{{--                        $('#row_' + id).remove();--}}
{{--                    }--}}
{{--                });--}}

{{--            }--}}
{{--        });--}}
{{--    });--}}

{{--    // $('.delete_audit_query').click(function () {--}}
{{--    //     id = $(this).data('audit-query-id');--}}
{{--    //     url = $(this).data('url');--}}
{{--    //     // submitModalData(url, {}, 'delete', 'audit_query_modal');--}}
{{--    //     ajaxCallAsyncCallbackAPI(url, {}, 'delete', function (resp) {--}}
{{--    //         if (resp.status === 'error') {--}}
{{--    //             toastr.error('no');--}}
{{--    //             console.log(resp.data)--}}
{{--    //         } else {--}}
{{--    //             toastr.success('Delete Successfully');--}}
{{--    //             $('#row_'+id).remove();--}}
{{--    //         }--}}
{{--    //     });--}}
{{--    // });--}}
{{--</script>--}}
