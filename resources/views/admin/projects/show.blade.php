@extends('layouts.app')

@section('page-title', $project->name)

@section('main-content')
<h1>
    {{ $project->name }}
</h1>
<div class="d-flex justify-content-between mb-4">

    <div class="d-flex">


        <a href="{{ route('admin.projects.edit', ['project' => $project->id]) }}" class="btn btn-warning me-2">

            Modifica

        </a>
        <form onsubmit=" return confirm('Sei sicuro di voler cancellare questo progetto?')" action="{{ route('admin.projects.destroy', ['project' => $project->id]) }}" method="POST">

            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">

                Elimina

            </button>
        </form>

    </div>

    <div>

        <a href="{{ route('admin.projects.index', ['project' => $project->id]) }}" class="btn btn-primary me-2">

            Indietro

        </a>

    </div>


</div>

<div class="card">
    <div class="card-body">
        <ul>
            <li class="list-group-item">
                Slug: {{ $project->slug }}
            </li>

            <li class="list-group-item">
                Pubblicato: {{ $project->published ? 'SI' : 'NO' }}
            </li>
            <li class="list-group-item">

                Tipo:
                @if (isset($project->type))

                    <a href="{{ route('admin.types.show', ['type' => $project->type_id]) }}">

                        {{ $project->type->name }}

                    </a>
                @else
                    -
                @endif

            </li>

            <li class="list-group-item">
                Tecnologie collegate:

                @if ($project->technologies()->count() > 0)
                    <ul>
                        @foreach ($project->technologies as $technology)
                            <li class="list-group-item">
                                <a href="{{ route('admin.technologies.show', ['technology' => $technology->id]) }}" class="badge rounded-pill text-bg-primary">
                                    {{ $technology->name }}
                                </a>
                                <small>
                                    (associazione creata il {{ $technology->pivot->created_at->format('d/m/Y') }})
                                </small>
                            </li>
                        @endforeach
                    </ul>
                @else
                    -
                @endif
            </li>

            <li class="list-group-item">
                Data di creazione: {{ $project->creation_date }}
            </li>


            <p>
                <h3>

                    Contenuto:

                </h3>

                {{ $project->content }}
            </p>

            <p>

                <h3>

                Descrizione:

                </h3>

            {{ $project->description }}
            </p>


            <li class="list-group-item">

                <h3>
                    Immagine di copertina
                </h3>

                @if ($project->cover)

                    <img src="{{ asset('storage/'.$project->cover) }}" alt="{{ $project->name }}" class="card-img img-cover">

                @endif

            </li>
        </ul>


    </div>


</div>
@endsection
