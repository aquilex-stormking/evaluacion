<?php

namespace app\modules\api\controllers;
use app\modules\api\models\Usuarios;

class UsuariosController extends \yii\web\Controller
{    
    
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::class,
            ],
        ];
    } 

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreateUsuarios(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $usuarios = new Usuarios();
        $usuarios->scenario = Usuarios::SCENARIO_CREATE;
        $usuarios->attributes = \Yii::$app->request->post();

        if($usuarios->validate()) {
            $usuarios->save();
            return array('status'=> true, 'data' => 'Usuario create Sucefully');
        }else {
            return array('status'=> false, 'data' => $usuarios->getErrors());
        }

        // return array('status' => true);
    }

    public function actionListUsuarios(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $usuarios = Usuarios::find()->all();
        if(count($usuarios)>0){
            return array('status'=> true, 'data' => $usuarios);
            
        }else {
            return array('status'=> false, 'data' => 'No usuarios found.');

        }

        
    }

    public function actionUpdateUsuarios($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $usuarios = Usuarios::findOne($id);
    
        if($usuarios !== null) {
            $usuarios->scenario = Usuarios::SCENARIO_UPDATE;
            $usuarios->attributes = \Yii::$app->request->post();
    
            if($usuarios->validate()) {
                $usuarios->save();
                return array('status'=> true, 'data' => 'Usuario updated successfully');
            } else {
                return array('status'=> false, 'data' => $usuarios->getErrors());
            }
        } else {
            return array('status'=> false, 'data' => 'Usuario not found');
        }
    }

    public function actionDeleteUsuarios($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $usuarios = Usuarios::findOne($id);
    
        if($usuarios !== null) {
            $usuarios->delete();
            return array('status'=> true, 'data' => 'Usuario deleted successfully');
        } else {
            return array('status'=> false, 'data' => 'Usuario not found');
        }
    }

    public function actionFindUsuarios($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $usuarios = Usuarios::findOne($id);
    
        if($usuarios !== null) {
            return array('status'=> true, 'data' => $usuarios);
        } else {
            return array('status'=> false, 'data' => 'Usuario not found');
        }
    }
    
    

}
