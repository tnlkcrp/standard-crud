<?php

use app\models\Author;
use app\models\Book;
use app\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            [
                'attribute' => 'name',
                'value' => function (Book $book) {
                    return Html::encode($book->getAuthorsString());
                },
                'filter' => Select2::widget([
                    'name' => 'name',
                    'data' => ArrayHelper::map(
                        Author::find()->asArray()->all(),
                        'name',
                        'name'
                    ),
                    'value' => $searchModel->name,
                    'options' => [
                        'class' => 'form-control',
                        'placeholder' => 'Author',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'selectOnClose' => true,
                    ]
                ])
            ],
            'genre',
            [
                'attribute' => 'user_id',
                'value' => function (Book $book) {
                    return Html::encode($book->user->username);
                },
                'filter' => Select2::widget([
                    'name' => 'user_id',
                    'data' => ArrayHelper::map(
                        User::find()->asArray()->all(),
                        'id',
                        'username'
                    ),
                    'value' => $searchModel->user_id,
                    'options' => [
                        'class' => 'form-control',
                        'placeholder' => 'Created by'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'selectOnClose' => true,
                    ]
                ])
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
