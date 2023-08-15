<!-- Код php для работы с базой данных -->
<?php
    // Подключение к базе данных
    $db = new PDO("mysql:host=localhost;dbname=movies", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Класс для представления фильма или сериала
    class Movie {
      public $id;
      public $title;
      public $poster;
      public $rating;
      public $date;
      public $director;
      public $tags;
      public $cast;
      public $description;
      public $playframe;

      public function __construct($id, $title, $poster, $rating, $date, $director, $tags, $cast, $description, $playframe) {
        $this->id = $id;
        $this->title = $title;
        $this->poster = $poster;
        $this->rating = $rating;
        $this->date = $date;
        $this->director = $director;
        $this->tags = explode(",", $tags);
        $this->cast = explode(",", $cast);
        $this->description = $description;
        $this->playframe = $playframe;
      }
    }

    // Класс для представления подборки фильмов или сериалов
    class Collection {
      public $id;
      public $name;
            public $image;
      public $description;
      public $type;
      public $movies;

      public function __construct($id, $name, $image, $description, $type, $movies) {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->description = $description;
        $this->type = $type;
        $this->movies = explode(",", $movies);
      }
    }

    // Функция для получения всех фильмов или сериалов из базы данных
    function get_all_movies($type) {
      global $db;
      $stmt = $db->prepare("SELECT * FROM movies WHERE type = ?");
      $stmt->execute([$type]);
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $movies = [];
      foreach ($rows as $row) {
        $movie = new Movie($row["id"], $row["title"], $row["poster"], 
          $row["rating"], $row["date"], $row["director"], 
          $row["tags"], $row["cast"], 
          $row["description"],$row["playframe"]);
        array_push($movies, $movie);
      }
      return json_encode($movies);
    }

    // Функция для получения одного фильма или сериала по id из базы данных
    function get_movie_by_id($id) {
      global $db;
      $stmt = $db->prepare("SELECT * FROM movies WHERE id = ?");
      $stmt->execute([$id]);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($row) {
        return json_encode(new Movie(
            $row["id"],
            $row["title"],
            $row["poster"],
            $row["rating"],
            $row["date"],
            $row["director"],
            $row["tags"], 
            $row["cast"],
            $row["description"],
            $row["playframe"]));
      } else {
        return null;
      }
    }

    // Функция для получения всех подборок фильмов или сериалов из базы данных
    function get_all_collections($type) {
      global $db;
      $stmt = $db->prepare("SELECT * FROM collections WHERE type = ?");
      $stmt->execute([$type]);
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $collections = [];
      foreach ($rows as $row) {
        $collection = new Collection(
            $row["id"], 
            $row["name"],
            $row["image"],
            $row["description"],
            $row["type"],
            $row["movies"]);
        array_push($collections, $collection);
      }
      return json_encode($collections);
    }

    // Функция для получения одной подборки фильмов или сериалов по id из базы данных
    function get_collection_by_id($id) {
      global $db;
      $stmt = $db->prepare("SELECT * FROM collections WHERE id = ?");
      $stmt->execute([$id]);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($row) {
        return json_encode(new Collection(
            $row["id"],
            $row["name"],
            $row["image"],
            $row["description"],
            $row["type"],
            $row["movies"]));
      } else {
        return null;
      }
    }

    // Функция для поиска фильмов или сериалов по названию из базы данных
    function search_movies_by_title($title) {
      global $db;
      $stmt = $db->prepare("SELECT * FROM movies WHERE title LIKE ?");
      $stmt->execute(["%$title%"]);
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $movies = [];
      foreach ($rows as $row) {
        $movie = new Movie(
            $row["id"], 
            $row["title"], 
            $row["poster"],
            $row["rating"],
            $row["date"],
            $row["director"],
            $row["tags"], 
            $row["cast"],
            $row["description"],
            $row["playframe"]);
        array_push($movies, $movie);
      }
      return json_encode($movies);
    }

    // Обработка запросов от клиента
    if (isset($_GET["action"])) {
      switch ($_GET["action"]) {
        case "get_all_movies":
          if (isset($_GET["type"])) {
            echo get_all_movies($_GET["type"]);
          }
          break;
        case "get_movie_by_id":
          if (isset($_GET["id"])) {
            echo get_movie_by_id($_GET["id"]);
          }
          break;
        case "get_all_collections":
          if (isset($_GET["type"])) {
            echo get_all_collections($_GET["type"]);
          }
          break;
        case "get_collection_by_id":
          if (isset($_GET["id"])) {
            echo get_collection_by_id($_GET["id"]);
          }
          break;
        case "search_movies_by_title":
          if (isset($_GET["title"])) {
            echo search_movies_by_title($_GET["title"]);
          }
          break;
      }
    }
    ?>