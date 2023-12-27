@extends('layouts.master')

@section('content')
    @include('pdf.header', ['EntrepriseData' => $EntrepriseData])
    @include('pdf.table', ['DevisData' => $DevisData, 'EntrepriseData' => $EntrepriseData, 'ClientData' => $ClientData])
@endsection

@section('footer')
    @include('pdf.footer', ['EntrepriseData' => $EntrepriseData])
@endsection
