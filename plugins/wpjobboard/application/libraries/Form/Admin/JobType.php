<?php
/**
 * Description of Category
 *
 * @author greg
 * @package
 */

class Wpjb_Form_Admin_JobType extends Daq_Form_ObjectAbstract
{
    protected $_model = "Wpjb_Model_JobType";

    public function _exclude()
    {
        if($this->_object->getId()) {
            return array("id" => $this->_object->getId());
        } else {
            return array();
        }
    }

    public function init()
    {
        $e1 = new Daq_Form_Element("id", Daq_Form_Element::TYPE_HIDDEN);
        $e1->setValue($this->_object->id);
        $e1->addFilter(new Daq_Filter_Int());
        $this->addElement($e1);

        $e3 = new Daq_Form_Element("title");
        $e3->setRequired(true);
        $e3->setValue($this->_object->title);
        $e3->setLabel(__("Job Type Title",WPJB_DOMAIN));
        $e3->setHint(__("The name is used to identify the category almost everywhere, for example under the post or in the category widget.", WPJB_DOMAIN));
        $this->addElement($e3);

        $e2 = new Daq_Form_Element("slug");
        $e2->setRequired(true);
        $e2->setValue($this->_object->slug);
        $e2->setLabel(__("Job Type Slug", WPJB_DOMAIN));
        $e2->setHint(__("The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.", WPJB_DOMAIN));
        $e2->addValidator(new Daq_Validate_Slug());
        $e2->addValidator(new Daq_Validate_Db_NoRecordExists("Wpjb_Model_JobType", "slug", $this->_exclude()));
        $this->addElement($e2);

        $e4 = new Daq_Form_Element("description", Daq_Form_Element::TYPE_TEXTAREA);
        $e4->setValue($this->_object->description);
        $e4->setLabel(__("Job Type Description", WPJB_DOMAIN));
        $e4->setHint(__("Briefly describe job type. (You can use HTML tags.)", WPJB_DOMAIN));
        $this->addElement($e4);

        $e5 = new Daq_Form_Element("color");
        $e5->setValue($this->_object->color);
        $e5->addFilter(new Daq_Filter_Trim("#"));
        $e5->setLabel(__("Text Color", WPJB_DOMAIN));
        $this->addElement($e5);
        
        apply_filters("wpja_form_init_jobtype", $this);

    }
}

?>