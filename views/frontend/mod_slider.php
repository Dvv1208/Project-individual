<?php
use App\Models\Slider;
$list_slider = Slider::where([['Position','=','slideshow'],['Status','=','1']])->orderBy('Orders', 'asc')->get();

?>

<div class="slider">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php $index = 1; ?>
            <?php foreach($list_slider as $row_slider): ?>
                <?php if($index==1) : ?>
                    <div class="carousel-item active ">
                        <img src="public/images/slider/<?php echo $row_slider['Img']; ?>" class="d-block w-100" alt="...">
                    </div>
                <?php else: ?>
                    <div class="carousel-item ">
                        <img src="public/images/slider/<?php echo $row_slider['Img']; ?>" class="d-block w-100" alt="...">
                    </div>
                <?php endif; ?>
                <?php $index++; ?>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>