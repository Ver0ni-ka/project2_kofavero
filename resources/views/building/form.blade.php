@extends('layout')
@section('content')
<h1>{{ $title }}</h1>

@if ($errors->any())
    <div class="alert alert-danger">Please fix the validation errors!</div>
@endif

<form 
    method="post" 
    action="{{ $building->exists ? '/buildings/patch/' . $building->id : '/buildings/put' }}"
    enctype="multipart/form-data">
 @csrf
 <div class="mb-3">
    <label for="building-name" class="form-label">Name</label>
    <input
        type="text"
        id="building-name"
        name="name"
        value="{{ old('name', $building->name) }}"
        class="form-control @error('name') is-invalid @enderror"
    >
    @error('name')
        <p class="invalid-feedback">{{ $errors->first('name') }}</p>
    @enderror
    </div>

    <div class="mb-3">
        <label for="building-architect" class="form-label">Architect</label>
        <select
            id="building-architect"
            name="architect_id"
            class="form-select @error('architect_id') is-invalid @enderror"
        >
    <option value="">Choose the architect!</option>
        @foreach($architects as $architect)
            <option
                value="{{ $architect->id }}"
                @if ($architect->id == old('architect_id', $building->architect_id ?? false)) selected @endif
            >{{ $architect->name }}</option>
        @endforeach
    </select>
    @error('architect_id')
    <p class="invalid-feedback">{{ $errors->first('architect_id') }}</p>
    @enderror
    </div>

    <div class="mb-3">
    <label for="building-description" class="form-label">Description</label>
    <textarea
    id="building-description"
    name="description"
    class="form-control @error('description') is-invalid @enderror"
    >{{ old('description', $building->description) }}</textarea>
    @error('description')
    <p class="invalid-feedback">{{ $errors->first('description') }}</p>
    @enderror
    </div>

    <div class="mb-3">
    <label for="building-year" class="form-label">Construction Year</label>
    <input
    type="number" max="{{ date('Y') + 1 }}" step="1"
    id="building-year"
    name="year"
    value="{{ old('year', $building->year) }}"
    class="form-control @error('year') is-invalid @enderror"
    >
    @error('year')
    <p class="invalid-feedback">{{ $errors->first('year') }}</p>
    @enderror
    </div>

    <div class="mb-3">
        <label for="building-image" class="form-label">Image</label>
    @if ($building->image)
    <img
        src="{{ asset('images/' . $building->image) }}"
        class="img-fluid img-thumbnail d-block mb-2"
        alt="{{ $building->name }}"
    >
    @endif
    <input
        type="file" accept="image/png, image/webp, image/jpeg"
        id="building-image"
        name="image"
        class="form-control @error('image') is-invalid @enderror"
    >
    @error('image')
    <p class="invalid-feedback">{{ $errors->first('image') }}</p>
    @enderror
    </div>

    <div class="mb-3">
    <div class="form-check">
    <input
        type="checkbox"
        id="building-display"
        name="display"
        value="1"
        class="form-check-input @error('display') is-invalid @enderror"
        @if (old('display', $building->display)) checked @endif
    >
    <label class="form-check-label" for="building-display">
        Builded
    </label>
    @error('display')
        <p class="invalid-feedback">{{ $errors->first('display') }}</p>
    @enderror
    </div>
    </div>

 <button type="submit" class="btn btn-primary">
  {{ $building->exists ? 'Update' : 'Create' }}
 </button>
</form>
@endsection