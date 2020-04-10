<?php

/**
 * This is the model class for table "spec_doc_compare".
 *
 * The followings are the available columns in table 'spec_doc_compare':
 * @property integer $id
 * @property integer $spec_id
 * @property string $brand
 * @property string $model
 * @property string $price
 * @property string $date_price
 * @property string $attach_file
 */
class SpecDocCompare extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'spec_doc_compare';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('spec_id, brand, model, price, date_price, attach_file', 'required'),
			array('spec_id', 'numerical', 'integerOnly'=>true),
			array('brand', 'length', 'max'=>500),
			//array('attach_file,attach_file1,attach_file2,attach_file3', 'file',  'allowEmpty'=>true, 'types'=>'docx,pdf,xls,xlsx,doc', 'safe' => false),
			array('model, attach_file', 'length', 'max'=>250),
			array('price', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, spec_id, brand, model, price, date_price, attach_file', 'safe', 'on'=>'search'),
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
			'spec_id' => 'Spec',
			'brand' => 'ยี่ห้อ',
			'model' => 'รุ่น',
			'price' => 'ราคา',
			'date_price' => 'วันที่',
			'attach_file' => 'ไฟล์แนบ',
			//'material_id' => 'วัสดุ'
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
		$criteria->compare('spec_id',$this->spec_id);
		$criteria->compare('brand',$this->brand,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('date_price',$this->date_price,true);
		$criteria->compare('attach_file',$this->attach_file,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SpecDocCompare the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave()
    {


        $str_date = explode("/", $this->date_price);

        if(count($str_date)>1 && intval($str_date[2])!=0 )
        	$this->date_price= ($str_date[2]-543)."-".$str_date[1]."-".$str_date[0];
        else
        	$this->date_price= "";
  

        return parent::beforeSave();
   }
     protected function afterSave(){
            parent::afterSave();
            $str_date = explode("-", $this->date_price);
            if(count($str_date)>1 && intval($str_date[0])!=0 )
            	$this->date_price = $str_date[2]."/".$str_date[1]."/".($str_date[0]+543);
            else
        	$this->date_price= "";
  
          
        
    }
    protected function afterFind(){
            parent::afterFind();
            $str_date = explode("-", $this->date_price);
            if(count($str_date)>1 && intval($str_date[0])!=0 )
            	$this->date_price = $str_date[2]."/".$str_date[1]."/".($str_date[0]+543);
            else
        		$this->date_price= "";
  
       
               
    }
}
