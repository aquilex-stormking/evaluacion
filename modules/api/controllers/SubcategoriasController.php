<?php

namespace app\modules\api\controllers;
use app\modules\api\models\Subcategorias;


class SubcategoriasController extends \yii\web\Controller
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

    public function actionCreateSubcategorias(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $subcategorias = new Subcategorias();
        $subcategorias->scenario = Subcategorias::SCENARIO_CREATE;
        $subcategorias->attributes = \Yii::$app->request->post();

        if($subcategorias->validate()) {
            $subcategorias->save();
            return array('status'=> true, 'data' => 'Subcategoria create Sucefully');
        }else {
            return array('status'=> false, 'data' => $subcategorias->getErrors());
        }

        // return array('status' => true);
    }

    public function actionListSubcategorias(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $subcategorias = Subcategorias::find()->all();
        if(count($subcategorias)>0){
            return array('status'=> true, 'data' => $subcategorias);
            
        }else {
            return array('status'=> false, 'data' => 'No Subcategorias found.');

        }

        
    }

    public function actionUpdateSubcategorias($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $subcategorias = Subcategorias::findOne($id);
    
        if($subcategorias !== null) {
            $subcategorias->scenario = Subcategorias::SCENARIO_UPDATE;
            $subcategorias->attributes = \Yii::$app->request->post();
    
            if($subcategorias->validate()) {
                $subcategorias->save();
                return array('status'=> true, 'data' => 'Subcategoria updated successfully');
            } else {
                return array('status'=> false, 'data' => $subcategorias->getErrors());
            }
        } else {
            return array('status'=> false, 'data' => 'Subcategoria not found');
        }
    }

    public function actionDeleteSubcategorias($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $subcategorias = Subcategorias::findOne($id);
    
        if($subcategorias !== null) {
            $subcategorias->delete();
            return array('status'=> true, 'data' => 'Subcategoria deleted successfully');
        } else {
            return array('status'=> false, 'data' => 'Subcategoria not found');
        }
    }

    public function actionFindSubcategorias($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //this will return response in json 
        $subcategorias = Subcategorias::findOne($id);
    
        if($subcategorias !== null) {
            return array('status'=> true, 'data' => $subcategorias);
        } else {
            return array('status'=> false, 'data' => 'Subcategoria not found');
        }
    }
}
