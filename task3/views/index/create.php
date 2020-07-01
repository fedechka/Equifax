<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Index */

$this->title = 'Create Index';
$this->params['breadcrumbs'][] = ['label' => 'Indices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="index-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
