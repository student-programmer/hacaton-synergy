@extends('layouts.auth')

@section('title-page', 'Вход')

@section('content')
<div class="d-flex flex-column w-50">
  <h1>Вход</h1>
<form id="form-login">
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
      <div class="input-group-prepend">
        <input type="radio" id="is-student" value="user" name="role" checked>
        <label for="is-student">Войти как ученик</label>
      </div>
      <div class="input-group-prepend">
        <input type="radio" id="is-teacher" value="teacher" name="role">
        <label for="is-teacher">Войти как учитель</label>
      </div>
      <div class="input-group-prepend">
        <input type="radio" id="is-admin" value="admin" name="role">
        <label for="is-admin">Войти как администратор</label>
      </div>
    </div>
  <button type="submit" class="btn btn-outline-success">Войти</button>
</form>
</div>
@endsection

@section('scripts')
@vite(['resources/js/scripts/login'])
@endsection