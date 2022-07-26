<div class="panel panel-default">
    @if(!empty($title))
        <div class="panel-heading">{{ $title }}</div>
    @endif

    <div class="panel-body">
        {{ $slot }}
    </div>

    @if(!empty($footer))
        <div class="panel-footer">{{ $footer }}</div>
    @endif
</div>
