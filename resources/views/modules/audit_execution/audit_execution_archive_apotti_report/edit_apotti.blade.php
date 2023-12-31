<style>
    .jFiler-theme-default .jFiler-input{
        width: 329px!important;
    }
</style>
<link rel="stylesheet" href="{{asset('assets/css/mFiler-font.css')}}" referrerpolicy="origin">
<link rel="stylesheet" href="{{asset('assets/css/mFiler.css')}}" referrerpolicy="origin">

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
                    onclick=""
                    class="btn btn-sm btn-warning btn_back btn-square mr-3">
                    <i class="fad fa-arrow-alt-left"></i> {{___('generic.back')}}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card sna-card-border mt-3 mb-15">
    <div class="mt-4">
        <form class="mb-4" id="apotti_create_form" autocomplete="off">
            <input type="hidden" value="{{$apotti_details['id']}}" name="id">
            <input type="hidden" value="{{$apotti_details['report_id']}}" name="report_id">
            <div class="row">
                <div class="col-md-3">
                    <label for="jorito_ortho_poriman" class="col-form-label">জড়িত অর্থ (টাকা)</label>
                    <input class="form-control" id="jorito_ortho_poriman" name="jorito_ortho_poriman" type="text" value="{{$apotti_details['jorito_ortho_poriman']}}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="audit_report_name" class="col-form-label">অডিট রিপোর্টের নাম</label>
                    <textarea class="form-control" id="audit_report_name" name="audit_report_name" cols="30" rows="3">{{$apotti_details['audit_report_name']}}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="orthobosor_start" class="col-form-label">বছর হইতে</label>
                    <input class="year-picker form-control" id="orthobosor_start" name="orthobosor_start" type="text" value="{{$apotti_details['orthobosor_start']}}" autocomplete="off">
                </div>

                <div class="col-md-3">
                    <label for="orthobosor_end" class="col-form-label">বছর পর্যন্ত</label>
                    <input class="form-control year-picker" id="orthobosor_end" name="orthobosor_end" type="text" autocomplete="off" value="{{$apotti_details['orthobosor_end']}}">
                </div>

                <div class="col-md-3">
                    <label for="nirikkhito_ortho_bosor" class="col-form-label">নিরীক্ষিত অর্থ-বছর</label>
                    <input class="form-control" id="nirikkhito_ortho_bosor" name="nirikkhito_ortho_bosor" type="text" autocomplete="off" value="{{$apotti_details['nirikkhito_ortho_bosor']}}">
                </div>

                <div class="col-md-3">
                    <label for="nirikkha_dhoron" class="col-form-label">নিরীক্ষার ধরন</label>
                    <select class="form-control select-select2" id="nirikkha_dhoron" name="nirikkha_dhoron">
                        <option value="">নিরীক্ষার ধরন</option>
                        <option @if($apotti_details['nirikkha_dhoron'] == 'কমপ্লায়েন্স অডিট') selected @endif value="কমপ্লায়েন্স অডিট">কমপ্লায়েন্স অডিট</option>
                        <option @if($apotti_details['nirikkha_dhoron'] == 'পারফরমেন্স অডিট') selected @endif value="পারফরমেন্স অডিট">পারফরমেন্স অডিট</option>
                        <option @if($apotti_details['nirikkha_dhoron'] == 'ফাইন্যান্সিয়াল অডিট') selected @endif value="ফাইন্যান্সিয়াল অডিট">ফাইন্যান্সিয়াল অডিট</option>
                        <option @if($apotti_details['nirikkha_dhoron'] == 'বার্ষিক অডিট') selected @endif value="বার্ষিক অডিট">বার্ষিক অডিট</option>
                        <option @if($apotti_details['nirikkha_dhoron'] == 'বিশেষ অডিট') selected @endif value="বিশেষ অডিট">বিশেষ অডিট</option>
                        <option @if($apotti_details['nirikkha_dhoron'] == 'ইস্যুভিত্তিক অডিট') selected @endif value="ইস্যুভিত্তিক অডিট">ইস্যুভিত্তিক অডিট</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="directorate_id" class="col-form-label">অডিট ডিরেক্টরেট সমূহ</label>
                    <select class="form-select select-select2" id="directorate_id" name="directorate_id">
                        @foreach($directorates as $directorate)
                            <option @if($apotti_details['directorate_id'] == $directorate['office_id']) selected @endif value="{{$directorate['office_id']}}">{{$directorate['office_name_bn']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="ministry_id" class="col-form-label">মন্ত্রণালয়/বিভাগ</label>
                    <select class="form-select select-select2" id="ministry_id" name="ministry_id">
                        <option value="">সবগুলো</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="entity_id" class="col-form-label">এনটিটি</label>
                    <select class="form-select select-select2" id="entity_id" name="entity_id">
                        <option value="">সবগুলো</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="unit_group_office_id" class="col-form-label">ইউনিট গ্রুপ</label>
                    <select class="form-select select-select2" id="unit_group_office_id" name="unit_group_office_id">
                        <option value="">সবগুলো</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="cost_center_id" class="col-form-label">কস্ট সেন্টার/ইউনিট</label>
                    <select class="form-select select-select2" id="cost_center_id" name="cost_center_id">
                        <option value="">সবগুলো</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="is_alocito" class="col-form-label">আলোচিত কি না?</label>
                    <select class="form-select select-select2" id="is_alocito" name="is_alocito">
                        <option value="0">না</option>
                        <option value="1">হা</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="is_nispottikrito" class="col-form-label">নিস্পন্ন হয়েছে কি না?</label>
                    <select class="form-select select-select2" id="is_nispottikrito" name="is_nispottikrito">
                        <option @if($apotti_details['is_nispottikrito'] == 0) selected @endif value="0">না</option>
                        <option @if($apotti_details['is_nispottikrito'] == 1) selected @endif value="1">হাঁ</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="apotti_status" class="col-form-label">আপত্তির বর্তমান অবস্থা</label>
                    <select class="form-select select-select2" id="apotti_status" name="apotti_status">
                        <option @if($apotti_details['apotti_status'] == 'নিস্পন্ন') selected @endif value="নিস্পন্ন">নিস্পন্ন</option>
                        <option @if($apotti_details['apotti_status'] == 'অনিস্পন্ন') selected @endif value="অনিস্পন্ন" selected>অনিস্পন্ন</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="onucched_no" class="col-form-label">অনুচ্ছেদ নম্বর</label>
                    <input class="form-control integer_type_positive bijoy-bangla" id="onucched_no" value="{{$apotti_details['onucched_no']}}" name="onucched_no" type="text">
                </div>
                <div class="col-md-9">
                    <label for="apotti_title" class="col-form-label">আপত্তির শিরোনাম</label>
                    <input class="form-control" id="apotti_title" name="apotti_title" type="text" value="{{$apotti_details['apotti_title']}}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="pa_commitee_meeting" class="col-form-label">পিএ কমিটির মিটিং</label>
                    <textarea class="form-control" id="pa_commitee_meeting" name="pa_commitee_meeting" cols="30" rows="3">{{$apotti_details['pa_commitee_meeting']}}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="pa_commitee_siddhanto" class="col-form-label">পিএ কমিটির সিদ্ধান্ত</label>
                    <textarea class="form-control" id="pa_commitee_siddhanto" name="pa_commitee_siddhanto" cols="30" rows="3">{{$apotti_details['pa_commitee_siddhanto']}}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="ministry_actions" class="col-form-label">মন্ত্রণালয় কর্তৃক গৃহীত কার্যক্রম</label>
                    <textarea class="form-control" id="ministry_actions" name="ministry_actions" cols="30" rows="3">{{$apotti_details['ministry_actions']}}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="audit_department_actions" class="col-form-label">অডিট অধিদপ্তর কর্তৃক গৃহীত কার্যক্রম</label>
                    <textarea class="form-control" id="audit_department_actions" name="audit_department_actions" cols="30" rows="3">{{$apotti_details['audit_department_actions']}}</textarea>
                </div>
            </div>

            <br>
            <a class="btn btn-primary btn-sm btn-bold btn-square store-apotti-report" href="javascript:;"
               onclick="Archive_Apotti_Report_Container.store_report_apotti()">
                <i class="far fa-save"></i> {{___('generic.save')}}
            </a>
        </form>
    </div>
</div>


@include('modules.audit_execution.audit_execution_archive_apotti.scripts.archive_scripts');

<script>
    $(function () {
        directorate_id = $('#directorate_id').val();
        ministry_id = '{{$apotti_details['ministry_id']}}';
        entity_id = '{{$apotti_details['entity_id']}}';
        parent_office_id = '{{$apotti_details['parent_office_id']}}';
        cost_center_id = '{{$apotti_details['cost_center_id']}}';

        Archive_Apotti_Common_Container.loadDirectorateWiseMinistry(directorate_id,ministry_id);
        Archive_Apotti_Common_Container.loadMinistryWiseEntity(ministry_id,entity_id);

        Archive_Apotti_Common_Container.loadEntityWiseUnitGroupOffice(entity_id,parent_office_id);
        Archive_Apotti_Common_Container.loadEntityOrUnitGroupWiseCostCenter(parent_office_id,cost_center_id);

    });

    $('.btn_back').click(function (){
        backToList()
    })

    function backToList(){
        $('.apotti-validate a').click();
    }


    //ministry
    $('#directorate_id').change(function () {
        directorate_id = $('#directorate_id').val();
        Archive_Apotti_Common_Container.loadDirectorateWiseMinistry(directorate_id);
    });

    //entity
    $('#ministry_id').change(function () {
        ministry_id = $('#ministry_id').val();
        Archive_Apotti_Common_Container.loadMinistryWiseEntity(ministry_id);
    });

    //unit group & cost center
    $('#entity_id').change(function () {
        entity_id = $('#entity_id').val();
        Archive_Apotti_Common_Container.loadEntityWiseUnitGroupOffice(entity_id);
        Archive_Apotti_Common_Container.loadEntityOrUnitGroupWiseCostCenter(entity_id);
    });

    //cost center
    $('#unit_group_office_id').change(function () {
        unit_group_office_id = $('#unit_group_office_id').val();
        Archive_Apotti_Common_Container.loadEntityOrUnitGroupWiseCostCenter(unit_group_office_id);
    });
</script>
