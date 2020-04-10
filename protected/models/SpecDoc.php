<?php

/**
 * This is the model class for table "spec_doc".
 *
 * The followings are the available columns in table 'spec_doc':
 * @property integer $id
 * @property integer $no
 * @property string $name
 * @property string $filename
 * @property string $detail_approve
 * @property integer $work_category_id
 * @property integer $contract_id
 * @property string $created_by
 * @property string $create_date
 * @property string $update_date
 * @property integer $status
 */
class SpecDoc extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'spec_doc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('material', 'required'),
			array(' work_category_id, status', 'numerical', 'integerOnly'=>true),
			array('detail, filename, contract_id, detail_approve, created_by', 'length', 'max'=>255),
			array('filename', 'file',  'allowEmpty'=>true, 'types'=>'docx,pdf,xls,xlsx,doc', 'safe' => false),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, no,material,dimension,unit, detail, filename, detail_approve, work_category_id, contract_id, created_by, create_date, update_date, status,send', 'safe', 'on'=>'search'),
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
			'id' => 'id',
			'no' => 'ลำดับ',
			'detail' => 'รายละเอียดประกอบแบบ',
			'filename' => 'ชื่อไฟล์เอกสาร',
			'detail_approve' => 'รายละเอียดการอนุมัติ',
			'work_category_id' => 'ประเภทงาน',
			'contract_id' => 'สัญญา',
			'created_by' => 'ผู้บันทึก',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
			'status' => 'สถานะ',
			'material' => 'วัสดุ',
			'dimension' => 'ขนาด',
			'unit' => 'หน่วย',
			'send'=>"จัดเก็บ"

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

		$criteria->compare('id',$this->id);
		$criteria->compare('no',$this->no,true);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('detail_approve',$this->detail_approve,true);
		$criteria->compare('work_category_id',$this->work_category_id);
		$criteria->compare('contract_id',$this->contract_id,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('material',$this->material,true);
		$criteria->compare('dimension',$this->dimension,true);
		$criteria->compare('unit',$this->unit,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function searchByID($work_category_id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		/*$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('no',$this->no,true);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('detail_approve',$this->detail_approve,true);
		$criteria->compare('work_category_id',$work_category_id);
		$criteria->compare('contract_id',$this->contract_id,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('material',$this->material,true);
		$criteria->compare('dimension',$this->dimension,true);
		$criteria->compare('unit',$this->unit,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));*/

		$criteria = new CDbCriteria;

		    $searchterm = empty($searchterm) ? trim(Yii::app()->request->getParam('search')) : $searchterm;
		    $work_id = empty($work_id) ? trim(Yii::app()->request->getParam('work_id')) : $work_id;
		    $searchterm = htmlspecialchars($searchterm, ENT_QUOTES);
		    if (!empty($searchterm)) {
		        $criteria->addCondition(' (t.detail like "%' . $searchterm . '%" OR
		              t.material like "%' . $searchterm . '%" OR
		              t.dimension like "%' . $searchterm.'%") AND work_category_id='.$work_id);
		    } else {
		        $criteria->addCondition('work_category_id='.$work_category_id);
		    }

		    if(!Yii::app()->user->isAdmin())
		    	$criteria->addCondition('status=1');

		    $criteria->addCondition('is_written=0 OR (is_written=1 AND send=1)') ;
		  
		    return new CActiveDataProvider($this, array(
		        'criteria' => $criteria,
		        'pagination' => array(
		            'pagesize' => 25,
		        )
		    ));

	}


	public function searchWrite()
	{
		
		$criteria = new CDbCriteria;

		    $searchterm = empty($searchterm) ? trim(Yii::app()->request->getParam('search')) : $searchterm;
		    
		    $searchterm = htmlspecialchars($searchterm, ENT_QUOTES);
		    if (!empty($searchterm)) {
		        $criteria->addCondition(' (t.detail like "%' . $searchterm . '%" OR
		              t.material like "%' . $searchterm . '%" OR
		              t.dimension like "%' . $searchterm.'%") ');
		    } 

		    $criteria->addCondition('is_written=1') ;
		  
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
	 * @return SpecDoc the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave()
    {


        $str_date = explode("/", $this->create_date);
        if(count($str_date)>1)
        	$this->create_date= $str_date[2]."-".$str_date[1]."-".$str_date[0];

        $str_date = explode("/", $this->update_date);
        if(count($str_date)>1)
        	$this->update_date= $str_date[2]."-".$str_date[1]."-".$str_date[0];


        return parent::beforeSave();
   }
     protected function afterSave(){
            parent::afterSave();
            $str_date = explode("-", $this->create_date);
            if(count($str_date)>1)
            	$this->create_date = $str_date[2]."/".$str_date[1]."/".($str_date[0]);

             $str_date = explode("-", $this->update_date);
            if(count($str_date)>1)
            	$this->update_date = $str_date[2]."/".$str_date[1]."/".($str_date[0]);
        
    }
    protected function afterFind(){
            parent::afterFind();
            $str_date = explode("-", $this->create_date);
            if(count($str_date)>1)
            	$this->create_date = $str_date[2]."/".$str_date[1]."/".($str_date[0]);

             $str_date = explode("-", $this->update_date);
            if(count($str_date)>1)
            	$this->update_date = $str_date[2]."/".$str_date[1]."/".($str_date[0]);
               
    }

    public function getCompare($data,$no)
    {
    	$spec_id = $data->id;
    	$model = SpecDocCompare::model()->findAll(array("condition"=>"spec_id='$spec_id' AND no='$no' "));
    	$str = "";
    	if(!empty($model))
    	{
    		$str = "ร้าน/ยี่ห้อ ".$model[0]->brand."<br>รุ่น ".$model[0]->model."<br>ราคา ".number_format($model[0]->price,2)." บาท<br>วันที่ ".$model[0]->date_price;
    	}
    	return $str;
    }

}
