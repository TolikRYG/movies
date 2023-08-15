<?php
// Подключаем файл с классом Database
require_once "database.php";
// Класс Collection для хранения названия, описания, изображения и типа подборки фильмов или сериалов по одной теме, а также для получения всех подборок или одной подборки по id из базы данных
class Collection {
  // Свойства класса для хранения данных о подборке
  private $id; // Идентификатор
  private $name; // Название
  private $description; // Описание
  private $image_url; // URL изображения
  private $type; // Тип (movies или serials)

  // Конструктор класса для инициализации свойств
  public function __construct($id, $name, $description, $image_url, $type) {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    $this->image_url = $image_url;
    $this->type = $type;
  }

  // Метод для получения всех подборок из базы данных
  public static function getAll() {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для получения всех подборок из таблицы collections
    $sql = "SELECT * FROM collections";
    // Выполняем запрос без параметров и получаем результат в виде массива
    $result = $db->query($sql, []);
    // Создаем пустой массив для хранения объектов класса Collection
    $collections = [];
    // Проходим по результату в цикле и создаем объекты класса Collection из каждой строки
    foreach ($result as $row) {
      // Создаем объект класса Collection с данными из строки
      $collection = new Collection($row["id"], 
                                   $row["name"], 
                                   $row["description"], 
                                   $row["image_url"], 
                                   $row["type"]);
      // Добавляем объект в массив
      array_push($collections, $collection);
    }
    // Возвращаем массив объектов класса Collection
    return $collections;
  }

  // Метод для получения одной подборки по id из базы данных
  public static function getOne($id) {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для получения одной подборки из таблицы collections по id
    $sql = "SELECT * FROM collections WHERE id = :id";
    // Выполняем запрос с параметром id и получаем результат в виде массива
    $result = $db->query($sql, [":id" => $id]);
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

  // Метод для получения списка фильмов или сериалов в подборке из базы данных
  public function getItems() {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для получения списка фильмов или сериалов в подборке из таблицы collection_items по id подборки и соединяем его с таблицей movies или serials в зависимости от типа подборки по id фильма или сериала
    if ($this->type == "movies") {
      // Если тип movies, то выбираем из таблицы movies
      $sql = "SELECT movies.* FROM collection_items INNER JOIN movies ON collection_items.movie_id = movies.id WHERE collection_items.collection_id = :id";
    } else if ($this->type == "serials") {
      // Если тип serials, то выбираем из таблицы serials
      $sql = "SELECT serials.* FROM collection_items INNER JOIN serials ON collection_items.serial_id = serials.id WHERE collection_items.collection_id = :id";
    } else {
      // Если тип неизвестен, то возвращаем пустой массив
      return [];
    }
    // Выполняем запрос с параметром id подборки и получаем результат в виде массива
    $result = $db->query($sql, [":id" => $this->id]);
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

  // Метод для получения названия подборки
  public function getName() {
    // Возвращаем свойство name объекта класса Collection
    return $this->name;
  }

  // Метод для получения описания подборки
  public function getDescription() {
    // Возвращаем свойство description объекта класса Collection
    return $this->description;
  }

  // Метод для получения URL изображения подборки
  public function getImageUrl() {
    // Возвращаем свойство image_url объекта класса Collection
    return $this->image_url;
  }

  // Метод для получения типа подборки
  public function getType() {
    // Возвращаем свойство type объекта класса Collection
    return $this->type;
  }
}
?>
