

<?php

class AddsiteController extends Controller {	

public  $sidebar, $sidebar_loggedin, $selected, $model, $pageheading;
	
    
	/**
	 * Decl
	 * ares class-based actions.
	 */
	
    

	public function init(){
		  $this->sidebar = array("Descriptions of monitoring platforms/ Tutorials"=>"index", "Support"=>"support", "Purchase hardware"=>"purchasehardware", "Purchase monthly subscriptions"=>"monthlysubscriptions", "Download"=>"download");
		  
		  $this->sidebar_loggedin = array("Dashboard"=>array("link"=>"dashboard","id"=>"1"), "Reports"=>array("link"=>"reports","id"=>"2"), "Alarms"=>array("link"=>"alarms","id"=>"3"), "My Account"=>array("link"=>"myaccount","id"=>"4"));
		  $this->model = new SoilMonitoring;
		  $this->pageheading = "Soil Monitoring";
	}

	
	
	public function accessRules() {
		if(!Yii::app()->user->isGuest){
			return array(
				array(
					'allow',
					'actions' => array('dashboard', 'reports', 'alarms', 'myaccount'),
					'users' => array('*'),
				),				
			);
		}else{
				return array(
				array(
					'allow',
					'actions' => array('index','support', 'purchasehardware', 'monthlysubscriptions', 'download'),
					'users' => array('*'),
				),				
			);
		}
	}
	public function isguestuser()
    {
        if(Yii::app()->user->isGuest)
        {
        	
            $this->redirect(yii::app()->getModule('user')->get_site_url()."/login");
            return;
        }
    }
	public function actionIndex() {	
	  	$this->isguestuser();
	  	$model=new SiteForm;
	  	$sys_info=new SystemForm;
	  	if(isset($_POST['SiteForm']))
		{		
				$sys_info->attributes=$_POST['SystemForm'];
				$model->attributes=$_POST['SiteForm'];
				
				if($model->validate()&&$sys_info->validate())
				{
				$id=Yii::app()->user->id;
				$timezone=LookUp::get_timezone($_POST['SystemForm']['lat_long'],$_POST['SystemForm']['long'],$_POST['SystemForm']['sys_country']);
				if($_POST['SystemForm']['have_parent']==1)
				{
					$model->user_id=Yii::app()->user->id;
					//$model->name=$_POST['SiteForm']['name'];
					$uploadedFile=CUploadedFile::getInstance($model,'s_icon');
					$dir=Yii::app() -> basePath.'/../uploads/sites/';
					if(!is_dir($dir))
					{
						mkdir($dir);
					}
					$ext=end(explode('.',$uploadedFile));
					$name=$id."-".time().'.'.$ext;
					$uploadedFile->saveAs($dir.$name);
					$model->s_icon=$name;
					$model->save();
					$sys_info->site_id=$model->site_id;
				}else
				{
					$sys_info->site_id=$_POST['SiteForm']['site_id'];
					
				}
				$sys_info->have_parent=$_POST['SystemForm']['have_parent'];
				$sys_info->user_id=Yii::app()->user->id;
				$sys_info->timezone=$timezone;
				$sys_info->save();
				$activation_url=$this->createAbsoluteUrl('/user/sites/update/',array("id" =>$sys_info->site_id));
				UserModule::sendMail('manoj@rudrainnovatives.com',UserModule::t("new site registered! please review it"),UserModule::t("A new Device has been registered on your website, Please <b>Approve/Decline</b> The by clicking the following button <center><a style='border-radius:3px;font-size:15px;color:white;border:1px #1373b5 solid;text-decoration:none;padding:14px 7px 14px 7px;margin:6px auto;display:block;background-color:#007ee6; width:190px' href='{activation_url}' target='_blank'>Click Here</a></center></br>You can also open the  link  in the Browser </br>{link}</br>The site information is given below:-</br>
				<table>
					<tr><td>Site name</td><td>{sitename}</td></tr>
					<tr><td>Latitude,Longitude</td><td>{lat,long}</td></tr>
					<tr><td>System Size</td><td>{sysize}</td></tr>
					<tr><td>Country</td><td>{country}</td></tr>
				</table> ",
				array('{link}'=>$activation_url,'{sitename}'=>$model->name,'{lat,long}'=>$sys_info->lat_long.','.$sys_info->long,'{sysize}'=>$sys_info->wattpeak,'{country}'=>$sys_info->sys_country)));
				
				Yii::app()->user->setFlash('site','your Site has been registerd successfully.it will accessible after approval');
				$this->refresh();
				}else $sys_info->validate();
		}
		$this->render('index',array('site'=>$model,'model'=>$sys_info));
	}

}
