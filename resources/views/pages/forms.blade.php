@extends('sideMenuLayout')
@section('content')
<div class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
    <div class="col-md-6">
        <div class="title py-2">
            <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>ড্রাগ এন্ড ড্রপ</h4>
        </div>
    </div>
</div>
<div class="px-3">
    <div class="row">
        <div class="col-md-6">
            <div class="card rounded-0 mt-5">
                <h5 class="rounded-0 card-header bg-light py-3 px-5">
                    {{ __('বেসিক ইনপুট ফর্মস') }}
                </h5>
                <div class="card-body p-5">
                    <div class="form-group">
                        <label>{{ __('টেক্সট ইনপুট') }}</label>
                        <input type="text" class="form-control rounded-0" placeholder="{{ __('টেক্সট ইনপুট') }}" />
                    </div>
                    <div class="form-group">
                        <label>{{ __('ইমেল এড্রেস') }}</label>
                        <input type="email" class="form-control rounded-0" placeholder="{{ __('ইমেল এড্রেস') }}" />
                    </div>
                    <div class="form-group">
                        <label>{{ __('পাসওয়ার্ড') }}</label>
                        <input type="password" class="form-control rounded-0" placeholder="{{ __('পাসওয়ার্ড') }}" />
                    </div>
                    <div class="form-group">
                        <label>{{ __('সিলেক্ট অপশন') }}</label>
                        <select class="form-control rounded-0" id="exampleSelect1">
                            <option>{{ __('১') }}</option>
                            <option>{{ __('২') }}</option>
                            <option>{{ __('৩') }}</option>
                            <option>{{ __('৪') }}</option>
                            <option>{{ __('৫') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{ __('সিলেক্ট অপশন') }}</label>
                        <select class="form-control rounded-0" id="kt_select2_1">
                            <option>{{ __('১') }}</option>
                            <option>{{ __('২') }}</option>
                            <option>{{ __('৩') }}</option>
                            <option>{{ __('৪') }}</option>
                            <option>{{ __('৫') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{ __('চেক বক্স') }}</label>
                        <div class="checkbox-inline">
                            <label class="checkbox">
                                <input type="checkbox" name="Checkboxes2">
                                <span></span>{{ __('অপশন ১') }}
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="Checkboxes2">
                                <span></span>{{ __('অপশন ২') }}
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="Checkboxes2">
                                <span></span>{{ __('অপশন ৩') }}
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox-list">
                            <label class="checkbox">
                            <input type="checkbox" name="Checkboxes4">
                            <span></span>{{ __('অপশন ১') }}</label>
                            <label class="checkbox">
                            <input type="checkbox" checked="checked" name="Checkboxes4">
                            <span></span>{{ __('অপশন ২') }}</label>
                            <label class="checkbox checkbox-disabled">
                            <input type="checkbox" disabled="disabled" name="Checkboxes4">
                            <span></span>{{ __('অপশন ৩') }}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('রেডিও বাটন') }}</label>
                        <div class="radio-list">
                            <label class="radio">
                            <input type="radio" name="radios1">
                            <span></span>{{ __('অপশন ১') }}</label>
                            <label class="radio radio-disabled">
                            <input type="radio" checked="checked" name="radios1">
                            <span></span>{{ __('অপশন ২') }}</label>
                            <label class="radio">
                            <input type="radio" checked="checked" name="radios1">
                            <span></span>{{ __('অপশন ৩') }}</label>
                        </div>
                        <div class="radio-inline">
                            <label class="radio">
                            <input type="radio" name="radios2">
                            <span></span>Option 1</label>
                            <label class="radio">
                            <input type="radio" name="radios2">
                            <span></span>Option 2</label>
                            <label class="radio">
                            <input type="radio" name="radios2">
                            <span></span>Option 3</label>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="reset" class="btn btn-primary mr-2 btn-square"><i class="fad fa-save"></i> {{ __('সংরক্ষন করুন') }}</button>
                        <button type="reset" class="btn btn-danger btn-square"><i class="fa fa-times"></i> {{ __('বাতিল করুন') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card rounded-0 mt-5">
                <h5 class="rounded-0 card-header bg-light py-3 px-5">
                    {{ __('HTML5 ইনপুট ফর্মস') }}
                </h5>
                <div class="card-body p-5">
                    <div class="form-group">
                        <input class="form-control rounded-0" type="text" value="{{ __('টেক্সট') }}" id="">
                    </div>
                    <div class="form-group">
                        <input class="form-control rounded-0" type="search" value="{{ __('সার্চ ইনপুট') }}" id="">
                    </div>
                    <div class="form-group">
                        <input class="form-control rounded-0" type="email" value="{{ __('ইমেইল ইনপুট') }}" id="">
                    </div>
                    <div class="form-group">
                        <input class="form-control rounded-0" type="url" value="{{ __('ইউ য়ার এল ইনপুট') }}" id="">
                    </div>
                    <div class="form-group">
                        <input class="form-control rounded-0" type="tel" value="1-(555)-555-5555" id="">
                    </div>
                    <div class="form-group">
                        <input class="form-control rounded-0" type="number" value="1" id="">
                    </div>
                    <div class="form-group">
                        <input class="form-control rounded-0" type="datetime-local" value="{{ __('টাইম এন্ড ডেট') }}" id="">
                    </div>
                    <div class="form-group">
                        <input class="form-control rounded-0" type="date" value="{{ __('ডেট') }}" id="">
                    </div>
                    <div class="form-group">
                        <input class="form-control rounded-0" type="month" value="{{ __('মাস') }}" id="">
                    </div>
                    <div class="form-group">
                        <input class="form-control rounded-0" type="week" value="{{ __('সপ্তাহ') }}" id="">
                    </div>
                    <div class="form-group">
                        <input class="form-control rounded-0" type="time" value="{{ __('টাইম') }}" id="">
                    </div>
                    <div class="form-group">
                        <input class="form-control rounded-0" type="color" value="#563d7c" id="">
                    </div>
                    <div class="form-group">
                        <input class="form-control rounded-0" type="range" id="">
                    </div>
                    <div class="text-right">
                        <button type="reset" class="btn btn-success mr-2 btn-square"><i class="fad fa-save"></i> {{ __('সংরক্ষন করুন') }}</button>
                        <button type="reset" class="btn btn-danger btn-square"><i class="fa fa-times"></i> {{ __('বাতিল করুন') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection