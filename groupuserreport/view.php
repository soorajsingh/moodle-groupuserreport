<?php
require_once('../../config.php');
require('report_form.php');
global $CFG,$SESSION;
$PAGE->set_url(new moodle_url('/local/groupuserreport/view.php'));
$PAGE->set_context(context_system::instance());
require_login();

$mform=new report_form();


if($mform->is_cancelled()) {
	
} else if ($fromform = $mform->get_data()) {

	if($fromform->nogroup)
	{
		$query="select u.* from {user} u LEFT JOIN {groups_members} gm on gm.userid=u.id where gm.userid is null and u.suspended=0 and u.deleted=0 and u.id>2";
	}else if(count($fromform->group)){
		$arr=implode(",",$fromform->group);
		$query="select u.* from {user} u JOIN {groups_members} gm on gm.userid=u.id where gm.groupid in ($arr)";
	}else{
		$query="select u.* from {user} u JOIN {groups_members} gm on gm.userid=u.id join {groups} g on g.id=gm.groupid where g.courseid= {$fromform->course}";
	}
	
	$SESSION->groupuserreport=$query;
	redirect(new moodle_url($CFG->wwwroot.'/local/groupuserreport/user_bulk_download.php'));
} else {
	
echo $OUTPUT->header();
  $mform->display();
}
echo $OUTPUT->footer();