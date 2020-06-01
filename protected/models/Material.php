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
    public $material_id;
    public $material_name;
    public $material_name1;
    public $moc_id;
    public $category;
    public $date;
    public $unit;
    public $code;
  
    public $date_start;
    public $date_end;

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
		    $searchterm = empty($searchterm) ? trim(Yii::app()->request->getParam('search_key')) : $searchterm;
		    $searchterm = htmlspecialchars($searchterm, ENT_QUOTES);

		    $date_condition = "'2019-04-01' AND '2019-07-01' ";
		    $date_condition = " ";
		    $search_condition = "";
		   
		    $startDate = $startDate=="วันที่เริ่ม" ? "" : $startDate;
		    $endDate = $endDate=="วันที่สิ้นสุด" ? "" : $endDate;


		    if($startDate!=""  && $endDate!="" )
		    {
		 
		    	$str = explode("/", $startDate);
		    	$startDate = ($str[2]-543).'-'.$str[1].'-'.$str[0];
		    	$str = explode("/", $endDate);
		    	$endDate = ($str[2]-543).'-'.$str[1].'-'.$str[0];
		    	$date_condition = "BETWEEN  '$startDate' AND '$endDate' ";
		    	
		    }
		    else{
		    	//$startDate = '0000-00-00';
		        //$endDate = '0000-00-00';

		    }
		      

		    
		    $startDate = '"'.$startDate.'"';
		    $endDate = '"'.$endDate.'"';	

			$criteria->alias = 'material';
			//$criteria->join='LEFT JOIN moc_price_map ON moc_price_map.material_id=Material.id LEFT JOIN moc_price ON moc_price.code=moc_price_map.code LEFT JOIN spec_doc_compare ON spec_doc_compare.material_id=Material.id';
			$criteria->join='LEFT JOIN moc_price_map ON moc_price_map.material_id=material.id LEFT JOIN moc_price ON moc_price.code=moc_price_map.code ';
			$criteria->select = array($startDate.' as date_start',$endDate.' as date_end','material.id as material_id','material.name AS material_name',"CONCAT(material.name,1) as material_name1",'material.detail','moc_price.unit as unit','moc_price.name AS dimension',"CONCAT(moc_price.year-543,'-',LPAD(moc_price.month,2,'00'),'-01') as date",'moc_price.id as moc_id','"-" as spec_id',"CONCAT(1,'-',material.id) AS category","moc_price.code as code");
			$criteria->condition = ("CONCAT(moc_price.year-543,'-',LPAD(moc_price.month,2,'00'),'-01') ".$date_condition);
			$criteria->group = "moc_price.code";
			//$criteria->addCondition("spec_doc_compare.id IS NOT NULL OR moc_price.id IS NOT NULL");
			$criteria->order = 'material.id ASC';
			//$criteria->limit = 50;
			if (!empty($searchterm) ) {
		        $criteria->addCondition(' material.name LIKE "%' . $searchterm . '%" OR
		              material.detail LIKE "%' . $searchterm . '%"  OR moc_price.name  LIKE "%'.$searchterm.'%"');
		    } 


			$criteria2 = new CDbCriteria();
			$criteria2->alias = 'material';
			$criteria2->join='LEFT JOIN spec_doc ON spec_doc.material=material.name ';
			$criteria2->select = array($startDate.' as date_start',$endDate.' as date_end','material.id as material_id','material.name AS material_name',"CONCAT(material.name,2) as material_name1",'material.detail','spec_doc.unit as unit','spec_doc.dimension AS dimension',"DATE(spec_doc.create_date) as date",'"-" as moc_id','spec_doc.id as spec_id',"CONCAT(2,'-',material.id) as category","spec_doc.id as code");
			$criteria2 ->condition =  ' spec_doc.id IS NOT NULL AND spec_doc.create_date '.$date_condition;
			$criteria2->group = "spec_doc.id ";
			$criteria2->order = 'material.id ASC';

			if (!empty($searchterm) ) {
		        $criteria2->addCondition(' material.name LIKE "%' . $searchterm . '%" OR
		              material.detail LIKE "%' . $searchterm . '%"  OR spec_doc.dimension  LIKE "%'.$searchterm.'%"');
		    } 



			/*$sql = "SELECT material.id,material.name as name,material.detail as detail,moc_price.unit,moc_price.name as dimension,CONCAT(moc_price.year,'-',LPAD(moc_price.month,2,'00'),'-01') as date,moc_price.id as moc_id,'-' as spec_id FROM `material` LEFT JOIN moc_price_map ON moc_price_map.material_id=material.id LEFT JOIN moc_price ON moc_price.code=moc_price_map.code UNION SELECT material.id,material.name as name,material.detail as detail,spec_doc.unit,spec_doc.dimension as dimension,DATE(spec_doc.create_date) AS date, '-' as moc_id,spec_doc.id as spec_id FROM `material`  LEFT JOIN spec_doc ON spec_doc.material=material.name WHERE spec_doc.id IS NOT NULL ORDER BY material.id ASC";


			$prov1 = new CActiveDataProvider($this, array(
				'criteria' => $criteria
			));

			$prov2 = new CActiveDataProvider($this, array(
				'criteria' => $criteria2
			));*/

		
			$records= array_merge( Material::model()->findAll($criteria2),Material::model()->findAll($criteria));

			$query = Material::model()->getCommandBuilder()->createFindCommand(Material::model()->getTableSchema(), $criteria)->getText();
			//print_r($query);
			//echo "date_condition = ".$this->date_condition;

			function build_sorter($key) {
			    return function ($a, $b) use ($key) {
			        return strnatcmp($a[$key], $b[$key]);
			    };
			}

			uasort($records, build_sorter("material_name1"));
			
			// echo "<pre>";
			
			// print_r($records);
			// echo "</pre>";


			//$records=Yii::app()->db->createCommand($sql)->queryAll();
			return new CArrayDataProvider($records,
                        array(
                           'keyField'=>false,
                            'sort' => array( //optional and sortring
                                'attributes' => array(
                                	'material_id'
                                  ),
                            ),
                            'pagination' => array('pageSize' => 100) //optional add a pagination
                        )
        );
		  /*  return new CActiveDataProvider($this, array(
		        'criteria' => $criteria->mergeWith($criteria2),
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
    	$str = explode("-", $data->category);
    	$category = $str[0];

    	$str = "";
    	$short_month = array('0'=>'','1' => 'ม.ค.', '2' => 'ก.พ.', '3' => 'มี.ค.', '4' => 'เม.ย.','5' => 'พ.ค.', '6' => 'มิ.ย.', '7' => 'ก.ค.', '8' => 'ส.ค.', '9' => 'ก.ย.', '10' => 'ต.ค.', '12' => 'ธ.ค.'); 


    	$date_condition = "'2019-04-01' AND '2019-07-01' ";
    	if($category==1)
    	{
    		
			
    		if(!empty($data->date_start) && !empty($data->date_end))
    		{
    			$date_condition = "'".$data->date_start."' AND '".$data->date_end."'";
				$model = Yii::app()->db->createCommand()
						    ->select('year,month,price')
						    ->from('moc_price')
						    ->where("(CONCAT(moc_price.year-543,'-',LPAD(moc_price.month,2,'00'),'-01') BETWEEN  ".$date_condition.') AND moc_price.code=:id', array(':id'=>$data->code))
						    ->order("year, month ASC")
						    ->queryAll();
			}
			else
			{
				$model = Yii::app()->db->createCommand()
						    ->select('year,month,price')
						    ->from('moc_price')
						    ->where('moc_price.code=:id', array(':id'=>$data->code))
						    ->order("year, month ASC")
						    ->queryAll();
			}



			foreach ($model as $key => $value) {
				$str .= number_format($value['price'])." (".$short_month[$value['month']]." ".$value['year'].")<br>";
			}
    	}

    	return $str;
    }

    function merge_sorted_arrays_by_field ($merge_arrays, $sort_field, $sort_desc = false, $limit = 0) 
	{ 
	    $array_count = count($merge_arrays); 
	    
	    // fast special cases... 
	    switch ($array_count) 
	    { 
	        case 0: return array(); 
	        case 1: return $limit ? array_slice(reset($merge_arrays), 0, $limit) : reset($merge_arrays); 
	    } 
	    
	    if ($limit === 0) 
	        $limit = PHP_INT_MAX; 
	    
	    // rekey merge_arrays array 0->N 
	    $merge_arrays = array_values($merge_arrays); 

	    $best_array = false; 
	    $best_value = false; 
	    
	    $results = array(); 
	    
	    // move sort order logic outside the inner loop to speed things up 
	    if ($sort_desc) 
	    { 
	        for ($i = 0; $i < $limit; ++$i) 
	        { 
	            for ($j = 0; $j < $array_count; ++$j) 
	            { 
	                // if the array $merge_arrays[$j] is empty, skip to next 
	                if (false === ($current_value = current($merge_arrays[$j]))) 
	                    continue; 
	                
	                // if we don't have a value for this round, or if the current value is bigger...
	                if ($best_value === false || $current_value[$sort_field] > $best_value[$sort_field]) 
	                { 
	                    $best_array = $j; 
	                    $best_value = $current_value; 
	                } 
	            } 
	            
	            // all arrays empty? 
	            if ($best_value === false) 
	                break; 
	            
	            $results[] = $best_value; 
	            $best_value = false; 
	            next($merge_arrays[$best_array]); 
	        } 
	    } 
	    else 
	    { 
	        for ($i = 0; $i < $limit; ++$i) 
	        { 
	            for ($j = 0; $j < $array_count; ++$j) 
	            { 
	                if (false === ($current_value = current($merge_arrays[$j]))) 
	                    continue; 
	                
	                // if we don't have a value for this round, or if the current value is smaller... 
	                if ($best_value === false || $current_value[$sort_field] < $best_value[$sort_field]) 
	                { 
	                    $best_array = $j; 
	                    $best_value = $current_value; 
	                } 
	            } 
	            
	            // all arrays empty? 
	            if ($best_value === false) 
	                break; 
	            
	            $results[] = $best_value; 
	            $best_value = false; 
	            next($merge_arrays[$best_array]); 
	        } 
	    } 
	    
	    return $results; 
	} 

}
