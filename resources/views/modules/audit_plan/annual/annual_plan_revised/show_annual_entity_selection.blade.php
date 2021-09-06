<x-title-wrapper>Annual Plan For {{$fiscal_year}} - ({{$activity_title}})</x-title-wrapper>
<div class="col-md-12">
    <div class="d-flex justify-content-end">
        <a onclick="Annual_Plan_Container.addPlanInfo($(this))"
           data-activity-id="{{$activity_id}}"
           data-activity-title="{{$activity_title}}"
           data-schedule-id="{{$schedule_id}}"
           data-milestone-id="{{$milestone_id}}"
           class="btn btn-success btn-sm btn-bold btn-square btn_create"
           href="javascript:;">
            <i class="far fa-plus mr-1"></i> Make Plan
        </a>
    </div>
</div>
<div class="col-lg-12">
    <!--begin::Advance Table Widget 4-->
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th class="align-middle">মন্ত্রণালয়/বিভাগ</th>
                        <th>প্রতিষ্ঠানের নাম</th>
                        <th>প্রতিষ্ঠানের ধরণ</th>
                        <th>প্রতিষ্ঠানের মোট ইউনিটের সংখ্যা</th>
                        <th>অডিটের জন্য প্রস্তাবিত ইউনিটের নাম ও সংখ্যা</th>
                        <th>সাবজেক্ট ম্যাটার</th>
                        <th>প্রয়োজনীয় লোকবল</th>
                        <th>মন্তব্য</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <!--end::Table-->
        </div>
    </div>
    <!--end::Advance Table Widget 4-->
</div>

