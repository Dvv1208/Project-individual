<?php 
use App\Models\Menu;
$list_menu=Menu::where([['ParentId','=','0'],['Status','=','1']])
->orderBy('Orders','asc')->get();
?>
<nav class="navbar navbar-expand-lg bg-mainmenu">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php foreach($list_menu as $row_menu) : ?>
                    <?php 
                    $list_menu1 = Menu::where([['ParentId','=',$row_menu['Id']],['Status','=','1']])
                    ->orderBy('Orders','asc')->get();
                    if(count($list_menu1) != 0) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="<?php echo $row_menu['Link'] ?>"
                            id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $row_menu['Name'] ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php foreach($list_menu1 as $row_menu1) : ?>
                            <li><a class="dropdown-item"
                                    href="<?php echo $row_menu1['Link'] ?>"><?php echo $row_menu1['Name'] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link text-light"
                            href="<?php echo $row_menu['Link'] ?>"><?php echo $row_menu['Name'] ?></a>
                    </li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    
            </ul>
            <form  class="d-flex" action="index.php?option=search" role="search" method="post">
                <input id="keyword" name="keyword" class="form-control me-2" type="search" placeholder="Bạn cần tìm gì?" >
                <button class="btn btn-outline-success btn-light text-dark" type="submit">Tìm</button>
            </form>
        </div>
    </div>
</nav>