<form class="mb-4" id="apotti_create_form" enctype="multipart/form-data" autocomplete="off">
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

    <div class="mt-4 mb-15">
        <div class="row">
            <div class="col-md-12">
                <div class="card sna-card-border mt-3 mb-15">
                    <h4>আপত্তির শিরোনাম: <span>{{$apotti['apotti_title']}}</span></h4>
                    <div class="row">
                        <div class="col-6">
                            <table class="table table-sm table-bordered">
                                <tbody>
                                <tr>
                                    <th style="width:180px!important">মন্ত্রণালয়/বিভাগ</th>
                                    <td>{{$apotti['ministry_name_bn']}}</td>
                                </tr>
                                <tr>
                                    <th>এনটিটি</th>
                                    <td>{{$apotti['entity_name']}}</td>
                                </tr>
                                <tr>
                                    <th>গ্রুপ</th>
                                    <td>{{$apotti['parent_office_name_bn']}}</td>
                                </tr>
                                <tr>
                                    <th>কস্ট সেন্টার</th>
                                    <td>{{$apotti['cost_center_name_bn']}}</td>
                                </tr>
                                <tr>
                                    <th>নিরীক্ষা বছর</th>
                                    <td>{{$apotti['nirikkhar_shal']}}</td>
                                </tr>
                                <tr>
                                    <th>নিরীক্ষার ধরন</th>
                                    <td>{{$apotti['nirikkha_dhoron']}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-6">
                            <table class="table table-sm table-bordered">
                                <tbody>
                                <tr>
                                    <th style="width:180px!important">অনুচ্ছেদ নং</th>
                                    <td>{{$apotti['onucched_no']}}</td>
                                </tr>
                                <tr>
                                    <th>আপত্তির শিরোনাম</th>
                                    <td>{{$apotti['apotti_title']}}</td>
                                </tr>
                                <tr>
                                    <th>আপত্তি অনিয়মের ক্যাটাগরি</th>
                                    <td>{{empty($apotti['oniyomer_category'])?'':$apotti['oniyomer_category']['name_bn']}}</td>
                                </tr>
                                <tr>
                                    <th>আপত্তির ধরন</th>
                                    <td>{{$apotti['apottir_dhoron']}}</td>
                                </tr>
                                <tr>
                                    <th>আপত্তির বর্তমান অবস্থা</th>
                                    <td>{{$apotti['apotti_status']}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card sna-card-border mt-3 mb-15">
                    <h4>কভার পেইজ</h4>
                    <div class="row mt-3">
                        <div class="col-md-2">
                            <img style="cursor: pointer" class="coverImage" src="{{$apotti['cover_page_path'].'/'.$apotti['cover_page']}}"
                                 onclick="showImageOnModal(this)" width="80%" height="100%"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card sna-card-border mt-3 mb-15">
                    <h4>আপত্তির মুল সংযুক্তি</h4>
                    <div class="row mt-3">
                        @foreach($apotti['attachments'] as $attachment)
                            @if ($attachment['attachment_type'] == 'main')
                                <div class="col-md-2">
                                    <img style="cursor: pointer" class="coverImage" src="{{$attachment['attachment_path'].'/'.$attachment['attachment_name']}}"
                                         onclick="showImageOnModal(this)" width="80%" height="100%"/>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card sna-card-border mt-3 mb-15">
                    <h4>আপত্তির পরিশিষ্ট সংযুক্তি</h4>
                    <div class="row mt-3">
                        @foreach($apotti['attachments'] as $attachment)
                            @if ($attachment['attachment_type'] == 'porisishto')
                                <div class="col-md-2">
                                    <img style="cursor: pointer" class="coverImage" src="{{$attachment['attachment_path'].'/'.$attachment['attachment_name']}}"
                                         onclick="showImageOnModal(this)" width="80%" height="100%"/>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card sna-card-border mt-3 mb-15">
                    <h4>আপত্তির প্রমানক সংযুক্তি</h4>
                    <div class="row mt-3">
                        @foreach($apotti['attachments'] as $attachment)
                            @if ($attachment['attachment_type'] == 'promanok')
                                <div class="col-md-2">
                                    <img style="cursor: pointer" class="coverImage" src="{{$attachment['attachment_path'].'/'.$attachment['attachment_name']}}"
                                         onclick="showImageOnModal(this)" width="80%" height="100%"/>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card sna-card-border mt-3 mb-15">
                    <h4>আপত্তির অন্যান্য সংযুক্তি</h4>
                    <div class="row mt-3">
                        @foreach($apotti['attachments'] as $attachment)
                            @if ($attachment['attachment_type'] == 'other')
                                <div class="col-md-2">
                                    <img style="cursor: pointer" class="coverImage" src="{{$attachment['attachment_path'].'/'.$attachment['attachment_name']}}"
                                         onclick="showImageOnModal(this)" width="80%" height="100%"/>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal -->
<div class="modal fade" id="showImageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" class="img-fluid" style="width:100%">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<script>
    function showImageOnModal(element) {
        var imageSrc = $(element).attr('src');
        $("#showImageModal").find('.modal-title').html('Image');
        $("#showImageModal").find('.modal-body img').attr('src', imageSrc);
        $("#showImageModal").modal('show');
    }
</script>
