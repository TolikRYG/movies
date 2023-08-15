<?php
// Подключаем файлы с классами Database и User
require_once "database.php";
require_once "user.php";
// Класс Likes для работы с лайками фильмов и сериалов пользователя в базе данных
class Likes {
  // Метод для добавления лайка или дизлайка фильму или сериалу в базе данных
  public static function add($title, $type, $like, $user) {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для вставки лайка или дизлайка в таблицу likes по названию и типу фильма или сериала и id пользователя
    $sql = "INSERT INTO likes (title, type, like, user_id) VALUES (:title, :type, :like, :user_id)";
    // Выполняем запрос с параметрами названия, типа, лайка или дизлайка и id пользователя и получаем количество затронутых строк
    $affected_rows = $db->query($sql, [":title" => $title, ":type" => $type, ":like" => $like, ":user_id" => $user->getId()]);
    // Проверяем, была ли успешно добавлена запись в таблицу likes
    if ($affected_rows == 1) {
      // Если да, то возвращаем true
      return true;
    } else {
      // Если нет, то возвращаем false
      return false;
    }
  }

  // Метод для удаления лайка или дизлайка фильму или сериалу в базе данных
  public static function remove($title, $type, $user) {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для удаления лайка или дизлайка из таблицы likes по названию и типу фильма или сериала и id пользователя
    $sql = "DELETE FROM likes WHERE title = :title AND type = :type AND user_id = :user_id";
    // Выполняем запрос с параметрами названия, типа и id пользователя и получаем количество затронутых строк
    $affected_rows = $db->query($sql, [":title" => $title, ":type" => $type, ":user_id" => $user->getId()]);
    // Проверяем, была ли успешно удалена запись из таблицы likes
    if ($affected_rows == 1) {
      // Если да, то возвращаем true
      return true;
    } else {
      // Если нет, то возвращаем false
      return false;
    }
  }

  // Метод для получения количества лайков или дизлайков фильма или сериала в базе данных
  public static function getCount($title, $type, $like) {
    // Создаем объект класса Database
    $db = new Database();
    // Формируем SQL-запрос для получения количества лайков или дизлайков из таблицы likes по названию и типу фильма или сериала и значению лайка или дизлайка с помощью функции COUNT
    $sql = "SELECT COUNT(*) FROM likes WHERE title = :title AND type = :type AND like = :like";
    // Выполняем запрос с параметрами названия, типа и лайка или дизлайка и получаем результат в виде массива
    $result = $db->query($sql, [":title" => $title, ":type" => $type, ":like" => $like]);
    // Проверяем, есть ли результат
    if ($result) {
      // Если есть, то берем первую строку из результата
      $row = $result[0];
      // Возвращаем значение первого столбца как число
      return intval($row[0]);
    } else {
      // Если нет, то возвращаем ноль
      return 0;
    }
  }
}
?>
