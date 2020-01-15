<?php

/**
 * This is the model class for table "spec_search".
 *
 * The followings are the available columns in table 'spec_search':
 * @property integer $id
 * @property string $material
 * @property string $detail
 * @property string $dimension
 * @property string $unit
 * @property integer $price1
 * @property integer $price2
 * @property integer $price3
 * @property integer $compare_id
 * @property integer $moc_id
 * @property string $note
 */
class SpecSearch extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'spec_search';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('material, detail, dimension, unit, price1, price2, price3, compare_id, moc_id, note', 'required'),
			array('price1, price2, price3, compare_id, moc_id', 'numerical', 'integerOnly'=>true),
			array('material, dimension', 'length', 'max'=>500),
			array('detail, note', 'length', 'max'=>800),
			array('unit', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, material, detail, dimension, unit, price1, price2, price3, compare_id, moc_id, note', 'safe', 'on'=>'search'),
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
			'material' => 'Material',
			'detail' => 'Detail',
			'dimension' => 'Dimension',
			'unit' => 'Unit',
			'price1' => 'Price1',
			'price2' => 'Price2',
			'price3' => 'Price3',
			'compare_id' => 'Compare',
			'moc_id' => 'Moc',
			'note' => 'Note',
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
		$criteria->compare('material',$this->material,true);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('dimension',$this->dimension,true);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('price1',$this->price1);
		$criteria->compare('price2',$this->price2);
		$criteria->compare('price3',$this->price3);
		$criteria->compare('compare_id',$this->compare_id);
		$criteria->compare('moc_id',$this->moc_id);
		$criteria->compare('note',$this->note,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SpecSearch the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
