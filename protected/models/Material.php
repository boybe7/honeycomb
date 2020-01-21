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


			$criteria->alias = 'material';
			//$criteria->join='LEFT JOIN moc_price_map ON moc_price_map.material_id=Material.id LEFT JOIN moc_price ON moc_price.code=moc_price_map.code LEFT JOIN spec_doc_compare ON spec_doc_compare.material_id=Material.id';
			$criteria->join='LEFT JOIN moc_price_map ON moc_price_map.material_id=material.id LEFT JOIN moc_price ON moc_price.code=moc_price_map.code ';
			$criteria->select = array('material.id','material.name','material.detail','moc_price.unit','moc_price.name AS dimension',"CONCAT(moc_price.year,'-',LPAD(moc_price.month,2,'00'),'-01') as date",'moc_price.id as moc_id','"-" as spec_id');
			//$criteria->addCondition("spec_doc.id IS NOT NULL ");
			//$criteria->addCondition("spec_doc_compare.id IS NOT NULL OR moc_price.id IS NOT NULL");


			$criteria2 = new CDbCriteria();
			$criteria2->alias = 'material';
			$criteria2->join='LEFT JOIN spec_doc ON spec_doc.material=material.name WHERE spec_doc.id IS NOT NULL';
			$criteria2->select = array('material.id','material.name','material.detail','spec_doc.unit','spec_doc.dimension AS dimension',"DATE(spec_doc.create_date) as date",'"-" as moc_id','spec_doc.id as spec_id');

			


			$sql = "SELECT material.id,material.name as name,material.detail as detail,moc_price.unit,moc_price.name as dimension,CONCAT(moc_price.year,'-',LPAD(moc_price.month,2,'00'),'-01') as date,moc_price.id as moc_id,'-' as spec_id FROM `material` LEFT JOIN moc_price_map ON moc_price_map.material_id=material.id LEFT JOIN moc_price ON moc_price.code=moc_price_map.code UNION SELECT material.id,material.name as name,material.detail as detail,spec_doc.unit,spec_doc.dimension as dimension,DATE(spec_doc.create_date) AS date, '-' as moc_id,spec_doc.id as spec_id FROM `material`  LEFT JOIN spec_doc ON spec_doc.material=material.name WHERE spec_doc.id IS NOT NULL";

			/*return new CSqlDataProvider($sql, [
			    // 'params' => [
			    //     ':t_assignee' => 3,
			    //     ':m_id' => $this->manager_id,
			    //     ':role' => 1,
			    // ]
			]);*/


			$rawData = Yii::app()->db->createCommand("SELECT material.id,material.name as name,material.detail as detail,moc_price.unit,moc_price.name as dimension,CONCAT(moc_price.year,'-',LPAD(moc_price.month,2,'00'),'-01') as date,moc_price.id as moc_id,'-' as spec_id FROM `material` LEFT JOIN moc_price_map ON moc_price_map.material_id=material.id LEFT JOIN moc_price ON moc_price.code=moc_price_map.code"); 

			$count = Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar(); //the count

			/*return new CSqlDataProvider($rawData, array(
					'totalItemCount' => $count,
			    	'pagination' => array(
			            'pageSize' => 25,
			        ),
			    )
			);*/

			$prov1 = new CActiveDataProvider($this, array(
				'criteria' => $criteria
			));

			$prov2 = new CActiveDataProvider($this, array(
				'criteria' => $criteria2
			));

			$records= array_merge($prov1->data , $prov2->data);


			//$records=Yii::app()->db->createCommand($sql)->queryAll();
			return new CArrayDataProvider($records,
                        array(
                           'keyField'=>false,
                            'sort' => array( //optional and sortring
                                'attributes' => array(
                                  ),
                            ),
                            'pagination' => array('pageSize' => 100) //optional add a pagination
                        )
        );
		   /* return new CActiveDataProvider($this, array(
		        'criteria' => $criteria,
		        'pagination' => array(
		            'pagesize' => 25,
		        )
		    ));*/
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
