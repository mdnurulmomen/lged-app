<div class="topbar">
    <div class="topbar-item">
        {!! $wizardData !!}
        <div class="d-none" id="stt_result"></div>
        <button id="voice2text" type="button" role="button" class="fr-command fr-btn" data-cmd="voice2text" data-toggle="popover" data-content="স্পিচ টু টেক্সট" data-placement="bottom" data-original-title="" title=""><i class="fa startListening fa-microphone-slash" aria-hidden="true" style="color: rgb(255, 0, 0);"></i></button>
    </div>
    <div class="dropdown">
        @include('layouts.partials.topbar._language')
    </div>
    <div class="dropdown">
        @include('layouts.partials.topbar._profile')
    </div>
</div>
