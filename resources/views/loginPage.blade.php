<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
        @include('partials.headerScript')
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
				<!--begin::Aside-->
				<div class="login-aside order-2 order-lg-1 d-flex flex-row-auto position-relative overflow-hidden">
					<!--begin: Aside Container-->
					<div class="d-flex flex-column-fluid flex-column justify-content-between py-9 px-7 py-lg-13 px-lg-35">
						<!--begin::Logo-->
						<a href="#" class="text-center pt-2">
							<img alt="Logo" class="" src="{{ asset('assets/images/logo.png') }}" />
						</a>
						<!--end::Logo-->
						<!--begin::Aside body-->
						<div class="d-flex flex-column-fluid flex-column flex-center">
							<!--begin::Signin-->
							<div class="login-form login-signin py-11">
								<!--begin::Form-->
								<form class="form" novalidate="novalidate" id="kt_login_signin_form">
									<!--begin::Title-->
									<div class="text-center pb-8">
										<h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">লগইন করুন</h2>
									</div>
									<!--end::Title-->
									<!--begin::Form group-->
									<div class="form-group">
										<label class="font-size-h6 font-weight-bolder text-dark">ইউজার আইডি</label>
										<input class="form-control form-control-solid h-auto py-7 px-6 rounded-0" type="text" name="username" autocomplete="off" placeholder="ইউজার আইডি"/>
									</div>
									<!--end::Form group-->
									<!--begin::Form group-->
									<div class="form-group">
										<div class="d-flex justify-content-between mt-n5">
											<label class="font-size-h6 font-weight-bolder text-dark pt-5">পাসওয়ার্ড</label>
											<a href="javascript:;" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" id="kt_login_forgot">রিসেট পাসওয়ার্ড ?</a>
										</div>
										<input class="form-control form-control-solid h-auto py-7 px-6 rounded-0" type="password" placeholder="পাসওয়ার্ড" name="password" autocomplete="off" />
									</div>
									<!--end::Form group-->
									<!--begin::Action-->
									<div class="text-center pt-2">
										<a  href="/dashboard" class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3 btn-square">লগইন</a>
									</div>
									<!--end::Action-->
								</form>
								<!--end::Form-->
							</div>
							<!--end::Signin-->
							<!--begin::Forgot-->
							<div class="login-form login-forgot pt-11">
								<!--begin::Form-->
								<form class="form" novalidate="novalidate" id="kt_login_forgot_form">
									<!--begin::Title-->
									<div class="text-center pb-8">
										<h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">পাসওয়ার্ড ভুলে গেছেন ?</h2>
										<p class="text-muted font-weight-bold font-size-h4">ইমেইল আইডি দিন রিসেট করার জন্য</p>
									</div>
									<!--end::Title-->
									<!--begin::Form group-->
									<div class="form-group">
										<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6" type="email" placeholder="ইউজার আইডি" name="email" autocomplete="off" />
									</div>
									<!--end::Form group-->
									<!--begin::Form group-->
									<div class="form-group d-flex flex-wrap flex-center pb-lg-0 pb-3">
										<button type="button" id="kt_login_forgot_submit" class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">সাবমিট করুন</button>
										<button type="button" id="kt_login_forgot_cancel" class="btn btn-danger font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">বাতিল করুন</button>
									</div>
									<!--end::Form group-->
								</form>
								<!--end::Form-->
							</div>
							<!--end::Forgot-->
						</div>
						<!--end::Aside body-->
					</div>
					<!--end: Aside Container-->
				</div>
				<!--begin::Aside-->
				<!--begin::Content-->
				<div class="content order-1 order-lg-2 d-flex flex-column w-100 pb-0" style="background-color: #B1DCED;">
					<!--begin::Title-->
					<div class="d-flex flex-column justify-content-center text-center pt-lg-40 pt-md-5 pt-sm-5 px-lg-0 pt-5 px-7">
						<h3 class="display4 font-weight-bolder my-7 text-dark" style="color: #986923;">AMMS 2.0</h3>
						<p class="font-weight-bolder font-size-h2-md font-size-lg text-dark opacity-70">Audit Management and Monitoring System</p>
					</div>
					<!--end::Title-->
					<!--begin::Image-->
					<div class="login-bg content order-1 order-lg-2 d-flex flex-column w-100 pb-0 content-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-center" style="background-image: url(assets/images/pasai-pillars.png);background-size: contain;"></div>
					<!--end::Image-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Login-->
		</div>
		<!--end::Main-->
		@include('partials.footerScript')
	</body>
</html>