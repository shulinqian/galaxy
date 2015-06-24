<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-24
 * Time: 下午1:55
 */

namespace star\account\controllers\home;

use Yii;
use star\account\models\Withdrawal;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class AccountController extends Controller
{
    public $layout = '/member';

    public function actionWithdrawal()
    {
        $model = Yii::createObject(Withdrawal::className());
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['withdrawal-log',]);
        } else {
            return $this->render('createWithdrawal', [
                'model' => $model,
            ]);
        }
    }

    public function actionWithdrawalLog(){
        $model = Yii::createObject(Withdrawal::className());
        $dataProvider = new ActiveDataProvider([
            'query' => $model::find()->where(['user_id' => Yii::$app->user->id])->orderBy(['create_at' => SORT_DESC, 'status' => 0]),
        ]);

        return $this->render('withdrawalLog', [
            'dataProvider' => $dataProvider,
        ]);
    }
} 