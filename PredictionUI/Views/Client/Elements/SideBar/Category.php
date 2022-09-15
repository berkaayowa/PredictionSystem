<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head">
        <i class="icon fa fa-align-justify fa-fw"></i> Categories
    </div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">
            <?php foreach(\Rep::GetCategories() as $category): ?>
                <li class="">
                    <a href="/products/index/<?=$category['CatName']?>/?cat=<?=$category['CatID']?>">
                        <i class="icon <?=$category['CatIcon']?>" aria-hidden="true"></i>
                        <?=$category['CatName']?>
                    </a>
                </li>
            <?php endforeach ?>
        </ul>
    </nav>
</div>
<!--open-->
