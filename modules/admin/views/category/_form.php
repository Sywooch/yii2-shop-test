<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="category-form">

    <?php $form = ActiveForm::begin([
        'options' =>['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'active')->checkbox(['id' => 'check']) ?>
    <?= $form->field($model, 'parent_category_id')
        ->dropDownList(
            //при обновлении исключаем самого себя из списка выбора
            ArrayHelper::map(\app\modules\admin\models\Category::getListCategory(($model->isNewRecord)?[]:'id!='.$model->id), 'id', 'name'),
            ['prompt'=>'Не выбрано']
        );?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <div class="row">
                <?php
                //TODO пофиксить метод отображения картинок
                /*
                foreach ($model->getImages() as $image){

                    echo Html::tag('div', Html::img($image->getPath('200x200')),['class'=>'col-md-3']);

                }*/
                ?>
            </div>
            
        </div>
    </div>
    
    <?= $form->field($model, 'created')->widget(DatePicker::classname(),[
        'language' => 'ru',
        'dateFormat' => 'dd-MM-yyyy',
    ]) ?>
    <?= $form->field($model,'updated')->textInput(['maxlength' => true,'disabled' =>'disabled']) ?>
    <?= $form->field($model, 'content')->textArea(['rows'=>'15']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
