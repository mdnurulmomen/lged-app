@props(['id' => 'quick_modal', 'title' => '', 'url' => '', 'method' => 'post', 'size'=>'xl', 'saveButton' => 'on', 'saveBtnTxt' => 'Save changes'])
<div class="modal fade" id="{{$id}}" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-{{$size}}" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$id}}_title">{{$title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                {{$slot}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold btn-square" data-dismiss="modal">
                    Close
                </button>
                @if($saveButton == "on")
                    <button type="button" class="btn btn-primary font-weight-bold btn-square" id="btn_{{$id}}_save"
                            data-method="{{$method}}"
                            data-url="{{$url}}">
                        {{$saveBtnTxt}}
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
