<?php
// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Form\Form;
use Joomla\Database\DatabaseDriver;


class plgSystemAdd_xml_fields extends CMSPlugin
{


/**
* Load the language file on instantiation.
* Note this is only available in Joomla 3.1 and higher.
* If you want to support 3.0 series you must override the constructor

*
* @var boolean
* @since <your version>

*/
protected $autoloadLanguage = true;

public function __construct(&$subject, $config)
{
    parent::__construct($subject, $config);
}
/**
* Prepare form and add my field.

*
* @param   Form  $form  The form to be altered.
* @param   mixed  $data  The associated data for the form.

*
* @return  boolean

*
* @since   <your version>

*/
  function onContentPrepareForm($form, $data)
  {
    $app = Factory::getApplication();
    $option = $app->input->get('option');

    $theadmincomponentsfiles = preg_split('/\s*,\s*/', (string) $this->params->get('theadmincomponentsfiles', ''), -1, PREG_SPLIT_NO_EMPTY);
    $theadmincomponents = preg_split('/\s*,\s*/', (string) $this->params->get('theadmincomponents'), -1, PREG_SPLIT_NO_EMPTY);
    $thesitecomponentsfiles = preg_split('/\s*,\s*/', (string) $this->params->get('thesitecomponentsfiles'), -1, PREG_SPLIT_NO_EMPTY);
    $thesitecomponents = preg_split('/\s*,\s*/', (string) $this->params->get('thesitecomponents'), -1, PREG_SPLIT_NO_EMPTY);
    $pieces = preg_split('/\s*,\s*/', (string) $this->params->get('filenames'), -1, PREG_SPLIT_NO_EMPTY);
    $themodules = preg_split('/\s*,\s*/', (string) $this->params->get('themodules'), -1, PREG_SPLIT_NO_EMPTY);
    if (version_compare(JVERSION, '3.0', 'ge'))
    {
    $db = Factory::getDBO();
    }
    else
    {
      $db = Factory::getContainer()->get(DatabaseDriver::class);
    }
    $query = 'SELECT module' . ' FROM #__modules' . ' WHERE id = ' . $db->Quote($app->input->get("id"));
    $db->setQuery($query);
    $module = $db->loadResult();
//Load the Site Default Template
// if Joomla 3.0
    if (version_compare(JVERSION, '3.0', 'ge'))
    {
    $dbtemplate = Factory::getDBO();
    }
    else
    {
      $dbtemplate = Factory::getContainer()->get(DatabaseDriver::class);
    }
    $querytemplate = "SELECT template FROM #__template_styles WHERE client_id = 0 AND home = 1";
    $dbtemplate->setQuery($querytemplate);
    $defaultsitetemplate = $dbtemplate->loadResult();
      if (version_compare(JVERSION, '3.0', 'ge'))
    {
    $dbadmintemplate = Factory::getDBO();
    }
    else
    {
      $dbadmintemplate = Factory::getContainer()->get(DatabaseDriver::class);
    }
    $queryadmintemplate = "SELECT template FROM #__template_styles WHERE client_id = 1 AND home = 1";
    $dbadmintemplate->setQuery($queryadmintemplate);
    $defaultadmintemplate = $dbadmintemplate->loadResult();
//For ADMIN COMPONENTS
    foreach ($theadmincomponents as $adminkey => $theadmincomponent)
    {
      $theadmincomponent = trim($theadmincomponent);
      if (in_array($option, $theadmincomponents))
      {
        switch ($this->params->get('theadmincomponentsfilespaths'))
        {
          case 'system' :
            Form::addFormPath(JPATH_ADMINISTRATOR . '/templates/system/forms/' . $theadmincomponent . '/');
            break;
          case 'template_override' :
            Form::addFormPath(JPATH_ADMINISTRATOR . '/templates/' . $defaultadmintemplate . '/html/' . $theadmincomponent . '/forms/');
            break;
          case 'plugins' :
            Form::addFormPath(JPATH_PLUGINS . '/system/add_xml_fields/');
            break;
        }
        if ($option == $theadmincomponent)
        {
          $form->loadFile($theadmincomponentsfiles[$adminkey], false);
        }
      }
    }
//For SITE COMPONENTS
    foreach ($thesitecomponents as $sitekey => $thesitecomponent)
    {
      $thesitecomponent = trim($thesitecomponent);
      if (in_array($option, $thesitecomponents))
      {
        switch ($this->params->get('thesitecomponentsfilespaths'))
        {
          case 'system' :
            Form::addFormPath(JPATH_SITE . '/templates/system/forms/' . $thesitecomponent . '/');
            break;
          case 'template_override' :
            Form::addFormPath(JPATH_SITE . '/templates/' . $defaultsitetemplate . '/html/' . $thesitecomponent . '/forms/');
            break;
          case 'plugins' :
            Form::addFormPath(JPATH_PLUGINS . '/system/add_xml_fields/');
            break;
        }
        if ($option == $thesitecomponent)
        {
          $form->loadFile($thesitecomponentsfiles[$sitekey], false);
        }
      }
    }
// For Site Modules
    foreach ($themodules as $key => $themodule)
    {
      $themodule = trim($themodule);
      if (in_array($module, $themodules))
      {
        switch ($this->params->get('thepath'))
        {
          case 'template_override' :
            Form::addFormPath(JPATH_SITE . '/templates/' . $defaultsitetemplate . '/html/' . $themodule . '/');
            break;
          case 'plugins' :
            Form::addFormPath(JPATH_PLUGINS . '/system/add_xml_fields/');
            break;
        }
        if ($module == $themodule)
        {
          $form->loadFile($pieces[$key], false);
        }
      }
    }
  }
}
