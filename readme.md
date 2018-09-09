# Gallery Laravel Documentation
Документация по Laravel
### Структура Фрейм Ворка
- Важные Кампоненты


1.[Route]()
2.[Controller]()
3.[View]()
4.[Request]()
5.[Helpers]()
6.[Validation]()
7.[Middleware]()
8.[Http Errors]() 
9.[Collection]()
10.[Query Builder]()
11.[Eloguent]()
12.[Unit\Feature Test]()
13.[PHP Artisan Console]()
14.[Laravel mix]()
15.[Migration]()
16.[Faker]()
17.[Pagination]()
18.[Seeds]()


### 1.**Route**
##### **Route** - занимаеться маршритазацией и вызывает метод action
 Route::get($url, $closure);
 Route::post($url, $closure);
 Route::put\patch($url, $closure);
 Route::delete($url, $closure);
 
 Route::get('/posts/{date}', $closure);
 Route::get('/posts/{id?}', $closure);
 Route::get('/posts/{id?}', $closure)->name('posts.show');
 
**Route** -  принимает определённый $url послу чего выполняет $closure.
У Route имееться два параметра:
1.Обязательный пишиться так: {date}.
2.Не обязательный пишиться так: {id?}.
? - Вопросительный знак нам указывает на не обезательность параметра.
Функция name позволяет давать названия маршрутам. 

**Вид функции**:
Route::get('/post', function (){
        // место для кода логики)
});

В Laravel усть префиксы для объяденения роутов.Если много роутов 
под одним префиксом то им их объяденяем:

