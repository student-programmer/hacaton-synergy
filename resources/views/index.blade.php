@extends('layouts.main')

@section('title-page', 'Главная')

@section('content')
    <h1>Главная</h1>
    <x-table data="{{ [] }}" headings="{{ ['#', 'ФИО', 'Курс', 'Факультет'] }}" />
@endsection