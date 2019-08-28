<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * BookSearch represents the model behind the search form of `app\models\Book`.
 */
class BookSearch extends Book
{
    /**
     * Author name - for sorting purposes, equals to column name
     * @var string
     */
    public $name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [
                [
                    'title',
                    'description',
                    'genre',
                    'tag',
                    'author_id',
                    'name',
                ],
                'safe'
            ],
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
        $query = Book::find()->distinct();
        $query->joinWith('authors', true);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => ['genre', 'name', 'title']],
            'pagination' => [
                'defaultPageSize' => \Yii::$app->params['pageSize'],
            ],
        ]);

        $this->load($params);
        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
        ]);

        if (!empty($this->name)) {
            $query->andFilterWhere(['name' => $this->name]);
        }

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'genre', $this->genre])
            ->andFilterWhere(['like', 'tag', $this->tag]);

        return $dataProvider;
    }
}
