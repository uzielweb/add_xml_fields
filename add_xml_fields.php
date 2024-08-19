<?php
// no direct access
defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Form\FormField;
use Joomla\CMS\Form\FormHelper;
class plgSystemAdd_xml_fields extends JPlugin
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
    $theadmincomponentsfiles = explode(",", $this->params->get('theadmincomponentsfiles'));
    $theadmincomponents = explode(",", $this->params->get('theadmincomponents'));
    $thesitecomponentsfiles = $this->params->get('thesitecomponentsfiles') ? explode(",", $this->params->get('thesitecomponentsfiles')) : array();
    $thesitecomponents = $this->params->get('thesitecomponentsfiles') ? explode(",", $this->params->get('thesitecomponents')) : array();
    $pieces = explode(",", $this->params->get('filenames'));
    $themodules = explode(",", $this->params->get('themodules'));
    $db = Factory::getDBO();
    $query = 'SELECT module' . ' FROM #__modules' . ' WHERE id = ' . $db->Quote($app->input->get("id"));
    $db->setQuery($query);
    $module = $db->loadResult();
//Load the Site Default Template
    $dbtemplate = Factory::getDBO();
    $querytemplate = "SELECT template FROM #__template_styles WHERE client_id = 0 AND home = 1";
    $dbtemplate->setQuery($querytemplate);
    $defaulsitetemplate = $dbtemplate->loadResult();
    $dbadmintemplate = Factory::getDBO();
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
            Form::addFormPath(JPATH_SITE . '/templates/' . $defaulsitetemplate . '/html/' . $themodule . '/');
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
