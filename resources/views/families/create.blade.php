@extends('layouts.families.app')

@section('family_content')
    <h1>Create New Family</h1>
    <form id="familyForm" action="{{ route('families.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="invalid-feedback">Please enter a name.</div>
            </div>

            <div class="form-group col-md-6">
                <label for="surname">Surname:</label>
                <input type="text" class="form-control" id="surname" name="surname" value="{{ old('surname') }}" required>
                @error('surname')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="invalid-feedback">Please enter a surname.</div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="birthdate">Birthdate:</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" required>
                @error('birthdate')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="invalid-feedback">Please enter a valid birthdate.</div>
            </div>

            <div class="form-group col-md-6">
                <label for="mobile_no">Mobile No:</label>
                <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="{{ old('mobile_no') }}" required pattern="\d{1,14}">
                @error('mobile_no')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="invalid-feedback">Please enter a valid mobile number (up to 14 digits).</div>
            </div>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="invalid-feedback">Please enter an address.</div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="state">State:</label>
                <select class="form-control" id="state" name="state" required>
                    <option value="">Select State</option>
                    @foreach($states as $state)
                        <option value="{{ $state->id }}" {{ old('state') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                    @endforeach
                </select>
                @error('state')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="invalid-feedback">Please select a state.</div>
            </div>

            <div class="form-group col-md-6">
                <label for="city">City:</label>
                <select class="form-control" id="city" name="city" required>
                    <option value="">Select City</option>
                </select>
                @error('city')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="invalid-feedback">Please select a city.</div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="pincode">Pincode:</label>
                <input type="text" class="form-control" id="pincode" name="pincode" value="{{ old('pincode') }}" required pattern="\d{6}">
                @error('pincode')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="invalid-feedback">Please enter a valid pincode (6 digits).</div>
            </div>

            <div class="form-group col-md-6">
                <label for="marital_status">Marital Status:</label>
                <select class="form-control" id="marital_status" name="marital_status" required>
                    <option value="Unmarried" {{ old('marital_status') == 'Unmarried' ? 'selected' : '' }}>Unmarried</option>
                    <option value="Married" {{ old('marital_status') == 'Married' ? 'selected' : '' }}>Married</option>
                </select>
                @error('marital_status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="invalid-feedback">Please select a marital status.</div>
            </div>
        </div>

        <div class="form-group" id="wedding_date_group" style="display: {{ old('marital_status') == 'Married' ? 'block' : 'none' }};">
            <label for="wedding_date">Wedding Date:</label>
            <input type="date" class="form-control" id="wedding_date" name="wedding_date" value="{{ old('wedding_date') }}">
            @error('wedding_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="invalid-feedback">Please enter a valid wedding date.</div>
        </div>

        
        <div class="form-group">
            <label for="hobbies">Hobbies:</label>
            <input type="text" class="form-control" id="hobbies" name="hobbies[]" placeholder="Enter hobbies" value="{{ old('hobbies.0') }}">
            <button type="button" class="btn btn-sm btn-primary mt-2" onclick="addHobby()">Add Hobby</button>
        </div>
        <div id="hobbiesContainer"></div>

        <div class="form-group">
            <label for="photo">Photo:</label>
            <input type="file" class="form-control-file" id="photo" name="photo">
            @error('photo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('scripts')
    <script>
        function addHobby() {
            var input = '<input type="text" class="form-control mt-2" name="hobbies[]" placeholder="Enter hobbies">';
            $('#hobbiesContainer').append(input);
        }

        $(document).ready(function() {
            $('#marital_status').change(function() {
                if ($(this).val() === 'Married') {
                    $('#wedding_date_group').show();
                } else {
                    $('#wedding_date_group').hide();
                }
            });

            $('#state').change(function() {
                var stateId = $(this).val();
                if (stateId) {
                    $.ajax({
                        url: '/get-cities/' + stateId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#city').empty().append('<option value="">Select City</option>');
                            $.each(data, function(key, value) {
                                $('#city').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#city').empty().append('<option value="">Select City</option>');
                }
            });

            $('#familyForm').submit(function(event) {
                var form = this;
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            });
            
        });
    </script>
@endsection