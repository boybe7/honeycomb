<?php

/**
 * This is the model class for table "regulation".
 *
 * The followings are the available columns in table 'regulation':
 * @property integer $id
 * @property string $book_no
 * @property string $detail
 * @property string $date_added
 * @property string $category
 * @property string $filename
 * @property string $keyword
 * @property integer $count_click
 */
class Regulation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'regulation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('book_no, detail', 'required'),
			array('count_click', 'numerical', 'integerOnly'=>true),
			array('book_no', 'length', 'max'=>100),
			array('detail, keyword', 'length', 'max'=>500),
			array('category, filename', 'length', 'max'=>300),
			array('filename', 'file',  'allowEmpty'=>true, 'types'=>'docx,pdf,xls,xlsx,doc', 'safe' => false),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, book_no, detail, date_added, category, filename, keyword, count_click', 'safe', 'on'=>'search'),
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
			'book_no' => 'เลขหนังสือ',
			'detail' => 'รายละเอียด',
			'date_added' => 'วันที่',
			'category' => 'ประเภท',
			'filename' => 'ไฟล์',
			'keyword' => 'Keyword',
			'count_click' => 'จำนวนการคลิก',
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
		$criteria->compare('book_no',$this->book_no,true);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('keyword',$this->keyword,true);
		$criteria->compare('count_click',$this->count_click);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function search2() {
		    // @todo Please modify the following code to remove attributes that should not be searched.

		    $criteria = new CDbCriteria;

		   // $criteria->order = 'staffid DESC';
		    //$financialyear = Financialyear::model()->findByAttributes(array('status' => '1')); //! $financialyear stores activated financial year details
		    $searchterm = empty($searchterm) ? trim(Yii::app()->request->getParam('search')) : $searchterm;
		    //$criteria->with = array('department', 'designation');
		    $searchterm = htmlspecialchars($searchterm, ENT_QUOTES);
		    if (!empty($searchterm)) {
		        $criteria->addCondition(' t.book_no like "%' . $searchterm . '%" OR
		              t.detail like "%' . $searchterm . '%" OR
		              t.keyword like "%' . $searchterm.'%"');
		    } else {
		        //$criteria->condition = 't.status = "0"';
		    }

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
	 * @return Regulation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave()
    {


        $str_date = explode("/", $this->date_added);
        if(count($str_date)>1)
        	$this->date_added= $str_date[2]."-".$str_date[1]."-".$str_date[0];

        return parent::beforeSave();
   }
     protected function afterSave(){
            parent::afterSave();
            $str_date = explode("-", $this->date_added);
            if(count($str_date)>1)
            	$this->date_added = $str_date[2]."/".$str_date[1]."/".($str_date[0]);
        
    }
    protected function afterFind(){
            parent::afterFind();
            $str_date = explode("-", $this->date_added);
            if(count($str_date)>1)
            	$this->date_added = $str_date[2]."/".$str_date[1]."/".($str_date[0]);
               
    }
}
