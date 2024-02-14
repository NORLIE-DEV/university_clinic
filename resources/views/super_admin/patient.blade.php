@extends('layout.superadmin_layout')

@section('content')
    <div class="mt-5">
        <h3>Patient Information:</h3>
        @foreach ($patients as $patient)
            <h1>{{ $patient->student->first_name }}</h1>
        @endforeach
    </div>
@endsection
