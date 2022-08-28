<form class="card" id="apoitti_response_form" autocomplete="off">
    <input type="hidden" name="directorate_id" value="{{$directorate_id}}">
    <input type="hidden" name="apotti_item_id" value="{{$apotti_item_id}}">
    <div class="row mt-2">
        <div class="col-md-12">
            <label>শিরোনাম</label>
            <textarea readonly class="form-control">{{$apotti_title_bn}}</textarea>
        </div>

        <div class="col-md-12">
            <label>মন্ত্রণালয় জবাব লিখুন</label>
            <textarea class="form-control" name="ministry_response"></textarea>
        </div>

        <div class="col-md-12">
            <label>এনটিটি জবাব লিখুন</label>
            <textarea class="form-control" name="entity_response"></textarea>
        </div>

        <div class="col-md-12">
            <label>কস্ট সেন্টার জবাব লিখুন</label>
            <textarea class="form-control" name="unit_response"></textarea>
        </div>
    </div>
</form>

<div class="row mt-2">
    <div class="col-md-12">
        <button class="btn btn-sm btn-square btn-outline-primary float-right"
                onclick="Rpu_Apotti_Container.rpuResponseSubmit($(this))">
            <i class="fa fa-save"></i> সংরক্ষণ
        </button>
    </div>
</div>
