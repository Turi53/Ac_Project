<div>
    <div>
        @include('admin.makes.partials._form', [
           'route' => route('admin.makes.update', $make),
           'method' => 'PUT'
        ])
    </div>
</div>
