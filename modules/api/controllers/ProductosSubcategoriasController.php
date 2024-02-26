<?php

namespace app\modules\api\controllers;
use app\modules\api\models\ProductosSubcategorias;


class ProductosSubcategoriasController extends \yii\web\Controller
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

    public function actionCreateProductossubcategorias(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $productosSubcategorias = new ProductosSubcategorias();
        $productosSubcategorias->scenario = ProductosSubcategorias::SCENARIO_CREATE;
        $productosSubcategorias->attributes = \Yii::$app->request->post();

        if($productosSubcategorias->validate()) {
            $productosSubcategorias->save();
            return array('status'=> true, 'data' => 'ProductosSubcategoria create Sucefully');
        }else {
            return array('status'=> false, 'data' => $productosSubcategorias->getErrors());
        }

        // return array('status' => true);
    }

    public function actionListProductossubcategorias(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $productosSubcategorias = ProductosSubcategorias::find()->all();
        if(count($productosSubcategorias)>0){
            return array('status'=> true, 'data' => $productosSubcategorias);
            
        }else {
            return array('status'=> false, 'data' => 'No ProductosSubcategorias found.');

        }

        
    }

    public function actionUpdateProductossubcategorias($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $productosSubcategorias = ProductosSubcategorias::findOne($id);
    
        if($productosSubcategorias !== null) {
            $productosSubcategorias->scenario = ProductosSubcategorias::SCENARIO_UPDATE;
            $productosSubcategorias->attributes = \Yii::$app->request->post();
    
            if($productosSubcategorias->validate()) {
                $productosSubcategorias->save();
                return array('status'=> true, 'data' => 'ProductosSubcategoria updated successfully');
            } else {
                return array('status'=> false, 'data' => $productosSubcategorias->getErrors());
            }
        } else {
            return array('status'=> false, 'data' => 'ProductosSubcategoria not found');
        }
    }

    public function actionDeleteProductossubcategorias($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $productosSubcategorias = ProductosSubcategorias::findOne($id);
    
        if($productosSubcategorias !== null) {
            $productosSubcategorias->delete();
            return array('status'=> true, 'data' => 'ProductosSubcategoria deleted successfully');
        } else {
            return array('status'=> false, 'data' => 'ProductosSubcategoria not found');
        }
    }

    public function actionFindProductossubcategorias($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $productosSubcategorias = ProductosSubcategorias::findOne($id);
    
        if($productosSubcategorias !== null) {
            return array('status'=> true, 'data' => $productosSubcategorias);
        } else {
            return array('status'=> false, 'data' => 'ProductosSubcategoria not found');
        }
    }

}
