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


                        $pieces     = explode(",", $this->params->get('filenames'));
                        $themodules = explode(",", $this->params->get('themodules'));
                        $db    = JFactory::getDBO();

                         $query = 'SELECT module'
                         .' FROM #__modules'
                         .' WHERE id = ' . $db->Quote($app->input->get("id"));
                         $db->setQuery($query);
                        $module = $db->loadResult();

                        foreach($themodules as $key=>$themodule){
                            $themodule = trim($themodule);
                              if ($module == $themodule){
                                  switch ($this->params->get('thepath')) {
                                      case 'template_override':
                                          JForm::addFormPath(JPATH_SITE . '/templates/' . $app->getTemplate() . '/html/' . $themodule . '/');
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

                return true;





    }
}

