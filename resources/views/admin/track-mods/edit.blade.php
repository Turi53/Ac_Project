<div>
    @include('admin.track-mods.partials._form', [
        'route' => route('admin.track-mods.update', $trackMod),
        'method' => 'PUT'
    ])
</div>
