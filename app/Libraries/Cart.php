<?php

namespace App\Libraries;

class Cart
{
    //addCart
    public static function addCart($row)
    {
        if (is_array($row)) {
            if (isset($_SESSION['cart'])) {
                $cart = $_SESSION['cart'];
                $key = self::cart_exist($cart, $row['Id']);
                if ($key != -1) {
                    $cart[$key]['qty']++;
                } else {
                    $cart[] = $row;
                }
            } else {
                $cart[] = $row;
            }
            $_SESSION['cart'] = $cart;
        }
        var_dump($_SESSION['cart']);
    }
    public static function cart_exist($cart, $id)
    {
        foreach ($cart as $key => $val) {
            if ($val['Id'] == $id) {
                return $key;
            }
        }
        return -1;
    }

    public static function removeCart($id)
    {
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            $key = self::cart_exist($cart, $id);
            if ($key != -1) {
                unset($cart[$key]);
                if (count($cart) == 0) {
                    unset($_SESSION['cart']);
                    return null;
                }
            }
            $_SESSION['cart'] = $cart;
        } else {
            return null;
        }
    }

    public static function updateCart($row, $id, $number)
    {
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            $key = self::cart_exist($cart, $id);
            $cart[$key]['qty'] = $number;
            $cart[$key]['amount'] = $cart[$key]['Price'] * $cart[$key]['qty'];
            if ($cart[$key]['qty'] == 0) {
                unset($cart[$key]);
            }
            $_SESSION['cart'] = $cart;
        } else {
            return null;
        }
    }

    public static function contentCart()
    {
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            return $cart;
        }
        return null;
    }

    public static function totalCart()
    {
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            return $cart;
        }
        return null;
    }

    public static function addToCart($row)
    {
        if (is_array($row)) {
            if (isset($_SESSION['cart'])) {
                $cart = $_SESSION['cart'];
                $key = self::cart_exist($cart, $row['Id']);
                if ($key != -1) {
                    $cart[$key]['qty']++;
                } else {
                    $cart[] = $row;
                }
            } else {
                $cart[] = $row;
            }
            $_SESSION['cart'] = $cart;
        }
        unset($cart);
    }
}
