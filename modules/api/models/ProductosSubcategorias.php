<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "productos_subcategorias".
 *
 * @property int $id_producto
 * @property int $id_subcategoria
 *
 * @property Productos $producto
 * @property Subcategorias $subcategoria
 */
class ProductosSubcategorias extends \yii\db\ActiveRecord
{   
    const SCENARIO_CREATE= 'create';
    const SCENARIO_UPDATE= 'update';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productos_subcategorias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_producto', 'id_subcategoria'], 'required'],
            [['id_producto', 'id_subcategoria'], 'integer'],
            [['id_producto', 'id_subcategoria'], 'unique', 'targetAttribute' => ['id_producto', 'id_subcategoria']],
            [['id_producto'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::class, 'targetAttribute' => ['id_producto' => 'id']],
            [['id_subcategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategorias::class, 'targetAttribute' => ['id_subcategoria' => 'id']],
        ];
    }
        public function scenarios(){
            $scenarios = parent::scenarios();
            $scenarios['create'] = ['id_producto','id_subcategoria'];
            $scenarios['update'] = ['id_producto','id_subcategoria'];

            return $scenarios;
        }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_producto' => 'Id Producto',
            'id_subcategoria' => 'Id Subcategoria',
        ];
    }

    /**
     * Gets query for [[Producto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Productos::class, ['id' => 'id_producto']);
    }

    /**
     * Gets query for [[Subcategoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategoria()
    {
        return $this->hasOne(Subcategorias::class, ['id' => 'id_subcategoria']);
    }
}
