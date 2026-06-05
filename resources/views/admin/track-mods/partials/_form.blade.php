<form action="{{ $route }}" method="POST">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif
    <input type="text"
           name="name"
           class=""
           value="{{ old('name', $trackMod->name) }}"
           placeholder="Enter Track name">

    <input type="text"
           name="distance"
           class=""
           value="{{ old('distance', $trackMod->distance) }}"
           placeholder="Enter Distance">

    <input type="text"
           name="number_of_pits"
           class=""
           value="{{ old('number_of_pits', $trackMod->number_of_pits) }}"
           placeholder="Enter No. of pits">

    <input type="text"
           name="country"
           class=""
           value="{{ old('country', $trackMod->country) }}"
           placeholder="country">

    <input type="text"
           name="city"
           class=""
           value="{{ old('city', $trackMod->city) }}"
           placeholder="Enter city">

    <textarea
        name="description"
        id=""
        cols="30"
        rows="10" class="">{{ old('description', $trackMod->mod->description ?? '') }}</textarea>

    <input
        type="text"
        name="download_link"
        class=""
        value="{{ old('download_link', $trackMod->mod->download_link ?? '') }}"
        placeholder="Enter Download Link">

    <select name="is_premium" id="" class="">
        <option value="1" @selected(old('is_premium', $trackMod->mod->is_premium ?? 0) == 1)>Yes</option>
        <option value="0" @selected(old('is_premium', $trackMod->mod->is_premium ?? 0) == 0)>No</option>
    </select>

    <select
        name="author_id"
        id=""
        class="">
        @foreach($authors as $author)
            <option
                value="{{ $author->id }}"
                @selected(old('author_id', $trackMod->mod->author_id ?? '') == $author->id)>
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
