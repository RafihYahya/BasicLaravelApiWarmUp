<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TaskRessource;
use App\Http\Requests\StoreTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use HttpResponses;
    public function index()
    {
        return TaskRessource::collection(
            Tasks::where('user_id', Auth::user()->id)->get(),

        );
    }

    /**
     * Show the form for creating a new resource.
     */

    public function store(StoreTaskRequest $request)
    {
        $request->validated($request->all());
        $task = Tasks::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'priority' => $request->priority,
        ]);
        return new TaskRessource($task);
    }

    /**
     * Display the specified resource.
     */

    public function show(Tasks $task)
    {
        $this->isNotAuthorized($task) ? $this->isNotAuthorized($task) : new TaskRessource($task);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tasks $task)
    {
        if (Auth::user()->id == $task->user_id) {
            return $this->Err('', 'You Are a Thief', 403);
        }
        $task->update($request->all());
        return new TaskRessource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasks $task)
    {
        $this->isNotAuthorized($task) ? $this->isNotAuthorized($task) : $task->delete();

    }

    private function isNotAuthorized($task)
    {
        if (Auth::user()->id == $task->user_id) {
            return $this->Err('', 'You Are a Thief', 403);
        }
    }
}
