<h5 class="text-info text-center">শিরোনামঃ {{$apottiItemInfo['memo_title_bn']}}</h5>

<div class="mt-5">
    <div class="form-group">
        <label for="">স্থানীয় অফিসের জবাব</label>
        <textarea class="form-control" readonly rows="1">{{$apottiItemInfo['unit_response']}}</textarea>
    </div>

    <div class="form-group">
        <label for="">উৰ্দ্ধতন কর্তৃপক্ষের জবাব</label>
        <textarea class="form-control" readonly rows="1">{{$apottiItemInfo['entity_response']}}</textarea>
    </div>

    <div class="form-group">
        <label for="">মন্ত্রণালয়ের সিদ্ধান্ত</label>
        <textarea class="form-control" readonly rows="1">{{$apottiItemInfo['ministry_response']}}</textarea>
    </div>

    <div class="form-group">
        <label for="">জড়িত অর্থ</label>
        <input style="text-align: right" type="text" class="form-control" readonly placeholder="জড়িত অর্থ"
               value="{{enTobn(number_format($apottiItemInfo['jorito_ortho_poriman'],0))}}">
    </div>

    <div class="form-group">
        <label for="">নিষ্পন্ন জড়িত অর্থ</label>
        <input style="text-align: right" type="number" class="form-control">
    </div>

    <div class="form-group">
        <select class="form-control select-select2" id="memo_type">
            <option value="0">সিদ্ধান্ত বাছাই করুন</option>
            <option value="1">নিস্পন্ন</option>
            <option value="2">অনিস্পন্ন</option>
            <option value="3">আংশিক নিস্পন্ন</option>
        </select>
    </div>

    <button class="btn btn-primary">সংরক্ষণ করুন</button>
</div>
