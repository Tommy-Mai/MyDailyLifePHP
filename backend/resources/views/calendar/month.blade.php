@inject ('meal_tasks', 'App\Models\MealTask')
@inject ('tasks', 'App\Models\Task')

@extends('common.application')

@section('title', '月別カレンダー')

@section('content')
<div class="row">
  <div class="calendar-container col col-xs-12">
    <div class="my-month-calendar">
      <div class="calendar-heading col-xs-12">
        <div class="icon col-xs-1 col-xs-offset-3">
          <a href="/calendar/month?y={{$subY}}&m={{$subM}}">&lt;</a>
        </div>
        <span class="calendar-title col-xs-4 text-center" id="pop_trigger">
          <a href="/calendar/month">
            {{$date->year}}年{{$date->month}}月
          </a>
        </span>
        <div class="icon col-xs-1">
          <a href="/calendar/month?y={{$addY}}&&m={{$addM}}">&gt;</a>
        </div>
      </div>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>月</th>
            <th>火</th>
            <th>水</th>
            <th>木</th>
            <th>金</th>
            <th class="saturday">土</th>
            <th class="sunday">日</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            @for ($i = 1; $i <= $daysInMonth; $i++)
              @if($i==1)
                @if ($date->format('N')!= 1) 
                  <!-- 1日が月曜じゃない場合はcolspanでその分あける -->
                  @for($j = 1; $j < $date->format('N'); $j++)
                    <td colspan="1"></td>
                  @endfor
                @endif
              @endif

              @if($date->format('N') == 1)
                <!-- 月曜日だったら改行 -->
                </tr><tr>
              @endif

              <?php
              // ループで表示している日
              $comp = $date->year."-".$date->month."-".$date->day;
              ?>

              <!-- ループの日と今日を比較 -->
              @if ($comp == $today_comp)
                <!-- 同じなので緑色の背景にする -->
                  <td class="day today" style="background: #8fd3f5; color: white;">
                  {{$date->day}}
                  <div class="task-count">
                    <a href="/calendar/day/meal?date={{$date->format('Y-m-d')}}" class="col-xs-12">食事{{$meal_tasks->getTaskNum($date)}}件</a>
                    <a href="/calendar/day/other?date={{$date->format('Y-m-d')}}" class="col-xs-12">その他{{$tasks->getTaskNum($date)}}件</a>
                  </div>
                </td>
              @else
                  @switch ($date->format('N'))
                    @case(6)
                      <td class="day wday-6" style="color:#a3d9ed">
                        {{$date->day}}
                        <div class="task-count">
                          <a href="/calendar/day/meal?date={{$date->format('Y-m-d')}}" class="col-xs-12">食事{{$meal_tasks->getTaskNum($date)}}件</a>
                          <a href="/calendar/day/other?date={{$date->format('Y-m-d')}}" class="col-xs-12">その他{{$tasks->getTaskNum($date)}}件</a>
                        </div>
                      </td>
                      @break
                    @case(7)
                      <td class="day wday-7" style="color:#f18f65;">
                        {{$date->day}}
                        <div class="task-count">
                          <a href="/calendar/day/meal?date={{$date->format('Y-m-d')}}" class="col-xs-12">食事{{$meal_tasks->getTaskNum($date)}}件</a>
                          <a href="/calendar/day/other?date={{$date->format('Y-m-d')}}" class="col-xs-12">その他{{$tasks->getTaskNum($date)}}件</a>
                        </div>
                      </td>
                      @break
                    @default
                      <td class="day" >
                        {{$date->day}}
                        <div class="task-count">
                          <a href="/calendar/day/meal?date={{$date->format('Y-m-d')}}" class="col-xs-12">食事{{$meal_tasks->getTaskNum($date)}}件</a>
                          <a href="/calendar/day/other?date={{$date->format('Y-m-d')}}" class="col-xs-12">その他{{$tasks->getTaskNum($date)}}件</a>
                        </div>
                      </td>
                      @break
                  @endswitch
              @endif
              <?php
                $date->addDay();
              ?>
            @endfor
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection