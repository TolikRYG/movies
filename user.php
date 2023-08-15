<?php
// Подключаем файл с классом Database
require_once "database.php";
// Класс User для работы с данными пользователей, если они хотят зарегистрироваться чтобы была возможность ставить лайк или дизлайк для фильма или сериала
class User {
  // Свойства класса для хранения данных о пользователе
  private $id; // Идентификатор
  private $username; // Имя пользователя
  private $password_hash; // Хеш пароля
  private $email; // Электронная почта

  // Конструктор класса для инициализации свойств
  public function __construct($id, $username, $password_hash, $email) {
    $this->id = $id;
    $this->username = $username;
    $this->password_hash = $password_hash;
    $this->email = $email;
  }

  // Метод для регистрации нового пользователя в базе данных
  public static function register($username, $password, $email) {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для вставки нового пользователя в таблицу users
    $sql = "INSERT INTO users (username, password_hash, email) VALUES (:username, :password_hash, :email)";
    // Генерируем хеш пароля с помощью функции password_hash
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    // Выполняем запрос с параметрами имени пользователя, хеша пароля и электронной почты и получаем количество затронутых строк
    $affected_rows = $db->query($sql, [":username" => $username, ":password_hash" => $password_hash, ":email" => $email]);
    // Проверяем, была ли успешно добавлена запись в таблицу users
    if ($affected_rows == 1) {
      // Если да, то возвращаем true
      return true;
    } else {
      // Если нет, то возвращаем false
      return false;
    }
  }

  // Метод для входа пользователя в приложение с проверкой имени пользователя и пароля
  public static function login($username, $password) {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для получения пользователя из таблицы users по имени пользователя
    $sql = "SELECT * FROM users WHERE username = :username";
    // Выполняем запрос с параметром имени пользователя и получаем результат в виде массива
    $result = $db->query($sql, [":username" => $username]);
    // Проверяем, есть ли результат
    if ($result) {
      // Если есть, то берем первую строку из результата
      $row = $result[0];
      // Проверяем, совпадает ли хеш пароля в базе данных с хешем введенного пароля с помощью функции password_verify
      if (password_verify($password, $row["password_hash"])) {
        // Если да, то создаем объект класса User с данными из строки
        $user = new User($row["id"], 
                         $row["username"], 
                         $row["password_hash"], 
                         $row["email"]);
        // Возвращаем объект класса User
        return $user;
      } else {
        // Если нет, то возвращаем null
        return null;
      }
    } else {
      // Если нет, то возвращаем null
      return null;
    }
  }

  // Метод для получения id пользователя
  public function getId() {
    // Возвращаем свойство id объекта класса User
    return $this->id;
  }

  // Метод для получения имени пользователя
  public function getUsername() {
    // Возвращаем свойство username объекта класса User
    return $this->username;
  }

  // Метод для получения электронной почты пользователя
  public function getEmail() {
    // Возвращаем свойство email объекта класса User
    return $this->email;
  }
}
?>
