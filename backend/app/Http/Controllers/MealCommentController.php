<?php

namespace App\Http\Controllers;

use App\Models\MealTag;
use App\Models\MealTask;
use App\Models\MealComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\CreateComment;
use Illuminate\Support\Facades\Storage;

class MealCommentController extends Controller
{
/**
 * POST /meal_tasks/{task_id}/comments/create
 */
    public function create(int $task_id, CreateComment $request)
    {
        if (!empty($request->image)) {
            $file = $request->file('image');

            // リサイズ
            $img = \Image::make($file);
            $img->resize(350, null, function($constraint){
                $constraint->upsize(); 
                $constraint->aspectRatio();
            })->encode('jpg');
            $img->resize(null, 350, function($constraint){
                $constraint->upsize(); 
                $constraint->aspectRatio();
            })->encode('jpg');

            // calculate md5 hash of encoded image
            $hash = md5($img->__toString());
            $hash = time() . $hash;

            // use hash as a name
            $path = "storage/comments/{$hash}.jpg";

            // save it locally to ~/public/storage/comments/{$hash}.jpg
            $img->save(public_path($path));

            // $url = "/images/{$hash}.jpg"
            $url = "/" . $path;

            // 画像のファイル名をつけて保存
            $fileName = "{$hash}.jpg";
        } else {
            $fileName = "";
        }

        if(Auth::user()->tasks()->find($task_id)->exists()){
            $task = Auth::user()->tasks()->find($task_id);
            $comment = new MealComment();

            $comment->task_id = $task->id;
            $comment->comment = $request->comment;
            $comment->image = $fileName;
            Auth::user()->meal_comments()->save($comment);

            return redirect()->route('meal_tasks.show', ['id' => $task_id]);
        }else{
            return false;
        }
    }

    public function delete(int $task_id, int $id)
    {
        $task = Auth::user()->meal_tasks()->find($task_id);
        if ($task->meal_comments()->find($id)->exists()){
            $comment = $task->meal_comments()->find($id);
            if(!empty($comment->image)){
                $img = $comment->image;
                $path = "public/comments/{$img}";
                Storage::disk('local')->delete($path);
            }
            MealComment::destroy($id);
        }

        // 食事タスク詳細ページへ
        return redirect()->route('meal_tasks.show', ['id' => $task_id]);
    }

}
