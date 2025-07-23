<ul class="mobile-menu">
    <li class="mobile_toggle"><a href=""><i class="bi bi-list"></i></a></li>
    <li><a href="{{route('admin.dashboard')}}"><i class="bi bi-house-door"></i></a></li>
    <li>
        <a class="dropdown-item" href="{{ route('admin.logout.submit') }}"
            onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i>
        </a>
    </li>
    
</ul>
    