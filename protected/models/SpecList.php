<?php

/**
 * This is the model class for table "spec_list".
 *
 * The followings are the available columns in table 'spec_list':
 * @property integer $id
 * @property string $detail
 * @property integer $spec_id
 * @property integer $spec_compare_id1
 * @property integer $spec_compare_id2
 * @property integer $spec_compare_id3
 */
class SpecList extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'spec_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('detail, spec_id', 'required'),
			array('spec_id, spec_compare_id1, spec_compare_id2, spec_compare_id3', 'numerical', 'integerOnly'=>true),
			array('detail', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, detail, spec_id, spec_compare_id1, spec_compare_id2, spec_compare_id3', 'safe', 'on'=>'search'),
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
			'detail' => 'Detail',
			'spec_id' => 'Spec',
			'spec_compare_id1' => 'Spec Compare Id1',
			'spec_compare_id2' => 'Spec Compare Id2',
			'spec_compare_id3' => 'Spec Compare Id3',
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
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('spec_id',$this->spec_id);
		$criteria->compare('spec_compare_id1',$this->spec_compare_id1);
		$criteria->compare('spec_compare_id2',$this->spec_compare_id2);
		$criteria->compare('spec_compare_id3',$this->spec_compare_id3);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SpecList the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
