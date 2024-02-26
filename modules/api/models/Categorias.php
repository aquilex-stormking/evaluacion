<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "categorias".
 *
 * @property int $id
 * @property string $nombre_categoria
 * @property string $estado
 *
 * @property Subcategorias[] $subcategorias
 */
class Categorias extends \yii\db\ActiveRecord
{   
    const SCENARIO_CREATE= 'create';
    const SCENARIO_UPDATE= 'update';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categorias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_categoria', 'estado'], 'required'],
            [['estado'], 'string'],
            [['nombre_categoria'], 'string', 'max' => 100],
        ];
    }
    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['nombre_categoria','estado'];
        $scenarios['update'] = ['nombre_categoria','estado'];

        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_categoria' => 'Nombre Categoria',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Subcategorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategorias()
    {
        return $this->hasMany(Subcategorias::class, ['id_categoria' => 'id']);
    }
}
