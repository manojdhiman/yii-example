<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Add Site';
$this->breadcrumbs=array(
	'Contact',
);
?>

<div class="col-md-12 main-front">
<h3 class="page-title">Register a New Site</h3>

<script type="text/javascript">
$(document).ready(function(){
$(".parent_device").click(function() {
    var value = $(this).val();
   if(value==0)
   {
   	$('.my_sites').show();
   	$('.options').hide();
   }else
   {
   $('.my_sites').hide();
   $('.options').show();
   }	
});
});
</script>



<div class="form contact-form">
<?php if(Yii::app()->user->hasFlash('site')): ?>

<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<?php echo Yii::app()->user->getFlash('site'); ?>
</div>

<?php endif; ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'site-form',
	'enableClientValidation'=>true,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		
	),
)); ?>
<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary(array($model,$site)); ?>
				 
		<h3>General Information </h3>
		
			<div class="sys_box location new_site">
			<div class="row">
			<?php
			 echo $form->labelEx($model,'have_parent'); 
                $site_type = array('1'=>'New Device', '0'=>'Old Device');
                echo $form->radioButtonList($model,'have_parent',$site_type,array('separator'=>' ','class'=>'parent_device'));
      		?>
			</div>
			<div class="row my_sites">
					<?php echo $form->labelEx($site,'site_id'); ?>
					<?php echo $form->dropDownList($site,'site_id',LookUp::sites()); ?>
					<?php //echo $form->error($model,'sys_country'); ?>
			</div>
			<div class="row options">
				<?php echo $form->labelEx($site,'name'); ?>
				<?php echo $form->textField($site,'name', array ('class' => 'form-control')); ?>
				<?php //echo $form->error($site,'name'); ?>
			</div>
				<div class="row options" style="height: 68px;">
				<?php 
				echo $form->labelEx($site, 's_icon');
				echo $form->fileField($site, 's_icon');
				echo $form->error($model, 's_icon');
				?>
				</div>
				<div class="row options">
					<?php echo $form->labelEx($site,'public'); ?>
					<?php echo $form->dropDownList($site,'public',array('1'=>'Yes','0'=>'No')); ?>
					<?php //echo $form->error($model,'sys_country'); ?>
				</div>
				<div class="row description options">
					<?php echo $form->labelEx($site,'desc'); ?>
					<?php echo $form->textArea($site,'desc',array('class' => 'form-control','style'=>'min-width:300px')); ?>
					
				</div>
			</div>
	<h3>Location </h3>
			<div class="sys_box location">
				<div class="row">
					<?php echo $form->labelEx($model,'sys_country'); ?>
					<?php echo $form->dropDownList($model,'sys_country',LookUp::country()); ?>
					<?php //echo $form->error($model,'sys_country'); ?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($model,'sys_city'); ?>
					<?php echo $form->textField($model,'sys_city',array('class' => 'form-control')); ?>
					<?php //echo $form->error($model,'sys_city'); ?>
				</div>
	
				<div class="row">
					<?php echo $form->labelEx($model,'sys_street'); ?>
					<?php echo $form->textField($model,'sys_street',array('class' => 'form-control')); ?>
					<?php //echo $form->error($model,'sys_street'); ?>
				</div>
	
				<div class="row">
					<?php echo $form->labelEx($model,'sys_postcode'); ?>
					<?php echo $form->textField($model,'sys_postcode',array('class' => 'form-control')); ?>
					<?php //echo $form->error($model,'sys_postcode'); ?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($model,'lat_long'); ?>
					<?php echo $form->textField($model,'lat_long',array('class' => 'form-control')); ?>
					<?php //echo $form->error($model,'lat_long'); ?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($model,'long'); ?>
					<?php echo $form->textField($model,'long',array('class' => 'form-control')); ?>
					<?php //echo $form->error($model,'long'); ?>
				</div>
			</div>
			
		<h3>PV Design</h3>
		<div class="sys_box pvdesign">
			<div class="row">
				<?php echo $form->labelEx($model,'wattpeak'); ?>
				<?php echo $form->textField($model,'wattpeak',array('class' => 'form-control')); ?>
				<?php //echo $form->error($model,'wattpeak'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model,'sys_type'); ?>
				<?php echo $form->dropDownList($model,'sys_type',LookUp::sys_type()); ?>
				<?php //echo $form->error($model,'sys_type'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model,'module_type'); ?>
				<?php echo $form->dropDownList($model,'module_type',LookUp::module_type()); ?>
				<?php //echo $form->error($model,'module_type'); ?>
			</div>
	
			<div class="row">
				<?php echo $form->labelEx($model,'tilt'); ?>
				<?php echo $form->textField($model,'tilt',array('class' => 'form-control')); ?>
				<?php //echo $form->error($model,'tilt'); ?>
			</div>
			
		</div>
		<h3>Costs </h3>
		<div class="sys_box costs">
		
			<div class="row coc">
				<?php echo $form->labelEx($model,'coc'); ?>
				<?php echo $form->textField($model,'coc',array('class' => 'form-control')); ?>
				<?php //echo $form->error($model,'coc'); ?>
			</div>
			<div class="row currency_opt">
				<?php echo $form->dropDownList($model,'currency',LookUp::get_currency()); ?>
				<?php //echo $form->error($model,'currency'); ?>
			</div>
			<div class="row currency_opt currency_unit">
			<p>/kwp</>
			</div>
			
			<div class="row coe">
				<?php echo $form->labelEx($model,'coe'); ?>
				<?php echo $form->textField($model,'coe',array('class' => 'form-control')); ?>
				<?php //echo $form->error($model,'coe'); ?>
			</div>
			<div class="row currency_opt">
				<?php echo $form->dropDownList($model,'currency',LookUp::get_currency()); ?>
				<?php //echo $form->error($model,'currency'); ?>
			</div>
			<div class="row currency_opt currency_unit">
			<p>/kwp</>
			</div>
			</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit', array ('class' => 'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


</div>
