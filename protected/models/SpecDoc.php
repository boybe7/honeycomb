<?php

/**
 * This is the model class for table "spec_doc".
 *
 * The followings are the available columns in table 'spec_doc':
 * @property integer $id
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
			array('name, filename, detail_approve, work_category_id, contract_id, created_by, create_date, update_date', 'required'),
			array('work_category_id, contract_id, status', 'numerical', 'integerOnly'=>true),
			array('name, filename, detail_approve, created_by', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, filename, detail_approve, work_category_id, contract_id, created_by, create_date, update_date, status', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'filename' => 'Filename',
			'detail_approve' => 'Detail Approve',
			'work_category_id' => 'Work Category',
			'contract_id' => 'Contract',
			'created_by' => 'Created By',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
			'status' => '0 = disable, 1 = enable',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('detail_approve',$this->detail_approve,true);
		$criteria->compare('work_category_id',$this->work_category_id);
		$criteria->compare('contract_id',$this->contract_id);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
}
