<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>MyDailyLifePHP</title>
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
  <header>
    <nav class="my-navbar">
      <a class="my-navbar-brand" href="/">MyDailyLife</a>
    </nav>
  </header>
  <main>
    <div class="container">
      <div class="row">
        <div class="col col-md-4">
          <nav class="panel panel-default">
            <div class="panel-heading">フォルダ</div>
            <div class="panel-body">
              <a href="#" class="btn btn-default btn-block">
                フォルダを追加する
              </a>
            </div>
            <div class="list-group">
              @foreach($meal_tags as $meal_tag)
                <a href="{{ route('mealTags.index', ['id' => $meal_tag->id]) }}" class="list-group-item">
                  {{ $meal_tag->title }}
                </a>
              @endforeach
            </div>
          </nav>
        </div>
        <div class="column col-md-8">
          <!-- ここにタスクが表示される -->
        </div>
      </div>
    </div>
  </main>
</body>
</html>