Route::prefix('admin')->group(function(){

   Route::get('/posts', 'PostsController@index');
   Route::get('/create', 'CreateController@index')

Namespace - для разгроничения controller:
Route::namespace('Admin')->group(function () {
  //Контроллеры в Namespace "App\Http\Controllers\Admin"
});

Middleware - служит как фильтр:
Route::middleware(['first', 'second'])->group(function () {
    Route::get('/', function () {
        // Route использует first и second для Middleware
    });
First, second - служат для логики фильтрации которую мы прописываем.

**Controller** - После того как прописали маршрут в роуте вызываеться экшн.
Самый частый встречаемый алгоритм работы экшна такой, что запрос идёт к базе
данных потом сортируеться результат передаёться в види сам вид выводиться.
Контроллер это то место где выполняеться код Модели и выводиться Вид,
и отробатывает база данных:
   
   class PostController{
   
		public function index(){
			//запрос к бд
			//сортировка результата
			//передача данных и вывод представления
		}
	}



**DI** - Мы подключаем нужные кампоненты и присваеваем к внутреним приватным
атрибутами, потом эти атрибуты используем там где нужно:
class PostController{
	
		private $someComponent;
		
		public function __comstruct(MyComponent $component){
			
			$this->someComponent = $component;
		}
	}
	
**View** - Когда вся логика было выполнена мы должны показать пользователю
результат.Для этого в Laravel имееться кампонент видов который называеться 
Blade:
Подключаеться так:

    </head>
    <body>


    @yield('content')
    </body>
    </html>	
Реализуеться так:

    @extends('layout')
    @section('content')
    <div class="container">
        <div class="page">
            <a href="/">
                <h3>HOME</h3>
            </a>
            <a href="/createCars">
                <h3>ADD IMAGE</h3>
            </a>
        </div>
        <h1 align="center">Cars</h1>

        <div class="row">
            @foreach($imageInCars as $image)


                <div class="col-md-3 gallery-item">
                    <div>
                        <img src="{{$image->image}}" alt="" class="img-thumbnail">
                    </div>

                    <a href="/showCars/{{$image->id}}" class="btn btn-info my-button">Посмотреть</a>
                </div>
            @endforeach


        </div>
    </div>


    @endsection
    
Потом прописываем маршрут в web.php:
     Route::get('blade', function () {
         return view('child');
     });
     
**Request** - Это обёртка над глобальными массивами $_GET, $_POST, $_FILES

**Helpers** - Сборник вспомогательных функции.
 dd('text') - тоже самое что и var_dump(), только лучше)?.
 
 route('posts.index') - для сформирования маршрута, в качестве параметра название роута.
 
 view('home.main') - рендер представления.
 
 redirect('/homepage') - переадресация.
 
 back() - переадресация на предидущий маршрут.
 
 with('variable', 'value') - функция передачи данных вид.
 
 withInput() - передает назад данные ведденые пользователем.
 
 old('title') - при отправки данных сохраняет их.
 
 scrf_field() - для защиты данных с формы.
 
 scrf_token() - выводит токин.
 
 auth() - возвращает авторизованого пользователя.
 
 collect() - создает колекцию на которой можна делать различные операции.
 
 config('app.name') - берет значение из конфига определеного файла.
 
 Строки:
 str_random() - рандомная строка.
 
 str_slug() - переводит кирилицу в латиницу.
 
 str_limit() - обрезает строки до определенной длины.
 
 Пути:
 public_path() - полной путь до папки public которая доступная для web.
 
 storage_path() - полной путь до папки storage.
 
**Validation** - Для валидации входящих данных с формы.
 Пишишться в разметки страницы так: 
     <div class="col-md-5">
          <h1>Add Image</h1>
          {{$errors->first('image')}}
          
  Пишиться в Коетроллере так:
     function add(Request $request) {
     
             $this->validate($request, [
                 'image' => 'required|image'
             ]);  
             
**Middleware** - Это обычный класс в который имеет метод, и в методе прописываем
 условие, после того как условие было удовлетворено мы имеем доступ к роутам
 иначе доступ перекрыт.
 Пример:
    Route::group(['namespace'=>'Gallery', 'middleware'=>'auth'], function () {
    
        Route::get('/create', 'FlowersController@flowers');
        
        
**HTTP Errors** - Кампонент для создания собственных http ошибок, таких как
 404, 500, 505 и т.д. Чтобы вывести ошибку в laravel существует функция abort().
 Но при этом функция abort выдаст вам вшытую старницу ошибки, для того что бы 
 создать собственную странцу ошибки, в view мы создаём папку ошибок errors и уже в папке errors
 создаём страницу ошибки 404.blade.php.
 
**Collection** - Кампонент который дает дополнительные возможности для работы с масивами.
 Пример обычный способ выборки пользователей по статусу не используя collection:
    $users = [
            [
                'id'=> 1,
                'name' => "Martin",
                'status' => 'ban'
            ],
            [
                'id'=> 2,
                'name' => "Oliver",
                'status' => 'ban'
            ],
            [
                'id'=> 3,
                'name' => "Anastasia",
                'status' => 'active'
            ],
            [
                'id'=> 4,
                'name' => "Gerrard",
                'status' => 'active'
            ],
        ];
    
        $bannedUsers = [];
    
        foreach ($users as $user)
        {
            if($user['status'] == "ban"){
                if($user['id'] > 1){
                    $bannedUsers[] = $user;
                }
            }
        }
    
        $bannedUsersWithIDs = [];
    
        foreach ($bannedUsers as $user)
        {
            if($user['id'] >1){
                $bannedUsersWithIDs[] = $user;
            }
        }
        dd($bannedUsersWithIDs);
    //    return view('welcome');
    });
    
  Пример сортировки по статусу применяя кампонент Collection:
    $users = collect([
            [
                'id'=> 1,
                'name' => "Martin",
                'status' => 'ban'
            ],
            [
                'id'=> 2,
                'name' => "Oliver",
                'status' => 'ban'
            ],
            [
                'id'=> 3,
                'name' => "Anastasia",
                'status' => 'active'
            ],
            [
                'id'=> 4,
                'name' => "Gerrard",
                'status' => 'active'
            ],
        ]);
    
    
    
        $names = $users->filter(function($user){
            return $user['status'] == 'ban';
        })->filter(function ($user){
            return $user['id'] > 1;
        });
    
        dd($names);
**Query Builder** -  создание запросов для баз данных, их обработка и т.д.

**Eloquent** - модель, позволяет работать c таблицами в базах данных как с обычными обьектами.

Для создание модели прописываем команду:

php artisan make:model Post

Создасться файл app/Post.php, с которым мы уже можем совершать некоторые действия, файл выглядит так:

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
}

Для вызова модели и для работы с ней, к примеру вывод всех статтей:

Post::all(); - выведем нам все статьи в Колекциях, чтобы вывести одну модель можно написать Post::first();, выведет 1 модель, тоесть 1 пост, чтобы вывести по определенному id нужно написать Post::find();, и указать в find(2) тобиш найдет вторую статью, также можна указать "где": Post::where('id', 9)->get();, в этом случае мы должны прописать ->get();, так как это не завершающее предложение, так как после where мы можем написать и limit и другие предлоги, без ->get(); мы получим только Builder что и переводится как строитель, тоесть не завершенный запрос.

Сам запрос и вывод выглядит так (для упрощения, написано все в Route):


Route::get('/', function(){
  $posts = Post::all();
  return view('welcome', ['posts'=>$posts]); // передаем в переменую $posts все посты
});
В самом файле welcome.blade.php для вывода прописываем так:

@foreach($posts as $post)
  <div>
  <h3>{{$post->title}}</h3>
  <p>{{$post->content}}</p>
  </div>
  <hr>
@endforeach
Create

//web.php

Route::get('/', function(){
  $posts = Post::create([
  	'title' => 'test',
	'content' => 'testcontent'
  ]);
  return view('welcome', ['posts'=>$posts]);
});
При запуске произойдет ошыбка, через защиту Laravel, чтобы избежать ошыбки, нам нужно перейти в файл модели Post.php, и позволить заполнять указанные поля, функцией $fillable (поля которые могут быть заполнены).

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
 	public $fillable =["title", "content"]; // в масиве передаем допустимые поля   
}
Все поля по умолчанию защищены, но если использовать функцию $guarded = [];, тогда поля не защищены, и их можно заполнять.

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
 	public $guarded =[];   
}
По умолчанию Laravel связывается с таблицей которая указана в названии модели, но можно изменить таблицу:

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	public $table = "post"; 
}
Второй способ на создания(записывания данных):

