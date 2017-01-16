<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\db\SceneButton;

/**
 * SceneButtonSearch represents the model behind the search form about `common\models\db\SceneButton`.
 */
class SceneButtonSearch extends SceneButton
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sceneButtonId', 'sceneId', 'action', 'segueLocationId', 'segueSceneId', 'cost'], 'integer'],
            [['text', 'answer', 'createdAt', 'updateAt'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
    public function search($params, $sceneId = null)
    {
        $query = SceneButton::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'sceneButtonId' => $this->sceneButtonId,
            'sceneId' => ($sceneId !== null) ? $sceneId : $this->sceneId,
            'action' => $this->action,
            'segueLocationId' => $this->segueLocationId,
            'segueSceneId' => $this->segueSceneId,
            'cost' => $this->cost,
            'createdAt' => $this->createdAt,
            'updateAt' => $this->updateAt,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'answer', $this->answer]);

        return $dataProvider;
    }
}
