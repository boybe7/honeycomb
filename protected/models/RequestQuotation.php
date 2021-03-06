<?php

/**
 * This is the model class for table "request_quotation".
 *
 * The followings are the available columns in table 'request_quotation':
 * @property integer $id
 * @property string $detail
 * @property integer $contact_id
 * @property string $date
 */
class RequestQuotation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'request_quotation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('detail, contact_id, date', 'required'),
			array('contact_id', 'numerical', 'integerOnly'=>true),
			array('detail,project', 'length', 'max'=>500),
			array('filename', 'file',  'allowEmpty'=>true, 'types'=>'docx,pdf,xls,xlsx,doc', 'safe' => false),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, detail, contact_id, date,filename,project', 'safe', 'on'=>'search'),
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
			'detail' => 'รายละเอียด',
			'contact_id' => 'Contact',
			'date' => 'วัน/เดือน/ปี',
			'project' => 'โครงการ',
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
	public function search($id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('contact_id',$id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('project',$this->date,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave()
    {


        $str_date = explode("/", $this->date);
        if(count($str_date)>1)
        	$this->date= ($str_date[2]-543)."-".$str_date[1]."-".$str_date[0];


        return parent::beforeSave();
   }
     protected function afterSave(){
            parent::afterSave();
            $str_date = explode("-", $this->date);
            if(count($str_date)>1)
            	$this->date = $str_date[2]."/".$str_date[1]."/".($str_date[0]+543);

         
        
    }
    protected function afterFind(){
            parent::afterFind();
            $str_date = explode("-", $this->date);
            if(count($str_date)>1)
            	$this->date = $str_date[2]."/".$str_date[1]."/".($str_date[0]+543);

               
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RequestQuotation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
