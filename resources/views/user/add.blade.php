@extends('layouts.main')

@section('title-page', 'Добавление пользователя')

@section('content')
<div class="container">
  <div class="alert alert-primary position-fixed top-0 end-0 d-none" role="alert" id="alert-add-user"></div>
  <div class="d-flex flex-column w-50">
      <h1>Добавление пользователя</h1>
    <form id="form-user-create">
      <div class="mb-3">
          <label for="lastname" class="form-label">Фамилия</label>
          <input type="text" class="form-control" name="lastname" id="lastname">
        </div>
      <div class="mb-3">
          <label for="firstname" class="form-label">Имя</label>
          <input type="text" class="form-control" name="firstname" id="firstname">
      </div>
      <div class="mb-3">
        <label for="patronymic" class="form-label">Отчество</label>
        <input type="text" class="form-control" name="patronymic" id="patronymic">
      </div>
      <div class="mb-3">
        <label for="nickname" class="form-label">Никнейм</label>
        <input type="text" class="form-control" name="nickname" id="nickname">
      </div>
      <div class="mb-3">
          <label for="login-password" class="form-label">Пароль</label>
          <div class="d-flex">
              <input type="password" class="form-control" id="login-password" name="password">
              <button class="btn btn-primary ms-3 d-flex justify-content-center align-items-center" id="change-password-state-btn" type="button">
                  <img id="eye" src="{{ asset('icons/eye.svg') }}" alt="Открытый глаз">
                  <img class="d-none" id="slash-eye" src="{{ asset('icons/eye-slash.svg') }}" alt="Закрытый глаз">
              </button>
          </div>
      </div>
      <div class="mb-3">
          <select name='role' class="form-select">
              <option value="is-student" selected>Ученик</option>
              <option value="is-admin">Администратор</option>
              <option value="is-teacher">Учитель</option>
          </select>
      </div>
      <button type="submit" class="btn btn-outline-success">Создать</button>
    </form>
    </div>
</div>
@endsection

@section('scripts')
@vite(['resources/js/scripts/createUser'])

@endsection