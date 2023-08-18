	<!DOCTYPE html>







<!--



Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 8



Author: KeenThemes



Website: http://www.keenthemes.com/



Contact: support@keenthemes.com



Follow: www.twitter.com/keenthemes



Dribbble: www.dribbble.com/keenthemes



Like: www.facebook.com/keenthemes



Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes



Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes



License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.



-->



<html lang="en">







<!-- begin::Head -->



<head>



	<base href="">



	<meta charset="utf-8" />



	<title>Popular Studio</title>



	<meta name="description" content="Latest updates and statistic charts">



	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!--begin::Fonts -->



	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">







	<!--end::Fonts -->


	<link href="{{ asset('/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />

	<script src="https://cdn.ckeditor.com/4.16.2/full/ckeditor.js" type="text/javascript"></script>

	<script src="{{ asset('/assets/js/pages/crud/forms/widgets/select2.js') }}" type="text/javascript"></script>

	<link href="{{ asset('/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />

	<link href="{{ asset('/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />


	<style type="text/css">
	th {
		font-weight: bold !important;
		color: #040A82 !important;
	}
	.toast.toast-success {
		background: #040A82;
	}
	.toast.toast-warning {
		background: red;
	}
	.toast.toast-error {
		background: #808000;
	}
	.toast.toast-info {
		background: #808000;
	}
</style>
<style type="text/css">
@media only screen and (max-width: 600px) {
	.top{

		display: block !important;
	}
	.bottom{

		display: block !important;
	}
}
.kt-portlet{
	/*width: 100%;*/
	margin: 0 auto;
}
.top{
	justify-content: space-between;
	display: flex;
}
.bottom{
	justify-content: space-between;
	display: flex;
}
label
{
	font-weight: bold !important;
}

.list-content{
	margin-bottom: 10px;
}
.list-content a{
	padding: 10px 15px;
	width: 100%;
	display: inline-block;
	background-color: #f5f5f5;
	position: relative;
	color: #565656;
	font-weight: 400;
	border-radius: 4px;
}
.list-content a[aria-expanded="true"] i{
	transform: rotate(180deg);
}
.list-content a i{
	text-align: right;
	position: absolute;
	top: 15px;
	right: 10px;
	transition: 0.5s;
}


</style>

<script src="{{ asset('/assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>

<script src="{{ asset('/assets/js/scripts.bundle.js') }}" type="text/javascript"></script>

<link rel="shortcut icon" href="{{ asset('/assets/media/logos/gcpl-new.png') }}" />



@stack('styles')

</head>

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading">

	<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">

		<div class="kt-header-mobile__logo">

			<a href="{{route('home')}}">
				<img alt="Logo" src="{{ asset('/assets/media/popularstudio.png') }}"  style="height: 50px; width: 50px;" />
			</a>

		</div>

		<div class="kt-header-mobile__toolbar">

			<div class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></div>

			<div class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></div>

			<div class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></div>

		</div>

	</div>


	<div class="kt-grid kt-grid--hor kt-grid--root">

		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

			<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>

			<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

				<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">

					<div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">

						<ul class="kt-menu__nav "> 
							<li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true"><a href="{{route('home')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-protection"></i><span class="kt-menu__link-text">Dashboard</span></a></li>
							<li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true"><a href="{{route('user.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-user"></i><span class="kt-menu__link-text">User Manager</span></a></li>
							<li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true"><a href="#" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-layers"></i><span class="kt-menu__link-text">Item Master</span></a></li>
							</ul>

						</div>

					</div>

				</div>


				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<div id="kt_header" class="kt-header kt-grid kt-grid--ver  kt-header--fixed ">


						<div class="kt-header__brand kt-grid__item  " id="kt_header_brand" style="background-color: white !important;">

							<div class="kt-header__brand-logo">
								<a href="{{route('home')}}">
									<img alt="Logo" src="{{ asset('/assets/media/logos/popularstudio.png') }}" style=" height: 75px; width: 75px;" />
								</a>
							</div>

						</div>


						<h3 class="kt-header__title kt-grid__item">
							<a href="{{route('home')}}" >
								Popular Studio
							</a>
						</h3>

						<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>

						<div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">

							<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">


								<ul class="kt-menu__nav ">
									<li class="kt-menu__item  kt-menu__item--active " aria-haspopup="true"><a href="{{route('home')}}" class="kt-menu__link "><span class="kt-menu__link-text">Dashboard</span></a></li>
									<li class="kt-menu__item  kt-menu__item--active " aria-haspopup="true"><a href="{{route('user.index')}}" class="kt-menu__link "><span class="kt-menu__link-text">User</span></a></li>
									
										</ul>

							</div>

						</div>

