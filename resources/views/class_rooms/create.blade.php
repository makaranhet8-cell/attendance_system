@extends('layouts.app')

@section('title', 'Add class room')

@section('content')
<div class="card p-4" style="max-width: 600px;">
    <h5 class="mb-3">Add class room</h5>
    <form action="{{ route('class_rooms.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Class name</label>
            <input type="text" name="class_name" value="{{ old('class_name') }}" class="form-control @error('class_name') is-invalid @enderror" required>
            @error('class_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('class_rooms.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
