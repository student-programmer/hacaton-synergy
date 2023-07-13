<?php
use ReallySimpleJWT\Parse;
use ReallySimpleJWT\Decode;
use ReallySimpleJWT\Jwt;

$token = $_COOKIE['token'];
$jwt = new Jwt($token);
$parse = new Parse($jwt, new Decode());
$parsed = $parse->parse();

$token_data = $parsed->getPayload();

$default_nav = [
  'home' => ['route' => '/', 'name' => 'Главная'],
  'profile' => ['route' => '/user', 'name' => 'Профиль'],
];

$nav_for_teacher = array_merge(
    $default_nav,
    [
      'add' => ['route' => '/gradebook/create', 'name' => 'Добавить зачетную книжку']
    ]
  );

$nav_for_admin = array_merge(
  $default_nav,
  [
    'add' => ['route' => '/user/add', 'name' => 'Добавить пользователя']
  ]
);

$main_nav = $default_nav;

if ($token_data['is_admin']) {
  $main_nav = $nav_for_admin;
} else if ($token_data['is_teacher']) {
  $main_nav = $nav_for_teacher;
}
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Gradebook synergy</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav w-100">
          @foreach ($main_nav as $item)
            <li class="nav-item">
              <a class="nav-link" href="{{ $item['route'] }}">{{ $item['name'] }}</a>
            </li>
          @endforeach
          <li class="nav-item d-flex justify-center align-items-center" style="margin-left: auto">
            <button class="btn btn-primary btn-sm" id="signout-btn" type="button">Выйти</button>
          </li>
        </ul>
      </div>
    </div>
</nav>