@extends('layouts.families.app')

@section('family_content')
    <h1>Families List</h1>
    <div class="mb-3">
        <a href="{{ route('families.create') }}" class="btn btn-primary">Create Family Head</a>
    </div>

    <table id="familiesTable" class="display">
        <thead>
            <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Mobile No</th>
                <th>Address</th>
                <th>Marital Status</th>
                <th>Members Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($families as $family)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $family->name }} {{ $family->surname }}</td>
                    <td>{{ $family->mobile_no }}</td>
                    <td>{{ $family->address }}</td>
                    <td>{{ $family->marital_status }}</td>
                    <td><a href="{{ route('families.show', $family->id) }}">{{ $family->members_count }} members</a></td>
                    <td>
                        
                        
                        <form action="{{ route('families.destroy', $family->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this family?');">Delete</button>
                        </form>
                    </td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#familiesTable').DataTable();
        });
    </script>
@endsection