<div>
    <h1>All Authors</h1>
    @foreach($authors as $author)
        <div style="display:flex; background-color: antiquewhite; margin-bottom: 8px; align-items: center; gap: 4px; ">
            <h4>{{ $author->name }}</h4>
            <p>{{ $author->id }}</p>
            <form action="{{ route('admin.authors.destroy', $author) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Delete" style="background-color: red">
            </form>

            <form action="{{ route('admin.authors.edit', $author) }}" method="POST">
                @csrf
                @method('GET')
                <input type="submit" value="Edit" style="background-color: darkslategrey; color: white;">
            </form>
        </div>
    @endforeach

    @if (session('success'))
        <div style="background-color: palevioletred; color: white;">
            {{ session('success') }}
        </div>
    @endif
</div>
