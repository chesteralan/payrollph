<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php 

/* draws a calendar */
function draw_calendar($month,$year,$inclusive_dates){

  $inc_dates = array();
  if( $inclusive_dates ) {
    foreach($inclusive_dates as $idate)
    $inc_dates[] = $idate->inclusive_date;
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
    $calendar.= '<td class="calendar-day text-right">';

      $list_date = date('Y-m-d', strtotime($year.'-'.$month.'-'.$list_day));
      $calendar.= '<label class="date_checkbox">';
      $calendar.= '<input type="hidden" name="inclusive_date[]" value="'.$list_date.'">';
      $calendar.= '<input type="checkbox" name="selected[]" value="'.$list_date.'"';
      $calendar.= (in_array($list_date, $inc_dates)) ? ' CHECKED':'';
      $calendar.= '>';
      $calendar.= '</label>';

      /* add in the day number */
      $calendar.= '<div class="day-number">';
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

<?php $this->load->view('payroll/payroll_navbar'); ?>

<div class="container">
<div class="row">

  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Payroll Calendar</h3>
        </div>
<form method="post">
        <div class="panel-body">
  <?php echo (validation_errors()) ? '<div class="alert alert-danger">' . validation_errors() . '</div>' : ''; ?>

<?php endif; 

$current_month = ($this->input->get('month')) ? $this->input->get('month') : $payroll->month;
$current_year = ($this->input->get('year')) ? $this->input->get('year') : $payroll->year;
?>
<input type="hidden" name="payroll_id" value="<?php echo $payroll->id; ?>"/>
<h4 class="text-center" style="margin-top:0px;">
<a href="<?php echo site_url("payroll/inclusive_dates/{$payroll->id}/{$output}") . "?next=payroll&month=" .  date('m', strtotime('+1 month', strtotime($current_year.'-'.$current_month.'-01'))) . "&year=" .  date('Y', strtotime('+1 month', strtotime($current_year.'-'.$current_month.'-01'))); ?>" class="pull-right ajax-modal-inner">&rArr;</a>
<a href="<?php echo site_url("payroll/inclusive_dates/{$payroll->id}/{$output}") . "?next=payroll&month=" .  date('m', strtotime('-1 month', strtotime($current_year.'-'.$current_month.'-01'))) . "&year=" .  date('Y', strtotime('-1 month', strtotime($current_year.'-'.$current_month.'-01'))); ?>" class="pull-left ajax-modal-inner">&lArr;</a>
<?php echo date('F', strtotime($current_month."/1/1970")); ?> <?php echo $current_year; ?></h4> 
<?php 
echo draw_calendar($current_month,$current_year, $inclusive_dates);
?>

<?php if( isset($output) && ($output!='ajax') ) : ?>
        </div>
</form>
      </div>
    </div>
</div>
</div>
<?php $this->load->view('footer'); ?>
<?php endif; ?>