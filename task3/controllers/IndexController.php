<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Authors;

class IndexController extends \yii\web\Controller
{
    public $authors;
    /**
     * Lists all Books models.
     * @return mixed
     */
    public function actionIndex()
    {
        $authors = Authors::find()->with('books')->all();
        $this->authors = $authors;
        return $this->render('index', compact('authors'));
    }
}
