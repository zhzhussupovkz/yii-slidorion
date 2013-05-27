<?php

/*
* yiiSlidorion - simple jQuery content slider for Yii
* based on slidorion jQuery plugin - http://www.slidorion.com
* @author Zhussupov Zhassulan <zhzhussupovkz@gmail.com>
* @version: 1.0
* MADE IN KAZAKHSTAN
*/
class yiiSlidorion extends CWidget {

	//id
	public $id;

	//слайдер
	public $slides = array();

	//контент
	public $accordion = array();

	//speed
	public $speed = '1000';

	//interval
	public $interval = '4000';

	//effect (slideUp, slideRight, slideDown, slideLeft, ...) - http://www.slidorion.com
	public $effect = 'slideLeft';

	public function run() {
		$this->allScripts();

		//begin slidorion
		echo '<div id = "'.$this->id.'">';

			//begin slides
			echo '<div id = "slider">';
			foreach ($this->slides as $row) {
				echo '<div class = "slide">'.CHtml::image($row['img'], '', array('width' => $row['width'], 'height' => $row['height'])).'</div>';
			}
			echo '</div>';
			//end slides

			//begin content
			echo '<div id = "accordion">';
			foreach ($this->accordion as $row) {
				echo '<div class = "link-header">'.$row['header'].'</div>';
				echo '<div class = "link-content">'.$row['content'].'</div>';
			}
			echo '</div>';
			//end accordion

		echo '</div>';
		//end slidorion

		$script = "$(document).ready(function(){
			$('#".$this->id."').slidorion({
				speed: ".$this->speed.",
				interval: ".$this->interval.",
				effect: '".$this->effect."'
			});
		});";

		Yii::app()->clientScript->registerScript('yiiSlidorion', $script, CClientScript::POS_END);
	}

	//access scripts
	protected function allScripts() {
		$assets = dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
		$baseUrl = Yii::app()->assetManager->publish($assets);
		if(is_dir($assets)) {
			Yii::app()->clientScript->registerCoreScript('jquery');
			Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/jquery.slidorion.min.js');
			Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/jquery.easing.js');
			Yii::app()->clientScript->registerCssFile($baseUrl.'/css/slidorion.css');
		}
		else {
			throw new Exception('Error in yiiSlidorion widget! Cannot access assets folder');
		}
	}

}
