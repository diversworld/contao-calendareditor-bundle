<?php

/**
 * This file is part of 
 * 
 * CalendarEditorBundle
 * @copyright  Daniel Gaußmann 2018
 * @author     Daniel Gaußmann (Gausi) 
 * @package    Calendar_Editor
 * @license    LGPL-3.0-or-later
 * @see        https://github.com/DanielGausi/Contao-CalendarEditor
 *
 * an extension for
 * Contao Open Source CMS
 * (c) Leo Feyer, LGPL-3.0-or-later
 *
 */


use DanielGausi\CalendarEditorBundle\Hooks\ListAllEventsHook;
use DanielGausi\CalendarEditorBundle\Module\ModuleCalenderEdit;
use DanielGausi\CalendarEditorBundle\Module\ModuleEventEditor;
use DanielGausi\CalendarEditorBundle\Module\ModuleEventReaderEdit;
use DanielGausi\CalendarEditorBundle\Module\ModuleHiddenEventlist;

// Front end modules
$GLOBALS['FE_MOD']['events'] = array
(
	'calendarEdit'  		=> ModuleCalenderEdit::class,
	'EventEditor' 			=> ModuleEventEditor::class,
	'EventReaderEditLink'   => ModuleEventReaderEdit::class,
	'EventHiddenList'   	=> ModuleHiddenEventlist::class
);

$GLOBALS['TL_HOOKS']['getAllEvents'][] = [ListAllEventsHook::class, 'updateAllEvents'];