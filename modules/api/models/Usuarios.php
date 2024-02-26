<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string $nombre_usuario
 * @property string $contrasena
 * @property string $rol
 * @property string $estado
 */
class Usuarios extends \yii\db\ActiveRecord
{   
    const SCENARIO_CREATE= 'create';
    const SCENARIO_UPDATE= 'update';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_usuario', 'contrasena', 'rol', 'estado'], 'required'],
            [['rol', 'estado'], 'string'],
            [['nombre_usuario'], 'string', 'max' => 50],
            [['contrasena'], 'string', 'max' => 255],
        ];
    }
    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['nombre_usuario','contrasena','rol','estado'];
        $scenarios['update'] = ['nombre_usuario','contrasena','rol','estado'];

        return $scenarios;
    }
 
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_usuario' => 'Nombre Usuario',
            'contrasena' => 'Contrasena',
            'rol' => 'Rol',
            'estado' => 'Estado',
        ];
    }
}
