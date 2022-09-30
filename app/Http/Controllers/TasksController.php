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
        // タスク一覧を取得
        $tasks = Task::all();
        
        // タスク一覧ビューで表示
        return view("tasks.index", [
                "tasks" => $tasks,
            ]);
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
        // タスクを作成
        $task = new Task;
        $task->content = $request->content;
        $task->save();
        
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
        //
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
        //
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
        //
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
        //
    }
}