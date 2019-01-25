<?php

	function local_groupuserreport_extend_navigation(global_navigation $navigation)
	{
    	
	    	global $CFG, $PAGE, $USER,$DB;
      
	
			$kng=$navigation->add('User Report');
			$kng->add('Download', new moodle_url($CFG->wwwroot .'/local/groupuserreport/view.php'));

	}
		

?>