//web.php

Route::get('/', function(){
  $post = new Post;
  
  $post->title = 'titletest';
  $post->content = 'njnjnj';
  $post->save();
  return view('welcome', ['posts'=>$posts]);
});
Комбинация подходов, и защищенность данных:

$post = Post::create($request->all()); // запишет все данные с формы
// некоторые данные мы должны защитить, к примеру пользователя который написал пост, и дату написания
$post->user_id = '123';
$post->date = ('Y-m-d');
$post->save();
Update

$post = Post::find(5);
$post->title = 'new Title';
$post->save();
Если данных много можна использовать модель наполнитель:

$data = [
	"title" => "new Title",
	"content" => "new Content"
];

$post = Post::find(5);
$post->fill($data);
$post->save();
Delete

$post = Post::find(5);
$post->delete();
Сылка на документацию - Getting Started

Relationships

К примеру у нас есть посты, у одного поста есть автор, но у автора может быть много постов.

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	public function user()
	{
		return $this->belongsTo('App\User'); // Укразываем клас к которому будем обращатся
	}
}
Обращаемся напрямую к пользователю, который связан с моделлю, и выводим его данные:

//web.php

Route::get('/', function(){
 	$post = Post::first();
	dd($post->user);
});
Можно прописывать в виде метода и давать дополнительные условия:

//web.php

Route::get('/', function(){
 	$post = Post::first();
	dd($post->user()->where('id', 1)->first());
	// или
	// $user->posts()->where('status', 1)->get();
});
Также пользователь у нас имеет множество постов:

