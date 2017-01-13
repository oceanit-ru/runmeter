#!/bin/bash

# scenario
php yii gii/model --tableName=scenario --modelClass=BaseScenario --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=location --modelClass=BaseLocation --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=scene --modelClass=BaseScene --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=sceneButton --modelClass=BaseSceneButton --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=conditionVisitLocation --modelClass=BaseConditionVisitLocation --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=conditionLoadScene --modelClass=BaseConditionLoadScene --ns="common\models\db" --overwrite=1 --interactive=0
php yii gii/model --tableName=conditionPressedButton --modelClass=BaseConditionPressedButton --ns="common\models\db" --overwrite=1 --interactive=0