<?php

namespace Database\Seeders;

use App\Models\Task;
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
        $tasks = [
            [
                'user_id' => 1,
                'name' => 'Eat Fried Rice',
                'execution_time' => date('Y-m-d H:i:s', strtotime('2021-07-21 23:00:00')),
            ],
            [
                'user_id' => 1,
                'name' => 'Eat Yellow Rice',
                'execution_time' => date('Y-m-d H:i:s', strtotime('2021-07-27 23:00:00')),
            ],
            [
                'user_id' => 1,
                'name' => 'Eat Meatball',
                'execution_time' => date('Y-m-d H:i:s', strtotime('2021-07-28 23:00:00')),
            ],
            [
                'user_id' => 1,
                'name' => 'Play Mobile Legends',
                'execution_time' => date('Y-m-d H:i:s', strtotime('2021-07-21 23:00:00')),
            ],
            [
                'user_id' => 2,
                'name' => 'Tournament Mobile Legends',
                'execution_time' => date('Y-m-d H:i:s', strtotime('2021-07-23 22:00:00')),
            ],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
