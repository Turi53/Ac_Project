<div>
    <h2>Published Car Mods</h2>
    @foreach($publishedCarMods as $carMod)
        <div style="display:flex; background-color: antiquewhite; margin-bottom: 8px; align-items: center; gap: 4px; ">
            <h4>{{ $carMod->make->name }}</h4>
            <p>{{ $carMod->model }}</p>
            <form action="{{ route('admin.car-mods.destroy', $carMod) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Delete" style="background-color: red">
            </form>

            <a href="{{ route('admin.car-mods.edit', $carMod) }}"
               style="background-color: darkslategrey; color: white; padding: 4px;">
                Edit
            </a>

            <form action="{{ route('admin.mods.unpublish', $trackMod->mod) }}" method="POST">
                @csrf
                <input type="submit" value="Unpublish" style="background-color: orange; color: white;">
            </form>
        </div>
    @endforeach

    @if (session('success'))
        <div style="background-color: palevioletred; color: white;">
            {{ session('success') }}
        </div>
    @endif
</div>
