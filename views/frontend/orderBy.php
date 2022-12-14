<?php

use App\Models\Product;

switch (isset($_POST['action'])) {
    case 'maxprice':
        break;
    case 'minprice':
        break;
    case 'atoz':
        break;
    case 'ztoa':
        break;
    case 'onetofour':
        break;
    case 'fourtoeight':
        break;
    case 'toeight':
        break;
}
// if (isset($_POST["maxprice"])) {
//     $price_desc = Product::where('Status', '=', '1')
//         ->orderBy('Price', 'desc')
//         ->get();
// }
// if (isset($_POST["minprice"])) {
//     $price_desc = Product::where('Status', '=', '1')
//         ->orderBy('Price', 'desc')
//         ->get();
// }
if (isset($_POST["atoz"])) {
    
}
// if (isset($_POST["ztoa"])) {
//     $name_desc = Product::where('Status', '=', '1')
//         ->orderBy('Name', 'desc')
//         ->get();
// }
// if (isset($_POST["onetofour"])) {
//     $price_desc = Product::where('Status', '=', '1')
//         ->orderBy('Price', 'desc')
//         ->get();
// }
// if (isset($_POST["fourtoeight"])) {
//     $price_desc = Product::where('Status', '=', '1')
//         ->orderBy('Price', 'desc')
//         ->get();
// }
// if (isset($_POST["toeight"])) {
//     $price_desc = Product::where('Status', '=', '1')
//         ->orderBy('Price', 'desc')
//         ->get();
// }
