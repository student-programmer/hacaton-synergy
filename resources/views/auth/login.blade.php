@extends('layouts.auth')

@section('title-page', 'Вход')

@section('content')
<div class="d-flex flex-column w-50">
    <h1>Вход</h1>
<form>
    <div class="mb-3">
      <label for="nickname" class="form-label">Никнейм</label>
      <input type="text" class="form-control" id="nickname">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <div class="d-flex">
            <input type="password" class="form-control" id="password">
            <button class="btn btn-primary ms-3 d-flex justify-content-center align-items-center" type="button">
                <img src="{{ asset('icons/eye.svg') }}" alt="Открытый глаз">
            </button>
        </div>
      </div>
      <div class="mb-3">
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="checkbox-is-admin">
          <label class="form-check-label" for="checkbox-is-admin">Войти как администратор</label>
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="checkbox-is-teacher">
          <label class="form-check-label" for="checkbox-is-teacher">Войти как учитель</label>
        </div>
      </div>
    <button type="submit" class="btn btn-outline-success">Войти</button>
  </form>
</div>
@endsection