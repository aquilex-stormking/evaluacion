<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "subcategorias".
 *
 * @property int $id
 * @property string $nombre_subcategoria
 * @property int|null $id_categoria
 * @property string $estado
 *
 * @property Categorias $categoria
 * @property Productos[] $productos
 * @property ProductosSubcategorias[] $productosSubcategorias
 */
class Subcategorias extends \yii\db\ActiveRecord
{   
    const SCENARIO_CREATE= 'create';
    const SCENARIO_UPDATE= 'update';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subcategorias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_subcategoria', 'estado'], 'required'],
            [['id_categoria'], 'integer'],
            [['estado'], 'string'],
            [['nombre_subcategoria'], 'string', 'max' => 100],
            [['id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::class, 'targetAttribute' => ['id_categoria' => 'id']],
        ];
    }

    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['nombre_subcategoria','estado','id_categoria'];
        $scenarios['update'] = ['nombre_subcategoria','estado','id_categoria'];

        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_subcategoria' => 'Nombre Subcategoria',
            'id_categoria' => 'Id Categoria',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorias::class, ['id' => 'id_categoria']);
    }

    /**
     * Gets query for [[Productos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Productos::class, ['id' => 'id_producto'])->viaTable('productos_subcategorias', ['id_subcategoria' => 'id']);
    }

    /**
     * Gets query for [[ProductosSubcategorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductosSubcategorias()
    {
        return $this->hasMany(ProductosSubcategorias::class, ['id_subcategoria' => 'id']);
    }
}
