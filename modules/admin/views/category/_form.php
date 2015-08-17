<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>
<?//var_dump($models)?>
<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'active')->checkbox(['id' => 'check']) ?>
    <?= $form->field($model, 'parent_category_id')->dropDownList(ArrayHelper::merge(['0' => '- Не выбрано'], ArrayHelper::map($models, 'id', 'name')));?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>
    
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
