<?php
namespace app\controllers;
use app\models\Checkprod;
use app\models\Doc;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\controllers\FunctionController;
use app\models\User;
use app\models\Product;
use yii\web\UploadedFile;

class CheckprodController extends FunctionController
{
    public $modelClass = 'app\models\Checkprod';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'only'=>['new','edit']
        ];
        return $behaviors;
    }

    public function actionNew()
    {

        $Checkprod=new Checkprod(Yii::$app->request->post());
        if (!$Checkprod->validate()) return $this->validation($Checkprod);
        $Checkprod->save(false);
        return $this->send(201, ['content'=>['code'=>201, 'message'=>'Запись создана']]);

    }

    public function actionEdit($id_ch)
    {
        $request=Yii::$app->request->getBodyParams();
        $Checkprod=CheckProd::findOne($id_ch);
        foreach ($request as $key => $value){
            $Checkprod->$key=$value;
        }
        if (!$Checkprod->validate()) return $this->validation($Checkprod); //Валидация модели
        $Checkprod->save();//Сохранение модели в БД
        return $this->send(201, ['content'=>['code'=>200, 'message'=>'Запись изменена']]);
    }


}