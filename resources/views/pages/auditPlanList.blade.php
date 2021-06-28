@extends('executionLayout')
@section('sidemenu')
this si demo
@endsection
@section('content')
<div class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-6">
        <div class="title py-2">
            <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>Audit Plan List</h4>
        </div>
    </div>
</div>
<div class="mt-4 px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom gutter-b">           
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="list-group list-group-flush">
                                <li id="daak_container_inbox_1_54_Daptorik" class="daak_list_item list-group-item pl-0 py-2 border-bottom">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="pr-2 flex-fill cursor-pointer position-relative">
                                            <div class="row d-md-flex flex-wrap align-items-start justify-content-md-between">
                                                <!--begin::Title-->
                                                <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3 col-md-6">
                                                    <div class="d-flex align-items-center flex-wrap  font-size-1-2"><a href="/create-operation" class=" text-dark text-hover-primary font-size-h5">Plan Name</a></div>
                                                    <div class=" font-weight-normal d-md-flex flex-wrap">
                                                        <div class="font-size-1-1"><span class="mr-2 perok-wrapper">প্রেরক:</span><span class="perok-wrapper sender_name" data-toggle="popover" data-content="প্রোগ্রাম এসোসিয়েট, টেকনোলজি, এসপায়ার টু ইনোভেট (এটু্আই) প্রোগ্রাম" data-original-title="" title="">মানিক মাহমুদ</span></div>
                                                        <div class="font-size-1-1"><span class="mx-2 prapok-wrapper perok-wrapper"><i class="la la-caret-right"></i></span><span class="mr-2 prapok-wrapper">মূল-প্রাপক:</span><span class="prapok-wrapper" data-toggle="popover" data-content="ন্যাশনাল কনসালটেন্ট, ই-সার্ভিস, এসপায়ার টু ইনোভেট (এটু্আই) প্রোগ্রাম" data-original-title="" title="">এ টি এম আল ফাত্তাহ</span></div>
                                                    </div>
                                                    <div class=" subject-wrapper font-weight-normal font-weight-normal">
                                                        <span class="mr-2 font-size-1-1">বিষয়:</span>
                                                        <span class="description text-wrap font-size-14">sdd</span>
                                                    </div>
                                                    <div class=" font-weight-normal siddhanto-wrapper">
                                                        <span class="mr-2 font-size-1-1">সিদ্ধান্ত:</span>
                                                        <span class="text-info font-size-14">সদয় সিদ্ধান্তের জন্যে প্রেরণ করা হলো</span>
                                                    </div>
                                                    <div class=" font-weight-normal d-none predict-wrapper">
                                                        <span class="predict-label text-success "></span>
                                                    </div>
                                                </div>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection