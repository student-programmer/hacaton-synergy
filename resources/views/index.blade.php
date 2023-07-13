@extends('layouts.main')

@section('title-page', 'Главная')

@section('content')
<div class="container text-center">
  <h1>Список зачетных книжек</h1>
      @if(!count($gradebooks ?? []))
      <div class='row'><p class='text-body-secondary'>В таблице нет зачётных книжек</p></div>
      @else
            <table class="table">
                <thead>
                  <tr>
                    <th>Номер книжки</th>
                    <th>ФИО</th>
                    <th>Факультет</th>
                    <th>Специальность</th>
                    <th>Дата выдачи</th>
                    <th>Номер курса</th>
                    <th>Управление</th>
                  </tr>
                </thead>

                <tbody>

                  @foreach ($gradebooks as $gradebook)
                  <tr>
                    <th>{{ $gradebook['num'] }}</th>
                    <th>{{ $gradebook['second_name'].' '.$gradebook['first_name'].' '.$gradebook['patronymic'] }}</th>
                    <th>{{ $gradebook['faculty'] }}</th>
                    <th>{{ $gradebook['specialization'] }}</th>
                    <th>{{ $gradebook['date_of_issue'] }}</th>
                    <th>{{ $gradebook['num_course'] }}</th>
                    <th><a href="gradebook/edit/{{$gradebook['id']}}" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Изменить</a> <button type="button" class="btn btn-danger ml-10" data-gradebook-id="{{ $gradebook['id']}} ">Удалить</button></th>
                  </tr>
                  @endforeach
                </tbody>
              </table>
      @endif
</div>
@endsection