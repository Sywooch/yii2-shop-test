<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Nav;
use yii\widgets\Menu;
//use yii\imagine\Image;
use Gregwar\Image\Image;
//use himiklab\colorbox\Colorbox; //подключил в layout

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $menu_items_product array*/
/* @var $menu_items_category array*/

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Телефоны', 'url' => ['category/index']];
$this->params['breadcrumbs'][] = ['label' => $model->category->name, 'url' => ['category/view','alias' => $model->category->alias]];
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->keywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $model->description]);
?>
<div class="product-view">  
    <?
    //эти характеристики выводим таблицой
    $attributes_table = [
        'screen_size',
        'os',
        'standart',
    ];
    ?>
    <div class="row">
        <div class="col-md-3">
            <?php
                echo Menu::widget([
                    'options' => ['class' => 'nav nav-pills nav-stacked'],
                    'items' => $menu_items_product,
                ]);
            ?>
            <h3>Категории</h3>
            <?php
                echo Nav::widget([
                    'options' => ['class' => 'nav-pills nav-stacked'],
                    'items' => $menu_items_category,
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
                            <h3>Супер цена: <span><? echo $model->price ? $model->price . ' руб.' : 'По запросу' ?></span></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Технические характеристики:</h4>
                            <table class="table table-striped table-bordered detail-view">
                                <? foreach ($attributes_table as $attribute): ?>
                                    <?if($model->$attribute):?>
                                        <tr><th><?= $model->getAttributeLabel($attribute) ?></th><td><?= $model->$attribute ?></td></tr>
                                    <?endif?>
                                <? endforeach ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="right-line">Описание:</h3>
                    <?= $model->description ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="right-line">Описание 2</h3>
                    <p><?= $model->content ?></p>
                </div>
            </div>
        </div>
    </div>
</div>