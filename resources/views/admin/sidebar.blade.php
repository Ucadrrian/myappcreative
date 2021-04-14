<div class="sidebar shadow">
    <div class="section-top">
        <div class="logo">
            <img src="{{ url('/static/images/logo.png') }}" class="img-fluid">
        </div>
        <div class="user">
            <span class="subtitle"> Hola</span>
            <div class="name">
                {{ Auth::user()->name}} {{Auth::user()->lastname}}
                <a href="{{url('/logout')}}" data-toggle="tooltip" data-placement="top" title="Salir"><i class="fas fa-sign-out-alt"></i></a>
            </div>
            <div class="email">{{Auth::user()->email}}</div>
        </div>
    </div>
    
    <div class="main">
        <ul>
            @if(kvfj(Auth::user()->permissions,'dashboard'))
            <li>
                <a href="{{url('/admin')}}" class="lk-dashboard"><i class="fas fa-home"></i>Dashboard</a>
            </li>
            @endif

            @if(kvfj(Auth::user()->permissions,'comics'))
            <li>
                <a href="{{url('/admin/comics/1')}}" class="lk-comics lk-comic_add lk-comic_edit
                lk-comic_gallery_add"><i class="fas fa-book-dead"></i>Comics</a>
            </li>
            @endif

            @if(kvfj(Auth::user()->permissions,'user_list'))
            <li>
                <a href="{{url('/admin/users/all')}}" class="lk-users_list lk-users_edit"><i class="fas fa-users"></i>Usuarios</a>
            </li>
            @endif

            @if(kvfj(Auth::user()->permissions,'categories'))
            <li>
                <a href="{{url('/admin/categories/0')}}" class="lk-categories lk-category_add
                lk-category_edit lk-category_delete">
                    <i class="fas fa-folder-open"></i>Categorias</a>
            </li>
            @endif
            
        </ul>
    </div>

</div>