<?php

namespace app\modules\api\controllers;
use app\modules\api\models\Categorias;

class CategoriasController extends \yii\web\Controller
{   
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function behaviors()
    {
    return [
        'corsFilter' => [
            'class' => \yii\filters\Cors::class,
        ],
    ];
    }   
    

    public function actionCreateCategorias(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $categorias = new Categorias();
        $categorias->scenario = Categorias::SCENARIO_CREATE;
        $categorias->attributes = \Yii::$app->request->post();

        if($categorias->validate()) {
            $categorias->save();
            return array('status'=> true, 'data' => 'categoria create Sucefully');
        }else {
            return array('status'=> false, 'data' => $categorias->getErrors());
        }

        // return array('status' => true);
    }

    public function actionListCategorias(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $categorias = Categorias::find()->all();
        if(count($categorias)>0){
            return array('status'=> true, 'data' => $categorias);
            
        }else {
            return array('status'=> false, 'data' => 'No employees found.');

        }

        
    }

    public function actionUpdateCategorias($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $categorias = Categorias::findOne($id);
    
        if($categorias !== null) {
            $categorias->scenario = Categorias::SCENARIO_UPDATE;
            $categorias->attributes = \Yii::$app->request->post();
    
            if($categorias->validate()) {
                $categorias->save();
                return array('status'=> true, 'data' => 'categoria updated successfully');
            } else {
                return array('status'=> false, 'data' => $categorias->getErrors());
            }
        } else {
            return array('status'=> false, 'data' => 'categoria not found');
        }
    }

    public function actionDeleteCategorias($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $categorias = Categorias::findOne($id);
    
        if($categorias !== null) {
            $categorias->delete();
            return array('status'=> true, 'data' => 'categoria deleted successfully');
        } else {
            return array('status'=> false, 'data' => 'categoria not found');
        }
    }

    public function actionFindCategorias($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $categorias = Categorias::findOne($id);
    
        if($categorias !== null) {
            return array('status'=> true, 'data' => $categorias);
        } else {
            return array('status'=> false, 'data' => 'categoria not found');
        }
    }
    

}
