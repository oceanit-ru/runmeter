<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\db\SceneButton;
use common\models\db\SceneButtonTranslation;

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
			[['sceneButtonId', 'sceneId', 'action', 'answerTextButtonId', 'segueLocationId', 'segueSceneId', 'cost'], 'integer'],
			[['text', 'createdAt', 'updateAt'], 'safe'],
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
		$query = SceneButton::find()->leftJoin(SceneButtonTranslation::tableName(), SceneButtonTranslation::tableName() . '.sceneButtonId = ' . SceneButton::tableName() . '.sceneButtonId');

		// add conditions that should always apply here

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);

		// grid filtering conditions
		$query->andFilterWhere([
			SceneButton::tableName() . '.sceneButtonId' => $this->sceneButtonId,
			SceneButton::tableName() . '.sceneId' => ($sceneId !== null) ? $sceneId : $this->sceneId,
			SceneButton::tableName() . '.action' => $this->action,
			SceneButton::tableName() . '.segueLocationId' => $this->segueLocationId,
			SceneButton::tableName() . '.segueSceneId' => $this->segueSceneId,
			SceneButton::tableName() . '.cost' => $this->cost,
			SceneButton::tableName() . '.createdAt' => $this->createdAt,
			SceneButton::tableName() . '.updateAt' => $this->updateAt,
			SceneButton::tableName() . '.answerTextButtonId' => $this->answerTextButtonId
		]);

		$query->andFilterWhere(['like', SceneButtonTranslation::tableName() . '.text', $this->text]);

		return $dataProvider;
	}

}
