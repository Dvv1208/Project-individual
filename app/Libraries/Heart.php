<?php

namespace App\Libraries;

class Heart
{
    public static function addHeart($row)
    {
        if (is_array($row)) {
            if (isset($_SESSION['heart'])) {
                $heart = $_SESSION['heart'];
                $key = self::heart_exist($heart, $row['Id']);
                if ($key != -1) {
                    $heart[$key]['qty']++;
                } else {
                    $heart[] = $row;
                }
            } else {
                $heart[] = $row;
            }
            $_SESSION['heart'] = $heart;
        }
    }
    public static function heart_exist($heart, $id)
    {
        foreach ($heart as $key => $val) {
            if ($val['Id'] == $id) {
                return $key;
            }
        }
        return -1;
    }

    public static function removeHeart($id)
    {
        if (isset($_SESSION['heart'])) {
            $heart = $_SESSION['heart'];
            $key = self::heart_exist($heart, $id);
            if ($key != -1) {
                unset($heart[$key]);
                if (count($heart) == 0) {
                    unset($_SESSION['heart']);
                    return null;
                }
            }
            $_SESSION['heart'] = $heart;
        } else {
            return null;
        }
    }

    public static function updateHeart($row)
    {
        if (isset($_SESSION['heart'])) {
            $heart = $_SESSION['heart'];
            $key = self::heart_exist($heart, $row['Id']);
            if ($key != -1) {
                $heart[$key]['qty'] = $row;
                $heart[$key]['Pricesale'] = $row['Pricesale'];
                $heart[$key]['amount'] = $row['amount'];
            }
            if ($heart[$key]['qty'] == 0) {
                unset($heart[$key]);
            }
            $_SESSION['heart'] = $heart;
        } else {
            return null;
        }
    }

    public static function contentHeart()
    {
        if (isset($_SESSION['heart'])) {
            $heart = $_SESSION['heart'];
            return $heart;
        }
        return null;
    }

    public static function totalHeart()
    {
        if (isset($_SESSION['heart'])) {
            $heart = $_SESSION['heart'];
            return $heart;
        }
        return null;
    }

}
