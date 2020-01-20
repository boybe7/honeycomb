<?php

/**
 * This is the model class for table "material".
 *
 * The followings are the available columns in table 'material':
 * @property integer $id
 * @property string $name
 */
class Material extends CActiveRecord
{
	
	public $spec_id;
    public $dimension;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'material';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, detail', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'วัสดุ',
			'detail'=>'รายละเอียด'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

			$criteria=new CDbCriteria;

		 	$startDate = empty($startDate) ? trim(Yii::app()->request->getParam('startDate')) : $startDate;
		 	$endDate = empty($endDate) ? trim(Yii::app()->request->getParam('endDate')) : $endDate;
		    $searchterm = empty($searchterm) ? trim(Yii::app()->request->getParam('search')) : $searchterm;
		    $searchterm = htmlspecialchars($searchterm, ENT_QUOTES);
		    if (!empty($searchterm) ) {
		        
		    } else {
		        
		    }


		    //relative search
		    //SELECT * FROM `material` m LEFT JOIN moc_price_map mp ON mp.material_id=m.id LEFT JOIN moc_price p ON p.code=mp.code LEFT JOIN spec_doc_compare s ON s.material_id=m.id WHERE p.id IS NOT NULL OR s.id IS NOT NULL
			
			$criteria->alias = 'Material';
			//$criteria->join='LEFT JOIN moc_price_map ON moc_price_map.material_id=Material.id LEFT JOIN moc_price ON moc_price.code=moc_price_map.code LEFT JOIN spec_doc_compare ON spec_doc_compare.material_id=Material.id';
			$criteria->join='LEFT JOIN moc_price_map ON moc_price_map.material_id=Material.id LEFT JOIN moc_price ON moc_price.code=moc_price_map.code LEFT JOIN spec_doc ON spec_doc.material_code=moc_price_map.code';
			//$criteria->select = array('Material.id','Material.name','Material.detail','spec_doc_compare.spec_id AS spec_id','moc_price.name AS dimension');
			//$criteria->addCondition("spec_doc.id IS NOT NULL ");
			//$criteria->addCondition("spec_doc_compare.id IS NOT NULL OR moc_price.id IS NOT NULL");

		    return new CActiveDataProvider($this, array(
		        'criteria' => $criteria,
		        'pagination' => array(
		            'pagesize' => 25,
		        )
		    ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Material the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	public function getPrice($data)
    {
    	$spec_id = $data->id;
    	$model = SpecDocCompare::model()->findAll(array("condition"=>"spec_id='$spec_id' "));
    	$str = "";
    	if(!empty($model))
    	{
    		//$str = "ร้าน/ยี่ห้อ ".$model[0]->brand."<br>รุ่น ".$model[0]->model."<br>ราคา ".number_format($model[0]->price,2)." บาท<br>วันที่ ".$model[0]->date_price;
    	}
    	return $str;
    }

}
