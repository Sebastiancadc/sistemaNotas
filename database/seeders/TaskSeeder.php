<?php

namespace Database\Seeders;

use App\Models\Tasks;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Obtiene el ID de un usuario existente
         $user = User::first();

         // Crea una tarea de ejemplo
         Tasks::create([
             'title' => 'Tarea de ejemplo',
             'description' => 'Esta es una tarea de ejemplo.',
             'status' => false,
             'due_date' => Carbon::now()->addDays(7),
             'user_id' => $user->id,
         ]);
    }
}
