<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

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
    public $author;
    
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
            [['name', 'date_manuf', 'author_id'], 'required'],
            [['author_id'], 'integer'],
            [['author', 'date_manuf', 'date_create', 'date_change'], 'safe'],
            [['author', 'name'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Authors::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['author'], 'exist', 'skipOnError' => true, 'targetClass' => Authors::className(), 'targetAttribute' => ['name' => 'author']],
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
            'author' => 'Author',
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
        return $this->hasOne(Authors::className(), ['author_id' => 'id']);
    }

    
    public function behaviors(){
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_create', 'date_change'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date_change'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
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
