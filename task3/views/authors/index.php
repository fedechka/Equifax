<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use kartik\datecontrol\DateControl;

$this->title = 'Authors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authors-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Authors', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'id',
                'options' => ['width' => '60'],
            ],
            'name',
            [
            'attribute' => 'date_birth',
            'format' => 'date',
            'filter' => DateControl::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_birth',
                    'autoWidget' => true,
                    'type' => DateControl::FORMAT_DATE,
                ])
            ],
            'biography:ntext',
            'books_count',
            [
                'attribute' => 'date_create',
                'format' => 'datetime',
                'filter' => DateControl::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_create',
                    'autoWidget' => true,
                    'type' => DateControl::FORMAT_DATETIME,
                ])
            ],
            [
                'attribute' => 'date_change',
                'format' => 'datetime',
                'filter' => DateControl::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_change',
                    'autoWidget' => true,
                    'type' => DateControl::FORMAT_DATETIME,
                ])
            ],
            ['class' => 'yii\grid\ActionColumn']
        ],
    ]); ?>


</div>
