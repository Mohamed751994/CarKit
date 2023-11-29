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
        <li class="@if(getActiveLink('cars')) mm-active @endif">
            <a href="{{ route('cars.index')  }}">
                <div class="parent-icon"><i class="bx bx-car"></i>
                </div>
                <div class="menu-title">السيارات</div>
            </a>
        </li>
        <li class="@if(getActiveLink('brands')) mm-active @endif">
            <a href="{{ route('brands.index')  }}">
                <div class="parent-icon"><i class="bx bx-car"></i>
                </div>
                <div class="menu-title">الماركات والموديلات</div>
            </a>
        </li>

        <li class="@if(getActiveLink('tanants')) mm-active @endif">
            <a href="{{ route('tanants.index')  }}">
                <div class="parent-icon"><i class="lni lni-offer"></i>
                </div>
                <div class="menu-title">الحجوزات</div>
            </a>
        </li>


        <li class="@if(getActiveLink('invoices')) mm-active @endif">
            <a href="{{ route('invoices.index')  }}">
                <div class="parent-icon"><i class="lni lni-printer"></i>
                </div>
                <div class="menu-title">الفواتير</div>
            </a>
        </li>


        <li class="@if(getActiveLink('reports')) mm-active @endif">
            <a href="{{ route('reports.index')  }}">
                <div class="parent-icon"><i class="bx bxs-file-pdf"></i>
                </div>
                <div class="menu-title">التقارير</div>
            </a>
        </li>


        <li class="@if(getActiveLink('settings')) mm-active @endif">
            <a href="{{ route('settings.index')  }}">
                <div class="parent-icon"><i class="lni lni-cog"></i>
                </div>
                <div class="menu-title">ضبط الإعدادات</div>
            </a>
        </li>

        <li class="@if(getActiveLink('seos')) mm-active @endif">
            <a href="{{ route('seos.index')  }}">
                <div class="parent-icon"><i class="lni lni-search"></i>
                </div>
                <div class="menu-title">محركات البحث</div>
            </a>
        </li>

        <li class="">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                <div class="parent-icon"><i class="bi bi-lock-fill"></i>
                </div>
                <div class="menu-title">تسجيل الخروج</div>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>



    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->
