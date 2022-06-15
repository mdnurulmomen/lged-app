<h5>অনুচ্ছেদ নংঃ- {{enTobn($apottiItemInfo['onucched_no'])}}</h5>

<div class="card border-0 mb-0 mt-5">
    <div class="card-header border-top-0 border-bottom-0 bg-white p-0 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 note_title font-weight-1">
                    শিরোনাম
                </h5>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="attachment_list_items pb-7">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 rounded-0 border-left-0 border-right-0">
                    <div class="position-relative w-100 d-flex align-items-start">
                        <span class="ml-2 d-flex align-items-start">{{$apottiItemInfo['memo_title_bn']}}</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="mt-5">
    <div class="form-group">
        <label for="">স্থানীয় অফিসের জবাব</label>
        <textarea class="form-control" readonly rows="1">{{$apottiItemInfo['unit_response']}}</textarea>
    </div>

    <div class="form-group">
        <label for="">উর্দ্ধতন কর্তৃপক্ষের সুপারিশ</label>
        <textarea class="form-control" readonly rows="1">{{$apottiItemInfo['entity_response']}}</textarea>
    </div>

    <div class="form-group">
        <label for="">মন্ত্রণালয়/বিভাগ/অন্যান্য এর সুপারিশ</label>
        <textarea class="form-control" readonly rows="1">{{$apottiItemInfo['ministry_response']}}</textarea>
    </div>

    <div class="form-group">
        <label for="">জড়িত অর্থ</label>
        <input style="text-align: right" type="text" class="form-control" readonly placeholder="জড়িত অর্থ"
               value="{{enTobn(currency_format($apottiItemInfo['jorito_ortho_poriman']))}}">
    </div>

    <div class="form-group">
        <label for="">আদায়</label>
        <input style="text-align: right" type="number" class="form-control">
    </div>

    <div class="form-group">
        <label for="">সমন্বয়</label>
        <input style="text-align: right" type="number" class="form-control">
    </div>

    <div class="form-group">
        <label for="">অবলোপন</label>
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
