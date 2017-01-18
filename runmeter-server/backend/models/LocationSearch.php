<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\db\Location;
use common\models\db\LocationTranslation;

/**
 * LocationSearch represents the model behind the search form about `common\models\db\Location`.
 */
class LocationSearch extends Location
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['locationId', 'screenplayId', 'number'], 'integer'],
            [['name', 'image', 'createdAt', 'updateAt'], 'safe'],
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
    public function search($params, $screenplayId = null)
    {		
		$query = Location::find()->leftJoin(LocationTranslation::tableName(), LocationTranslation::tableName() . '.locationId = ' . Location::tableName() . '.locationId');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        // grid filtering conditions
        $query->andFilterWhere([
            Location::tableName() . '.locationId' => $this->locationId,
			Location::tableName() . '.screenplayId' => isset($screenplayId) ? $screenplayId : $this->screenplayId,
            Location::tableName() . '.number' => $this->number,
            Location::tableName() . '.createdAt' => $this->createdAt,
            Location::tableName() . '.updateAt' => $this->updateAt,
        ]);

        $query->andFilterWhere(['like', LocationTranslation::tableName() . '.name', $this->name])
            ->andFilterWhere(['like', Location::tableName() . '.image', $this->image]);

        return $dataProvider;
    }
}
