<?php

/**
 * This is the model class for table "moc_price".
 *
 * The followings are the available columns in table 'moc_price':
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $unit
 * @property integer $month
 * @property integer $year
 * @property string $price
 * @property string $datetime_record
 */
class MocPrice extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'moc_price';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, name, datetime_record', 'required'),
			array('month, year', 'numerical', 'integerOnly'=>true),
			array('code, unit', 'length', 'max'=>20),
			array('name', 'length', 'max'=>200),
			array('price', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, code, name, unit, month, year, price, datetime_record', 'safe', 'on'=>'search'),
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
			'code' => 'รหัสวัสดุก่อสร้าง',
			'name' => 'รายละเอียด',
			'unit' => 'หน่วยนับ',
			'month' => 'เดือน',
			'year' => 'ปี',
			'price' => 'ราคาเดือนปัจจุบัน',
			'datetime_record' => 'Datetime Record',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('month',$this->month);
		$criteria->compare('year',$this->year);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('datetime_record',$this->datetime_record,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MocPrice the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
