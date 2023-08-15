<?php
// Подключаем файл с классом Database
require_once "database.php";
// Класс Movie для хранения названия, рейтинга, даты создания, списка актеров в виде json в базе (в том числе озвучки), режиссёр, тегов (для соотнесения с жанрами, отдельными сборками фильмов и сериалов по темам) и постера фильма или сериала, а также для получения всех фильмов или сериалов по номеру страницы и лимиту на страницу или одного фильма или сериала по названию из базы данных.
class Movie {
  // Свойства класса для хранения данных о фильме или сериале
  private $id; // Идентификатор
  private $title; // Название
  private $rating; // Рейтинг
  private $release_date; // Дата создания
  private $director; // Режиссер
  private $tags; // Теги
  private $poster_url; // URL постера
  private $playframe_url; // URL плеера
  private $likes; // Количество лайков
  private $dislikes; // Количество дизлайков

  // Конструктор класса для инициализации свойств
  public function __construct($id, $title, $rating, $release_date, $director, $tags, $poster_url, $playframe_url, $likes, $dislikes) {
    $this->id = $id;
    $this->title = $title;
    $this->rating = $rating;
    $this->release_date = $release_date;
    $this->director = $director;
    $this->tags = $tags;
    $this->poster_url = $poster_url;
    $this->playframe_url = $playframe_url;
    $this->likes = $likes;
    $this->dislikes = $dislikes;
  }

  // Метод для получения всех фильмов или сериалов по номеру страницы и лимиту на страницу из базы данных
  public static function getAll($page, $limit, $type) {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для получения всех фильмов или сериалов из таблицы movies или serials в зависимости от типа с пагинацией
    if ($type == "movies") {
      // Если тип movies, то выбираем из таблицы movies
      $sql = "SELECT * FROM movies LIMIT :offset, :limit";
    } else if ($type == "serials") {
      // Если тип serials, то выбираем из таблицы serials
      $sql = "SELECT * FROM serials LIMIT :offset, :limit";
    } else {
      // Если тип неизвестен, то возвращаем пустой массив
      return [];
    }
    // Вычисляем смещение в зависимости от номера страницы и лимита на страницу
    $offset = ($page - 1) * $limit;
    // Выполняем запрос с параметрами смещения и лимита и получаем результат в виде массива
    $result = $db->query($sql, [":offset" => $offset, ":limit" => $limit]);
    // Создаем пустой массив для хранения объектов класса Movie
    $movies = [];
    // Проходим по результату в цикле и создаем объекты класса Movie из каждой строки
    foreach ($result as $row) {
      // Создаем объект класса Movie с данными из строки
      $movie = new Movie($row["id"], 
                         $row["title"], 
                         $row["rating"], 
                         $row["release_date"], 
                         $row["director"], 
                         $row["tags"], 
                         $row["poster_url"], 
                         $row["playframe_url"], 
                         $row["likes"], 
                         $row["dislikes"]);
      // Добавляем объект в массив
      array_push($movies, $movie);
    }
    // Возвращаем массив объектов класса Movie
    return $movies;
  }

  // Метод для получения одного фильма или сериала по названию из базы данных
  public static function getOne($title, $type) {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для получения одного фильма или сериала из таблицы movies или serials в зависимости от типа по названию
    if ($type == "movies") {
      // Если тип movies, то выбираем из таблицы movies
      $sql = "SELECT * FROM movies WHERE title = :title";
    } else if ($type == "serials") {
      // Если тип serials, то выбираем из таблицы serials
      $sql = "SELECT * FROM serials WHERE title = :title";
    } else {
      // Если тип неизвестен, то возвращаем null
      return null;
    }
    // Выполняем запрос с параметром названия и получаем результат в виде массива
    $result = $db->query($sql, [":title" => $title]);
    // Проверяем, есть ли результат
    if ($result) {
      // Если есть, то берем первую строку из результата
      $row = $result[0];
      // Создаем объект класса Movie с данными из строки
      $movie = new Movie($row["id"], 
                         $row["title"], 
                         $row["rating"], 
                         $row["release_date"], 
                         $row["director"], 
                         $row["tags"], 
                         $row["poster_url"], 
                         $row["playframe_url"], 
                         $row["likes"], 
                         $row["dislikes"]);
      // Возвращаем объект класса Movie
      return $movie;
    } else {
      // Если нет, то возвращаем null
      return null;
    }
  }

