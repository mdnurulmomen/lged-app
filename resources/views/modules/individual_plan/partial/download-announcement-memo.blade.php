<div class="card sna-card-border mt-3" style="margin-bottom:30px; padding: 25px;">
    <div class="col-sm-12">
        <b>Ref : </b>
    </div>

    <div class="col-sm-12">
    <?php
        $date = \Carbon\Carbon::parse($announcementMemo['engagement_letter']['created_at'])->format('d/m/Y');
    ?>
        <b>Date : {{$date}}</b>
    </div>

    <div class="col-sm-12" style="text-align: center; font-size: 1.3rem;">
        <b>Internal Audit Engagement Letter</b>
    </div>

    <div class="col-sm-12 mt-3" style="text-align: left;">
        {{$announcementMemo['engagement_letter']['letter_to']}}
        <br>
        {{$announcementMemo['yearly_plan_info']['project_name_en']}}
        <br>
        LGED, Dhaka.
    </div>

    <br>

    <div class="col-sm-12 mt-3">
        <b>Subject: {{$announcementMemo['engagement_letter']['subject']}}</b>
    </div>

    <br>

    <div class="col-sm-12 mt-2">
        <span>Reference : Memo No - {{$announcementMemo['finding']['onucched_no']}}</span>
    </div>

    <br>

    <div class="col-sm-12 mt-2" style="text-align: justify;">
        {{$announcementMemo['engagement_letter']['body']}}
    </div>

    <div class="col-sm-12 mt-2" style="text-align: justify;">
       <b>OBJECTIVE OF THE AUDIT</b>
       <br>
       {!!$announcementMemo['audit_plan_info']['objective']!!}
    </div>

    <div class="col-sm-12 mt-2" style="text-align: justify;">
       <b>SCOPE OF THE AUDIT</b>
       <br>
       {!!$announcementMemo['audit_plan_info']['scope']!!}
    </div>

    <div class="col-sm-12 mt-2" style="text-align: justify;">
        {!!$announcementMemo['engagement_letter']['others']!!}
    </div>

    <div class="col-sm-12 mt-2" style="text-align: justify;">
        Yours sincerely,
        <br>
        {!!$announcementMemo['engagement_letter']['letter_from']!!}
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

