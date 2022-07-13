<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Task;
use App\Models\User;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * @param TaskRepository $tasks
     * @return void
     */

    public function __construct(TaskRepository $tasks){
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    public function showUser($id){

        //return User::findOrFail($id);

        return view('user.profile', [
            'user' => User::findOrFail($id)
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request){
        //return $this->tasks->forUser($request->user());

        return view('index', [
            'tasks' => $this->tasks->forUser($request->user()),
            'user' => $request->user()
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function store(Request $request){
        $this->validate($request, [
            'name'=> 'required|max:255',
            'description'=>'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name'=>$request->name,
            'description'=>$request->description,
        ]);

        return redirect('/tasks');
    }

    /**
     * @param Request $request
     * @param Task $task
     * @return Response
     */
    public function destroy(Request $request, Task $task){
        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('/tasks');
    }

    public function edit (Task $task){
        $this->authorize('checkTaskOwner', $task);
        return view('edit', [
            'task' => $task,
        ]);
    }

    /**
     * @param Request $request
     * @param Task $task
     * @return type
     */
    public function update(Request $request, Task $task){
        $this->authorize('checkTaskOwner', $task);
        $task->update($request->all());
        return redirect('/tasks');
    }
}
