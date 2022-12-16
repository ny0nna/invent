<?php
namespace app\controllers;
use app\models\Product;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use app\models;
class ProductController extends FunctionController
{
    public $modelClass = 'app\models\Product';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'only'=>['red_prod','del_prod']
        ];
        return $behaviors;
    }


    public function actionCreate(){
        $product=new Product(Yii::$app->request->post());

       // if (!$this->user()) return $this->send(403, ['content'=>['code'=>403, 'message'=>'Действие заблокировано']]);
        if (!$product->validate()) return $this->validation($product);
        $product->save(false);
        return $this->send(201, ['content'=>['code'=>201, 'message'=>'Продукт добавлен в базу']]);

    }

    public function actionEdit($id_t)
    {
        $request=Yii::$app->request->getBodyParams();
        $product=Product::findOne($id_t);
        foreach ($request as $key => $value){
        $product->$key=$value;
        }
        if (!$product->validate()) return $this->validation($product); //Валидация модели
        $product->save();//Сохранение модели в БД
        return $this->send(201, ['content'=>['code'=>200, 'message'=>'Товар изменен']]);//Отправка сообщения пользователю
    }

    public function actionDelete($id_t)
    {
        $product = Product::findOne($id_t);
        if (!$product) return $this->send(404,['messege'=>'Товар не найден']);
        if (!$product->validate()) return $this->validation($product); //Валидация модели
        $product->delete();//Сохранение модели в БД
        return $this->send(201, ['content'=>['code'=>200, 'message'=>'Товар удален']]);
    }

}