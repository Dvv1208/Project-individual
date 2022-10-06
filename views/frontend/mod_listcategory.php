<?php
use App\models\category;
$listcategory1=Category::where([['ParentId','=','0'],['Status','=','1']])
->orderBy('Orders','asc')
->get();
?>
<ul class="list-group mb-2">
    <h3 class="list-group-item active">Danh mục sản phẩm</h3>
    <?php foreach($listcategory1 as $rowcat1):?>
    <?php
        $listcategory2=Category::where([['ParentId','=',$rowcat1['Id']],['Status','=','1']])
        ->orderBy('Orders','asc')
        ->get();
    ?>
    <?php if(count($listcategory2)!=0):?>
    <li class="list-group-item">
        <ul class="">
            <a class="nav-link dropdown-toggle text-dark" href="" id="navbarDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false"
                href="index.php?option=product&cat=<?php echo $rowcat1['Slug'];?>"><?php echo $rowcat1['Name'];?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php foreach($listcategory2 as $rowcat2):?>
                <li class="list-group-item">
                    <a class="dropdown-item"
                        href="index.php?option=product&id=<?php echo $rowcat2['Slug'];?>"><?php echo $rowcat2['Name'];?></a>
                </li>
                <?php endforeach;?>
            </ul>
        </ul>
    </li>
    <?php else:?>
    <li class="list-group-item">
        <a href="index.php?option=product&cat=<?php echo $rowcat1['Slug'];?>"><?php echo $rowcat1['Name'];?></a>
    </li>
    <?php endif;?>
    <?php endforeach;?>
</ul>