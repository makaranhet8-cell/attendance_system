@extends('layouts.app')

@section('title', 'Edit student')

@section('content')
<div class="card p-4" style="max-width: 600px;">
    <h5 class="mb-3">Edit student</h5>
    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">User</label>
            <select name="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $student->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->username }})
                    </option>
                @endforeach
            </select>
            @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Class room</label>
            <select name="class_id" class="form-select @error('class_id') is-invalid @enderror" required>
                @foreach ($classRooms as $classRoom)
                    <option value="{{ $classRoom->id }}" {{ old('class_id', $student->class_id) == $classRoom->id ? 'selected' : '' }}>
                        {{ $classRoom->class_name }}
                    </option>
                @endforeach
            </select>
            @error('class_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Student code</label>
            <input type="text" name="student_code" value="{{ old('student_code', $student->student_code) }}" class="form-control @error('student_code') is-invalid @enderror">
            @error('student_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $student->phone) }}" class="form-control @error('phone') is-invalid @enderror">
            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
