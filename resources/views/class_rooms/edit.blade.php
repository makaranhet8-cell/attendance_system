@extends('layouts.app')

@section('title', 'Edit class room')

@section('content')
<div class="card p-4" style="max-width: 600px;">
    <h5 class="mb-3">Edit class room</h5>
    <form action="{{ route('class_rooms.update', $classRoom->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Class name</label>
            <input type="text" name="class_name" value="{{ old('class_name', $classRoom->class_name) }}" class="form-control @error('class_name') is-invalid @enderror" required>
            @error('class_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $classRoom->description) }}</textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('class_rooms.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
