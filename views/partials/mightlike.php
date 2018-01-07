<?
use yii\widgets\LinkPager;
use yii\helpers\Url;
?>
<div class="items">
    <?foreach ($mightlike as $one):?>
        <div class="single-item">
            <a href="<?=Url::toRoute(['site/view', 'id'=>$one->id]) ?>">
                <img style="width: 400px;height: 250px;" src="<?=$one->getImage();?>" alt="">

                <p><?=$one->title?></p>
            </a>
        </div>
    <?php endforeach;?>
</div>