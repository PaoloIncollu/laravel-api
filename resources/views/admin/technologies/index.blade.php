@extends('layouts.app')

@section('page-title', 'Tutte le tecnologie')

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Tutte le tecnologie
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <a href="{{ route('admin.technologies.create') }}" class="btn btn-success w-100">
                + Aggiungi
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col" class="text-center"># progetti collegati</th>
                                <th scope="col" class="text-center">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($technologies as $technology)
                                <tr>
                                    <th scope="row">{{ $technology->id }}</th>
                                    <td>{{ $technology->name }}</td>
                                    <td class="text-center">

                                        <div>
                                            {{ count($technology->projects) }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.technologies.show', ['technology' => $technology->id]) }}" class="btn btn-primary btn-sm">
                                            Vedi
                                        </a>
                                        <a href="{{ route('admin.technologies.edit', ['technology' => $technology->id]) }}" class="btn btn-warning btn-sm">
                                            Modifica
                                        </a>
                                        <form action="{{ route('admin.technologies.destroy', ['technology' => $technology->id]) }}" method="post" class="d-inline-block"
                                            onsubmit="return confirm('Sei sicur* di voler eliminare questa tecnologia?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Elimina
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
