<h5 class="text-info text-center">শিরোনামঃ {{$memoTitleBn}}</h5>

@if(count($attachments['porisishtos']) >0)
<div class="card border-0 mb-0 mt-5">
    <div class="card-header border-top-0 border-bottom-0 bg-white p-0 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 note_title font-weight-1">
                    পরিশিষ্ট
                    (<span class="badge badge-light text-violate bg-light p-1">{{enTobn(count($attachments['porisishtos']))}}</span>)
                </h5>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="attachment_list_items pb-7">
            <ul class="list-group">
                @foreach($attachments['porisishtos'] as $attachment)
                    @php
                        $extension = pathinfo($attachment['attachment_path'], PATHINFO_EXTENSION);
                    @endphp

                    @if($extension == 'pdf')
                        @php $fileIcon = 'fa-file-pdf'; @endphp
                    @elseif($extension == 'excel')
                        @php $fileIcon = 'fa-file-excel'; @endphp
                    @elseif($extension == 'docx')
                        @php $fileIcon = 'fa-file-word'; @endphp
                    @else
                        @php $fileIcon = 'fa-file-image'; @endphp
                    @endif

                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 rounded-0 border-left-0 border-right-0">
                        <div class="position-relative w-100 d-flex align-items-start">
                            <a title="" href="{{$attachment['attachment_path']}}" download class="d-inline-block text-dark‌‌">
                                <span class="viewer_trigger d-flex align-items-start">
                                    <i class="text-warning fas {{$fileIcon}} fa-lg px-3"></i>
                                    <span class="ml-2 d-flex align-items-start">{{$attachment['user_define_name']}}</span>
                                </span>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif

@if(count($attachments['pramanoks']) >0)
<div class="card border-0 mb-0 mt-5">
    <div class="card-header border-top-0 border-bottom-0 bg-white p-0 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 note_title font-weight-1">
                    প্রমানক
                    (<span class="badge badge-light text-violate bg-light p-1">{{enTobn(count($attachments['pramanoks']))}}</span>)
                </h5>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="attachment_list_items pb-7">
            <ul class="list-group">
                @foreach($attachments['pramanoks'] as $attachment)
                    @php
                        $extension = pathinfo($attachment['attachment_path'], PATHINFO_EXTENSION);
                    @endphp

                    @if($extension == 'pdf')
                        @php $fileIcon = 'fa-file-pdf'; @endphp
                    @elseif($extension == 'excel')
                        @php $fileIcon = 'fa-file-excel'; @endphp
                    @elseif($extension == 'docx')
                        @php $fileIcon = 'fa-file-word'; @endphp
                    @else
                        @php $fileIcon = 'fa-file-image'; @endphp
                    @endif

                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 rounded-0 border-left-0 border-right-0">
                        <div class="position-relative w-100 d-flex align-items-start">
                            <a title="" href="{{$attachment['attachment_path']}}" download class="d-inline-block text-dark‌‌">
                                <span class="viewer_trigger d-flex align-items-start">
                                    <i class="text-warning fas {{$fileIcon}} fa-lg px-3"></i>
                                    <span class="ml-2 d-flex align-items-start">{{$attachment['user_define_name']}}</span>
                                </span>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif

{{--@if(count($attachments['memos']) >0)
<div class="card border-0 mb-0 mt-5">
    <div class="card-header border-top-0 border-bottom-0 bg-white p-0 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 note_title font-weight-1">
                    মেমো
                    (<span class="badge badge-light text-violate bg-light p-1">{{enTobn(count($attachments['memos']))}}</span>)
                </h5>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="attachment_list_items pb-7">
            <ul class="list-group">
                @foreach($attachments['memos'] as $attachment)
                    @php
                        $extension = pathinfo($attachment['attachment_path'], PATHINFO_EXTENSION);
                    @endphp

                    @if($extension == 'pdf')
                        @php $fileIcon = 'fa-file-pdf'; @endphp
                    @elseif($extension == 'excel')
                        @php $fileIcon = 'fa-file-excel'; @endphp
                    @elseif($extension == 'docx')
                        @php $fileIcon = 'fa-file-word'; @endphp
                    @else
                        @php $fileIcon = 'fa-file-image'; @endphp
                    @endif

                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 rounded-0 border-left-0 border-right-0">
                        <div class="position-relative w-100 d-flex align-items-start">
                            <a title="" href="{{$attachment['attachment_path']}}" download class="d-inline-block text-dark‌‌">
                                <span class="viewer_trigger d-flex align-items-start">
                                    <i class="text-warning fas {{$fileIcon}} fa-lg px-3"></i>
                                    <span class="ml-2 d-flex align-items-start">{{$attachment['user_define_name']}}</span>
                                </span>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif--}}

