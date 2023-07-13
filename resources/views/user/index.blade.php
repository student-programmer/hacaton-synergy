<?php
$user_role = "Студент";

switch ($user['role']) {
  case 'is-admin':
    $user_role = "Администратор";
    break;
  case 'is-teacher':
    $user_role = "Учитель";
    break;
}

$user_data = [
  ['title' => 'Фамилия', 'value' => $user['second_name']],
  ['title' => 'Имя', 'value' => $user['first_name']],
  ['title' => 'Отчество', 'value' => $user['patronymic']],
  ['title' => 'Никнейм', 'value' => $user['nickname']],
  ['title' => 'Роль', 'value' => $user_role],
];
?>

@extends('layouts.main')

@section('title-page', 'Пользователь')

@section('content')
<div class="container w-50">
  <h1>{{ $user['first_name'].' '.$user['second_name'] }}</h1>
  <ul class="list-group">
    @foreach ($user_data as $data)
    <li class="list-group-item d-flex align-items-center justify-content-between">
      <h6 class="mb-0">{{ $data['title'] }}</h6>
      {{ $data['value'] }}
    </li>
    @endforeach
  </ul>
</div>
@endsection