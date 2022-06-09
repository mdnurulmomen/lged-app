

<div class="card sna-card-border d-flex flex-wrap flex-row mb-2">
    <div class="col-xl-12 text-left">
        <span><b>অডিট রিপোর্টের নাম :</b>{{$report_details['audit_report_name']}}</span>
        <br>
        <span><b>রিপোর্টের সন :</b> {{enTobn($report_details['ortho_bochor'])}}</span>
    </div>
</div>

<div class="card sna-card-border d-flex flex-wrap flex-row">
    <div class="col-md-12">
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
                            <th width="15%">কস্ট সেন্টার</th>
                            <th width="10%">জড়িত অর্থ (টাকা)</th>
                            {{--        <th width="5%">কার্যক্রম</th>--}}
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($report_details['archive_apottis'] as $apotti)
                            <tr>
                                <td class="text-center">{{enTobn($loop->iteration)}}</td>
                                <td class="text-left">{{$apotti['apotti_title']}}</td>
                                <td class="text-left">{{$apotti['ministry_name_bn']}}</td>
                                <td class="text-left">{{$apotti['cost_center_name_bn']}}</td>
                                <td class="text-right">
                                    <span>{{enTobn(number_format($apotti['jorito_ortho_poriman'],0))}}</span>
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="card sna-card-border mt-3 mb-15">
                            <div class="row mt-3">
                                @foreach($report_details['arc_report_attachment'] as $attachment)
                                        <div class="col-md-2">
                                            <img style="cursor: pointer" class="coverImage" src="{{$attachment['attachment_path'].'/'.$attachment['attachment_name']}}"
                                                 onclick="showImageOnModal(this)" width="80%" height="100%"/>
                                        </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




