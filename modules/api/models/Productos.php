<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property int $id
 * @property string $nombre_producto
 *
 * @property ProductosSubcategorias[] $productosSubcategorias
 * @property Subcategorias[] $subcategorias
 */
class Productos extends \yii\db\ActiveRecord
{   
    
    const SCENARIO_CREATE= 'create';
    const SCENARIO_UPDATE= 'update';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_producto'], 'required'],
            [['nombre_producto'], 'string', 'max' => 100],
        ];
    }

    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['nombre_producto'];
        $scenarios['update'] = ['nombre_producto'];

        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_producto' => 'Nombre Producto',
        ];
    }

    /**
     * Gets query for [[ProductosSubcategorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductosSubcategorias()
    {
        return $this->hasMany(ProductosSubcategorias::class, ['id_producto' => 'id']);
    }

    /**
     * Gets query for [[Subcategorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategorias()
    {
        return $this->hasMany(Subcategorias::class, ['id' => 'id_subcategoria'])->viaTable('productos_subcategorias', ['id_producto' => 'id']);
    }
}
