@extends('layout.patient_layout')

@section('content')
    <form action="/student_logout" method="POST">
        @csrf
        <input type="submit">
    </form>
@endsection
