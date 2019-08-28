<?php

namespace app\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $user_id
 * @property string $genre
 * @property string $tag
 *
 * @property Author[] $authors
 * @property AuthorToBook[] $authorsToBooks
 * @property User $user
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @var array
     */
    public $author_id = [];

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
            [
                ['title', 'description', 'genre', 'user_id', 'author_id'],
                'required',
            ],
            [['description'], 'string'],
            [['user_id'], 'integer'],
            [['title', 'genre', 'tag'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [
                ['user_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['user_id' => 'id']
            ],
            ['author_id', 'each', 'rule' => ['integer']]
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return array_merge(parent::attributes(), ['author_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'user_id' => 'Created By',
            'genre' => 'Genre',
            'tag' => 'Tag',
            'author_id' => 'Author'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorsToBooks()
    {
        return $this->hasMany(AuthorToBook::class, ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])
            ->viaTable(AuthorToBook::tableName(), ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @param string $delimiter
     * @return string
     */
    public function getAuthorsString($delimiter = ', ')
    {
        return join(
            $delimiter,
            ArrayHelper::getColumn($this->authors, 'name')
        );
    }
}
