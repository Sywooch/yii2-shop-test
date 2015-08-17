<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Nav;
use yii\widgets\Menu;
//use yii\imagine\Image;
use Gregwar\Image\Image;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */
/* @var $menu_items_product array */
/* @var $menu_items_category array */
/* @var $items_product app\modules\admin\models\Product; */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Телефоны', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->keywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $model->description]);
?>
<div class="category-view">
    <div class="row">
        <div class="col-md-3">
            <?php
            echo Nav::widget([
                'options' => ['class' => 'nav-pills nav-stacked'],
                'items' => $menu_items_category,
            ]);
            ?>

            <h3>Товары</h3>
            <?php
            echo Menu::widget([
                'options' => ['class' => 'nav nav-pills nav-stacked'],
                'items' => $menu_items_product,
            ]);
            ?>
        </div>
        <div class="col-md-9">
            <h1><?= Html::encode($this->title) ?></h1>
            <div class="row">
                <div class="col-md-4">
                    <a class="colorbox" href="<?= Image::open($model->image)->resize(700, 700)->jpeg(100) ?>">
                        <img src="<?= Image::open($model->image)->resize(250, 300)->jpeg() ?>" >
                    </a>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <p><?= $model->content ?></p>
                            <p><?= $model->description ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <br /><br />
                <? foreach ($items_product as $product): ?>
                    <div class="col-sm-4">
                        <div class="ec-box">
                            <div class="ec-box-header">
                                <a href="<?= Url::to(['product/view', 'alias' => $product->alias]) ?>"><?= $product->name ?></a>
                            </div>
                            <a href="<?= Url::to(['product/view', 'alias' => $product->alias]) ?>">
                                <img src="<?= Image::open($product->image)->resize(Yii::$app->params['thumbnail_size']['w'], Yii::$app->params['thumbnail_size']['h'])->jpeg() ?>" alt="<?= $product->name ?>">
                            </a><br />

                            <div class="ec-box-footer">
                                <span class="label label-primary">
                                    <? echo $product->price ? $product->price . ' руб.' : 'Цена по запросу' ?>
                                </span>
                                <a href="<?= Url::to(['product/view', 'alias' => $product->alias]) ?>">
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
        </div>
    </div>
</div>
