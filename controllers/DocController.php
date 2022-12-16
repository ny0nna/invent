<?php
namespace app\controllers;
use app\models\Doc;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;
use app\controllers\FunctionController;
class DocController extends FunctionController
{
    public $modelClass = 'app\models\Doc';
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'only'=>['create']
        ];
        return $behaviors;
    }

    public function actionCreate(){
        $request=Yii::$app->request->post();
        $doc=new Doc();

        $user=Yii::$app->user->identity;
        $doc->id_u=$user->id_u;
        $doc->load($request, 'DOC');
        if (!$doc->validate()) return $this->validation($doc);

       // if (!$this->user()) return $this->send(403, ['content'=>['code'=>403, 'message'=>'Действие заблокировано']]);
        $doc->name=UploadedFile::getInstanceByName('name');
        $hash=hash('sha256', $doc->name->baseName) . '.' . $doc->name->extension;
        $doc->name->saveAs(\Yii::$app->basePath. '/assets/' . $hash);
         $doc->name=$hash;
         $doc->save(false);
       return $this->send(201, ['content'=>['code'=>201, 'message'=>'Документ создан']]);

    }

}