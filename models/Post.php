<?php


class Post
{
    const SHOW_BY_DEFAULT = 5;
    const PAGE_COMMENT = 3;




    public static function getCountComments()
    {
        // Соединение с БД
        $db = DB::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT count(id) AS count FROM comments ';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);

        // Выполнение коменды
        $result->execute();

        // Возвращаем значение count - количество
        $row = $result->fetch();
        return $row['count'];
    }


    public static function getCommentsListPost($page = 1){


        $page = intval($page);
        $offset =($page - 1)*self::PAGE_COMMENT;

        $db = DB::getConnection();

        $result = $db->query('SELECT c.id, c.name, description, date, u.name AS user_name, email, u.id AS user_id FROM comments AS c '
            . 'JOIN user AS u ON c.user_id = u.id '
            . 'ORDER BY c.id DESC '
            . 'LIMIT '.self::PAGE_COMMENT
            . ' OFFSET '. $offset);

        $i = 0;
        $comments = array();
        while ($row = $result->fetch()){
            $comments[$i]['id'] = $row['id'];
            $comments[$i]['name'] = $row['name'];
            $comments[$i]['description'] = $row['description'];
            $comments[$i]['date'] = $row['date'];
            $comments[$i]['user_name'] = $row['user_name'];
            $comments[$i]['email'] = $row['email'];
            $comments[$i]['user_id'] = $row['user_id'];

            $i++;
        }

        return $comments;




    }

    public static function getCommentsListDate($date){



        $db = DB::getConnection();
        $comments = array();
        $result = $db->query('SELECT c.id, c.name, description, date, u.name AS user_name, email, u.id AS user_id FROM comments AS c '
                        . 'JOIN user AS u ON c.user_id = u.id '
                        . "WHERE `date` = " ."'{$date}'"
                        );
        $i = 0;
        while ($row = $result->fetch()) {
            $comments[$i]['id'] = $row['id'];
            $comments[$i]['name'] = $row['name'];
            $comments[$i]['description'] = $row['description'];
            $comments[$i]['date'] = $row['date'];
            $comments[$i]['user_name'] = $row['user_name'];
            $comments[$i]['email'] = $row['email'];
            $comments[$i]['user_id'] = $row['user_id'];

            $i++;
        }

        return $comments;

    }

    public static function getCommentsListName($nameId){



        $db = DB::getConnection();
        $comments = array();
        $result = $db->query('SELECT c.id, c.name, description, date, u.name AS user_name, email, u.id AS user_id FROM comments AS c '
            . 'JOIN user AS u ON c.user_id = u.id '
            . "WHERE `user_id` = " ."'{$nameId}'"
        );
        $i = 0;
        while ($row = $result->fetch()) {
            $comments[$i]['id'] = $row['id'];
            $comments[$i]['name'] = $row['name'];
            $comments[$i]['description'] = $row['description'];
            $comments[$i]['date'] = $row['date'];
            $comments[$i]['user_name'] = $row['user_name'];
            $comments[$i]['email'] = $row['email'];
            $comments[$i]['user_id'] = $row['user_id'];

            $i++;
        }

        return $comments;

    }

    public static function updatePhotoId($id)
    {
        // Соединение с БД
        $db = DB::getConnection();
        $result = $db->query("UPDATE comments SET photo = ". "\"$id.jpg\" "
            . 'WHERE id ="'.$id.'"');
        $result->fetch();
    }

    public static function createComments($name, $description, $date, $userId)
    {
        // Соединение с БД
        $db = DB::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO comments (name, description, date, user_id) '
            . 'VALUES (:name, :description, :date, :user_id)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':date', $date, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }

    public static function getCommentList()
    {
        // Соединение с БД
        $db = DB::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT * FROM comments ORDER BY id ASC');
        $comments = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $comments[$i]['id'] = $row['id'];
            $comments[$i]['name'] = $row['name'];
            $comments[$i]['photo'] = $row['photo'];

            $i++;
        }
        return $comments;
    }


    public static function createComment($options)
    {
        // Соединение с БД
        $db = DB::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO comments (name, description, date, user_id)'
            . 'VALUES (:name, :description, :date, :user_id)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':date', $options['date'], PDO::PARAM_STR);
        $result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);

        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }

    public static function updateCommById($id, $options)
    {
        // Соединение с БД
        $db = DB::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE comments
            SET
                name = :name,
                description = :description,
                date = :date,
                user_id = :user_id
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':date', $options['date'], PDO::PARAM_STR);

        return $result->execute();
    }

    public static function getCommentsId ($id){
        $id = intval($id);

        if($id) {
            $db = DB::getConnection();
            $result = $db->query('SELECT * FROM `comments` WHERE id=' .$id);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            return $result->fetch();
        }

    }

    public static function deleteCommById($id)
    {
        // Соединение с БД
        $db = DB::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM comments WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getAvailabilityStatus($stat)
    {
        switch ($stat) {
            case '1':
                return 'Есть';
                break;
            case '0':
                return 'Нет';
                break;
        }
    }


    public static function getImage($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с post
        $path = '/upload/images/posts/';

        // Путь к изображению post
        $pathToPostImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToPostImage)) {
            // Если изображение для post существует
            // Возвращаем путь изображения post
            return $pathToPostImage;
        }

        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }



    public static function getComments($postId)
    {
        // Соединение с БД
        $db = DB::getConnection();

        // Текст запроса к БД
        $sql = "SELECT * FROM comments WHERE post_id = " . $postId;

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':post_id', $postId, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполняем запрос
        $result->execute();

        // Возвращаем данные
        $commentsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $commentsList[$i]['id'] = $row['id'];
            $commentsList[$i]['name'] = $row['name'];
            $commentsList[$i]['description'] = $row['description'];
            $commentsList[$i]['post_id'] = $row['post_id'];
            $i++;
        }
        return $commentsList;
    }

    public static function checkComments($name)
    {
        // Соединение с БД
        $db = DB::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT * FROM comments WHERE name = :name';
        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_INT);
        $result->execute();
        // Обращаемся к записи
        $commentId= $result->fetch();
        if ($commentId) {
            // Если запись существует, возвращаем id пользователя
            return $commentId['id'];
        }
        return false;
    }





    public static function authPost($commentId)
    {


        $_SESSION['id'] = $commentId;
    }



}