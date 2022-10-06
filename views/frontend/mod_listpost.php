<?php
use App\models\Post;
$listpost1=Post::where([['Type','!=','0'],['Status','=','1']])
->get();
?>
<ul class="list-group mb-2">
    <h3 class="list-group-item active">Chủ đề bài viết</h3>
    <?php foreach($listpost1 as $rowpost1):?>
    <li class="list-group-item"><a
            href="index.php?option=post&id=<?php echo $rowpost1['Slug'];?>"><?php echo $rowpost1['Title'];?></a></li>
    <?php endforeach;?>
</ul>