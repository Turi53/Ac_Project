<div>
    @include('admin.makes.partials._form', [
       'route' => route('admin.makes.store', $make),
       'method' => 'POST'
    ])
</div>
