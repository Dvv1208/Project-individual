<?php

$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'sort_date';

switch ($sort) {
    case 'sort_neighborhood':
        $order_by = 'Neighborhood ASC';
        break;
    case 'sort_method':
        $order_by = 'Method ASC';
        break;
    case 'sort_category':
        $order_by = 'Category ASC';
        break;
    case 'sort_price':
        $order_by = 'Price ASC';
        break;
    case 'sort_condition':
        $order_by = 'Condit ASC';
        break;
    case 'sort_date':
        $order_by = 'Date ASC';
        break;
    default:
        $order_by = 'Date DESC';
        $sort = 'sort_date';
        break;
}
