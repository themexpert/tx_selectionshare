<?php
/**
 * @package		DigiCom
 * @author 		ThemeXpert http://www.themexpert.com
 * @copyright	Copyright (c) 2010-2015 ThemeXpert. All rights reserved.
 * @license 	GNU General Public License version 3 or later; see LICENSE.txt
 * @since 		1.0.0
 */

defined('_JEXEC') or die;

/**
 * Form Field class for the Joomla Platform.
 *
 * @package     Joomla.Libraries
 * @subpackage  Form
 * @since       3.2
 */
class JFormFieldBasicField extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since   3.2
	 */
	protected $type = 'basicfield';

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string	The field input markup.
	 *
	 * @since   3.2
	 */
	protected function getLabel(){
		return '';
	}
	protected function getInput()
	{
		$html = [];
		$ref = '?utm_medium=banner&utm_campaign=extension-referral&utm_source='.JUri::root();
		$images = [
			'<a target="_blank" href="https://www.themexpert.com/quix-pagebuilder'.$ref.'">
				<img src="'.JUri::root().'media/tx_selectionshare/images/quix-squire.jpg" />
			</a>',

			'<a target="_blank" href="https://www.themexpert.com/joomla-templates'.$ref.'">
				<img src="'.JUri::root().'media/tx_selectionshare/images/join-tx.jpg" />
			</a>'
		];

		$html[] = '<div style="margin-left: -180px;margin-top: 50px;">';
		$html[] = $images[array_rand($images)];
		$html[] = '</div>';
		
		return implode($html);
	}

	
}
