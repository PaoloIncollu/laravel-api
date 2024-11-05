@extends('layouts.app')

@section('page-title', $type->name)

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        {{ $type->name }}
                    </h1>
                    <h6 class="text-center">
                        Creata il: {{ $type->created_at->format('d/m/Y') }}
                        <br>
                        alle: {{ $type->created_at->format('H:i') }}
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between mb-4">
        <div>
            <a href="{{ route('admin.types.edit', ['type' => $type->id]) }}" class="btn btn-warning">
                Modifica
            </a>
            <form action="{{ route('admin.types.destroy', ['type' => $type->id]) }}" method="post" class="d-inline-block"
                onsubmit="return confirm('Sei sicur* di voler eliminare questa categoria?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Elimina
                </button>
            </form>
        </div>

        <div>

            <a href="{{ route('admin.types.index', ['type' => $type->id]) }}" class="btn btn-primary me-2">

                Indietro

            </a>


        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <ul>
                        <li>
                            ID: {{ $type->id }}
                        </li>
                        <li>
                            Slug: {{ $type->slug }}
                        </li>
                        <li>
                            Post collegati:

                             @if ($type->projects()->count() > 0)
                                <ul>
                                    @foreach ($type->projects as $project)
                                        <li>
                                            <a href="{{ route('admin.projects.show', ['project' => $project->id]) }}">
                                                {{ $project->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                nessun progetto collegato
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
