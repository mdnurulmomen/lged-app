<h5 class="text-info text-center">শিরোনামঃ {{$memoInfo['memo_title_bn']}}</h5>
<div class="card border-0 h-100 mb-0 mt-5">
    <div class="card-header border-top-0 border-bottom-0 bg-white p-0 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 note_title font-weight-1">
                    পরিশিষ্ট
                    (<span class="badge badge-light text-violate bg-light p-1">১</span>)
                </h5>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="attachment_list_items pb-7">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 rounded-0 border-left-0 border-right-0">
                    <div class="position-relative w-100 d-flex align-items-start">
                        <a title="" class="d-inline-block text-dark‌‌">
                            <span class="viewer_trigger d-flex align-items-start">
                                <i class="text-warning fas fa-file-pdf fa-lg px-3"></i>
                                <span class="ml-2 d-flex align-items-start">New Microsoft Office Word Document.pdf</span>
                            </span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div>
            <span style="font-weight: bold">পরিশিষ্ট</span>
            <div class="mt-3">
                @foreach($memoInfo['ac_memo_attachments'] as $attachment)
                    @if($attachment['attachment_type'] == 'porisishto')
                        <a title="ডাউনলোড করুন" href="{{$attachment['attachment_path']}}" target="_blank" class="btn btn-outline-primary btn-square mt-2">
                            <i class="fal fa-file"></i> {{$attachment['user_define_name']}}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
            <span style="font-weight: bold">প্রমানক</span>

            <div class="mt-3">
                @foreach($memoInfo['ac_memo_attachments'] as $attachment)
                    @if($attachment['attachment_type'] == 'pramanok')
                        <a href="{{$attachment['attachment_path']}}" target="_blank" class="btn btn-outline-primary btn-square mt-2">
                            <i class="fal fa-file"></i> {{$attachment['user_define_name']}}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="bangla-font" style="font-family:SolaimanLipi,serif !important;margin-top: 10px">
            <span style="font-weight: bold">মেমো</span>

            <div class="mt-3">
                @foreach($memoInfo['ac_memo_attachments'] as $attachment)
                    @if($attachment['attachment_type'] == 'memo')
                        <a href="{{$attachment['attachment_path']}}" target="_blank" class="btn btn-outline-primary btn-square mt-2">
                            <i class="fal fa-file"></i> {{$attachment['user_define_name']}}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

