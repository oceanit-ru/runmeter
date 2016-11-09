#!/bin/bash
git pull
php yii migrate
./generate-api-doc.sh