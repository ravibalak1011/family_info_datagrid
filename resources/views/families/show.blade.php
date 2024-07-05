@extends('layouts.families.app')

@section('family_content')
    <h1>{{ $family->name }} Family Details</h1>
        @if(session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif
    <div class="mb-3">
        <a href="{{ route('family_members.create', ['family' => $family->id]) }}" class="btn btn-primary">Add Family Member</a>
    </div>
    <table id="familyMembersTable" class="display">
        <thead>
            <tr>
                <th>Sr.No.</th>
                <th>Name</th>
                <th>Birthdate</th>
                <th>Marital Status</th>
                <th>Wedding Date</th>
                <th>Education</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach ($family->members as $member)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->birthdate }}</td>
                    <td>{{ $member->marital_status }}</td>
                    <td>{{ $member->wedding_date }}</td>
                    <td>{{ $member->education }}</td>
                    <td>
                        @if ($member->photo)
                            <img src="{{ Storage::url($member->photo) }}" alt="Photo" width="50">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('family_members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this family member?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @php $i++; @endphp
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('families.index') }}">Back to Families List</a>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $('#familyMembersTable').DataTable();
        });
    </script>
@endsection