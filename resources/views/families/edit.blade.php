@extends('layouts.families.app')

@section('family_content')
    <h1>Edit Family Head</h1>
    <form action="{{ route('families.update', $family->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $family->name) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="surname">Surname:</label>
                <input type="text" id="surname" name="surname" class="form-control" value="{{ old('surname', $family->surname) }}" required>
                @error('surname')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="birthdate">Birthdate:</label>
                <input type="date" id="birthdate" name="birthdate" class="form-control" value="{{ old('birthdate', $family->birthdate) }}" required>
                @error('birthdate')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="mobile_no">Mobile No:</label>
                <input type="text" id="mobile_no" name="mobile_no" class="form-control" value="{{ old('mobile_no', $family->mobile_no) }}" required>
                @error('mobile_no')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="address">Address:</label>
                <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address', $family->address) }}</textarea>
                {{-- <input type="text" id="address" name="address" class="form-control" value="{{ old('address', $family->address) }}" required> --}}
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="state">State:</label>
                <select id="state" name="state" class="form-control" required>
                    <option value="">Select State</option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}" {{ $family->state == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                    @endforeach
                </select>
                @error('state')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="city">City:</label>
                <select id="city" name="city" class="form-control" required>
                    <option value="">Select City</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}" {{ $family->city == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                    @endforeach
                </select>
                @error('city')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="pincode">Pincode:</label>
                <input type="text" id="pincode" name="pincode" class="form-control" value="{{ old('pincode', $family->pincode) }}" required>
                @error('pincode')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="marital_status">Marital Status:</label>
                <select id="marital_status" name="marital_status" class="form-control" required>
                    <option value="Unmarried" {{ old('marital_status', $family->marital_status) == 'Unmarried' ? 'selected' : '' }}>Unmarried</option>
                    <option value="Married" {{ old('marital_status', $family->marital_status) == 'Married' ? 'selected' : '' }}>Married</option>
                </select>
                @error('marital_status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row" id="wedding_date_div" style="display: {{ old('marital_status', $family->marital_status) == 'Married' ? 'block' : 'none' }}">
            <div class="form-group col-md-6">
                <label for="wedding_date">Wedding Date:</label>
                <input type="date" id="wedding_date" name="wedding_date" class="form-control" value="{{ old('wedding_date', $family->wedding_date) }}">
                @error('wedding_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="hobbies">Hobbies:</label>
                <input type="text" id="hobbies" name="hobbies[]" class="form-control" value="{{ old('hobbies', $hobbies ? implode(',', $hobbies) : '') }}">
                @error('hobbies')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="photo">Photo:</label>
                <input type="file" id="photo" name="photo" class="form-control-file">
                @if ($family->photo)
                    <img src="{{ Storage::url($family->photo) }}" alt="Photo" width="50">
                @endif
                @error('photo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Family Head</button>
    </form>
    <a href="{{ route('families.index') }}" class="btn btn-secondary mt-2">Back to Families List</a>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#state').change(function() {
                var stateId = $(this).val();
                $.ajax({
                    url: '{{ url('get-cities') }}/' + stateId,
                    type: 'GET',
                    success: function(data) {
                        $('#city').empty();
                        $('#city').append('<option value="">Select City</option>');
                        $.each(data, function(key, value) {
                            $('#city').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            });

            $('#marital_status').change(function() {
                if ($(this).val() == 'Married') {
                    $('#wedding_date_div').show();
                } else {
                    $('#wedding_date_div').hide();
                }
            });
        });
    </script>
@endsection