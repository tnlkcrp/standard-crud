<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Book;

/**
 * BookSearch represents the model behind the search form of `app\models\Book`.
 */
class BookSearch extends Book
{
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
        $query = Book::find()
            ->alias('b');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'b.id' => $this->id,
            'b.user_id' => $this->user_id,
        ]);

        if (!empty($this->author_id)) {
            $query->innerJoin(['atb' => AuthorToBook::tableName()], [
                'AND',
                'b.id = atb.book_id',
                ['atb.author_id' => $this->author_id],
            ]);
        }

        $query->andFilterWhere(['like', 'b.title', $this->title])
            ->andFilterWhere(['like', 'b.description', $this->description])
            ->andFilterWhere(['like', 'b.genre', $this->genre])
            ->andFilterWhere(['like', 'b.tag', $this->tag]);

        return $dataProvider;
    }
}
