<?php
// no direct access
defined ('_JEXEC') or die;
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
* @param   JForm  $form  The form to be altered.
* @param   mixed  $data  The associated data for the form.
*
* @return  boolean
*
* @since   <your version>
*/
function onContentPrepareForm($form, $data)
{



$app = JFactory::getApplication();
$option = $app->input->get('option');
$theadmincomponentsfiles    = explode(",", $this->params->get('theadmincomponentsfiles'));
$theadmincomponents = explode(",", $this->params->get('theadmincomponents'));
$thesitecomponentsfiles     = explode(",", $this->params->get('thesitecomponentsfiles'));
$thesitecomponents = explode(",", $this->params->get('thesitecomponents'));
$pieces     = explode(",", $this->params->get('filenames'));
$themodules = explode(",", $this->params->get('themodules'));



$db    = JFactory::getDBO();



$query = 'SELECT module'
.' FROM #__modules'
.' WHERE id = ' . $db->Quote($app->input->get("id"));
$db->setQuery($query);
$module = $db->loadResult();
//Load the Site Default Template
$dbtemplate    = JFactory::getDBO();
$querytemplate = "SELECT template FROM #__template_styles WHERE client_id = 0 AND home = 1";
$dbtemplate->setQuery($querytemplate);
$defaulsitetemplate = $dbtemplate->loadResult();

$dbadmintemplate    = JFactory::getDBO();
$queryadmintemplate = "SELECT template FROM #__template_styles WHERE client_id = 1 AND home = 1";
$dbadmintemplate->setQuery($queryadmintemplate);
$defauladmintemplate = $dbadmintemplate->loadResult();
 //For ADMIN COMPONENTS
foreach($theadmincomponents as $key=>$theadmincomponent){

$theadmincomponent = trim($theadmincomponent);
if ($option == $theadmincomponent){

switch ($this->params->get('theadmincomponentsfilespaths')) {
case 'system':
JForm::addFormPath(JPATH_ADMINISTRATOR.'/templates/system/forms/'.$theadmincomponent. '/');
break;
case 'template_override':
JForm::addFormPath(JPATH_ADMINISTRATOR . '/templates/' . $defauladmintemplate . '/html/' . $theadmincomponent . '/forms/');
break;
case 'plugins':
JForm::addFormPath(JPATH_PLUGINS . '/system/add_xml_fields/');
break;
}

foreach ($theadmincomponentsfiles as $k => $theadmincomponentsfile) {
$form->loadFile($theadmincomponentsfiles[$key], false);

}
return true;
}
}

//For SITE COMPONENTS
foreach($thesitecomponents as $key=>$thesitecomponent){

$thesitecomponent = trim($thesitecomponent);
if ($option == $thesitecomponent){

switch ($this->params->get('thesitecomponentsfilespaths')) {
case 'system':
JForm::addFormPath(JPATH_SITE.'/templates/system/forms/'.$thesitecomponent. '/');
break;
case 'template_override':
JForm::addFormPath(JPATH_SITE.'/templates/' . $defaulsitetemplate . '/html/' . $thesitecomponent . '/forms/');
break;
case 'plugins':
JForm::addFormPath(JPATH_PLUGINS . '/system/add_xml_fields/');
break;
}

foreach ($thesitecomponentsfiles as $k => $thesitecomponentsfile) {
$form->loadFile($thesitecomponentsfiles[$key], false);

}
return true;
}
}




foreach($themodules as $key=>$themodule){
$themodule = trim($themodule);
if ($module == $themodule){
switch ($this->params->get('thepath')) {
case 'template_override':
JForm::addFormPath(JPATH_SITE . '/templates/' . $defaulsitetemplate . '/html/' . $themodule . '/');
break;
case 'plugins':
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
?>
