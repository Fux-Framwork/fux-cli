<?php

namespace FuxCli\Utils;

class LocalDB
{

    private static $connection = null;
    private static $sqlite_error = null;

    public static function getDbFile()
    {
        return getcwd() . "/db/.idx.db";
    }

    /**
     * @throws \Exception
     */
    public static function ref()
    {
        if (self::$connection) return self::$connection;

        self::$connection = sqlite_open(self::getDbFile(), 0666, self::$sqlite_error);
        if (!self::$connection) throw new \Exception("Failed to connect to DB");
        return self::$connection;
    }

    public static function init()
    {
        $sql = "
            CREATE TABLE executed_vcs IF NOT EXISTS (
                filepath varchar(255) primary key,
                executed_at varchar(20),
                add index filepath
            )
        ";
        sqlite_query(self::ref(), $sql);
        if (self::$sqlite_error) throw new \Exception(self::$sqlite_error);
        return true;
    }

    public static function markFile($path)
    {
        self::init();
        $ts = date('Y-m-d H:i:s');
        $q = sqlite_query(self::ref(), "INSERT INTO executed_vcs ('$path', '$ts')");
        if (self::$sqlite_error) throw new \Exception(self::$sqlite_error);
        return true;
    }

    public static function isFileMarked($path)
    {
        self::init();
        $q = sqlite_query(self::ref(), "SELECT * FROM executed_vcs WHERE path = '$path'");
        if (self::$sqlite_error) throw new \Exception(self::$sqlite_error);
        $row = sqlite_fetch_array($q);
        return !!$row;
    }


}