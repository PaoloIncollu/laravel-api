@extends('layouts.app')

@section('page-title', 'Nuova tecnologia')

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Aggiungi nuova tecnologia
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end mb-4">

        <a href="{{ route('admin.technologies.index')}}" class="btn btn-primary me-2">

            Indietro

        </a>

    </div>

    @if ($errors->any())

        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>

    @endif

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.technologies.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Titolo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required minlength="3" maxlength="255" value="{{ old('name') }}" placeholder="Inserisci il nome...">
                        </div>

                        <div>
                            <button type="submit" class="btn btn-success w-100">
                                + Aggiungi
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
