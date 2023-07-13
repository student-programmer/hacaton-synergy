@extends('layouts.main')

@section('title-page', 'Изменение зачетной книжки')

@section('content')
<div class="container">
  <div class="alert alert-primary position-fixed top-0 end-0 d-none" role="alert" id="alert-add-gradebook"></div>
  <div class="d-flex flex-column w-50">
      <h1>Изменение зачетной книжки</h1>
    <form id="form-gradebook-create">
      <div class="mb-3">
          <label for="nickname" class="form-label">Никнейм</label>
          <input type="text" class="form-control" name="nickname" id="nickname" value="{{ $gradebook['second_name'].' '.$gradebook['first_name'].' '.$gradebook['patronymic'] }}">
      </div>
      <div class="mb-3">
          <label for="num" class="form-label">Номер</label>
          <input type="text" class="form-control" name="num" id="num" value="{{ $gradebook['num'] }}">
      </div>
      <div class="mb-3">
          <label for="faculty" class="form-label">Факультет</label>
          <input type="text" class="form-control" name="faculty" id="faculty" value="{{ $gradebook['faculty'] }}">
      </div>
      <div class="mb-3">
        <label for="specialization" class="form-label">Специальность</label>
        <input type="text" class="form-control" name="specialization" id="specialization" value="{{ $gradebook['specialization'] }}">
      </div>
      <div class="mb-3">
        <label for="date_of_issue" class="form-label">Дата выдачи</label>
        <input type="date" class="form-control" name="date_of_issue" id="date_of_issue" value="{{ $gradebook['date_of_issue'] }}">
      </div>
      <div class="mb-3">
        <label for="num_course" class="form-label">Номер курса</label>
        <input type="text" class="form-control" name="num_course" id="num_course" value="{{ $gradebook['num_course'] }}">
      </div>
      <button type="submit" class="btn btn-outline-success">Внести изменения</button>
    </form>
    </div>
</div>
@endsection
<!-- 
@section('scripts')
@vite(['resources/js/scripts/createGradebook'])
@endsection -->