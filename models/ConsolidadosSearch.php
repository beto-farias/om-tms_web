<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EntConsolidados;

/**
 * ConsolidadosSearch represents the model behind the search form about `app\models\EntConsolidados`.
 */
class ConsolidadosSearch extends EntConsolidados
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_consolidado', 'id_tipo_consolidado'], 'integer'],
            [['uddi', 'txt_nombre', 'fch_creacion'], 'safe'],
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
        $query = EntConsolidados::find();

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
            'id_consolidado' => $this->id_consolidado,
            'id_tipo_consolidado' => $this->id_tipo_consolidado,
            'fch_creacion' => $this->fch_creacion,
        ]);

        $query->andFilterWhere(['like', 'uddi', $this->uddi])
            ->andFilterWhere(['like', 'txt_nombre', $this->txt_nombre]);

        return $dataProvider;
    }
}
