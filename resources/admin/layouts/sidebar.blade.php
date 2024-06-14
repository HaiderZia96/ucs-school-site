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
            {{-- start location  --}}
            @canany(['location-list','location-create'])
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect" href="#" id="department" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span>
                    Locations
                </span>
                    <i class="fa fa-plus"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="location">
                    @can('location-create')
                        <li><a class="dropdown-item" href="{{route('locations.create')}}">Add New</a></li>
                    @endcan
                    @can('location-list')
                        <li><a class="dropdown-item" href="{{route('locations.index')}}">View All</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            {{-- end location  --}}
             {{-- category start  --}}
             @canany(['category-list','category-create'])
             <li class="nav-item dropdown">
                 <a class="nav-link dropdown-toggle waves-effect" href="#" id="categories" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 <span>
                     Categories
                 </span>
                     <i class="fa fa-plus"></i>
                 </a>
                 <ul class="dropdown-menu" aria-labelledby="categories">
                     @can('category-create')
                         <li><a class="dropdown-item" href="{{route('categories.create')}}">Add New</a></li>
                     @endcan
                     @can('category-list')
                         <li><a class="dropdown-item" href="{{route('categories.index')}}">View All</a></li>
                     @endcan
                 </ul>
             </li>
             @endcanany
             {{-- end category --}}
            {{-- events start  --}}
            @canany(['event-list','event-create'])
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect" href="#" id="events" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span>
                    News and Events
                </span>
                    <i class="fa fa-plus"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="events">
                    @can('event-create')
                        <li><a class="dropdown-item" href="{{route('events.create')}}">Add New</a></li>
                    @endcan
                    @can('event-list')
                        <li><a class="dropdown-item" href="{{route('events.index')}}">View All</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            {{-- end events --}}
            {{-- Projects start  --}}
            @canany(['project-list','project-create'])
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect" href="#" id="projects" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span>
                    Projects
                </span>
                    <i class="fa fa-plus"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="projects">
                    @can('project-create')
                        <li><a class="dropdown-item" href="{{route('projects.create')}}">Add New</a></li>
                    @endcan
                    @can('project-list')
                        <li><a class="dropdown-item" href="{{route('projects.index')}}">View All</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            {{-- end Projects --}}
            {{-- news start  --}}
            @canany(['news-list','news-create'])
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect" href="#" id="news" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span>
                    Communication
                </span>
                    <i class="fa fa-plus"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="news">
                    @can('news-create')
                        <li><a class="dropdown-item" href="{{route('news.create')}}">Add New</a></li>
                    @endcan
                    @can('news-list')
                        <li><a class="dropdown-item" href="{{route('news.index')}}">View All</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            {{-- end news --}}
            {{-- publication start  --}}
            @canany(['publication-list','publication-create'])
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect" href="#" id="publications" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span>
                    Publications
                </span>
                    <i class="fa fa-plus"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="publications">
                    @can('publication-create')
                        <li><a class="dropdown-item" href="{{route('publications.create')}}">Add New</a></li>
                    @endcan
                    @can('publication-list')
                        <li><a class="dropdown-item" href="{{route('publications.index')}}">View All</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            {{-- end publication --}}
            @canany(['publication-list','publication-create'])
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect" href="#" id="contact" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span>
                    Contact Us
                </span>
                    <i class="fa fa-plus"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="contact">
                    @can('publication-list')
                        <li><a class="dropdown-item" href="{{route('contact-us.index')}}">View All</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany
            {{-- end contact --}}
        </ul>
    </nav>
</nav>
