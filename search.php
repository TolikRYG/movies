<?php
// Подключаем файлы с классами Database и Movie
require_once "database.php";
require_once "movie.php";
// Класс Search для работы с поиском фильмов и сериалов по разным критериям, таким как название, рейтинг, дата создания, режиссер, теги и подборки
class Search {
  // Метод для поиска фильмов или сериалов по названию из базы данных
  public static function byTitle($title, $type) {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для поиска фильмов или сериалов из таблицы movies или serials в зависимости от типа по названию с помощью оператора LIKE
    if ($type == "movies") {
      // Если тип movies, то выбираем из таблицы movies
      $sql = "SELECT * FROM movies WHERE title LIKE :title";
    } else if ($type == "serials") {
      // Если тип serials, то выбираем из таблицы serials
      $sql = "SELECT * FROM serials WHERE title LIKE :title";
    } else {
      // Если тип неизвестен, то возвращаем пустой массив
      return [];
    }
    // Добавляем проценты к названию для поиска по части слова
    $title = "%" . $title . "%";
    // Выполняем запрос с параметром названия и получаем результат в виде массива
    $result = $db->query($sql, [":title" => $title]);
    // Создаем пустой массив для хранения объектов класса Movie
    $movies = [];
    // Проходим по результату в цикле и создаем объекты класса Movie из каждой строки
    foreach ($result as $row) {
      // Создаем объект класса Movie с данными из строки
      $movie = new Movie(
          $row["id"],
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

  // Метод для поиска фильмов или сериалов по рейтингу из базы данных
  public static function byRating($rating, $type) {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для поиска фильмов или сериалов из таблицы movies или serials в зависимости от типа по рейтингу с помощью оператора >=
    if ($type == "movies") {
      // Если тип movies, то выбираем из таблицы movies
      $sql = "SELECT * FROM movies WHERE rating >= :rating";
    } else if ($type == "serials") {
      // Если тип serials, то выбираем из таблицы serials
      $sql = "SELECT * FROM serials WHERE rating >= :rating";
    } else {
      // Если тип неизвестен, то возвращаем пустой массив
      return [];
    }
    // Выполняем запрос с параметром рейтинга и получаем результат в виде массива
    $result = $db->query($sql, [":rating" => $rating]);
    // Создаем пустой массив для хранения объектов класса Movie
    $movies = [];
    // Проходим по результату в цикле и создаем объекты класса Movie из каждой строки
    foreach ($result as $row) {
      // Создаем объект класса Movie с данными из строки
      $movie = new Movie(
        $row["id"],
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

  // Метод для поиска фильмов или сериалов по дате создания из базы данных
  public static function byReleaseDate($release_date, $type) {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для поиска фильмов или сериалов из таблицы movies или serials в зависимости от типа по дате создания с помощью оператора =
    if ($type == "movies") {
      // Если тип movies, то выбираем из таблицы movies
      $sql = "SELECT * FROM movies WHERE release_date = :release_date";
    } else if ($type == "serials") {
      // Если тип serials, то выбираем из таблицы serials
      $sql = "SELECT * FROM serials WHERE release_date = :release_date";
    } else {
      // Если тип неизвестен, то возвращаем пустой массив
      return [];
    }
    // Выполняем запрос с параметром даты и получаем результат в виде массива
    $result = $db->query($sql, [":release_date" => $release_date]);
    // Создаем пустой массив для хранения объектов класса Movie
    $movies = [];
    // Проходим по результату в цикле и создаем объекты класса Movie из каждой строки
    foreach ($result as $row) {
      // Создаем объект класса Movie с данными из строки
      $movie = new Movie(
          $row["id"],
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

  // Метод для поиска фильмов или сериалов по режиссеру из базы данных
  public static function byDirector($director, $type) {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для поиска фильмов или сериалов из таблицы movies или serials в зависимости от типа по режиссеру с помощью оператора =
    if ($type == "movies") {
      // Если тип movies, то выбираем из таблицы movies
      $sql = "SELECT * FROM movies WHERE director LIKE :director";
    } else if ($type == "serials") {
      // Если тип serials, то выбираем из таблицы serials
      $sql = "SELECT * FROM serials WHERE director LIKE :director";
    } else {
      // Если тип неизвестен, то возвращаем пустой массив
      return [];
    }
    // Добавляем процент к режиссёру для поиска по части слова
    $director = "%" . $director . "%"; 
    // Выполняем запрос с параметром режиссера и получаем результат в виде массива
    $result = $db->query($sql, [":director" => $director]);
    // Создаем пустой массив для хранения объектов класса Movie
    $movies = [];
    // Проходим по результату в цикле и создаем объекты класса Movie из каждой строки
    foreach ($result as $row) {
      // Создаем объект класса Movie с данными из строки
      $movie = new Movie(
        $row["id"],
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

  // Метод для поиска фильмов или сериалов по тегам из базы данных
  public static function byTags($tags, $type) {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для поиска фильмов или сериалов из таблицы movies или serials в зависимости от типа по тегам с помощью оператора IN
    if ($type == "movies") {
      // Если тип movies, то выбираем из таблицы movies
      $sql = "SELECT * FROM movies WHERE tags IN (:tags)";
    } else if ($type == "serials") {
      // Если тип serials, то выбираем из таблицы serials
      $sql = "SELECT * FROM serials WHERE tags IN (:tags)";
    } else {
      // Если тип неизвестен, то возвращаем пустой массив
      return [];
    }
    // Преобразуем массив тегов в строку с запятыми для подстановки в запрос
    $tags = implode(",", $tags);
    // Выполняем запрос с параметром тегов и получаем результат в виде массива
    $result = $db->query($sql, [":tags" => $tags]);
    // Создаем пустой массив для хранения объектов класса Movie
    $movies = [];
    // Проходим по результату в цикле и создаем объекты класса Movie из каждой строки
    foreach ($result as $row) {
      // Создаем объект класса Movie с данными из строки
      $movie = new Movie(
        $row["id"], 
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

  // Метод для поиска фильмов или сериалов по подборкам из базы данных
  public static function byCollections($collections, $type) {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для поиска фильмов или сериалов из таблицы movies или serials в зависимости от типа по подборкам с помощью оператора IN и соединения с таблицей collections_movies или collections_serials
    if ($type == "movies") {
      // Если тип movies, то выбираем из таблицы movies и соединяем с таблицей collections_movies
      $sql = "SELECT m.* FROM movies m JOIN collections_movies cm ON m.id = cm.movie_id WHERE cm.collection_id IN (:collections)";
    } else if ($type == "serials") {
      // Если тип serials, то выбираем из таблицы serials и соединяем с таблицей collections_serials
      $sql = "SELECT s.* FROM serials s JOIN collections_serials cs ON s.id = cs.serial_id WHERE cs.collection_id IN (:collections)";
    } else {
      // Если тип неизвестен, то возвращаем пустой массив
      return [];
    }
    // Преобразуем массив подборок в строку с запятыми для подстановки в запрос
    $collections = implode(",", $collections);
    // Выполняем запрос с параметром подборок и получаем результат в виде массива
    $result = $db->query($sql, [":collections" => $collections]);
    // Создаем пустой массив для хранения объектов класса Movie
    $movies = [];
    // Проходим по результату в цикле и создаем объекты класса Movie из каждой строки
    
    foreach ($result as $row) {
        
      // Создаем объект класса Movie с данными из строки
      $movie = new Movie(
        $row["id"],
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
}

?>