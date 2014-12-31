<?php

/**
 * This is the model class for table "menu".
 *
 * The followings are the available columns in table 'menu':
 * @property integer $menu_id
 * @property integer $parent_menu_id
 * @property string $menu_referance
 * @property string $menu_mudule
 * @property string $menu_controller
 * @property string $menu_action
 * @property string $menu_name
 * @property string $default_active
 * @property string $status
 * @property string $allowedForFree
 * @property string $allowedForSubscribed
 */
class SiteForm extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	 public $s_icon;
	public function tableName()
	{
		return 'tbl_sites';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,desc,public', 'safe'),
			//array('desc', 'min'=>1, 'max'=>200)
			array('s_icon', 'file', 'types'=>'jpg, gif, png','allowEmpty'=>true),
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
		//array('name', 'required'),
		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'site_id'=>'site',
			'user_id' => 'User Id',
			'name'=>'Site Name',
			'desc'=>'Short Description',
			's_icon'=>'Site Image',
			'public'=>'Public Site?'
			
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
		$criteria->compare('s_heading',$this->s_heading);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Menu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
