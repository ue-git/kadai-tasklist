<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            $tasks = Task::where('user_id',$user->id)->get();
            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
        }
        // Welcomeビューでそれらを表示
        return view('welcome', $data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\Auth::check()) { // 認証済みの場合
            $task = new Task;
            return view('tasks.create',[
                'task' => $task,
            ]);
        }
        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (\Auth::check()) { // 認証済みの場合
            $request->validate([
                'status'=>'required|max:10',
                'content'=>'required|max:255',
            ]);
            
            $user = \Auth::user();
            $task = new Task;
            $task->status = $request->status;
            $task->content = $request->content;
            $task->user_id = $user->id; 
            $task->save();
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (\Auth::check()) { // 認証済みの場合
            //dd($id);
            $user = \Auth::user();
            $task = Task::findOrFail($id);
            if($task->user_id == $user->id){
                //dd($task);
                return view('tasks.show',[
                    'task' => $task,
                ]);
            }else{
                return redirect('/');
            };
        }
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (\Auth::check()) { // 認証済みの場合
            $user = \Auth::user();
            $task = Task::findOrFail($id);
            if($task->user_id == $user->id){
                return view('tasks.edit',[
                    'task' => $task,
                ]);
            }else{
                return redirect('/');
            };
        }
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (\Auth::check()) { // 認証済みの場合
            $request->validate([
                'status'=>'required|max:10',
                'content'=>'required|max:255',
            ]);
            $user = \Auth::user();
            $task = Task::findOrFail($id);
            if($task->user_id == $user->id){
                $task->status = $request->status;
                $task->content = $request->content;
                $task->save();
            }else{
                return redirect('/');
            };
        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Auth::check()) { // 認証済みの場合
            $user = \Auth::user();
            $task = Task::findOrFail($id);
            if($task->user_id == $user->id){
                $task->delete();
            }
        }
        return redirect('/');
    }
}
