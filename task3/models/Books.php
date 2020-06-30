<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $name
 * @property int|null $date_manuf
 * @property int $author_id
 * @property string|null $date_create
 * @property string|null $date_change
 *
 * @property Authors $author
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'author_id'], 'required'],
            [['date_manuf', 'author_id'], 'integer'],
            [['date_create', 'date_change'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Authors::className(), 'targetAttribute' => ['author_id' => 'id']],
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
            'date_manuf' => 'Date Manuf',
            'author_id' => 'Author ID',
            'date_create' => 'Date Create',
            'date_change' => 'Date Change',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery|AuthorsQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
    }

    /**
     * {@inheritdoc}
     * @return BooksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BooksQuery(get_called_class());
    }
}
