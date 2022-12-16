<?php
namespace app\controllers;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class UserController extends FunctionController
{
    public $modelClass = 'app\models\User';

        public function actionCreate()
        {
          $request=Yii::$app->request->post(); //получение данных из post запроса
            $user=new User($request); // Создание модели на основе присланных данных
            if (!$user->validate()) return $this->validation($user); //Валидация модели
            $user->password=Yii::$app->getSecurity()->generatePasswordHash($user->password); //хэширование пароля
            $user->save();//Сохранение модели в БД
            return $this->send(201, ['content'=>['code'=>201, 'message'=>'Вы зарегистрировались']]);//Отправка сообщения пользователю
        }


        public function actionAuth(){
            $request=Yii::$app->request->post();//Здесь не объект, а ассоциативный массив
            $loginForm=new LoginForm($request);
            if (!$loginForm->validate()) return $this->validation($loginForm);
            $user=User::find()->where(['login'=>$request['login']])->one();
            if (isset($user) && Yii::$app->getSecurity()->validatePassword($request['password'], $user->password)){
                $user->token=Yii::$app->getSecurity()->generateRandomString();
                $user->save(false);
                return $this->send(200, ['content'=>['code'=>200, 'token'=>$user->token,'message'=>' Успешная авторизация']]);
            }
            return $this->send(401, ['content'=>['code'=>401, 'message'=>'Неверный логин или пароль']]);
        }
}