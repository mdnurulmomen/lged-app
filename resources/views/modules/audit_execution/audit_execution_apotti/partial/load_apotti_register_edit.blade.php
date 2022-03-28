<h5>
    শিরোনাম: {{$apotti_info['apotti_title']}}
</h5>

<div class="form-group mt-4">
    <label for="apotti_type">আপত্তি ধরন<span class="text-danger">*</span></label>
    <select class="form-control" id="apotti_type">
        <option value="">--বাছাই করুন--</option>
        <option value="sfi">এসএফআই</option>
        <option value="non-sfi">নন-এসএফআই</option>
    </select>
</div>

<div class="form-group">
    <label for="comments">মন্তব্য<span class="text-danger">*</span></label>
    <textarea class="form-control" id="comments" placeholder="মন্তব্য" cols="30" rows="2"></textarea>
</div>

<div class="d-flex justify-content-end">
    <a href="javascript:;" role="button"
       data-apotti-id="{{$apotti_info['id']}}"
       onclick="Apotti_Register_Container.updateApotti($(this))"
       class="btn btn-primary btn-sm btn-square btn-forward">
        <i class="fa fa-save"></i>
        সংরক্ষন করুন
    </a>
</div>
