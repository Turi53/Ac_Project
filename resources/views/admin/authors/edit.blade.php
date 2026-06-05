<div>
    @include('admin.authors.partials._form', [
      'route' => route('admin.authors.update', $author),
      'method' => 'PUT'
   ])
</div>
