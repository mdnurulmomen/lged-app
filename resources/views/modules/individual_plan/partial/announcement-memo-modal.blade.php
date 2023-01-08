<div style="text-align: right;">
    <button class="btn btn-download btn-sm btn-bold btn-square"
        data-audit-plan-id="{{$announcementMemo['audit_plan_id']}}"
        data-yearly_plan_location_id="{{$announcementMemo['audit_plan']['yearly_plan_location']['id']}}"
        onclick="Individual_Plan_Container.downloadAnnouncementModal($(this))">
        <i class="far fa-file-pdf"></i> Download
    </button>

    <button data-audit-plan-id="{{$announcementMemo['audit_plan_id']}}"
            data-yearly_plan_location_id="{{$announcementMemo['audit_plan']['yearly_plan_location']['id']}}"
            onclick="Individual_Plan_Container.generateEngagementLetterMSWord($(this))"
            class="btn btn-primary btn-sm btn-bold btn-square">
        <i class="far fa-file-word"></i> MS Word
    </button>
</div>

<div class="card sna-card-border mt-3" style="margin-bottom:30px; padding: 25px;">
    <div class="col-sm-12">
        <b>Ref : </b>
    </div>

    <div class="col-sm-12">
    <?php
        $date = \Carbon\Carbon::parse($announcementMemo['created_at'])->format('d/m/Y');
    ?>
        <b>Date : {{$date}}</b>
    </div>

    <div class="col-sm-12" style="text-align: center; font-size: 1.3rem;">
        <b>Internal Audit Engagement Letter</b>
    </div>

    <div class="col-sm-12 mt-3" style="text-align: left;">
        {{$announcementMemo['letter_to']}}
        <br>
        {{$announcementMemo['audit_plan']['yearly_plan_location']['project_name_en']}}
        <br>
        LGED, Dhaka.
    </div>


    <div class="col-sm-12 mt-3">
        <b>Subject: {{$announcementMemo['subject']}}</b>
    </div>

    <div class="col-sm-12 mt-2">
        <span>Reference : Memo No - {{$announcementMemo['audit_plan']['office_order']['memorandum_no']}}</span>
    </div>

    <div class="col-sm-12 mt-2" style="text-align: justify;">
        {{$announcementMemo['body']}}
    </div>

    <div class="col-sm-12 mt-2" style="text-align: justify;">
       <b>OBJECTIVE OF THE AUDIT</b>
       <br>
       {!!$announcementMemo['audit_plan']['objective']!!}
    </div>

    <div class="col-sm-12 mt-2" style="text-align: justify;">
       <b>SCOPE OF THE AUDIT</b>
       <br>
       {!!$announcementMemo['audit_plan']['scope']!!}
    </div>

    <div class="col-sm-12 mt-2" style="text-align: justify;">
        {!!$announcementMemo['others']!!}
    </div>

    <div class="col-sm-12 mt-2" style="text-align: justify;">
        Yours sincerely,
        <br>
        {!!$announcementMemo['letter_from']!!}
        <br>
        LGED, Dhaka.
        <br>
        <br>
        <b>Date : </b>
        <br>
        <br>
        Signature of Authorised Officer: ____________________________
        <br>
        <b>Name : </b>
        <br>
        <b>Date : </b>

    </div>
</div>

