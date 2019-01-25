<?php 
require('../../config.php');
global $CFG,$DB;
$id = required_param('id',PARAM_INT);
$records=$DB->get_records_sql("select * from {groups} WHERE courseid=$id");
$option='';
if(count($records))
{
	foreach($records as $rec)
	{
		$count=$DB->count_records("groups_members",array('groupid'=>"$rec->id"));
		$option.="<option value='$rec->id'>$rec->name ($count) </option>";
	}
}
else
{
	$option.="<option>no result found</option>";
}
echo $option;
?>