<?php

namespace backend\controllers;

use Yii;
use common\models\db\Scene;
use backend\models\SceneSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * ScenesController implements the CRUD actions for Scene model.
 */
class ScenesController extends Controller
{
	/**
	 * @inheritdoc
	 */
	public function beforeAction($action)
    {
        if (in_array($action->id, ['scenes'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
	
	
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}

	/**
	 * Lists all Scene models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new SceneSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
					'searchModel' => $searchModel,
					'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Scene model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		return $this->render('view', [
					'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new Scene model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate($locationId)
	{
		$model = new Scene();
		$model->locationId = $locationId;

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['locations/view', 'id' => $model->locationId]);
		} else {
			return $this->render('create', [
						'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Scene model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->sceneId]);
		} else {
			return $this->render('update', [
						'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Scene model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);
		$locationId = $model->locationId;
		$model->delete();

		return $this->redirect(['locations/view', 'id' => $locationId]);
	}

	/**
	 * Finds the Scene model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Scene the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Scene::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	// CITY LIST
	public function actionScenes()
	{
		$out = [];
		if (isset($_POST['depdrop_parents'])) {
			$parents = $_POST['depdrop_parents'];
			if ($parents != null) {
				$selected = '';
				$locationId = $parents[0];
				$sceneId = -1;
				if (!empty($_POST['depdrop_params'])) {
					$params = $_POST['depdrop_params'];
					$sceneId = $params['0']; // get the value of input-type-1
					$locationIdModel = $params['1']; // get the value of input-type-1
				}
				$scenes = ArrayHelper::map(Scene::find()->where(['locationId' => $locationId])->all(), 'sceneId', 'name');
				foreach ($scenes as $key => $value) {
					if (empty($selected) && isset($params)) {
						$selected = '' . $key;
					}
					$out[] = ['id' => $key, 'name' => $value];
					if (($key == $sceneId) && ($locationIdModel == $locationId)) {
						$selected = '' . $key;
					}
				}
				\Yii::error(Json::encode(['output' => $out, 'selected' => $selected]));
				// the getSubCatList function will query the database based on the
				// cat_id and return an array like below:
				// [
				//    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
				//    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
				// ]
				echo Json::encode(['output' => $out, 'selected' => $selected]);
				return;
			}
		}
		echo Json::encode(['output' => '', 'selected' => '']);
	}

}
