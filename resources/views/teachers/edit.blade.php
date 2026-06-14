@extends('layouts.app')

@section('title', 'Edit teacher')

@section('content')
<div class="card p-4" style="max-width: 600px;">
    <h5 class="mb-3">Edit teacher</h5>
    <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">User</label>
            <select name="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $teacher->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->username }})
                    </option>
                @endforeach
            </select>
            @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Teacher code</label>
            <input type="text" name="teacher_code" value="{{ old('teacher_code', $teacher->teacher_code) }}" class="form-control @error('teacher_code') is-invalid @enderror">
            @error('teacher_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $teacher->phone) }}" class="form-control @error('phone') is-invalid @enderror">
            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
