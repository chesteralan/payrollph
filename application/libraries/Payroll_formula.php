<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Payroll_formula {
    
    var $CI;
    private $data = array();
    private $x_value = 0;
    private $formula = FALSE;

    public function __construct()
    {
       $this->CI =& get_instance();
    }
            
    function set($key, $value=NULL)
    {
        if( is_array($key) ) {
            foreach($key as $k=>$v) {
                $this->data[$k] = $v;
            }
        } else {
            $this->data[$key] = $value;
        }
    }
    
    function get($key)
    {
        return (isset($this->data[$key])) ? $this->data[$key] : null;
    }
    
    function set_formula($formula) {
        $this->formula = $formula;
    }

    function set_xvalue($xvalue) {
        $this->x_value = $xvalue;
    }

    function calculate() {
        switch($this->formula) {
            case '(X)_HOURS_X_HOURLY_RATE':
                if( $this->get('pe_id') ) {
                    $salaries = new $this->CI->Payroll_employees_salaries_model('pes');
                    $salaries->setPeId($this->get('pe_id'),true);
                    $salary = $salaries->get();

                    switch( $salary->rate_per ) {
                        case 'month':
                          //$monthly_rate = $salary->amount;
                          //$daily_rate = ( ($salary->amount * $salary->months) / $salary->annual_days );
                          $hourly_rate = ( (($salary->amount * $salary->months) / $salary->annual_days) / $salary->hours );
                        break;
                        case 'day':
                          //$monthly_rate = ( $salary->amount * $salary->days );
                          //$daily_rate = $salary->amount;
                          $hourly_rate = ( $salary->amount / $salary->hours );
                        break;
                        case 'hour':
                          //$monthly_rate = ( $salary->amount * $salary->days * $salary->hours );
                          //$daily_rate = ( $salary->amount * $salary->hours );
                          $hourly_rate = $salary->amount;
                        break;
                      }

                    return ($this->x_value * round($hourly_rate,2));
                } 
            break;
            default:
                return $this->x_value;
            break;
        }
    }
    
}

/* End of file Global_variables.php */