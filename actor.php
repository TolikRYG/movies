<?php
// Подключаем файл с классом Database
require_once "database.php";
// Класс Actor для хранения имени и фото актера, а также для получения всех актеров или одного актера по id из базы данных
class Actor {
  // Свойства класса для хранения данных об актере
  private $id; // Идентификатор
  private $name; // Имя
  private $photo_url; // URL фото

  // Конструктор класса для инициализации свойств
  public function __construct($id, $name, $photo_url) {
    $this->id = $id;
    $this->name = $name;
    $this->photo_url = $photo_url;
  }

  // Метод для получения всех актеров из базы данных
  public static function getAll() {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для получения всех актеров из таблицы actors
    $sql = "SELECT * FROM actors";
    // Выполняем запрос без параметров и получаем результат в виде массива
    $result = $db->query($sql, []);
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

  // Метод для получения одного актера по id из базы данных
  public static function getOne($id) {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для получения одного актера из таблицы actors по id
    $sql = "SELECT * FROM actors WHERE id = :id";
    // Выполняем запрос с параметром id и получаем результат в виде массива
    $result = $db->query($sql, [":id" => $id]);
    // Проверяем, есть ли результат
    if ($result) {
      // Если есть, то берем первую строку из результата
      $row = $result[0];
      // Создаем объект класса Actor с данными из строки
      $actor = new Actor($row["id"], 
                         $row["name"], 
                         $row["photo_url"]);
      // Возвращаем объект класса Actor
      return $actor;
    } else {
      // Если нет, то возвращаем null
      return null;
    }
  }

  // Метод для получения имени актера
  public function getName() {
    // Возвращаем свойство name объекта класса Actor
    return $this->name;
  }

  // Метод для получения URL фото актера
  public function getPhotoUrl() {
    // Возвращаем свойство photo_url объекта класса Actor
    return $this->photo_url;
  }
}

// Класс Role для хранения роли актера в фильме или сериале, а также для получения всех ролей или одной роли по id из базы данных
class Role {
  // Свойства класса для хранения данных о роли
  private $id; // Идентификатор
  private $actor_id; // Идентификатор актера
  private $movie_id; // Идентификатор фильма или сериала (в зависимости от того, что это за роль)
  private $character_name; // Имя персонажа, которого играет или озвучивает актер
  private $voice_actor; // Флаг, указывающий, является ли актер озвучивающим

  // Конструктор класса для инициализации свойств
  public function __construct($id, $actor_id, $movie_id, $character_name, $voice_actor) {
    $this->id = $id;
    $this->actor_id = $actor_id;
    $this->movie_id = $movie_id;
    $this->character_name = $character_name;
    $this->voice_actor = $voice_actor;
  }

  // Метод для получения всех ролей из базы данных
  public static function getAll() {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для получения всех ролей из таблицы roles
    $sql = "SELECT * FROM roles";
    // Выполняем запрос без параметров и получаем результат в виде массива
    $result = $db->query($sql, []);
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

  // Метод для получения одной роли по id из базы данных
  public static function getOne($id) {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для получения одной роли из таблицы roles по id
    $sql = "SELECT * FROM roles WHERE id = :id";
    // Выполняем запрос с параметром id и получаем результат в виде массива
    $result = $db->query($sql, [":id" => $id]);
    // Проверяем, есть ли результат
    if ($result) {
      // Если есть, то берем первую строку из результата
      $row = $result[0];
      // Создаем объект класса Role с данными из строки
      $role = new Role($row["id"], 
                       $row["actor_id"], 
                       $row["movie_id"] ?? $row["serial_id"], // Используем оператор ?? для выбора одного из двух значений в зависимости от того, что существует
                       $row["character_name"], 
                       $row["voice_actor"]);
      // Возвращаем объект класса Role
      return $role;
    } else {
      // Если нет, то возвращаем null
      return null;
    }
  }

  // Метод для получения имени персонажа, которого играет или озвучивает актер
  public function getCharacterName() {
    // Возвращаем свойство character_name объекта класса Role
    return $this->character_name;
  }

  // Метод для получения флага, указывающего, является ли актер озвучивающим
  public function isVoiceActor() {
    // Возвращаем свойство voice_actor объекта класса Role
    return $this->voice_actor;
  }
}
?>
