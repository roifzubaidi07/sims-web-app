@extends('template.app')
 
@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-sm-2 rounded-full max-w-full h-auto overflow-hidden">
            <img src="{{ asset('assets/profil.jpg') }}" class="" alt="">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="name" class="form-label">Nama Kandidat</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus disabled value="M. Roif">
        </div>
        <div class="col">
            <label for="name" class="form-label">Posisi Kandidat</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus disabled value="Website Programmer">
        </div>
    </div>
</div>
@endsection