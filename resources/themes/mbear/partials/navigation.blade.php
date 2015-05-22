<div class="nav">
    <h3 class="nav-title">Menu</h3>
    <a href="#" class="nav-close">
        <span class="hidden">Close</span>
    </a>
    <ul>
        @foreach(setting('navigation') as $item)
        <li class="nav-{{$item->slug}}" role="presentation"><a href="{{$item->url}}">{{$item->label}}</a></li>
        @endforeach
    </ul>
    <a class="subscribe-button icon-feed" href="{{url('rss')}}">Subscribe</a>
</div>
<span class="nav-cover"></span>
