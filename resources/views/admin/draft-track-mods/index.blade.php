<div>
    <div>
        <h2>Draft Track Mods</h2>
        @foreach($draftTrackMods as $trackMod)
            <div style="display:flex; background-color: antiquewhite; margin-bottom: 8px; align-items: center; gap: 4px; ">
                <h4>{{ $trackMod->name }}</h4>
                <p>{{ $trackMod->mod->description }}</p>
                <form action="{{ route('admin.track-mods.destroy', $trackMod) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" style="background-color: red">
                </form>

                <form action="{{ route('admin.track-mods.edit', $trackMod) }}" method="POST">
                    @csrf
                    @method('GET')
                    <input type="submit" value="Edit" style="background-color: darkslategrey; color: white;">
                </form>

                <a href="{{ route('admin.track-mods.edit', $trackMod) }}"
                   style="background-color: darkslategrey; color: white; padding: 4px;">
                    Edit
                </a>

                <form action="{{ route('admin.mods.publish', $trackMod->mod) }}" method="POST">
                    @csrf
                    <input type="submit" value="Publish" style="background-color: limegreen; color: white;">
                </form>
            </div>
        @endforeach

        @if (session('success'))
            <div style="background-color: palevioletred; color: white;">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>
