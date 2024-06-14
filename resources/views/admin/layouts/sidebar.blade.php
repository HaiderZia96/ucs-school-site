<nav class="sidebar">
    <nav class="sidebar-menu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <div class="user-info">
                    <div class="image">
                        <img src="{{asset('admin/images/user.png')}}" width="48" height="48" alt="User">
                    </div>
                    <div class="info-container">
                        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
                        <div class="email">{{Auth::user()->email}}</div>
                    </div>
                </div>
            </li>
            <li class="main-navigation">
                Main Navigation
            </li>
            @can('dashboard')
                <li class="nav-item mt-2 waves-effect">
                    <a class="nav-link" aria-current="page" href="{{route('dashboard')}}">
                        <span>Home</span>
                    </a>
                </li>
            @endcan
            @canany(['permission-group-list','permission-group-create'])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect" href="#" id="permission_group" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>
                        Permission Group
                    </span>
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="permission_group">
                        @can('permission-group-create')
                            <li><a class="dropdown-item" href="{{route('permission_group.create')}}">Add New</a></li>
                        @endcan
                        @can('permission-group-list')
                            <li><a class="dropdown-item" href="{{route('permission_group.index')}}">View All</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            @canany(['permission-list','permission-create'])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect" href="#" id="permission" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>
                        Permission
                    </span>
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="permission">
                        @can('permission-create')
                            <li><a class="dropdown-item" href="{{route('permission.create')}}">Add New</a></li>
                        @endcan
                        @can('permission-list')
                            <li><a class="dropdown-item" href="{{route('permission.index')}}">View All</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            @canany(['role-list','role-create'])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect" href="#" id="permission" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>
                        Role
                    </span>
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="permission">
                        @can('role-create')
                            <li><a class="dropdown-item" href="{{route('role.create')}}">Add New</a></li>
                        @endcan
                        @can('role-list')
                            <li><a class="dropdown-item" href="{{route('role.index')}}">View All</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            @canany(['user-list','user-create'])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect" href="#" id="user" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>
                        Users
                    </span>
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="user">
                        @can('user-create')
                            <li><a class="dropdown-item" href="{{route('user.create')}}">Add New</a></li>
                        @endcan
                        @can('user-list')
                            <li><a class="dropdown-item" href="{{route('user.index')}}">View All</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @canany(['contact-list'])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect" href="#" id="contact" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span>
                    Contact Us
                </span>
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="contact">
                        @can('contact-list')
                            <li><a class="dropdown-item" href="{{route('contact-us.index')}}">View All</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            {{-- end contact --}}
            @canany(['news-categories-list'])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect" href="#" id="contact" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span>
                    News Categories
                </span>
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="contact">
                        @can('news-categories-create')
                            <li><a class="dropdown-item" href="{{route('news-categories.create')}}">Create New & View All</a></li>
                    </ul>
                    @endcan
                </li>
            @endcanany
            {{-- end category --}}

            @canany(['tags-list'])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect" href="#" id="contact" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span>
                    Tags
                </span>
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="contact">
                        @can('tags-create')
                            <li><a class="dropdown-item" href="{{route('tags.create')}}">Create & View New Tags</a></li>
                    </ul>
                    @endcan
                </li>
            @endcanany
            {{-- end tags --}}

            @canany(['news-and-events-list' , 'news-and-events-create'])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect" href="#" id="contact" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span>
                    News and Events
                </span>
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="contact">
                        @can('news-and-events-create')
                            <li><a class="dropdown-item" href="{{route('news-and-events.create')}}">Create New</a></li>
                        @endcan
                        @can('news-and-events-list')
                            <li><a class="dropdown-item" href="{{route('news-and-events.index')}}">View All</a></li>
                        @endcan
                    </ul>

                </li>
            @endcanany
            {{-- end tags --}}

            <!-- News and Events -->
            {{-- @can('news-and-events-list')
                    <ul class="list-unstyled sub-menu">
                        <li>
                            <a href="javaScript:void();" class="waves-effect">
                            <i class="zmdi zmdi-chart"></i> <span>News And Events</span>
                            </a>
                            <ul class="sidebar-submenu">
                               @can('news-and-events-create')
                                   <li><a href="{{route('news-and-events.create')}}">
                                       <i class="zmdi zmdi-chart"></i>Create New</a></li>
                               @endcan
                                   <li><a href="{{route('news-and-events.index')}}">
                                   <i class="zmdi zmdi-chart"></i>View All</a></li>
                           </ul>
                        </li>
                    </ul>
                @endcan --}}
            {{-- Popup --}}
            @canany(['popup-list' , 'popup-create'])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect" href="#" id="popup" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span>
                    Popup
                </span>
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="contact">
                        @can('popup-create')
                            <li><a class="dropdown-item" href="{{route('popup.create')}}">Create New</a></li>
                        @endcan
                        @can('popup-list')
                            <li><a class="dropdown-item" href="{{route('popup.index')}}">View All</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            {{-- Prospectus --}}
            @canany(['prospectus-list' , 'prospectus-create'])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect" href="#" id="prospectus" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span>
                    Prospectus
                </span>
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="prospectus">
                        @can('prospectus-create')
                            <li><a class="dropdown-item" href="{{route('prospectus.create')}}">Create New</a></li>
                        @endcan
                        @can('prospectus-list')
                            <li><a class="dropdown-item" href="{{route('prospectus.index')}}">View All</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            {{-- Prospectus --}}
            @canany(['calendar-list' , 'calendar-create'])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect" href="#" id="calendar" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span>
                    Calendar
                </span>
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="calendar">
                        @can('calendar-create')
                            <li><a class="dropdown-item" href="{{route('calendar.create')}}">Create New</a></li>
                        @endcan
                        @can('calendar-list')
                            <li><a class="dropdown-item" href="{{route('calendar.index')}}">View All</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany

        </ul>
    </nav>
</nav>
