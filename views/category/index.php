<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\widgets\Menu;
//use yii\imagine\Image;
//use Gregwar\Image\Image;
use yii\widgets\LinkPager;
use \yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */
/* @var $items_product app\modules\admin\models\Product; */
/* @var $menu_items_product array */
/* @var $menu_items_category array */
/* @var $images array */


$this->title = 'Телефоны';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">
    <div class="row">
        <div class="col-md-3">
            <?php
            echo Nav::widget([
                'options' => ['class' => 'nav-pills nav-stacked'],
                'items' => $menu_items_category,
            ]);
            ?>
        </div>
        <div class="col-md-9">
            <h1><?= Html::encode($this->title) ?></h1>
            <?php Pjax::begin([
                'timeout' => 1500,
                'scrollTo' => 200,//скролл на колличество пикселей сверху
                ]); ?>
            <div class="row">
                <div class="col-md-12" style='padding-bottom:20px;'>
                    <div class="btn-group">
                        <?echo $sort->link('price');?>
                    </div>
                    
                </div>
                <? foreach ($items_product as $product): ?>
                    <div class="col-sm-4">
                        <div class="ec-box">
                            <div class="ec-box-header">
                                <a href="<?= Url::to(['product/view', 'alias' => $product->alias]) ?>" data-pjax="0"><?= $product->name ?></a>
                            </div>
                            <a href="<?= Url::to(['product/view', 'alias' => $product->alias]) ?>" data-pjax="0">
                                <!--img src="<?//= Image::open($product->image)->resize(Yii::$app->params['thumbnail_size']['w'], Yii::$app->params['thumbnail_size']['h'])->jpeg() ?>" alt="<?//= $product->name ?>"-->
                                <img src="<?if(is_object($images['items'][$product->id])) {
                                   echo $images['items'][$product->id]->getPath(Yii::$app->params['thumbnail_size']['w'].'x'.Yii::$app->params['thumbnail_size']['h']);
                                }else{
                                    echo $images['placeholder']->getPath(Yii::$app->params['thumbnail_size']['w'].'x'.Yii::$app->params['thumbnail_size']['h']);
                                }?>" alt="<?= $product->name ?>">
                            </a><br />

                            <div class="ec-box-footer">
                                <span class="label label-primary">
                                    <? echo $product->price ? $product->price . ' руб.' : 'Цена по запросу' ?>
                                </span>
                                <a href="<?= Url::to(['product/view', 'alias' => $product->alias]) ?>" data-pjax="0">
                                    <span class="btn-success btn-sm pull-right">Подробнее</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <? endforeach ?>
            </div>
            <div class="row">
                <?
                echo LinkPager::widget([
                    'pagination' => $pages,
                ]);
                ?>
            </div>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
