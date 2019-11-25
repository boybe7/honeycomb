<?php

/**
 * This is the model class for table "labor_cost".
 *
 * The followings are the available columns in table 'labor_cost':
 * @property integer $id
 * @property string $no
 * @property string $detail
 * @property integer $category
 * @property string $filename
 * @property string $unit
 * @property integer $cost
 * @property string $remark
 */
class LaborCost extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'labor_cost';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('detail, category', 'required'),
			array('category, cost', 'numerical', 'integerOnly'=>true),
			array('no', 'length', 'max'=>2),
			//array('detail, remark,group_detail,subgroup_detail', 'length', 'max'=>500),
			array('filename', 'file',  'allowEmpty'=>true, 'types'=>'docx,pdf,xls,xlsx,doc', 'safe' => false),
			array('unit', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, no, detail, category, filename, unit, cost, remark,group_detail,subgroup_detail', 'safe', 'on'=>'search'),
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
			'no' => 'ลำดับ',
			'detail' => 'รายการ',
			'category' => 'ประเภท',
			'filename' => 'ไฟล์แนบ',
			'unit' => 'หน่วย',
			'cost' => 'ค่าแรง/หน่วย(บาท)',
			'remark' => 'หมายเหตุ',
			'group_detail'=>'ประเภท',
			'subgroup_detail'=>'งาน'
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
		$criteria->compare('no',$this->no,true);

		$criteria->compare('category',$this->category);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('cost',$this->cost);
		$criteria->compare('remark',$this->remark,true);

		$criteria2=new CDbCriteria;
		$criteria2->compare('detail',$this->detail,true,'OR');
		$criteria2->compare('subgroup_detail',$this->subgroup_detail,true,'OR');
		$criteria2->compare('group_detail',$this->group_detail,true);

		$criteria->mergeWith($criteria2, 'OR');
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(

                        'pageSize'=>50,

                ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LaborCost the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getCategory($m)
    {
        $status = '';
        switch ($m->category) {
        	case 0:
        		$status = "บัญชีค่าแรง (กรมบัญชีกลาง)";
        		break;
        	case 1:
        		$status = "ค่าแรงสืบค้น";
        		break;
        	case 2:
        		$status = "ค่าแรงกำหนดเอง";
        		break;	
        	default:
        		# code...
        		break;
        }
        return $status;
    }

    public function getCategoryFormat($m)
    {
        $status = '';
        switch ($m->category) {
        	case 0:
        		$status = "บัญชีค่าแรง (กรมบัญชีกลาง)";
        		break;
        	case 1:
        		$status = "ค่าแรงสืบค้น";
        		break;
        	case 2:
        		$status = "ค่าแรงกำหนดเอง";
        		break;	
        	default:
        		# code...
        		break;
        }
        if(empty($m->subgroup_detail))
        	return "<b>".$status."</b>";
        else
        	return "<b>".$status.' :: <i>'.$m->subgroup_detail."</i></b>";
    }

    public function getRemark($m)
    {

        $msg = $m->remark."  ";
        if($m->category==1 && !empty($m->filename))
        	$msg .= ", <a href='../../honeycomb/fileuploads/labor_cost/".$m->filename."'><img src='../../honeycomb/images/icon-doc.png' width='14px'></a>ใบเสนอราคา</a>";
        else if($m->category==2 && !empty($m->filename))
        	$msg .= ", <a href='../../honeycomb/fileuploads/labor_cost/".$m->filename."'><img src='../../honeycomb/images/icon-doc.png' width='14px'></a>ใบแสดงการคำนวณ";
        
        return $msg;
    }


}
