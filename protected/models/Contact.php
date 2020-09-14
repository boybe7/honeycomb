<?php

/**
 * This is the model class for table "contact".
 *
 * The followings are the available columns in table 'contact':
 * @property integer $id
 * @property string $name
 * @property string $detail
 * @property string $telephone
 * @property string $website
 * @property string $card
 * @property integer $category
 */
class Contact extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contact';
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
			array('category', 'numerical', 'integerOnly'=>true),
			array('name, detail,address', 'length', 'max'=>500),
			array('telephone', 'length', 'max'=>20),
			array('website, card', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, detail, telephone, website, card, category,address,tax_id', 'safe', 'on'=>'search'),
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
			'name' => 'บริษัท/ผู้ประกอบการ/ร้านค้า',
			'detail' => 'ประเภทสินค้า/บริการ',
			'telephone' => 'เบอร์โทร',
			'website' => 'Website',
			'card' => 'Card',
			'category' => 'ประเภทงาน',
			'tax_id' => 'เลขประจำตัวผู้เสียภาษี',
			'address' => 'ที่อยู่',
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
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('card',$this->card,true);
		$criteria->compare('category',$this->category);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchByID($id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('card',$this->card,true);
		$criteria->compare('category',$id);

		$searchterm = empty($searchterm) ? trim(Yii::app()->request->getParam('search_key')) : $searchterm;
		$searchterm = htmlspecialchars($searchterm, ENT_QUOTES);
		if (!empty($searchterm) ) {
		    $criteria->addCondition(' name LIKE "%' . $searchterm . '%" OR
		              detail LIKE "%' .$searchterm.'%"');
		} 

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getQuotationFile($data)
    {
    	
    	$model = RequestQuotation::model()->findAll(array("condition"=>"contact_id=".$data->id));
    	$str = "";
    	foreach ($model as $key => $value) {
    		//$str .= $value->filename."<br>";
    		if(!empty($value->filename))
    		$str .= CHtml::link($value->detail,Yii::app()->createUrl('/Contact/download?filename='.$value->filename),array("target"=>"_blank","class"=>"export"))."<br>";
    	}

    	
    	return $str;
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
