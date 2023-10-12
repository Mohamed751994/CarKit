<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">

        <div>
           <img src="{{asset('admin_dashboard/assets/images/logo.png')}}" alt=""  width="120px"/>
        </div>
        <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard')  }}">
                <div class="parent-icon"><i class="bi bi-house-fill"></i>
                </div>
                <div class="menu-title">لوحة التحكم</div>
            </a>
        </li>

        <li class="@if(getActiveLink('vendors')) mm-active @endif">
            <a href="{{ route('vendors.index')  }}">
                <div class="parent-icon"><i class="lni lni-users"></i>
                </div>
                <div class="menu-title">أصحاب المعارض</div>
            </a>
        </li>
        <li class="@if(getActiveLink('users')) mm-active @endif">
            <a href="{{ route('users.index')  }}">
                <div class="parent-icon"><i class="lni lni-users"></i>
                </div>
                <div class="menu-title">العملاء</div>
            </a>
        </li>
{{--        <li class="@if(getActiveLink('brands')) mm-active @endif">--}}
{{--            <a href="{{ route('brands.index')  }}">--}}
{{--                <div class="parent-icon"><i class="bx bx-car"></i>--}}
{{--                </div>--}}
{{--                <div class="menu-title">الماركات والموديلات</div>--}}
{{--            </a>--}}
{{--        </li>--}}


    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->
