<?php
// Класс Database для подключения к базе данных, выполнения запросов с параметрами и закрытия подключения
class Database {
  // Свойства класса для хранения данных о подключении
  private $host = "localhost"; // Имя хоста
  private $db_name = "serialize"; // Имя базы данных
  private $username = "root"; // Имя пользователя
  private $password = ""; // Пароль
  private $conn; // Переменная для хранения объекта PDO

  // Метод для подключения к базе данных
  public function connect() {
    // Обнуляем переменную подключения
    $this->conn = null;
    try {
      // Создаем объект PDO с данными о подключении
      $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
      // Устанавливаем режим исключений для обработки ошибок
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      // Выводим сообщение об ошибке, если не удалось подключиться
      echo "Connection failed: " . $e->getMessage();
    }
    // Возвращаем объект PDO
    return $this->conn;
  }

  // Метод для выполнения запроса к базе данных с параметрами
  public function query($sql, $params) {
    // Подключаемся к базе данных
    $conn = $this->connect();
    try {
      // Создаем подготовленный запрос с помощью объекта PDO
      $stmt = $conn->prepare($sql);
      // Выполняем запрос с переданными параметрами
      $stmt->execute($params);
      // Возвращаем результат в виде ассоциативного массива
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
      // Выводим сообщение об ошибке, если не удалось выполнить запрос
      echo "Query failed: " . $e->getMessage();
    }
    // Закрываем подключение к базе данных
    $conn = null;
  }
}
?>
