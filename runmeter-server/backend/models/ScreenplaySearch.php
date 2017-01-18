<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\db\Screenplay;
use common\models\db\ScreenplayTranslation;

/**
 * ScreenplaySearch represents the model behind the search form about `common\models\db\Screenplay`.
 */
class ScreenplaySearch extends Screenplay
{

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['screenplayId'], 'integer'],
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
	public function search($params)
	{
		$query = Screenplay::find()->leftJoin(ScreenplayTranslation::tableName(), ScreenplayTranslation::tableName() . '.screenplayId = ' . Screenplay::tableName() . '.screenplayId');

		// add conditions that should always apply here

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);


		// grid filtering conditions
		$query->andFilterWhere([
			Screenplay::tableName() . '.screenplayId' => $this->screenplayId,
			Screenplay::tableName() . '.createdAt' => $this->createdAt,
			Screenplay::tableName() . '.updateAt' => $this->updateAt,
		]);

		$query->andFilterWhere(['like', ScreenplayTranslation::tableName() . '.name', $this->name]);

		return $dataProvider;
	}

}
