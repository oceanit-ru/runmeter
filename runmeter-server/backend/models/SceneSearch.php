<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\db\Scene;
use common\models\db\SceneTranslation;

/**
 * SceneSearch represents the model behind the search form about `common\models\db\Scene`.
 */
class SceneSearch extends Scene
{

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['sceneId', 'locationId', 'number', 'displayedButtonCount'], 'integer'],
			[['name', 'createdAt', 'updateAt'], 'safe'],
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
	public function search($params, $locationId = null)
	{

		$query = Scene::find()->leftJoin(SceneTranslation::tableName(), SceneTranslation::tableName() . '.sceneId = ' . Scene::tableName() . '.sceneId');

		// add conditions that should always apply here

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);

		// grid filtering conditions
		$query->andFilterWhere([
			Scene::tableName() . '.sceneId' => $this->sceneId,
			Scene::tableName() . '.locationId' => isset($locationId) ? $locationId : $this->locationId,
			Scene::tableName() . '.number' => $this->number,
			Scene::tableName() . '.displayedButtonCount' => $this->displayedButtonCount,
			Scene::tableName() . '.createdAt' => $this->createdAt,
			Scene::tableName() . '.updateAt' => $this->updateAt,
		]);

		$query->andFilterWhere(['like', SceneTranslation::tableName() . '.name', $this->name]);

		return $dataProvider;
	}

}
