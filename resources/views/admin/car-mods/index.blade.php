<div>
   <h2 class="">Logged in</h2>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <input type="submit" value="logout">
    </form>

    <h2>All Car Mods</h2>
    @foreach($carMods as $carMod)
        <div style="display:flex; background-color: antiquewhite; margin-bottom: 8px; align-items: center; gap: 4px; ">
            <h4>{{ $carMod->make->name }}</h4>
            <p>{{ $carMod->model }}</p>
        </div>
    @endforeach
</div>
