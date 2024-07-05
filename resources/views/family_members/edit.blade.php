@extends('layouts.families.app')

@section('family_content')
    <h1>Edit Family Member</h1>
    <form action="{{ route('family_members.update', $family_member->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $family_member->name) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="birthdate">Birthdate:</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ old('birthdate', $family_member->birthdate) }}" required>
                @error('birthdate')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="marital_status">Marital Status:</label>
                <select class="form-control" id="marital_status" name="marital_status" required>
                    <option value="Unmarried" {{ old('marital_status', $family_member->marital_status) == 'Unmarried' ? 'selected' : '' }}>Unmarried</option>
                    <option value="Married" {{ old('marital_status', $family_member->marital_status) == 'Married' ? 'selected' : '' }}>Married</option>
                </select>
                @error('marital_status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6" id="wedding_date_group" style="display: {{ old('marital_status', $family_member->marital_status) == 'Married' ? 'block' : 'none' }};">
                <label for="wedding_date">Wedding Date:</label>
                <input type="date" class="form-control" id="wedding_date" name="wedding_date" value="{{ old('wedding_date', $family_member->wedding_date) }}">
                @error('wedding_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="education">Education:</label>
                <input type="text" class="form-control" id="education" name="education" value="{{ old('education', $family_member->education) }}">
                @error('education')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="photo">Photo:</label>
                <input type="file" class="form-control" id="photo" name="photo">
                @if ($family_member->photo)
                    <img src="{{ Storage::url($family_member->photo) }}" alt="Photo" width="50">
                @endif
                @error('photo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#marital_status').change(function() {
                if ($(this).val() === 'Married') {
                    $('#wedding_date_group').show();
                } else {
                    $('#wedding_date_group').hide();
                    $('#wedding_date').val('');
                }
            });
        });
    </script>
@endsection