<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string $name
 * @property string|null $date_birth
 * @property string $biography
 * @property string|null $date_create
 * @property string|null $date_change
 *
 * @property Books[] $books
 */
class Authors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'biography'], 'required'],
            [['date_birth', 'date_create', 'date_change'], 'safe'],
            [['biography'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'date_birth' => 'Date Birth',
            'biography' => 'Biography',
            'date_create' => 'Date Create',
            'date_change' => 'Date Change',
        ];
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery|BooksQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::className(), ['author_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return AuthorsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthorsQuery(get_called_class());
    }
}
