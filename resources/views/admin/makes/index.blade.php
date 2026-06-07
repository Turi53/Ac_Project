<div>
    <h1>All Makes</h1>
    @foreach($makes as $make)
        <div style="display:flex; background-color: antiquewhite; margin-bottom: 8px; align-items: center; gap: 4px; ">
            <h4>{{ $make->name }}</h4>
            <p>{{ $make->id }}</p>
            <form action="{{ route('admin.makes.destroy', $make) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Delete" style="background-color: red">
            </form>

            <form action="{{ route('admin.makes.edit', $make) }}" method="POST">
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
