<div class="card sna-card-border">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex justify-content-start">
                <h5 class="mt-5"></h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="d-flex justify-content-end">
                <a
                    class="btn btn-sm btn-warning btn_back btn-square mr-3">
                    <i class="fad fa-arrow-alt-left"></i> {{___('generic.back')}}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card sna-card-border d-flex flex-wrap flex-row mb-2">
    <div class="col-xl-12 text-left">
        <span style="font-size: 18px"><b>অডিট রিপোর্টের নাম :</b>{{$report_name}}</span>
        <br>
        <span style="font-size: 18px"><b>রিপোর্টের সন :</b> {{enTobn(2019-2021)}}</span>
    </div>
</div>

<div class="card sna-card-border d-flex flex-wrap flex-row">
    <div class="col-md-12 mb-15">
        <ul class="nav nav-tabs custom-tabs mb-0" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active rounded-0" data-toggle="tab"
                   href="#apotti_list">
                    <span class="nav-text">আপত্তি সমূহ</span>
                </a>
            </li>
            <li class="nav-item">
                <a id="milestone_tab" class="nav-link rounded-0" data-toggle="tab"
                   href="#image_list">
                    <span class="nav-text">ছবি সমূহ</span>
                </a>
            </li>
        </ul>
        <div class="tab-content" id="rp_office_tab">
            <div class="tab-pane border border-top-0 p-3 fade show active" id="apotti_list"
                 role="tabpanel" aria-labelledby="activity-tab">
                <div class="row">
                    <table class="table table-bordered m-5" width="100%">
                        <thead class="thead-light">
                        <tr class="bg-hover-warning">
                            <th width="5%">ক্রমিক নং</th>
                            <th width="15%">আপত্তির শিরোনাম</th>
                            <th width="15%">মন্ত্রণালয়/বিভাগ</th>
{{--                            <th width="15%">কস্ট সেন্টার</th>--}}
                            <th width="10%">জড়িত অর্থ (টাকা)</th>
                            <th width="10%">কার্যক্রম</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($apottiDetails as $apotti)
                            <tr id="apotti_{{$apotti['id']}}">
                                <td class="text-center">{{enTobn($loop->iteration)}}</td>
                                <td class="text-left">{{$apotti['apotti']['apotti_title']}}</td>
                                <td class="text-left">{{$apotti['apotti']['ministry_name_bn']}}</td>
{{--                                <td class="text-left">{{$apotti['cost_center_name_bn']}}</td>--}}
                                <td class="text-right">
                                    <span>{{enTobn(currency_format($apotti['apotti']['total_jorito_ortho_poriman']))}}</span>
                                </td>
                                <td class="text-center">
                                    <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-icon-primary list-btn-toggle"
                                            title="হালনাগাদ করুন"
                                            data-apotti-id="{{$apotti['id']}}"
                                            onclick="Report_Apottis.loadArchiveApottiEditForm($(this))">
                                        <i class="fad fa-edit"></i>
                                    </button>
                                    <button class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-icon-danger list-btn-toggle"
                                            title="বিস্তারিত দেখুন"
                                            data-apotti-id="{{$apotti['id']}}"
                                            onclick="Report_Apottis.deleteReportApottis($(this))">
                                        <i class="fad fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr data-row="0" class="datatable-row" style="left: 0px;">
                                <td colspan="12" class="datatable-cell text-center"><span>Nothing Found</span></td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="tab-pane border border-top-0 p-3 fade" id="image_list"
                 role="tabpanel" aria-labelledby="activity-tab">
{{--                <div class="row">--}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="card sna-card-border mt-3 mb-15">--}}
{{--                            <div class="row mt-3">--}}
{{--                                @foreach($report_details['arc_report_attachment'] as $attachment)--}}
{{--                                    <div class="col-md-2">--}}
{{--                                        <img style="cursor: pointer" class="coverImage" src="{{$attachment['attachment_path'].'/'.$attachment['attachment_name']}}"--}}
{{--                                             onclick="showImageOnModal(this)" width="80%" height="100%"/>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</div>

<script>
    $('.btn_back').click(function (){
        $('.apotti-validate a').click();
    });

    var Report_Apottis = {
        deleteReportApottis: function (elem) {
            apotti_id = elem.data('apotti-id');
            swal.fire({
                title: 'আপনি কি তথ্যটি মুছে ফেলতে চান?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'হ্যাঁ',
                cancelButtonText: 'না'
            }).then(function(result) {
                if (result.value) {
                    let url = '{{route('audit.execution.archive-apotti-report.report-apotti-delete')}}';
                    let data = {apotti_id};

                    KTApp.block('#kt_content', {
                        opacity: 0.1,
                        state: 'primary' // a bootstrap color
                    });

                    ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                        KTApp.unblock('#kt_content');
                        if (response.status === 'error') {
                            toastr.error(response.data);
                        } else {
                            $('#apotti_'+apotti_id).remove();
                            toastr.success(response.data);
                        }
                    });
                }
            });

        },

        loadArchiveApottiEditForm: function (elem) {
            apotti_id = elem.data('apotti-id');
            let url = '{{route('audit.execution.archive-apotti-report.report-apotti-edit-form')}}';
            let data = {apotti_id};

            KTApp.block('#kt_content', {
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });

            ajaxCallAsyncCallbackAPI(url, data, 'POST', function (response) {
                KTApp.unblock('#kt_content');
                if (response.status === 'error') {
                    toastr.error(response.data);
                } else {
                    $('#kt_content').html(response);
                }
            });
        },
    }
</script>




