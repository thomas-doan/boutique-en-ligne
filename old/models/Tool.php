<?php

class Tool
{

    public static function util(array $params)
    {
        $sql = "";

        foreach ($params as $value) {
            $sql .= "$value = :$value, ";
        }
        $sql = substr($sql, 0, -2);
        return $sql;
    }
}
