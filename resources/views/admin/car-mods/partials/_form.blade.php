<form action="{{ $route }}" method="POST">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif
    <input type="text"
           name="model"
           class=""
           value="{{ old('model', $carMod->model) }}"
           placeholder="Enter Car Model">

    <input type="text"
           name="year_of_manufacture"
           class=""
           value="{{ old('year_of_manufacture', $carMod->year_of_manufacture) }}"
           placeholder="Enter Year Of Manufacture">

    <input type="text"
           name="power"
           class=""
           value="{{ old('power', $carMod->power) }}"
           placeholder="Enter BHP">

    <input type="text"
           name="torque"
           class=""
           value="{{ old('torque', $carMod->torque) }}"
           placeholder="Enter Torque">

    <input type="text"
           name="zero_to_100"
           class=""
           value="{{ old('zero_to_100', $carMod->zero_to_100) }}"
           placeholder="Enter 0-100km/ph">

    <input type="text"
           name="weight"
           class=""
           value="{{ old('weight', $carMod->weight) }}"
           placeholder="Enter weight">

    <input type="text"
           name="top_speed"
           class=""
           value="{{ old('top_speed', $carMod->top_speed) }}"
           placeholder="Enter Top Speed">

    <select
        name="make_id"
        id=""
        class="">
        @foreach($makes as $make)
            <option
                value="{{ $make->id }}"
                @selected(old('make_id', $carMod->make_id) == $make->id)>
                {{ $make->name }}
            </option>
        @endforeach
    </select>

    <textarea
        name="description"
        id=""
        cols="30"
        rows="10" class="">{{ old('description', $carMod->mod->description ?? '') }}</textarea>

    <input
        type="text"
        name="download_link"
        class=""
        value="{{ old('download_link', $carMod->mod->download_link ?? '') }}"
        placeholder="Enter Download Link">

    <select name="is_premium" id="" class="">
        <option value="1" @selected(old('is_premium', $carMod->mod->is_premium ?? 0) == 1)>Yes</option>
        <option value="0" @selected(old('is_premium', $carMod->mod->is_premium ?? 0) == 0)>No</option>
    </select>

    <select
        name="author_id"
        id=""
        class="">
        @foreach($authors as $author)
            <option
                value="{{ $author->id }}"
                @selected(old('author_id', $carMod->mod->author_id ?? '') == $author->id)>
                {{ $author->name }}
            </option>
        @endforeach
    </select>

    <input type="submit">
</form>

<div class="">
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</div>
