<?php

namespace backend\controllers;

use Yii;
use common\models\db\SceneButton;
use backend\models\SceneButtonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\db\ConditionVisitLocation;
use common\models\db\ConditionLoadScene;
use common\models\db\ConditionPressedButton;
use common\models\db\ConditionShowButton;
use kartik\grid\EditableColumnAction;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * SceneButtonsController implements the CRUD actions for SceneButton model.
 */
class SceneButtonsController extends PrivateController
{
	public function beforeAction($action)
    {
        if (in_array($action->id, ['scene-buttons'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		$behaviors = parent::behaviors();
		$behaviors['verbs'] = [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
					
					// Condition Visit Location
					'add-conditions-visit-location' => ['POST'],
					'delete-visit-vocation' => ['POST'],
					'edit-condition-visit-location' => [   // identifier for your editable action
						'class' => EditableColumnAction::className(), // action class name
						'modelClass' => ConditionVisitLocation::className(), // the update model class
						'method' => 'POST'
					],
					
					// Condition Load Scene
					'edit-condition-load-scene' => [   // identifier for your editable action
						'class' => EditableColumnAction::className(), // action class name
						'modelClass' => ConditionLoadScene::className(), // the update model class
						'method' => 'POST'
					],
					'add-conditions-load-scene' => ['POST'],
					
					// Condition Pressed Button
					'edit-condition-pressed-button' => [   // identifier for your editable action
						'class' => EditableColumnAction::className(), // action class name
						'modelClass' => ConditionPressedButton::className(), // the update model class
						'method' => 'POST'
					],
					'add-conditions-pressed-button' => ['POST'],
					
					// Condition Show Button
					'edit-condition-show-button' => [   // identifier for your editable action
						'class' => EditableColumnAction::className(), // action class name
						'modelClass' => ConditionShowButton::className(), // the update model class
						'method' => 'POST'
					],
					'add-conditions-show-button' => ['POST']
				],
			];
		return $behaviors;
	}

	/**
	 * Lists all SceneButton models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new SceneButtonSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
					'searchModel' => $searchModel,
					'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single SceneButton model.
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
	 * Creates a new SceneButton model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate($sceneId)
	{
		$model = new SceneButton();
		$model->sceneId = $sceneId;

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['scenes/view', 'id' => $model->sceneId]);
		} else {
			return $this->render('create', [
						'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing SceneButton model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->sceneButtonId]);
		} else {
			return $this->render('update', [
						'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing SceneButton model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);
		$sceneId = $model->sceneId;
		$model->delete();


		return $this->redirect(['scenes/view', 'id' => $sceneId]);
	}

	public function actionEditConditionVisitLocation()
	{
		if (Yii::$app->request->post('hasEditable')) {
			$conditionId = Yii::$app->request->post('editableKey');
			$model = ConditionVisitLocation::findOne($conditionId);
			$out = Json::encode(['output' => '', 'message' => '']);
			$posted = current($_POST['ConditionVisitLocation']);
			$post = ['ConditionVisitLocation' => $posted];
			if ($model->load($post)) {
				$model->save();
				$output = '';
				$out = Json::encode(['output' => $output, 'message' => '']);
			}
			// return ajax json encoded response and exit
			echo $out;
			return;
		}
	}

	public function actionAddConditionsVisitLocation()
	{
		$model = new ConditionVisitLocation();
		$model->load(Yii::$app->request->post());
		$model->save();
		return;
	}

	public function actionDeleteVisitLocation($id)
	{
		$model = ConditionVisitLocation::findOne($id);
		if ($model !== null) {
			$model->delete();
		}
		return;
	}

	public function actionEditConditionLoadScene()
	{
		if (Yii::$app->request->post('hasEditable')) {
			$conditionId = Yii::$app->request->post('editableKey');
			$model = ConditionLoadScene::findOne($conditionId);
			$out = Json::encode(['output' => '', 'message' => '']);
			$posted = current($_POST['ConditionLoadScene']);
			$post = ['ConditionLoadScene' => $posted];
			if ($model->load($post)) {
				$model->save();
				$output = '';
				$out = Json::encode(['output' => $output, 'message' => '']);
			}
			// return ajax json encoded response and exit
			echo $out;
			return;
		}
	}

	public function actionAddConditionsLoadScene()
	{
		$model = new ConditionLoadScene();
		$model->load(Yii::$app->request->post());
		$model->save();
		return;
	}

	public function actionDeleteLoadScene($id)
	{
		$model = ConditionLoadScene::findOne($id);
		if ($model !== null) {
			$model->delete();
		}
		return;
	}

	public function actionEditConditionPressedButton()
	{
		if (Yii::$app->request->post('hasEditable')) {
			$conditionId = Yii::$app->request->post('editableKey');
			$model = ConditionPressedButton::findOne($conditionId);
			$out = Json::encode(['output' => '', 'message' => '']);
			$posted = current($_POST['ConditionPressedButton']);
			$post = ['ConditionPressedButton' => $posted];
			if ($model->load($post)) {
				$model->save();
				$output = '';
				$out = Json::encode(['output' => $output, 'message' => '']);
			}
			// return ajax json encoded response and exit
			echo $out;
			return;
		}
	}

	public function actionAddConditionsPressedButton()
	{
		$model = new ConditionPressedButton();
		$model->load(Yii::$app->request->post());
		$model->save();
		return;
	}

	public function actionDeletePressedButton($id)
	{
		$model = ConditionPressedButton::findOne($id);
		if ($model !== null) {
			$model->delete();
		}
		return;
	}
	
	public function actionEditConditionShowButton()
	{
		if (Yii::$app->request->post('hasEditable')) {
			$conditionId = Yii::$app->request->post('editableKey');
			$model = ConditionShowButton::findOne($conditionId);
			$out = Json::encode(['output' => '', 'message' => '']);
			$posted = current($_POST['ConditionShowButton']);
			$post = ['ConditionShowButton' => $posted];
			if ($model->load($post)) {
				$model->save();
				$output = '';
				$out = Json::encode(['output' => $output, 'message' => '']);
			}
			// return ajax json encoded response and exit
			echo $out;
			return;
		}
	}

	public function actionAddConditionsShowButton()
	{
		$model = new ConditionShowButton();
		$model->load(Yii::$app->request->post());
		$model->save();
		return;
	}

	public function actionDeleteShowButton($id)
	{
		$model = ConditionShowButton::findOne($id);
		if ($model !== null) {
			$model->delete();
		}
		return;
	}

	/**
	 * Finds the SceneButton model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return SceneButton the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = SceneButton::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
	
	// SCENE_BUTTONS LIST
	public function actionSceneButtons()
	{
		$out = [];
		if (isset($_POST['depdrop_parents'])) {
			$parents = $_POST['depdrop_parents'];
			if ($parents != null) {
				$selected = '';
				$sceneId = $parents[0];
				$sceneButtonId = -1;
				$type = -1;
				if (!empty($_POST['depdrop_params'])) {
					$params = $_POST['depdrop_params'];
					$sceneButtonId = $params['0']; // get the value of input-type-1
					$sceneIdModel = $params['1']; // get the value of input-type-2
					if (count($params) > 2) {
						$type = $params['2'];
					}
				}
				$query = SceneButton::find()->where(['sceneId' => $sceneId]);
				if ($type != -1) {
					$query = $query->andWhere(['action' => $type]); 
				}
				$query = $query->orderBy('number'); 
				$sceneButtons = ArrayHelper::map($query->all(), 'sceneButtonId', 'shortText');
				foreach ($sceneButtons as $key => $value) {
					if (empty($selected) && isset($params)) {
						$selected = '' . $key;
					}
					$out[] = ['id' => $key, 'name' => $value];
					if (($key == $sceneButtonId) && ($sceneIdModel == $sceneId)) {
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
