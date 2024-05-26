<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Mostrar una lista de tareas
    public function index()
    {
        try {
            if (auth()->user()->hasRole('admin')) {
                // Si es administrador, obtén todas las tareas
                $tasks = Tasks::all();
            } else {
                // Obtén el usuario autenticado
                $user = auth()->user();
                // Obtén las tareas del usuario autenticado
                $tasks = $user->tasks()->get();
                // Formatea la fecha de vencimiento de las tareas
                foreach ($tasks as $task) {
                    $task->formatted_due_date = Carbon::parse($task->due_date)->format('Y-m-d');
                }
            }

            $users = User::all();
            // Retorna las tareas a la vista
            return view('tasks.index', compact('tasks', 'users'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hubo un error al listar las tarea: ' . $e->getMessage());
        }
    }



    // Almacenar una nueva tarea en la base de datos
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'status' => 'required',
                'due_date' => 'required'
            ]);

            Tasks::create($request->all());

            return redirect()->route('tasks.index')
                ->with('success', 'Tarea creada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hubo un error al crear la tarea: ' . $e->getMessage());
        }
    }

    // Actualizar una tarea específica en la base de datos
    public function update(Request $request, Tasks $task)
    {
        try {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'status' => 'required',
                'due_date' => 'required'
            ]);

            $task->update($request->all());

            return redirect()->route('tasks.index')
                ->with('success', 'Tarea actualizada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hubo un error al editar la tarea: ' . $e->getMessage());
        }
    }

    // Eliminar una tarea específica de la base de datos
    public function destroy(Tasks $task)
    {
        try {
            $task->delete();

            return redirect()->route('tasks.index')
                ->with('success', 'Tarea eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hubo un error al eliminar la tarea: ' . $e->getMessage());
        }
    }


    // Completar una tarea específica de la base de datos
    public function complete(Request $request, Tasks $task)
    {
        try {
            $task->status = 1;
            $task->save();
            return redirect()->back()->with('success', 'Tarea completada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hubo un error al completar la tarea: ' . $e->getMessage());
        }
    }
}
