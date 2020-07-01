<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Authors;

/**
 * AuthorsSearch represents the model behind the search form of `app\models\Authors`.
 */
class AuthorsSearch extends Authors
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'date_birth', 'biography', 'books_count',  'date_create', 'date_change'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $subQuery = Authors::find()
            ->select(['{{%authors}}.*', 'books_count' => new \yii\db\Expression('COUNT({{%books}}.id)')])
            ->joinWith(['books'])
            ->groupBy('{{%authors}}.id');

        $query = Authors::find()->from($subQuery);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['books_count'] = [
            'asc' => ['books_count' => SORT_ASC],
            'desc' => ['books_count' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date_birth' => $this->date_birth,
            'books_count' => $this->books_count,
            'date_create' => $this->date_create,
            'date_change' => $this->date_change,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'biography', $this->biography]);

        return $dataProvider;
    }
}
