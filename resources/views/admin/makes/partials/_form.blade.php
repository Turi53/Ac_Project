<form action="{{ $route }}" method="POST">
    @csrf

    @if($method !== 'POST')
        @method($method)
    @endif

    <input type="text"
           name="name"
           class=""
           value="{{ old('name', $make->name) }}"
           placeholder="Enter Name">

    <input type="submit">
</form>

<div class="">
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</div>
