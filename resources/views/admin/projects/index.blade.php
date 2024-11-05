@extends('layouts.app')

@section('page-title', 'Tutti i Proggetti')

@section('main-content')


<h1>
    Tutti i Proggetti
</h1>

<div class="mb-4">
    <a href="{{ route('admin.projects.create') }}" class="btn btn-success w-100">
        + Aggiungi
    </a>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" class="text-center">Nome</th>
            <th scope="col" class="text-center">Data di creazione</th>
            <th scope="col" class="text-center">Tipo</th>
            <th scope="col" class="text-center">Tecnologie</th>
            <th scope="col" class="text-center">Pubblicato</th>
            <th scope="col" class="text-center">Azioni</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($projects as $project)
            <tr>
                <th class="text-center" scope="row">{{ $project->id }}</th>
                <td class="text-center">{{ $project->name }}</td>
                <td class="text-center">{{ $project->creation_date }}</td>
                <td class="text-center">
                    @if (isset($project->type))
                        <a href="{{ route('admin.types.show', ['type' => $project->type_id]) }}">
                            {{ $project->type->name }}
                        </a>
                    @else
                        -
                    @endif
                </td>
                <td class="text-center">
                    @forelse($project->technologies as $technology)
                        <a href="{{ route('admin.technologies.show', ['technology' => $technology->id]) }}" class="badge rounded-pill text-bg-primary">
                            {{ $technology->name }}
                        </a>
                    @empty
                        -
                    @endforelse
                </td>
                
                <td class="text-center">{{ $project->published ? 'SI' : 'NO' }} </td>
                <td class="d-flex justify-content-around text-center">

                    <a href="{{ route('admin.projects.show', ['project' => $project->id]) }}" class="btn btn-primary">

                        Mostra

                    </a>

                    <a href="{{ route('admin.projects.edit', ['project' => $project->id]) }}" class="btn btn-warning">

                        Modifica

                    </a>

                    <form onsubmit=" return confirm('Sei sicuro di voler cancellare questo project?')" action="{{ route('admin.projects.destroy', ['project' => $project->id]) }}" method="POST">

                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">

                            Elimina

                        </button>

                    </form>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
