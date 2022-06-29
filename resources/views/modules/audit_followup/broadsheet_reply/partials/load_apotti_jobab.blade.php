<h5>অনুচ্ছেদ নম্বরঃ- {{enTobn($apottiItemInfo['onucched_no'])}}</h5>

<div class="card border-0 mb-0 mt-5">
    <div class="card-header border-top-0 border-bottom-0 bg-white p-0 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 note_title font-weight-1">
                    শিরোনাম
                </h5>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="attachment_list_items pb-7">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 rounded-0 border-left-0 border-right-0">
                    <div class="position-relative w-100 d-flex align-items-start">
                       <span class="ml-2 d-flex align-items-start">{{$apottiItemInfo['memo_title_bn']}}</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="card border-0 mb-0 mt-5">
    <div class="card-header border-top-0 border-bottom-0 bg-white p-0 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 note_title font-weight-1">
                    স্থানীয় অফিসের জবাব
                </h5>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="attachment_list_items pb-7">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 rounded-0 border-left-0 border-right-0">
                    <div class="position-relative w-100 d-flex align-items-start">
                        <a href="javascript:;" class="d-inline-block text-dark‌‌">
                            <span class="viewer_trigger d-flex align-items-start">
                                <span class="ml-2 d-flex align-items-start">
                                    {{$apottiItemInfo['unit_response']}}
                                </span>
                            </span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

@if($apottiItemInfo['memo_type'] == 'sfi')
<div class="card border-0 mb-0 mt-5">
    <div class="card-header border-top-0 border-bottom-0 bg-white p-0 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 note_title font-weight-1">
                    উর্দ্ধতন কর্তৃপক্ষের সুপারিশ
                </h5>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="attachment_list_items pb-7">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 rounded-0 border-left-0 border-right-0">
                    <div class="position-relative w-100 d-flex align-items-start">
                        <a href="javascript:;" class="d-inline-block text-dark‌‌">
                            <span class="viewer_trigger d-flex align-items-start">
                                <span class="ml-2 d-flex align-items-start">
                                    {{$apottiItemInfo['entity_response']}}
                                </span>
                            </span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endif


<div class="card border-0 mb-0 mt-5">
    <div class="card-header border-top-0 border-bottom-0 bg-white p-0 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 note_title font-weight-1">
                    মন্ত্রণালয়/বিভাগ/অন্যান্য এর সুপারিশ
                </h5>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="attachment_list_items pb-7">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 rounded-0 border-left-0 border-right-0">
                    <div class="position-relative w-100 d-flex align-items-start">
                        <a href="javascript:;" class="d-inline-block text-dark‌‌">
                            <span class="viewer_trigger d-flex align-items-start">
                                <span class="ml-2 d-flex align-items-start">
                                    {{$apottiItemInfo['ministry_response']}}
                                </span>
                            </span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
