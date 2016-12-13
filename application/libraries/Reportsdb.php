<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Reportsdb {
    
    var $month;
    var $day;
    var $year;
    var $monthDays;
    var $monthName;
    var $currentDate;
    var $reports = array();

    public function __construct()
    {
       $this->month = date('m');
       $this->day = date('d');
       $this->year = date('Y');
       $this->monthDays = date('t');
       $this->monthName = date('F');
       $this->currentDate = date('Y-m-d');
    }
    
    public function setMonth($m) {
        $this->month = $m;
        //$this->monthDays = cal_days_in_month(0, $this->month, $this->year);
        $this->monthDays = date('t', strtotime($this->month."/".$this->day."/".$this->year));
         $this->monthName = date('F', strtotime($this->month."/".$this->day."/".$this->year));
         $this->currentDate = date('Y-m-d', strtotime($this->month."/".$this->day."/".$this->year));
    }

    public function setDay($d) {
        $this->day = $d;
        $this->currentDate = date('Y-m-d', strtotime($this->month."/".$this->day."/".$this->year));
    }

    public function setYear($y) {
        $this->year = $y;
        $this->currentDate = date('Y-m-d', strtotime($this->month."/".$this->day."/".$this->year));
    }

    public function setDate($d) {
        $this->month = date('m', strtotime($d));
        $this->day = date('d', strtotime($d));
        $this->year = date('Y', strtotime($d));
        $this->monthDays = date('t', strtotime($d));
        $this->monthName = date('F', strtotime($d));
        $this->currentDate = date('Y-m-d', strtotime($this->month."/".$this->day."/".$this->year));
    }

    public function getReports() {
        $ci = get_instance();
        $ci->load->model('Reports_deposits_model');
        for($i=1;$i<=$this->monthDays;$i++) {
            $cdate = $this->year . '-' . $this->month . '-' . $i;
            $reports = new $ci->Reports_deposits_model;
            $reports->setReportDate($cdate,true);
            $reports->setSelect('(SELECT COUNT(*) FROM reports_deposits WHERE report_date=\''.$cdate.'\') as deposit');
            $reports->setSelect('(SELECT COUNT(*) FROM reports_disbursements WHERE report_date=\''.$cdate.'\') as disburse');
            $this->reports[$cdate] = $reports->get();
        }
    }

    public function init() {
        $this->getReports();
        return $this;
    }
}

/* End of file Global_variables.php */