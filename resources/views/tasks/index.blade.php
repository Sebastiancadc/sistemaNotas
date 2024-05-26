@extends('layout')

@section('title', 'Tareas')

@section('content')
    <h1>Lista de Tareas</h1>
    <!-- Mensaje de éxito -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Botón para abrir el modal de creación -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearModal">
        Nueva Tarea +
    </button>

    <!-- Modal de Creación -->
    <div class="modal fade" id="crearModal" tabindex="-1" role="dialog" aria-labelledby="crearModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearModalLabel">Crear Nueva Tarea</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Título</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Estado</label>
                            <select name="status" class="form-control" required>
                                <option value="0">Pendiente</option>
                                <option value="1">Completada</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="due_date">Fecha de Vencimiento</label>
                            <input type="date" name="due_date" class="form-control" required>
                        </div>
                        @if (auth()->user()->hasRole('admin'))
                            <div class="form-group">
                                <label for="user_id">Usuario</label>
                                <select name="user_id" class="form-control" required>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear Tarea</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Fecha de Vencimiento</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        @if ($task->status == 0)
                            Pendiente
                        @elseif ($task->status == 1)
                            Completada
                        @endif
                    </td>
                    <td>{{ $task->formatted_due_date }}</td>
                    <td>{{ $task->user->name }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#editModal{{ $task->id }}" data-id="{{ $task->id }}">
                            Editar
                        </button>
                        <button type="button" class="btn btn-danger" data-toggle="modal"
                            data-target="#deleteModal{{ $task->id }}">
                            Eliminar
                        </button>
                    </td>
                </tr>
                <div class="modal fade" id="editModal{{ $task->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="editModalLabel{{ $task->id }}">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $task->id }}">Editar Tarea</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="title">Título</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ $task->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Descripción</label>
                                        <textarea name="description" class="form-control" rows="3">{{ $task->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Estado</label>
                                        <select class="form-control" name="status">
                                            <option value="0" {{ $task->status == 'Pendiente' ? 'selected' : '' }}>
                                                Pendiente</option>
                                            <option value="1" {{ $task->status == 'Completada' ? 'selected' : '' }}>
                                                Completada
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="due_date">Fecha de vencimiento</label>
                                        <input type="date" name="due_date" class="form-control"
                                            value="{{ $task->formatted_due_date }}">
                                    </div>
                                    @if (auth()->user()->hasRole('admin'))
                                        <div class="form-group">
                                            <label for="user_id">Usuario</label>
                                            <select name="user_id" class="form-control" required>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ $task->user_id == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @else
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar
                                    </button>
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- Modal de Eliminación -->
                <div class="modal fade" id="deleteModal{{ $task->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="deleteModalLabel{{ $task->id }}">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $task->id }}">Elimar Tarea</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body">
                                    ¿Estás seguro de eliminar la tarea {{ $task->name }}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
@endsection
