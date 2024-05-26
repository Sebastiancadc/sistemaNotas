@extends('layout')

@section('title', 'Dashboard')

@section('content')
    <h1>Bienvenido {{ auth()->user()->name }}</h1>
    <p>Rol: {{ auth()->user()->getRoleNames()->first() }}</p>

    <h2>Mis Tareas</h2>
    <div class="row">
        @foreach (auth()->user()->tasks as $task)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $task->title }}</h5>
                        <p class="card-text">{{ $task->description }}</p>
                        @if ($task->status == '0')
                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-primary">Completar</button>
                            </form>
                        @else
                            <span class="badge text-bg-success" style="
                            background-color: green;">Completada</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
