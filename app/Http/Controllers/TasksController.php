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
     
    // getでtasks/ にアクセスされた場合の「タスク一覧表示処理」
    public function index()
    {
        $data = [];
        if (\Auth::user()) {
            // 認証済みユーザを取得
            $user = \Auth::user();
            // タスク一覧を取得
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                "user" => $user,
                "tasks" => $tasks,
            ];    
        }
        
        
        
        return view("welcome", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // getでtasks/createにアクセスされた場合の「タスク登録画面表示処理」
    public function create()
    {
        $task = new Task;
        
        // タスク作成ビューを表示
        return view("tasks.create", [
                "task" => $task,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // postでtasks/にアクセスされた場合の「タスク登録機能」
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            "status" => "required|max:10",
            "content" => "required",
        ]);
        
        // タスクを作成
        // $task = new Task;
        // $task->status = $request->status;
        // $task->content = $request->content;
        // $task->save();
        
        // 認証済みユーザの投稿として作成
        $request->user()->tasks()->create([
            "content" => $request->content,
            "status" => $request->status,
        ]);
        
        return redirect("/");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // getでtasks/(任意のid)にアクセスされた場合の「タスク詳細表示機能」
    public function show($id)
    {
        // idの値でタスクを検索し取得
        $task = Task::findOrFail($id);
        
        // 閲覧者が投稿の所執者である場合は、詳細画面の表示
        if (\Auth::id() == $task->user_id) {
            return view("tasks.show", ["task" => $task,]);
        }
        
        return redirect("/");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // getでtasks/(任意のid)/editにアクセスされた場合の「タスク編集画面表示機能」
    public function edit($id)
    {
        // idの値でタスクを検索し取得
        $task = Task::findOrFail($id);
        
        // 閲覧者が投稿の所有者である場合は、編集画面を表示
        if (\Auth::id() == $task->user_id) {
            return view("tasks.edit", ["task" => $task,]);
        }
        
        return redirect("/");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // putでtasks/(任意のid)にアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        // idの値でタスクを検索し取得
        $task = Task::findOrFail($id);
        
        // バリデーション
        $request->validate([
            "status" => "required|max:10",
            "content" => "required",
        ]);
        
        // タスクを更新
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();
        
        return redirect("/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // タスク削除
    public function destroy($id)
    {
        // idの値でタスクを検索し取得
        $task = Task::findOrFail($id);
        // タスク削除
        if (\Auth::id() == $task->user_id) {
            $task->delete();
        }
        
        return redirect("/");
        
    }
}
