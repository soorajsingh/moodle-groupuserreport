<?php
require_once("$CFG->libdir/formslib.php");
class report_form extends moodleform {
    function definition() {
			global $DB,$PAGE;
        $mform =& $this->_form;
        
		
		
        $mform->addElement('header', 'users', 'Group');
		
		$mform->addElement('advcheckbox', 'nogroup', 'Not in Group', 'all the users not belongs to any group', array('group' => 1), array(0, 1));
		
		$coursearray=array(); 
		$coursearray=$DB->get_records_select_menu('course','',array(),'id','id,fullname');
		$coursearray['']="Choose Course";
		
		
		$mform->addElement('select', 'course', 'Select Course', $coursearray,array('id'=>'id_course'));
        $mform->setDefault('course','');
		
		$groups=array(); 
		$groups=$DB->get_records_select_menu('groups','',array(),'id','id,name');
		$groups['']="Choose Group";
		
        $mform->addElement('select', 'group', 'Select group', $groups,array('id'=>'id_group'));
		$mform->getElement('group')->setMultiple(true);
		// $mform->addRule('group', get_string('error'), 'required', '', 'client', false, false);		
       
		$mform->disabledIf('course', 'nogroup', 'eq', 1);
		$mform->disabledIf('group', 'nogroup', 'eq', 1);
		$mform->disabledIf('group', 'course', 'eq', '');

		
		$modulejs=array(
		'name'=>'apply',
		'fullpath'=>'/local/groupuserreport/js/ajax.js',
		'string'=>array(),
		'requires' => array(),
		);
		$PAGE->requires->js_init_call('apply',array('id_course','id_group'),true,$modulejs);
		
		
		
		
        $this->add_action_buttons();
    }
}