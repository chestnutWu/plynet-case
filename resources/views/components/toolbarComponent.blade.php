<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-th-list"> 後台資料表
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <a href="/news" class="list-group-item list-group-item-action">最新消息</a>
            <a href="/tickets" class="list-group-item list-group-item-action">特價清倉</a>
            <a href="#" class="list-group-item list-group-item-action">旅遊必備</a>
            <a href="#" class="list-group-item list-group-item-action">旅遊資訊</a>
            <a href="/travels" class="list-group-item list-group-item-action">出去走走</a>
            <a href="/orders" class="list-group-item list-group-item-action">訂單查詢</a>
        </ul>
    </li>
    <li><a href="#"><span class="glyphicon glyphicon-user"></span> {{Auth::user()->name}}</a></li>
    <li>                                    
        <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();document.getElementById('logout-form').submit();">登出</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </li>
</ul>