<?php

//'caledit_dateDirection, 
//caledit_dateIncludeCSS, caledit_dateIncludeCSSTheme, 
//caledit_dateImage, caledit_dateImageSRC'
namespace DanielGausi\CalendarEditorBundle\EventListener\DataContainer;
use Contao\Backend;
use Contao\BackendUser;



class CalendarEventsEditor extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		//$this->import('BackendUser', 'User');
		$user = BackendUser::getInstance();

		if (!$user->isAdmin && !is_array($user->calendars))
		{
			return array();
		}
	}

	/**
	 * Return all event templates as array
	 * @param object
	 * @return array
	 */
	public function getEventEditTemplates()
	{
		return $this->getTemplateGroup('eventEdit_');
	}

	public function getCSSValues()
	{
		$columnFields = null;

		$columnFields = array
		(
			'label' => array (
				'label' => &$GLOBALS['TL_LANG']['tl_module']['css_label'],
				'mandatory' => true,
				'default' => null,
				'inputType' => 'text',
				'eval' => array('style' => 'width:100px')
			),
			'value' => array (
				'label' => &$GLOBALS['TL_LANG']['tl_module']['css_value'],
				'mandatory' => true,
				'inputType' => 'text',
				'eval' => array('rgxp' => 'alpha', 'style' => 'width:70px')
			)
		);
		return $columnFields;
	}
	public function getCalendars()
	{
		if (!$this->User->isAdmin && !is_array($this->User->calendars))
		{
			return array();
		}

		$arrCalendars = array();
		$objCalendars = $this->Database->execute("SELECT id, title FROM tl_calendar ORDER BY title");

		while ($objCalendars->next())
		{
			if ($this->User->hasAccess($objCalendars->id, 'calendars'))
			{
				$arrCalendars[$objCalendars->id] = $objCalendars->title;
			}
		}

		return $arrCalendars;
	}

	/**
	 * Return a list of tinyMCE config files in this system.
	 * copied from "FormRTE", @copyright  Andreas Schempp 2009
	 */
	public function getConfigFiles()
	{
		$arrConfigs = array();

		//$arrFiles = scan(TL_ROOT . '/system/config/');
		$arrFiles = scan(TL_ROOT.'/vendor/mindbird/contao-calendar-editor/src/Resources/contao/tinyMCE/');// . '/system/config/');

		foreach( $arrFiles as $file ) {
			//if (substr($file, 0, 4) == 'tiny') {
			$arrConfigs[] = basename($file, '.php');
			//}
		}
		return $arrConfigs;
	}
}

