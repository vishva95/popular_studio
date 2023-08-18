	<!-- begin:: Header Topbar -->
  <div class="kt-header__topbar">


<div class="kt-header__topbar-item kt-header__topbar-item--user">

    <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">



        <span class="kt-header__topbar-icon kt-hidden-"><i class="flaticon2-user-outline-symbol"></i></span>

    </div>

    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

        <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(assets/media/misc/bg-1.jpg)">

            <div class="kt-user-card__avatar">

            </div>

            <div class="kt-user-card__name">
              Admin

            </div>

            <div class="kt-user-card__badge">
                <form id="logout-form" action="{{  route('logout') }}" method="POST" >
                    @csrf
                        <button class="btn btn-success btn-sm btn-bold btn-font-md" type="submit"  style="color: white;">Logout</button>
                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</div>

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">