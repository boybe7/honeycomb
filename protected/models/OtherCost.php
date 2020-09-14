<?php

/**
 * This is the model class for table "other_cost".
 *
 * The followings are the available columns in table 'other_cost':
 * @property integer $id
 * @property string $contract_no
 * @property string $filename
 * @property integer $type_id
 */
class OtherCost extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'other_cost';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contract_no, filename, type_id,date_update,detail', 'required'),
			array('type_id', 'numerical', 'integerOnly'=>true),
			array('contract_no,detail', 'length', 'max'=>255),
			array('filename', 'file',  'allowEmpty'=>true, 'types'=>'docx,pdf,xls,xlsx,doc', 'safe' => false),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, contract_no, filename, type_id,date_update', 'safe', 'on'=>'search'),
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
			'contract_no' => 'สัญญา/งาน',
			'filename' => 'ไฟล์แนบ',
			'detail' => 'ไฟล์แนบ',
			'type_id' => 'ประเภท',
			'date_update'=>'อัพเดตวันที่'
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
		$criteria->compare('contract_no',$this->contract_no,true);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('type_id',$this->type_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchByType($type_id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('contract_no',$this->contract_no,true);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('type_id',$type_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OtherCost the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
