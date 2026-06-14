@extends('layouts.app')

@section('title', 'Add subject')

@section('content')
<div class="card p-4" style="max-width: 600px;">
    <h5 class="mb-3">Add subject</h5>
    <form action="{{ route('subjects.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Subject name</label>
            <input type="text" name="subject_name" value="{{ old('subject_name') }}" class="form-control @error('subject_name') is-invalid @enderror" required>
            @error('subject_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
