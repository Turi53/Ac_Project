<div>
    @include('admin.authors.partials._form', [
        'route' => route('admin.authors.store', $author),
        'method' => 'POST'
     ])
</div>
