<?php


class DB
{
    public static function getConnection(){
        $paramsPath = ROOT.'/config/db_news.php';
        $params = include ($paramsPath);

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);
        $db->exec('set names utf8');
        return $db;
    }

}