<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
        <base href="../../">
        <meta charset="utf-8" />
        <title>PriceCom | Register</title>
        <link href="assets/app.css" rel="stylesheet" type="text/css" />
        <link href="assets/admin/plugins/global/plugins.bundle.css" rel="stylesheet"/>
        <link href="assets/admin/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet"/>
        <link href="assets/admin/css/style.bundle.css" rel="stylesheet"/>
        <link href="assets/admin/css/themes/layout/header/base/light.css" rel="stylesheet"/>
        <link href="assets/admin/css/themes/layout/header/menu/light.css" rel="stylesheet"/>
        <link href="assets/admin/css/themes/layout/brand/dark.css" rel="stylesheet"/>
        <link href="assets/admin/css/themes/layout/aside/dark.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    </head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
                <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('assets/admin/media/bg/bg-5.jpg');">
					<div class="row" style="width: 100%;">
						<div class="col-7 login-form text-center tw-py-40 position-relative overflow-hidden">
							<div class="d-flex flex-center tw-my-8">
								<div style="font-size:75px; text-shadow: #FC0 1px 0 10px;" class="tw-font-bold tw-italic tw-text-black">PriceCom</div>
							</div>
							<div>
								<h3 class="tw-text-white">Sign In now.</h3>
								<div class="text-muted font-weight-bold">Sign In now with existing account.</div>
								<a href="User/auth/login.php" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Sign In</a>
							</div>
						</div>
						<div class="col-5 login-form position-relative overflow-hidden">
							<div class="login-signin tw-mr-36 tw-py-20 tw-bg-white tw-rounded-lg tw-bg-opacity-60">
								<div class="tw-mb-8 tw-px-16">
									<h3 class="tw-text-black tw-uppercase tw-font-bold" style="font-size:30px;">Registration</h3>
								<div class="font-weight-bold tw-text-black">Enter your account information below.</div>
								</div>
								<div class="tw-mx-16 text-center">
									<div class="form-group mb-5">
										<input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Username" name="username" autofocus/>
									</div>
									<div class="form-group mb-5">
										<input class="form-control h-auto form-control-solid py-4 px-8" type="email" placeholder="Email" name="email" autofocus />
									</div>
									<div class="form-group mb-5">
										<input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Phone Number" name="phone_no" autofocus />
									</div>
									<div class="form-group mb-5">
										<input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="password" required/>
									</div>
									<div class="form-group mb-5">
										<input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Comfirm Password" name="comfirm_password" required/>
									</div>
									<button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Sign Up</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
    <script>var HOST_URL = "https://keenthemes.com/metronic/tools/preview";</script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/admin/plugins/global/plugins.bundle.js"></script>
    <script src="assets/admin/plugins/custom/prismjs/prismjs.bundle.js"></script>
    <script src="assets/admin/js/scripts.bundle.js"></script>
    <script type="text/javascript" src="assets/admin/plugins/custom/datatables/datatables.bundle.js" defer></script>
    <script type="text/javascript" src="assets/admin/js/pages/crud/datatables/basic/scrollable.js" defer></script>
</html>