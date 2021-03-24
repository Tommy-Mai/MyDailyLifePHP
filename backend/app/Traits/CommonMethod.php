<?php namespace App\Traits;

use Carbon\Carbon;
use App\Models\MealTag;
use App\Models\TaskTag;
use App\Models\MealTask;
use App\Models\TaskTask;
use App\Models\MealComment;
use App\Models\TaskComment;

trait CommonMethod
{
  public function getFormatDate(){
    return $this->date->format('Y/m/d');
  }

  public function getFormatDateHyphen(){
    return $this->date->format('Y-m-d');
  }

  public function getFormatTime(){
      return $this->time->format('H:i');
  }

  public function getFormatDateTime(){
      return $this->created_at->format('Y/m/d H:i');
  }

  public function getMealTagName(){
    $tag = MealTag::find($this->tag_id);
    return $tag->name;
  }

  public function getTaskTagName(){
    $tag = TaskTag::find($this->tag_id);
    return $tag->name;
  }

  public function getFormatDateSearch(){
    return $this->format('Y/m/d');
  }

  public function getFormatTimeSearch(){
      return $this->format('H:i');
  }

  public function getTagNameSearch(){
    $tag = MealTag::find($this);
    return $tag->name;
  }

  public function getTaskNum($date){
    $tasks = $this->whereDate('date', $date)->count();
    return $tasks;
  }

}