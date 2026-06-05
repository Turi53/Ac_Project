<div>
    @include('admin.car-mods.partials._form', [
        'route' => route('admin.car-mods.update', $carMod),
        'method' => 'PUT'
     ])
</div>

