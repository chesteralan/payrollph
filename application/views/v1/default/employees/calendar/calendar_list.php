<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php 
/* draws a calendar */
function draw_calendar($month,$year,$current_dates){

  $cDates = array();
  $cDates2 = array();
  if( $current_dates ) {
    foreach($current_dates as $current_date) {
      $cDates[$current_date->calendar_date] = $current_date;
      $cDates2[date("m-d", strtotime($current_date->calendar_date))] = $current_date;
    }
  }

  /* draw table */
  $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

  /* table headings */
  $headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
  $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

  /* days and weeks vars now ... */
  $running_day = date('w',mktime(0,0,0,$month,1,$year));
  $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
  $days_in_this_week = 1;
  $day_counter = 0;
  $dates_array = array();

  /* row for week one */
  $calendar.= '<tr class="calendar-row">';

  /* print "blank" days until the first of the current week */
  for($x = 0; $x < $running_day; $x++):
    $calendar.= '<td class="calendar-day-np"> </td>';
    $days_in_this_week++;
  endfor;

  /* keep going with days.... */
  for($list_day = 1; $list_day <= $days_in_month; $list_day++):

    $list_date = date('Y-m-d', strtotime($year.'-'.$month.'-'.$list_day));

      $working_day = true;
      switch ($running_day) {
        case '0':
          $working_day = WORK_ON_SUN;
          break;
        case '1':
          $working_day = WORK_ON_MON;
          break;
        case '2':
          $working_day = WORK_ON_TUE;
          break;
        case '3':
          $working_day = WORK_ON_WED;
          break;
        case '4':
          $working_day = WORK_ON_THU;
          break;
        case '5':
          $working_day = WORK_ON_FRI;
          break;
        case '6':
          $working_day = WORK_ON_SAT;
          break;
      }

          $calendar.= '<td class="calendar-day text-right ';
          $calendar.= (($working_day)?'':' disabled');
          $calendar.= ((isset($cDates[$list_date]))? ' has-data':'');
          $calendar.= ((isset($cDates2[date('m-d', strtotime($list_date))]))? ' has-data':'');
          $calendar.= ((date('Y-m-d')==$list_date)? ' current-day':'');
          $calendar.='">';

        $calendar.= '<a class="date_link" data-title="'.date('F d, Y', strtotime($list_date)).'" href="'.site_url("employees_calendar/records/{$list_date}") . "?next=" . uri_string() .'">';
        //$calendar.= '<input type="hidden" name="inclusive_date[]" value="'.$list_date.'">';
        //$calendar.= '<input type="checkbox" name="selected[]" value="'.$list_date.'"';
        //$calendar.= '>';
        
        if(isset($cDates[$list_date])) {
          $calendar.=((isset($cDates[$list_date])) ? $cDates[$list_date]->notes . " (+".$cDates[$list_date]->premium."%)" :'');
        } else {
          $calendar.=((isset($cDates2[date('m-d', strtotime($list_date))])) ? $cDates2[date('m-d', strtotime($list_date))]->notes . " (+".$cDates2[date('m-d', strtotime($list_date))]->premium."%)" :'');
        }

        $calendar.= '</a>';


      /* add in the day number */
      $calendar.= '<div class="day-number day-number2">';
       $calendar.= $list_day;
      $calendar.='</div>';

      /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
      $calendar.= str_repeat('<p> </p>',2);
        

    $calendar.= '</td>';
    if($running_day == 6):
      $calendar.= '</tr>';
      if(($day_counter+1) != $days_in_month):
        $calendar.= '<tr class="calendar-row">';
      endif;
      $running_day = -1;
      $days_in_this_week = 0;
    endif;
    $days_in_this_week++; $running_day++; $day_counter++;
  endfor;

  /* finish the rest of the days in the week */
  if($days_in_this_week < 8):
    for($x = 1; $x <= (8 - $days_in_this_week); $x++):
      $calendar.= '<td class="calendar-day-np"> </td>';
    endfor;
  endif;

  /* final row */
  $calendar.= '</tr>';

  /* end the table */
  $calendar.= '</table>';
  
  /* all done, return result */
  return $calendar;
}

?>

<?php if( isset($output) && ($output!='ajax') ) : ?>

<?php $this->load->view('header'); ?>

<?php $this->load->view('employees/employees_navbar'); ?>

<div class="container">
<div class="row">
<?php 
$next = ($this->input->get('next')) ? $this->input->get('next') : 'employees_calendar';
?>
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <a href="<?php echo site_url("employees_calendar/index/".date('m', strtotime('+1 month', strtotime($current_year.'-'.$current_month.'-01')))."/".date('Y', strtotime('+1 month', strtotime($current_year.'-'.$current_month.'-01')))."/{$output}") . "?next={$next}"; ?>" class="pull-right"><?php echo date('F Y', strtotime('+1 month', strtotime($current_year.'-'.$current_month.'-01'))); ?> &rArr;</a>

          <a href="<?php echo site_url("employees_calendar/index/".date('m', strtotime('-1 month', strtotime($current_year.'-'.$current_month.'-01')))."/".date('Y', strtotime('-1 month', strtotime($current_year.'-'.$current_month.'-01')))."/{$output}") . "?next={$next}"; ?>" class="pull-left">&lArr; <?php echo date('F Y', strtotime('-1 month', strtotime($current_year.'-'.$current_month.'-01'))); ?></a>

<div class="text-center" style="margin-top:0px;">

  <div class="btn-group">
  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <strong><?php echo date('F Y', strtotime($current_month."/1/".$current_year)); ?></strong> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
<?php for($i=1;$i <= 12; $i++ ) { ?>
    <li class="<?php echo ($i==$current_month) ? "active" : ""; ?>"><a href="<?php echo site_url("employees_calendar/index/{$i}/{$current_year}"); ?>"><?php echo date('F Y', strtotime($i."/1/".$current_year)); ?></a></li>
<?php } ?>
  </ul>
</div>

<a href="<?php echo site_url("employees_calendar/import"); ?>">
  <span class="fa fa-upload"></span> Upload Timesheet
</a>  
</div>

        </div>

        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; ?>

<?php 
echo draw_calendar($current_month,$current_year,$current_dates);
?>


<?php if( isset($output) && ($output!='ajax') ) : ?>
        </div>

      </div>
    </div>
</div>
</div>
<?php $this->load->view('footer'); ?>
<?php endif; ?>