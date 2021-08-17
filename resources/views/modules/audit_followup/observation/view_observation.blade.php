<x-title-wrapper-return area="#kt_content" title="Back To Lists"
                        url="{{route('audit.followup.observation.lists')}}">
    Objection Lists
</x-title-wrapper-return>
<div class="mt-4 px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom card-stretch gutter-b">
               
                    <div class="card-header">
                        <h4>Observation: <span>{{ $data['observation_en'] }}</span></h4>
                    </div>
                        
                    <div class="card-body">
                        
                        <span class="badge badge-pill badge-light border font-weight-bold mr-1 shadow">Observation no:
                            <span class="en_to_bn_text text-dark">{{ $data['observation_no'] }}</span>
                        </span>
                            <span class="badge badge-pill badge-light border font-weight-bold mr-1 shadow">Fiscal year:
                            <span class="en_to_bn_text text-dark">{{ $data['fiscal_year']['description'] }}</span>
                        </span>
                            <span class="badge badge-pill badge-light border font-weight-bold mr-1 shadow">Observation type:
                            <span class="en_to_bn_text text-dark">{{ $data['observation_type'] }}</span>
                        </span>
                            <span class="badge badge-pill badge-light border font-weight-bold mr-1 shadow">Ministry/Division:
                            <span class="en_to_bn_text text-dark">{{ $data['ministry_id'] }}/{{ $data['division_id'] }}</span>
                        </span>
                            <span class="badge badge-pill badge-light border font-weight-bold mr-1 shadow">Parent office:
                            <span class="en_to_bn_text text-dark">{{ $data['parent_office_id'] }}</span>
                        </span>
                            <span class="badge badge-pill badge-light border font-weight-bold mr-1 shadow">Amount:
                            <span class="en_to_bn_text text-dark">{{ $data['amount'] }}</span>
                        </span>
                        <span class="badge badge-pill badge-light border font-weight-bold mr-1 shadow">Initiation date:
                            <span class="en_to_bn_text text-dark">{{ $data['initiation_date'] }}</span>
                        </span>
                        <span class="badge badge-pill badge-light border font-weight-bold mr-1 shadow">Status:
                            <span class="en_to_bn_text text-dark">{{ $data['status'] }}</span>
                        </span><br>
                        <p class="d-flex justify-content-center">
                            <p class="text-dark">{!! $data['observation_details'] !!}</p>
                        </p>
                        <hr>
                        <h3>Attachments</h3> <small> (Uploaded files)</small>
                        <hr>
                        <h4>Cover Page</h4>
                        @php
                        $type = ['jpeg', 'jpg', 'png', 'gif'];    
                        @endphp
                        <div class="thumbs" style="width: unset;margin: unset;text-align: unset;" data-gallery="one">
                            @foreach ($data['attachments'] as $attachment)
                                @if($attachment['file_category'] == 'cover')
                                    <a target="_blank" href="{{$attachment['file_url']}}" style="background-image:url({{ in_array($attachment['file_type'], $type) ? $attachment['file_url'] : asset('assets/images/doc.png') }})" title="{{$attachment['file_name']}}" title="{{$attachment['file_name']}}"></a>
                                @endif
                            @endforeach
                        </div>
                        <h4 class="mt-5">Main Observation Attachment</h4>
                        <div class="thumbs" style="width: unset;margin: unset;text-align: unset;" data-gallery="one">
                            @foreach ($data['attachments'] as $attachment)
                                @if($attachment['file_category'] == 'main')
                                    <a target="_blank" href="{{$attachment['file_url']}}" style="background-image:url({{ in_array($attachment['file_type'], $type) ? $attachment['file_url'] : asset('assets/images/doc.png') }})" title="{{$attachment['file_name']}}" title="{{$attachment['file_name']}}"></a>
                                @endif
                            @endforeach
                        </div>
                        <h4 class="mt-5">Appendix Attachment</h4>
                        <div class="thumbs" style="width: unset;margin: unset;text-align: unset;" data-gallery="one">
                            @foreach ($data['attachments'] as $attachment)
                                @if($attachment['file_category'] == 'appendix')
                                    <a target="_blank" href="{{$attachment['file_url']}}" style="background-image:url({{ in_array($attachment['file_type'], $type) ? $attachment['file_url'] : asset('assets/images/doc.png') }})" title="{{$attachment['file_name']}}" title="{{$attachment['file_name']}}"></a>
                                @endif
                            @endforeach
                        </div>
                        <h4 class="mt-5">Authentic attachment</h4>
                        <div class="thumbs" style="width: unset;margin: unset;text-align: unset;" data-gallery="one">
                            @foreach ($data['attachments'] as $attachment)
                                @if($attachment['file_category'] == 'authentic')
                                    <a target="_blank" href="{{$attachment['file_url']}}" style="background-image:url({{ in_array($attachment['file_type'], $type) ? $attachment['file_url'] : asset('assets/images/doc.png') }})" title="{{$attachment['file_name']}}" title="{{$attachment['file_name']}}"></a>
                                @endif
                            @endforeach
                        </div>
                        <h4 class="mt-5">Other Observation Attachment</h4>
                        <div class="thumbs" style="width: unset;margin: unset;text-align: unset;" data-gallery="one">
                            @foreach ($data['attachments'] as $attachment)
                                @if($attachment['file_category'] == 'others')
                                    <a target="_blank" href="{{$attachment['file_url']}}" style="background-image:url({{ in_array($attachment['file_type'], $type) ? $attachment['file_url'] : asset('assets/images/doc.png') }})" title="{{$attachment['file_name']}}" title="{{$attachment['file_name']}}"></a>
                                @endif
                            @endforeach
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>



