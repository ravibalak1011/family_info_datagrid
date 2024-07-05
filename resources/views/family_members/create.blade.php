@extends('layouts.family_members.app')

@section('family_member_content')
    <h1>Add Family Member</h1>
    <form id="familyMemberForm" action="{{ route('family_members.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf
        <input type="hidden" name="family_id" value="{{ $family->id }}">

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="invalid-feedback">Please enter a name.</div>
            </div>

            <div class="form-group col-md-6">
                <label for="birthdate">Birthdate:</label>
                <input type="date" id="birthdate" name="birthdate" class="form-control" value="{{ old('birthdate') }}" required>
                @error('birthdate')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="invalid-feedback">Please enter a valid birthdate.</div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="marital_status">Marital Status:</label>
                <select id="marital_status" name="marital_status" class="form-control" required>
                    <option value="Unmarried" {{ old('marital_status') == 'Unmarried' ? 'selected' : '' }}>Unmarried</option>
                    <option value="Married" {{ old('marital_status') == 'Married' ? 'selected' : '' }}>Married</option>
                </select>
                @error('marital_status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="invalid-feedback">Please select a marital status.</div>
            </div>

            <div class="form-group col-md-6" id="wedding_date_div" style="display: {{ old('marital_status') == 'Married' ? 'block' : 'none' }}">
                <label for="wedding_date">Wedding Date:</label>
                <input type="date" id="wedding_date" name="wedding_date" class="form-control" value="{{ old('wedding_date') }}">
                @error('wedding_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="invalid-feedback">Please enter a valid wedding date.</div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="education">Education:</label>
                <input type="text" id="education" name="education" class="form-control" value="{{ old('education') }}">
                @error('education')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="invalid-feedback">Please enter a valid education level.</div>
            </div>

            <div class="form-group col-md-6">
                <label for="photo">Photo:</label>
                <input type="file" id="photo" name="photo" class="form-control-file">
                @error('photo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="invalid-feedback">Please upload a valid photo (max size: 2MB).</div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Add Member</button>
    </form>

    <script>
        document.getElementById('marital_status').addEventListener('change', function() {
            var weddingDateDiv = document.getElementById('wedding_date_div');
            weddingDateDiv.style.display = this.value === 'Married' ? 'block' : 'none';
        });

        document.getElementById('familyMemberForm').addEventListener('submit', function(event) {
            var form = this;
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    </script>
@endsection