<style>
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
        box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
</style>

<form autocomplete="off" id="role_update_form">
    <input type="hidden" name="role_id" value="{{$roleId}}">

    <div class="row">
        <div class="col-md-12">
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">
                    Master Designation
                </legend>
                @foreach($masterDesignationList as $designation)
                    <div class="row">
                        <div class="col-md-12 pl-0 text-capitalize">
                            <label>
                                <input name="master_designation[]" type="checkbox" value="{{$designation['id']}}">
                                <span class="pl-2">{{$designation['designation_name_eng']}}</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </fieldset>
        </div>
    </div>


    <div class="d-flex justify-content-end">
        <a href="javascript:;" role="button"
           class="btn btn-primary btn-sm btn-square btn-forward">
            <i class="fa fa-save"></i>
            Save
        </a>
    </div>
</form>
