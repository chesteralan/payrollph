<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php 

/* draws a calendar */
function draw_calendar($name_id, $month,$year,$absences=NULL, $attendance=NULL, $overtimes=NULL){

  $absents = array();
  if( $absences ) {
    foreach($absences as $idate) {
      $absents[$idate->date_absent] = $idate;
    }
  }

  $presents = array();
  if( $attendance ) {
    foreach($attendance as $adate) {
      $presents[$adate->date_present] = $adate;
    }
  }
  $overtime = array();
  if( $overtimes ) {
    foreach($overtimes as $odate) {
      $overtime[$odate->date_overtime] = $odate;
    }
  }
  
print_r($absences);
  /* draw table */
  $calendar = '<table cellpadding="0" cellspacing="0" class="calendar" width="100%">';

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
    $calendar.= '<td class="calendar-day-np calendar-day-np2"> </td>';
    $days_in_this_week++;
  endfor;

  /* keep going with days.... */
  for($list_day = 1; $list_day <= $days_in_month; $list_day++):

    $list_date = date('Y-m-d', strtotime($year.'-'.$month.'-'.$list_day));
    $list_date2 = date('F d, Y', strtotime($year.'-'.$month.'-'.$list_day));

    $calendar.= '<td class="calendar-day calendar-day2 text-right ';
    

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

      if( !$working_day ) {
        $calendar.= 'disabled ';        
      } else {
          if( isset($absents[$list_date]) ) {
            $calendar.= 'is_absent ';        
          }
          if( isset($presents[$list_date]) ) {
            $calendar.= 'is_absent ';        
          }
      }

      $calendar.= '">';

      if( $working_day ) {
        $calendar.= '<a class="date_checkbox ajax-modal" data-toggle="modal" data-title="'.$list_date2.'" href="#ajaxModal" data-url="'.site_url("employees_dtr/add_leave_by_name/{$name_id}/{$list_date}/ajax") . "?next=" . uri_string() .'">';
          if( isset($absents[$list_date]) ) {
              $calendar.="<p class='text-center'><strong>".(($absents[$list_date]->leave_type)?$absents[$list_date]->leave_name:'Leave without pay')."</strong>";
              $calendar.=" (".number_format(($absents[$list_date]->hours/8),2)." day)</p>";
              if( $absents[$list_date]->notes!='' ) {
                $calendar.="<p class='text-center'>".$absents[$list_date]->notes."</p>";
              }
          } else {
            $calendar.= "<p class='text-center'>Set Absence</p>";
          }
        $calendar.= '</a>';
         $calendar.= '<a class="date_checkbox ajax-modal" data-toggle="modal" data-title="'.$list_date2.'" href="#ajaxModal" data-url="'.site_url("employees_dtr/add_attendance/{$name_id}/{$list_date}/ajax") . "?next=" . uri_string() .'">';
          if( isset($presents[$list_date]) ) {
              $calendar.="<p class='text-center'><strong>Employee is present</strong> (".number_format(($presents[$list_date]->hours/8),2)." day)</p>";
              if( $presents[$list_date]->notes!='' ) {
                $calendar.="<p class='text-center'>".$presents[$list_date]->notes."</p>";
              }
          } else {
            $calendar.="<p class='text-center'>Set Attendance</p>";
          }
        $calendar.= '</a>';
        $calendar.= '<a class="date_checkbox ajax-modal" data-toggle="modal" data-title="'.$list_date2.'" href="#ajaxModal" data-url="'.site_url("employees_dtr/add_overtime/{$name_id}/{$list_date}/ajax") . "?next=" . uri_string() .'">';
          if( isset($overtime[$list_date]) ) {
              $calendar.="<p class='text-center'><strong>Employee is present</strong> (".$overtime[$list_date]->hours." day)</p>";
              if( $overtime[$list_date]->notes!='' ) {
                $calendar.="<p class='text-center'>".$overtime[$list_date]->notes."</p>";
              }
          } else {
            $calendar.="<p class='text-center'>Set Overtime</p>";
          }
        $calendar.= '</a>';
      }

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
<?php $this->load->view('header'); ?>
<?php if( ! $inner_page ): ?>
<?php $this->load->view('employees/employees/employees_view_navbar'); ?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
<a href="<?php echo site_url("employees_dtr/view/{$name_id}/{$next_month}/{$next_year}"); ?>" class="pull-right"><?php echo date('F Y', strtotime($next_year.'-'.$next_month.'-01')); ?> &rArr;</a>
<a href="<?php echo site_url("employees_dtr/view/{$name_id}/{$previous_month}/{$previous_year}"); ?>" class="pull-left">&lArr; <?php echo date('F Y', strtotime($previous_year.'-'.$previous_month.'-01')); ?></a>                  
                  <center>
                  <h3 class="panel-title bold">
<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <strong><?php echo date('F Y', strtotime($current_month."/1/".$current_year)); ?></strong> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
<?php for($i=1;$i <= 12; $i++ ) { ?>
    <li class="<?php echo ($i==$current_month) ? "active" : ""; ?>"><a href="<?php echo site_url("employees_dtr/view/{$name_id}/{$i}/{$current_year}"); ?>"><?php echo date('F Y', strtotime($i."/1/".$current_year)); ?></a></li>
<?php } ?>
  </ul>
</div>

                  </h3>
                </center>
                </div>
                <div class="panel-body" id="ajaxBodyInnerPage">
<?php endif; ?>

<?php echo draw_calendar($employee->name_id, $current_month,$current_year, $absences, $attendance); ?>

<?php if( ! $inner_page ): ?>

              </div>
              </div>
            </div>
    </div>
</div>
<?php endif; ?>
<?php $this->load->view('footer'); ?>