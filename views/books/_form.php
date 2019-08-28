<?php

use app\models\Author;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'author_id')->widget(Select2::class, [
        'data' => ArrayHelper::map( // @todo: ajax search
            Author::find()->asArray()->all(),
            'id',
            'name'
        ),
        'options' => [
            'class' => 'form-control',
            'placeholder' => 'Select Author',
            'multiple' => true,
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'selectOnClose' => true,
        ]
    ]) ?>
    <?= $form->field($model, 'genre')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tag')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
