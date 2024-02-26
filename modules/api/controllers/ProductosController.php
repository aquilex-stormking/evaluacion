<?php

namespace app\modules\api\controllers;
use app\modules\api\models\Productos;

class ProductosController extends \yii\web\Controller
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

    public function actionCreateProductos(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $productos = new Productos();
        $productos->scenario = Productos::SCENARIO_CREATE;
        $productos->attributes = \Yii::$app->request->post();

        if($productos->validate()) {
            $productos->save();
            return array('status'=> true, 'data' => 'productos create Sucefully');
        }else {
            return array('status'=> false, 'data' => $productos->getErrors());
        }

        // return array('status' => true);
    }

    public function actionListProductos(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $productos = Productos::find()->all();
        if(count($productos)>0){
            return array('status'=> true, 'data' => $productos);
            
        }else {
            return array('status'=> false, 'data' => 'No productos found.');

        }

        
    }

    public function actionUpdateProductos($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $productos = Productos::findOne($id);
    
        if($productos !== null) {
            $productos->scenario = Productos::SCENARIO_UPDATE;
            $productos->attributes = \Yii::$app->request->post();
    
            if($productos->validate()) {
                $productos->save();
                return array('status'=> true, 'data' => 'productos updated successfully');
            } else {
                return array('status'=> false, 'data' => $productos->getErrors());
            }
        } else {
            return array('status'=> false, 'data' => 'productos not found');
        }
    }

    public function actionDeleteProductos($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $productos = Productos::findOne($id);
    
        if($productos !== null) {
            $productos->delete();
            return array('status'=> true, 'data' => 'productos deleted successfully');
        } else {
            return array('status'=> false, 'data' => 'productos not found');
        }
    }

    public function actionFindProductos($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $productos = Productos::findOne($id);
    
        if($productos !== null) {
            return array('status'=> true, 'data' => $productos);
        } else {
            return array('status'=> false, 'data' => 'productos not found');
        }
    }

}
