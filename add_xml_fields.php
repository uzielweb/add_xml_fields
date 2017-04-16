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
        $app    = JFactory::getApplication();
        $option = $app->input->get('option');


                if ($app->isAdmin() or $app->isSite())
                {

                        $pieces     = explode(",", $this->params->get('filenames'));
                        $themodules = explode(",", $this->params->get('themodules'));
                        $db    = JFactory::getDBO();
                        $query = "SELECT template FROM #__template_styles WHERE client_id = 0 AND home = 1";
                        $db->setQuery($query);
                        $defaultemplate = $db->loadResult();

                         $db2    = JFactory::getDBO();
                         $query2 = 'SELECT module'
                         .' FROM #__modules'
                         .' WHERE id = ' . $db->Quote($app->input->get("id"));
                         $db2->setQuery($query2);
                        $module = $db2->loadResult();

                        foreach($themodules as $key=>$themodule){
                              if ($module == $themodule){

                               if ($this->params->get('thepath') == 'template_override') {
                                JForm::addFormPath(JPATH_SITE . '/templates/' . $defaultemplate . '/html/' . $themodule . '/');
                                }
                                if ($this->params->get('thepath') == 'plugins') {
                                     JForm::addFormPath(JPATH_PLUGINS . '/system/add_xml_fields/');
                                }
                                 foreach ($pieces as $k => $piece) {
                                $form->loadFile($pieces[$key], false);
                                 }
                              }




                        }






                }

                return true;





    }
}
?>