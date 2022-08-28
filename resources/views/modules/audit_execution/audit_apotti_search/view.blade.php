<div class="card sna-card-border">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex justify-content-start">
                <h5 class="mt-5"></h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="d-flex justify-content-end">
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-sm btn-warning btn_back btn-square mr-3" href="javascript:;">
                            <i class="fad fa-arrow-alt-left"></i> {{___('generic.back')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mt-4 mb-15">
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card sna-card-border">
                <div class="card-title font-size-h4 font-weight-bold">
                    <strong>আপত্তির শিরোনামঃ</strong> <span>{{$apotti['apotti_title']}}
                </div>
                <div class="row">
                    <div class="col-6">
                        <table class="table table-sm table-bordered">
                            <tbody>
                            <tr>
                                <th style="width:180px!important">আইডি</th>
                                <td>{{enTobn($apotti['id'])}}</td>
                            </tr>
                            <tr>
                                <th>মন্ত্রণালয়/বিভাগ</th>
                                <td>{{$apotti['ministry_name_bn']}}</td>
                            </tr>
                            <tr>
                                <th>এনটিটি</th>
                                <td>{{$apotti['parent_office_name_bn']}}</td>
                            </tr>
                            <tr>
                                <th>অর্থ বছর</th>
                                <td>{{enTobn($apotti['fiscal_year']['start'])}}-{{enTobn($apotti['fiscal_year']['end'])}}</td>
                            </tr>
                            <tr>
                                <th>ফাইল নং</th>
                                <td>{{$apotti['file_token_no']}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-6">
                        <table class="table table-sm table-bordered">
                            <tbody>
                            <tr>
                                <th style="width:180px!important">অনুচ্ছেদ নম্বর</th>
                                <td>{{enTobn($apotti['onucched_no'])}}</td>
                            </tr>
                            <tr>
                                <th>আপত্তির শিরোনাম</th>
                                <td>{{$apotti['apotti_title']}}</td>
                            </tr>
                            <tr>
                                <th>আপত্তির ধরন</th>
                                <td>
                                    @if($apotti['apotti_type'] == 'sfi')
                                        এসএফআই
                                    @elseif($apotti['apotti_type'] == 'non-sfi')
                                        নন-এসএফআই
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>জড়িত অর্থ</th>
                                <td>{{enTobn(currency_format($apotti['total_jorito_ortho_poriman']))}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card sna-card-border">
                <div class="card-title font-size-h4 font-weight-bold">আপত্তির মুল সংযুক্তি</div>
                <div class="row mt-3 mb-14">
                    @foreach($attachments as $attachment)
                        @if($attachment['file_type'] == 'main')
                            <div class="col-md-2 mb-16">
                                <img style="cursor: pointer;border: 2px solid #040404;box-shadow: 10px 10px 5px #ccc;" class="coverImage" src="{{'https://audit-archive.tappware.com'.$attachment['file_path'].$attachment['file_custom_name']}}"
                                     onclick="showImageOnModal(this)" width="80%" height="100%"/>

                                <button class="btn btn-sm btn-primary ml-1 mt-2" data-file-url="{{'https://audit-archive.tappware.com'.$attachment['file_path'].$attachment['file_custom_name']}}" onclick="downloadImage($(this))">
                                    <i class="fad fa-download"></i> Download
                                </button>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card sna-card-border">
                <div class="card-title font-size-h4 font-weight-bold">আপত্তির পরিশিষ্ট সংযুক্তি</div>
                <div class="row mt-3 mb-14">
                    @foreach($attachments as $attachment)
                        @if($attachment['file_type'] == 'porisishto')
                            <div class="col-md-2 mb-16">
                                <img style="cursor: pointer;border: 2px solid #040404;box-shadow: 10px 10px 5px #ccc;" class="coverImage" src="{{'https://audit-archive.tappware.com'.$attachment['file_path'].$attachment['file_custom_name']}}"
                                     onclick="showImageOnModal(this)" width="80%" height="100%"/>

                                <button class="btn btn-sm btn-primary ml-1 mt-2" data-file-url="{{'https://audit-archive.tappware.com'.$attachment['file_path'].$attachment['file_custom_name']}}" onclick="downloadImage($(this))">
                                    <i class="fad fa-download"></i> Download
                                </button>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card sna-card-border">
                <div class="card-title font-size-h4 font-weight-bold">আপত্তির প্রমানক সংযুক্তি</div>
                <div class="row mt-3 mb-14">
                    @foreach($attachments as $attachment)
                        @if($attachment['file_type'] == 'promanok')
                            <div class="col-md-2 mb-16">
                                <img style="cursor: pointer;border: 2px solid #040404;box-shadow: 10px 10px 5px #ccc;" class="coverImage" src="{{'https://audit-archive.tappware.com'.$attachment['file_path'].$attachment['file_custom_name']}}"
                                     onclick="showImageOnModal(this)" width="80%" height="100%"/>
                                <button class="btn btn-sm btn-primary ml-1 mt-2" data-file-url="{{'https://audit-archive.tappware.com'.$attachment['file_path'].$attachment['file_custom_name']}}" onclick="downloadImage($(this))">
                                    <i class="fad fa-download"></i> Download
                                </button>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card sna-card-border">
                <div class="card-title font-size-h4 font-weight-bold">আপত্তির অন্যান্য সংযুক্তি</div>
                <div class="row mt-3 mb-14">
                    @foreach($attachments as $attachment)
                        @if($attachment['file_type'] == 'other')
                            <div class="col-md-2 mb-16">
                                <img style="cursor: pointer;border: 2px solid #040404;box-shadow: 10px 10px 5px #ccc;" class="coverImage" src="{{'https://audit-archive.tappware.com'.$attachment['file_path'].$attachment['file_custom_name']}}"
                                     onclick="showImageOnModal(this)" width="80%" height="100%"/>
                                <button class="btn btn-sm btn-primary ml-1 mt-2" data-file-url="{{'https://audit-archive.tappware.com'.$attachment['file_path'].$attachment['file_custom_name']}}" onclick="downloadImage($(this))">
                                    <i class="fad fa-download"></i> Download
                                </button>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="showImageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i style="color:#ffffff!important;" aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <img src="" class="img-fluid" style="width:100%">
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

    $('.btn_back').click(function () {
        $('.apotti-search a').click();
    });

</script>