<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

        class User extends Model
        {
            public function posts()
                {
                    return $this->hasMany('App\Post');
                }
        }
    Вывод множества постов:

    //web.php

    Route::get('/', function(){
        $user = User::first();
        dd($user->posts()->orderBy('id', 'desc')->get()); 
        dd($user->posts->pluck('id)); // вытащит все id
	
    });
    $this->hasMany('App\Post'); - получим колекцию постов, если нужно получить к примеру не колекцию а один пост, или к
 примеру у пользователя есть номер телефона, и мы хотим только его получит, нам тогда нужно прописать hasOne.


**Unit/Feature Test** - Unit\Feature Test - тесты, созданые для автоматизации тестов Laravel.

**PHP Artisan Console** - PHP Artisan Console - консольная утилита для рутинных задач.

**Laravel mix** - Laravel mix - создыный для работы с webpack.

**Migration** -  для работы с базой данных.

Для создания миграции нам нужно в php artisan прописать команду:

	php artisan make:migration create_user_table
В названии миграции должно присутствовать то, что мы хотим с етим сделать. К примеру create_user_table создаст нам таблицу user.

Все миграции по умолчанию находятся в database/migration.

Запустить все миграции мы можем командой:

php artisan migrate
Откатить предидущую миграцию можно командой:

php artisan migrate:rollback
Откатить все миграции:

php artisan migrate:reset
Откатить и вернуть миграции на свое предидущее "место":

php artisan migrate:refresh
Файл с миграциями выглядит так:

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
Где:

Schema::create('users', function (Blueprint $table) - создание таблицы с именем users.

$table->string('name'); - создание поля name, string - по умолчанию varchar255.

**Faker** - Faker - создан для наполнения фейковыми данными бд.
            
            Файлы с Factories находятся по пути database/factories.
            
            Для создания новых фековых данных нам нужно создать сперва Factory:
            
            php artisan make:factory PostFactory
            
            Потом в файле PostFactory.php, нужно прописать где и какие данные мы хотим получить.
            
            $factory->define(App\Post::class, function (Faker $faker) {
                return [
                    'title' => $faker->words,
                    'slug' => $faker->slug,
                    'content' => $faker->text,
                    'date' => $faker->date('Y-m-d'),
                    'user_id' => 1
                ];
            });
            Для исполнения faker нужно написать следующую команду:
            
            factory(App\Post::class, 5)->create();
            Где 5 это сколько сделать записей.
            
            Можна вызвать напрямую из маршрута Route:
            
            Route::get('/', function () {
                factory(App\Post::class, 5)->create();
            });
            
**Paginator** - Для создании пагинации используем функцию paginate();
                
                Реализация в коде:
                
                //web.php
                
                user App\Post;
                
                Route::get('/', function(){
                	$posts = Post::paginate(5);   // 5 - елементов на 1 странице
                	return view('welcome');
                });
                Вывод пагинации(сам переключатель);
                
                //welcome.blae.php
                @foreach($posts as $post)
                	<div>
                		<h3>{{$post->title}}</h3>
                		<p>{{$post->content}}</p>
                	</div>
                	<hr>
                @endforeach
                
                {{$posts->links()}} // Вывод пагинации
                Для стилизования пагинации используем следующии команды:
                
                php artisan vendor:publish
                Попадем в окошко, в котором нужно прописать что мы хотим "вынести" В случаи пагинации, выбираем 8, и оно нам скопирует в нашу директорию все файлы связаны с пагинацией, для редактирования
                
**Seed** - Сидеры в отличии от факера заполняют DB реальными данными.
           
           //database/seeds
           
           <?php
           
           use App\Post;
           use Illuminate\Database\Seeder;
           
           class DatabaseSeeder extends Seeder
           {
               /**
                * Seed the application's database.
                *
                * @return void
                */
               public function run()
               {
                   Post::find(5)->update(['title'] => ['new title']);
                   // $this->call(UsersTableSeeder::class);
               }
           }
           
           Запуск seed :
           
           php artisan db:seed
           Создание нового сида:
           
           php artisan make:seed PostTableSeeder
           Для вызова определенного сидера нужно прописать в файле DatabaseSeeder.php:
           
           <?php
           use Illuminate\Database\Seeder;
           
           class DatabaseSeeder extends Seeder
           {
               /**
                * Seed the application's database.
                *
                * @return void
                */
               public function run()
               {
                   $this->call(PostTableSeeder::class);
               }
           }
           Для выполнения одного Сидера прописываем:
           
           php artisan db:seed --class=PostTableSeeder
                
           


                        
    

 
                  

    
      
	



         
 
