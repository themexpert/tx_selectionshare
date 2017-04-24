<?php
/**
 * @package    	Tx Selectionshare
 * @author    	ThemeXpert http://www.themexpert.com
 * @copyright  	Copyright (c) 2010-2015 ThemeXpert. All rights reserved.
 * @license  	GNU General Public License version 3 or later; see LICENSE.txt
 * @since    	1.0.0
 */
defined('_JEXEC') or die;

class PlgSystemTx_SelectionShare extends JPlugin
{
	/**
	 * Load the language file on instantiation. Note this is only available in Joomla 3.1 and higher.
	 * If you want to support 3.0 series you must override the constructor
	 *
	 * @var    boolean
	 * @since  3.1
	 */
	protected $autoloadLanguage = true;

	/**
	 * onBeforeRender
	 *
	 * @return bollian
	 */
	public function onBeforeRender()
	{
		// add for admin only menu options
		if (JFactory::getApplication()->isAdmin())
		{
			$input = JFactory::getApplication()->input;
			$option = $input->get('option', '');
			$view = $input->get('view', '');
			if('com_quix' == $option && ('pages' == $view or 'collections' == $view or 'integrations' == $view or 'dashboard' == $view or 'elements' == $view)){
				$pluginid = $this->getPluginId('tx_selectionshare','system','plugin');
				$link = JRoute::_("index.php?option=com_plugins&client_id=0&task=plugin.edit&extension_id=".$pluginid);

				$toolbar = JToolBar::getInstance('toolbar');
				$toolbar->appendButton('Custom', "<a href='".$link ."' target='_blank' class='btn hasPopover' data-title='".JText::_('PLG_SYSTEM_TX_SELECTIONSHARE')."' data-content='".JText::_('PLG_SYSTEM_TX_SELECTIONSHARE_INTRO')."' data-placement='bottom'>".JText::_('PLG_SYSTEM_TX_SELECTIONSHARE_TITLE')."</a>");				
			}
			return;
		}

		// Use only for front-end site 
		$appid = $this->params->get('appid', '');
		$url = JUri::current();		
		$doc = JFactory::getDocument();
		$doc->addScript('media/tx_selectionshare/selection-sharer.js');
		$doc->addStylesheet('media/tx_selectionshare/selection-sharer.css');
		$doc->addScriptDeclaration("jQuery(function($){jQuery('div').selectionSharer();});");

		if($appid){
			$doc->setMetadata('fb:app_id', $appid);
		}

		$doc->setMetadata('og:url', $url);

		return;
	}

	/*
	* method getPluginId
	* used to get plugin for use
	* @element : joomla plugin element name
	* @folder : joomla plugin folder name
	* @type : joomla plugin type
	* @return extension_id
	*/
	function getPluginId($element,$folder, $type)
	{
	    $db = JFactory::getDBO();
	    $query = $db->getQuery(true);
	    $query
	        ->select($db->quoteName('a.extension_id'))
	        ->from($db->quoteName('#__extensions', 'a'))
	        ->where($db->quoteName('a.element').' = '.$db->quote($element))
	        ->where($db->quoteName('a.folder').' = '.$db->quote($folder))
	        ->where($db->quoteName('a.type').' = '.$db->quote($type));
	    $db->setQuery($query);
	    $db->execute();
	    
	    if($db->getNumRows()){
	        return $db->loadResult();
	    }
	    
	    return false;
	}
}