  // Метод для получения списка актеров в фильме или сериале из базы данных
  public function getActors() {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для получения списка актеров в фильме или сериале из таблицы roles по id фильма или сериала и соединяем его с таблицей actors по id актера
    $sql = "SELECT actors.* FROM roles INNER JOIN actors ON roles.actor_id = actors.id WHERE roles.movie_id = :id OR roles.serial_id = :id";
    // Выполняем запрос с параметром id фильма или сериала и получаем результат в виде массива
    $result = $db->query($sql, [":id" => $this->id]);
    // Создаем пустой массив для хранения объектов класса Actor
    $actors = [];
    // Проходим по результату в цикле и создаем объекты класса Actor из каждой строки
    foreach ($result as $row) {
      // Создаем объект класса Actor с данными из строки
      $actor = new Actor($row["id"], 
                         $row["name"], 
                         $row["photo_url"]);
      // Добавляем объект в массив
      array_push($actors, $actor);
    }
    // Возвращаем массив объектов класса Actor
    return $actors;
  }

  // Метод для получения списка ролей актеров в фильме или сериале из базы данных
  public function getRoles() {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для получения списка ролей актеров в фильме или сериале из таблицы roles по id фильма или сериала
    $sql = "SELECT * FROM roles WHERE movie_id = :id OR serial_id = :id";
    // Выполняем запрос с параметром id фильма или сериала и получаем результат в виде массива
    $result = $db->query($sql, [":id" => $this->id]);
    // Создаем пустой массив для хранения объектов класса Role
    $roles = [];
    // Проходим по результату в цикле и создаем объекты класса Role из каждой строки
    foreach ($result as $row) {
      // Создаем объект класса Role с данными из строки
      $role = new Role($row["id"], 
                       $row["actor_id"], 
                       $row["movie_id"] ?? $row["serial_id"], // Используем оператор ?? для выбора одного из двух значений в зависимости от того, что существует
                       $row["character_name"], 
                       $row["voice_actor"]);
      // Добавляем объект в массив
      array_push($roles, $role);
    }
    // Возвращаем массив объектов класса Role
    return $roles;
  }

  // Метод для получения подборки фильмов или сериалов по одной теме, в которую входит фильм или сериал из базы данных
  public function getCollection() {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для получения подборки фильмов или сериалов по одной теме, в которую входит фильм или сериал из таблицы collection_items по id фильма или сериала и соединяем его с таблицей collections по id подборки
    $sql = "SELECT collections.* FROM collection_items INNER JOIN collections ON collection_items.collection_id = collections.id WHERE collection_items.movie_id = :id OR collection_items.serial_id = :id";
    // Выполняем запрос с параметром id фильма или сериала и получаем результат в виде массива
    $result = $db->query($sql, [":id" => $this->id]);
    // Проверяем, есть ли результат
    if ($result) {
      // Если есть, то берем первую строку из результата
      $row = $result[0];
      // Создаем объект класса Collection с данными из строки
      $collection = new Collection($row["id"], 
                                   $row["name"], 
                                   $row["description"], 
                                   $row["image_url"], 
                                   $row["type"]);
      // Возвращаем объект класса Collection
      return $collection;
    } else {
      // Если нет, то возвращаем null
      return null;
    }
  }

  // Метод для получения URL постера фильма или сериала
  public function getPosterUrl() {
    // Возвращаем свойство poster_url объекта класса Movie
    return $this->poster_url;
  }

  // Метод для получения URL плеера фильма или сериала
  public function getPlayframeUrl() {
    // Возвращаем свойство playframe_url объекта класса Movie
    return $this->playframe_url;
  }

  // Метод для получения названия фильма или сериала
  public function getTitle() {
    // Возвращаем свойство title объекта класса Movie
    return $this->title;
  }

  // Метод для получения рейтинга фильма или сериала
  public function getRating() {
    // Возвращаем свойство rating объекта класса Movie
    return $this->rating;
  }

  // Метод для получения даты создания фильма или сериала
  public function getReleaseDate() {
    // Возвращаем свойство release_date объекта класса Movie
    return $this->release_date;
  }

  // Метод для получения режиссера фильма или сериала
  public function getDirector() {
    // Возвращаем свойство director объекта класса Movie
    return $this->director;
  }

  // Метод для получения тегов фильма или сериала
  public function getTags() {
    // Возвращаем свойство tags объекта класса Movie
    return $this->tags;
  }

  // Метод для получения количества лайков фильма или сериала
  public function getLikes() {
    // Возвращаем свойство likes объекта класса Movie
    return $this->likes;
  }

  // Метод для получения количества дизлайков фильма или сериала
  public function getDislikes() {
    // Возвращаем свойство dislikes объекта класса Movie
    return $this->dislikes;
  }
}
?>
