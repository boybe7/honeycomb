<?php

/**
 * This is the model class for table "spec_doc_compare_temp".
 *
 * The followings are the available columns in table 'spec_doc_compare_temp':
 * @property integer $id
 * @property integer $spec_id
 * @property string $brand
 * @property string $model
 * @property string $price
 * @property string $date_price
 * @property string $attach_file2
 * @property string $attach_file1
 * @property string $attach_file3
 */
class SpecDocCompareTemp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $vendor_name;
	public function tableName()
	{
		return 'spec_doc_compare_temp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('spec_id, vendor_id,brand, model, price, date_price, attach_file2, attach_file1, attach_file3', 'required'),
			array('spec_id', 'numerical', 'integerOnly'=>true),
			array('brand', 'length', 'max'=>500),
			array('model, attach_file2', 'length', 'max'=>250),
			array('price', 'length', 'max'=>10),
			array('attach_file1, attach_file3', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, spec_id, brand, model, price, date_price, attach_file2, attach_file1, attach_file3,vendor_id', 'safe', 'on'=>'search'),
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
			'vendor_id' => 'บริษัท',
			'brand' => 'ยี่ห้อ',
			'model' => 'รุ่น',
			'price' => 'ราคา',
			'date_price' => 'Date Price',
			'attach_file2' => 'Attach File2',
			'attach_file1' => 'Attach File1',
			'attach_file3' => 'Attach File3',
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
		$criteria->compare('attach_file2',$this->attach_file2,true);
		$criteria->compare('attach_file1',$this->attach_file1,true);
		$criteria->compare('attach_file3',$this->attach_file3,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SpecDocCompareTemp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
