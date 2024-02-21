<div class="main-sidebar">
    <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="index.html">Vehicle Management</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">VM</a>
    </div>
    <ul class="sidebar-menu">
    @if (auth()->user()->role == 'admin')
        <li class="menu-header">Dashboard</li>
        <li class="nav-item dropdown {{ Request::segment(1) === 'companies' ? 'active' : null }}">
            <a class="nav-link" href="{!! route('companies') !!}"><i class="fas fa-building"></i></i> <span>Company</span></a>
        </li>
        <li class="nav-item dropdown {{ Request::segment(1) === 'vehicles' ? 'active' : null }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-car"></i> <span>Vehicle</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="{!! route('vehicles') !!}">Vehicle</a></li>
                <li><a class="nav-link" href="{!! route('monitoring') !!}">Monitoring</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown {{ Request::segment(1) == 'vehicle_usage' ? 'active' : null }}">
            <a class="nav-link" href="{!! route('vehicle_usage') !!}"><i class="fas fa-home"></i><span>Vehicle Usage</span></a>
        </li>
        <li class="nav-item dropdown {{ Request::segment(1) === 'log-activity' ? 'active' : null }}">
            <a class="nav-link" href="{!! route('log-activity') !!}"><i class="fas fa-clock"></i><span>Log Activity</span></a>
        </li>
    @elseif (auth()->user()->role == 'officer')
        <li class="nav-item dropdown {{ Request::segment(1) == 'vehicle_usage' ? 'active' : null }}">
            <a class="nav-link" href="{!! route('vehicle_usage') !!}"><i class="fas fa-home"></i><span>Vehicle Usage</span></a>
        </li>
        <li class="nav-item dropdown {{ Request::segment(1) === 'log-activity' ? 'active' : null }}">
            <a class="nav-link" href="{!! route('log-activity') !!}"><i class="fas fa-clock"></i><span>Log Activity</span></a>
        </li>
    @endif      
    </ul>
    </aside>
</div>
