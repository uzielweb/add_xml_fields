<?php
// no direct access
defined('_JEXEC') or die;
class plgSystemAdd_xml_fields extends JPlugin {
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



* @param   JForm  $form  The form to be altered.



* @param   mixed  $data  The associated data for the form.



*



* @return  boolean



*



* @since   <your version>



*/
  function onContentPrepareForm($form, $data) {
    $app = JFactory::getApplication();
    $option = $app->input->get('option');
    $theadmincomponentsfiles = explode(",", $this->params->get('theadmincomponentsfiles'));
    $theadmincomponents = explode(",", $this->params->get('theadmincomponents'));
    $thesitecomponentsfiles = explode(",", $this->params->get('thesitecomponentsfiles'));
    $thesitecomponents = explode(",", $this->params->get('thesitecomponents'));
    $pieces = explode(",", $this->params->get('filenames'));
    $themodules = explode(",", $this->params->get('themodules'));
    $db = JFactory::getDBO();
    $query = 'SELECT module' . ' FROM #__modules' . ' WHERE id = ' . $db->Quote($app->input->get("id"));
    $db->setQuery($query);
    $module = $db->loadResult();
//Load the Site Default Template
    $dbtemplate = JFactory::getDBO();
    $querytemplate = "SELECT template FROM #__template_styles WHERE client_id = 0 AND home = 1";
    $dbtemplate->setQuery($querytemplate);
    $defaulsitetemplate = $dbtemplate->loadResult();
    $dbadmintemplate = JFactory::getDBO();
    $queryadmintemplate = "SELECT template FROM #__template_styles WHERE client_id = 1 AND home = 1";
    $dbadmintemplate->setQuery($queryadmintemplate);
    $defaultadmintemplate = $dbadmintemplate->loadResult();
//For ADMIN COMPONENTS
    foreach ($theadmincomponents as $adminkey => $theadmincomponent) {
      $theadmincomponent = trim($theadmincomponent);
      if (in_array($option, $theadmincomponents)) {
        switch ($this->params->get('theadmincomponentsfilespaths')) {
          case 'system' :
            JForm::addFormPath(JPATH_ADMINISTRATOR . '/templates/system/forms/' . $theadmincomponent . '/');
            break;
          case 'template_override' :
            JForm::addFormPath(JPATH_ADMINISTRATOR . '/templates/' . $defaultadmintemplate . '/html/' . $theadmincomponent . '/forms/');
            break;
          case 'plugins' :
            JForm::addFormPath(JPATH_PLUGINS . '/system/add_xml_fields/');
            break;
        }
        foreach ($theadmincomponentsfiles as $admink => $theadmincomponentsfile) {
          $form->loadFile($theadmincomponentsfiles[$adminkey], false);
        }
      }
    }
//For SITE COMPONENTS
    foreach ($thesitecomponents as $sitekey => $thesitecomponent) {
      $thesitecomponent = trim($thesitecomponent);
      if (in_array($option, $thesitecomponents)) {
        switch ($this->params->get('thesitecomponentsfilespaths')) {
          case 'system' :
            JForm::addFormPath(JPATH_SITE . '/templates/system/forms/' . $thesitecomponent . '/');
            break;
          case 'template_override' :
            JForm::addFormPath(JPATH_SITE . '/templates/' . $defaultsitetemplate . '/html/' . $thesitecomponent . '/forms/');
            break;
          case 'plugins' :
            JForm::addFormPath(JPATH_PLUGINS . '/system/add_xml_fields/');
            break;
        }
        foreach ($thesitecomponentsfiles as $sitek => $thesitecomponentsfile) {
          $form->loadFile($thesitecomponentsfiles[$sitekey], false);
        }
      }
    }
// For Site Modules
    foreach ($themodules as $key => $themodule) {
      $themodule = trim($themodule);
      if (in_array($module, $themodules)) {
        switch ($this->params->get('thepath')) {
          case 'template_override' :
            JForm::addFormPath(JPATH_SITE . '/templates/' . $defaulsitetemplate . '/html/' . $themodule . '/');
            break;
          case 'plugins' :
            JForm::addFormPath(JPATH_PLUGINS . '/system/add_xml_fields/');
            break;
        }
        foreach ($pieces as $k => $piece) {
          $form->loadFile($pieces[$key], false);
        }
      }
    }
  }
}
