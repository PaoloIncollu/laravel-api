@extends('layouts.app')

@section('page-title', $technology->name)

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        {{ $technology->name }}
                    </h1>
                    <h6 class="text-center">
                        Creato il: {{ $technology->created_at->format('d/m/Y') }}
                        <br>
                        alle: {{ $technology->created_at->format('H:i') }}
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between mb-4">
        <div>
            <a href="{{ route('admin.technologies.edit', ['technology' => $technology->id]) }}" class="btn btn-warning">
                Modifica
            </a>
            <form action="{{ route('admin.technologies.destroy', ['technology' => $technology->id]) }}" method="post" class="d-inline-block"
                onsubmit="return confirm('Sei sicur* di voler eliminare questo technology?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Elimina
                </button>
            </form>
        </div>

        <div>

            <a href="{{ route('admin.technologies.index', ['technology' => $technology->id]) }}" class="btn btn-primary me-2">

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
                            ID: {{ $technology->id }}
                        </li>
                        <li>
                            Slug: {{ $technology->slug }}
                        </li>
                        <li>
                            Progetti collegati:

                            @if ($technology->projects()->count() > 0)
                                <ul>
                                    @foreach ($technology->projects as $project)
                                        <li>
                                            <a href="{{ route('admin.projects.show', ['project' => $project->id]) }}">
                                                {{ $project->name }}
                                            </a>
                                            <small>
                                                (associazione creata il {{ $project->pivot->created_at->format('d/m/Y') }})
                                            </small>
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
