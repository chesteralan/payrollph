<?php
/*
| -------------------------------------------------------------------
| MY_Model
| -------------------------------------------------------------------
| This file is the parent class of Model Classes
|
| version 4.4
|
*/
class MY_Model extends CI_Model
{

    protected $_table_name = NULL;
    protected $_short_name = NULL;
    protected $_fields = array();
    protected $_required = array();
    protected $_dataFields = array();
    protected $_select = array();
    protected $_join = array();
    protected $_where = array();
    protected $_where_or = array();
    protected $_where_in = array();
    protected $_where_in_or = array();
    protected $_where_not_in = array();
    protected $_where_not_in_or = array();
    protected $_like = array();
    protected $_like_or = array();
    protected $_like_not = array();
    protected $_like_not_or = array();
    protected $_having = array();
    protected $_having_or = array();
    protected $_group_by = array();
    protected $_filter = array();
    protected $_order = array();
    protected $_exclude = array();
    protected $_start = 0;
    protected $_limit = 10;
    protected $_results = FALSE;
    protected $_distinct = FALSE;
    protected $_cache_on = FALSE;
    protected $_db = NULL;
    protected $_inserted_id = NULL;

    public function __construct($short_name=NULL, $db_config='default') {
        parent::__construct(); 
        $this->_db = $this->db; 
        $this->_short_name = ($short_name!=NULL && (trim($short_name)!='')) ? $short_name : $this->_short_name;
        if( $db_config ) {
            $this->_db = $this->load->database( $db_config, TRUE, TRUE );
        }
    }

        /**
    * set field values and conditions
    * @access protected
    * @param  String
    * @return $this;
    */

    protected function _set_field($field_name, $value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
        $this->$field_name = ( ($value == '') && ($this->$field_name != '') ) ? '' : $value;
        if( $setWhere ) {
            $key = $this->_short_name . '.' . $field_name;
            if ( $whereOperator != NULL && $whereOperator != '' ) {
                $key = $key . ' ' . $whereOperator;
            }
            
            $this->__field_conditions($underCondition,$key, $value, $priority);
            
        }
        if( $set_data_field ) {
            $this->_dataFields[] = $field_name;
        }
        return $this;
    }

/**
    * Checks if result not empty 
    * @access public
    * @param  None
    * @return Boolean;
    */

    public function nonEmpty() {
        if ( $this->has_conditions() ) {
            
            $this->setup_join();
            $this->setup_conditions();
            $this->setup_group_by();
            
            if( $this->_cache_on ) {
                $this->_db->cache_on();
            }
            
            $query = $this->_db->get($this->_db->database . '.' . $this->_table_name . ' ' . $this->_short_name, 1);
            
            if( $this->_cache_on ) {
                $this->_db->cache_off();
            }
            
            $result = $query->result();
            if ( isset( $result[0] ) === true ) {
                $this->_results = $result[0];
                return true;
            } else {
                return false;
            }
        }
    }


    /**
    * Get Results 
    * @return Mixed;
    */

    public function getResults() {
        return $this->_results;
    }


    public function get_results() {
        return $this->_results;
    }

    // --------------------------------------------------------------------

    /**
    * Delete 
    * @access public
    * @param  String
    * @return Boolean;
    */

    public function delete() {
        if ( $this->has_conditions() ) {
                $this->setup_conditions();
                return $this->_db->delete($this->_db->database . '.' . $this->_table_name);
        }
    }


    // --------------------------------------------------------------------

    /**
    * Limit Data Fields
    * @access public
    * @param  String
    * @return Boolean;
    */

    public function limitDataFields($fields) {
                $this->limit_data_fields($fields);
    }

    public function limit_data_fields($fields) {
        if($fields != '') {
            if( ! is_array($fields) ) {
                $this->_dataFields = array($fields);
            } else {
                $this->_dataFields = $fields;
            }
        }
    }

    public function clear_data_fields() {
        $this->_dataFields = array();
    }

    // --------------------------------------------------------------------

    /**
    * Update 
    * @access public
    * @param  String
    * @return Boolean;
    */

    public function update() {
        if ( ( $this->get_data() ) && ( $this->has_conditions() ) ) {
                                $this->_set_db_data(); 
                $this->setup_conditions();
                return $this->_db->update($this->_db->database . '.' . $this->_table_name . ' ' . $this->_short_name );
        }
    }


    // --------------------------------------------------------------------

    /**
    * Insert new row 
    * @access public
    * @param  String
    * @return Boolean;
    */

    public function insert() {
        if( $this->get_data() ) {
            $this->_set_db_data(); 
            if( $this->_db->insert( $this->_db->database . '.' . $this->_table_name ) === TRUE ) {
                $this->id = $this->_db->insert_id();
                $this->_inserted_id = $this->_db->insert_id();
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }


    // --------------------------------------------------------------------


    // --------------------------------------------------------------------

    /**
    * Get Inserted Id 
    * @access public
    * @param  String
    * @return Boolean;
    */

    public function get_inserted_id() {
        return $this->_inserted_id;
    }


    // --------------------------------------------------------------------

    /**
    * Replace new row 
    * @access public
    * @param  String
    * @return Boolean;
    */

    public function replace() {
        if( $this->get_data() ) {
            $this->_set_db_data(); 
            if( $this->_db->replace( $this->_db->database . '.' . $this->_table_name ) === TRUE ) {
                $this->id = $this->_db->insert_id();
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
    
    // --------------------------------------------------------------------

    /**
    * Get First Data 
    * @access public
    * @return Object / False;
    */

    public function get() {
        
        if( $this->_select ) {
                $this->_db->select( implode(',' , $this->_select) );
        }
        
        $this->setup_join();
        $this->setup_conditions();
        $this->setup_group_by();
        
        if( $this->_order ) {
            foreach( $this->_order as $field=>$orientation ) {
                $this->_db->order_by( $field, $orientation );
            }
        }
        
        $this->_db->limit( 1, $this->_start);
        
        if( $this->_cache_on ) {
            $this->_db->cache_on();
        }
        
        $query = $this->_db->get($this->_db->database . '.' . $this->_table_name . ' ' . $this->_short_name);
        
        if( $this->_cache_on ) {
            $this->_db->cache_off();
        }
        
        $result = $query->result();
        
        if( isset($result[0]) ) {
            
            $this->_results = $result[0];
            
            return $this->_results;
            
        }
        
        return false;
    }
    // --------------------------------------------------------------------

    /**
    * Populate Data 
    * @access public
    * @param  String
    * @return Array;
    */

    public function populate() {
    
        if( $this->_distinct ) {
            $this->_db->distinct();
        }
        
        if( $this->_select ) {
                $this->_db->select( implode(',' , $this->_select ) );
        }
        
        $this->setup_join();
        $this->setup_conditions();
        $this->setup_group_by();
        
        if( $this->_order ) {
            foreach( $this->_order as $field=>$orientation ) {
                $this->_db->order_by( $field, $orientation );
            }
        }
        
        if( $this->_limit > 0 ) {
            $this->_db->limit( $this->_limit,$this->_start);
        }
        
        if( $this->_cache_on ) {
            $this->_db->cache_on();
        }
        
        $query = $this->_db->get($this->_db->database . '.' . $this->_table_name . ' ' . $this->_short_name);
        
        if( $this->_cache_on ) {
            $this->_db->cache_off();
        }
            
        $this->_results = $query->result();
        
        return $this->_results;
    }
    
    // --------------------------------------------------------------------
    
    /**
    * Recursive 
    * @access public
    * @param  String
    * @return Array;
    */

    public function recursive($match, $find, $child='id', $level=10, $conn='children') {
            if( $level == 0 ) return;
            if( $this->_limit > 0 ) {
                $this->_db->limit( $this->_limit,$this->_start);
            }
            if( $this->_select ) {
                    $this->_db->select( implode(',' , $this->_select) );
            }
            
            $this->setup_join();
            $this->set_where($match, $find);
            $this->setup_conditions();
            $this->setup_group_by();
            $this->clear_where( $match );
            
            if( $this->_order ) {
                foreach( $this->_order as $field=>$orientation ) {
                    $this->_db->order_by( $field, $orientation );
                }
            }
            
            if( $this->_cache_on ) {
                $this->_db->cache_on();
            }
            
            $query = $this->_db->get($this->_db->database . '.' . $this->_table_name . ' ' . $this->_short_name);
            
            if( $this->_cache_on ) {
                $this->_db->cache_off();
            }
            
            $results=array();
            if( $query->result() ) {
                foreach( $query->result() as $qr ) {
                    $children = $this->recursive($match, $qr->$child, $child, ($level-1), $conn ) ;
                    $results[] = (object) array_merge( (array) $qr, array($conn=>$children) );
                }
            }
        return $results;
    }

    // --------------------------------------------------------------------
    
    /**
    * Recursive One
    * @access public
    * @param  String
    * @return Array;
    */

    public function recursive_one($match, $find, $get_field='id', $container=array(), $primary_field='id', $level=10) {
            if( $level == 0 ) return;
            if( $this->_limit > 0 ) {
                $this->_db->limit( $this->_limit,$this->_start);
            }
            if( $this->_select ) {
                    $this->_db->select( implode(',' , $this->_select) );
            }
            
            $this->setup_join();
            $this->set_where($match, $find);
            $this->setup_conditions();
            $this->setup_group_by();
            $this->clear_where( $match );
            
            if( $this->_order ) {
                foreach( $this->_order as $field=>$orientation ) {
                    $this->_db->order_by( $field, $orientation );
                }
            }
            
            if( $this->_cache_on ) {
                $this->_db->cache_on();
            }
            
            $query = $this->_db->get($this->_db->database . '.' . $this->_table_name . ' ' . $this->_short_name);
            
            if( $this->_cache_on ) {
                $this->_db->cache_off();
            }
            
            if( $query->result() ) {
                foreach( $query->result() as $qr ) {
                    $container[] = $qr->$get_field;
                    $container = $this->recursive_one($match, $qr->$primary_field, $get_field, $container, $primary_field, ($level-1) ) ;                   
                }
            }
        return $container;
    }

        // --------------------------------------------------------------------

    /**
    * Set Field Where Clause 
    * @access public
    * @param String / Array
    * @return Array;
    */

    public function set_field_where($fields) {
        if($fields != '') {
            if( ! is_array($fields) ) {
                $this->_where[] = array($fields => $this->$fields);
            } else {
                foreach($fields as $field) {
                    if($w != '') {
                        $this->_where[] = array($field => $this->$field);
                    }
                }
            }
        }
    }

        // --------------------------------------------------------------------

    /**
    * Set Field Value Manually
    * @access public
    * @param Field Key ; Value
    * @return self;
    */
    
    public function set_field_value($field_name, $value, $setWhere=FALSE, $set_data_field=FALSE, $whereOperator=NULL, $underCondition=NULL, $priority=NULL) {
        return $this->_set_field($field_name, $value, $setWhere, $set_data_field, $whereOperator, $underCondition, $priority);
    }
    
    // --------------------------------------------------------------------

    /**
    * Prepares data 
    * @access private
    * @return Array;
    */

    public function get_data($exclude=NULL) {
        $data = array();

        $fields = $this->_fields;
        if( count( $this->_dataFields ) > 0 ) {
            $fields = $this->_dataFields;
        }
        foreach( $fields as $field ) {
            
            if( ( in_array( $field, $this->_required ) ) 
            && ( $this->$field === '' ) 
            && ( ! in_array( $field, $this->_exclude ) ) 
            ) {
                return false;
            }
            if( ( in_array( $field, $this->_required ) ) 
            && ($this->$field !== '') 
            && ( ! in_array( $field, $this->_exclude ) ) 
            ) {
                $data[$field] = $this->$field;
            }
            if( ( ! in_array( $field, $this->_required ) ) 
            && ( ! in_array( $field, $this->_exclude ) ) 
            ) {
                $data[$field] = $this->$field;
            }  
        }

        return $data;   
    }

        // --------------------------------------------------------------------

        /**
    * set data to ci_db
    * @access protected
    * @return Null;
    */
    
    protected function _set_db_data() {
        if( $this->get_data() ) {
            foreach($this->get_data() as $key=> $value) {
                if( !is_null($value) ) {
                    $this->_db->set($key, $value);
                }
            }
        }
    }

        // --------------------------------------------------------------------
        
    /**
    * Field Conditions Clauses 
    * @access protected
    * @return Null;
    */

    protected function __field_conditions($underCondition,$key, $value, $priority) {
        switch( $underCondition ) {
            case 'where_or':
                if( ! is_array( $value ) ) {
                    $value = explode(',', $value );
                }
                $this->set_where_or($key, $value, $priority);
            break;
            case 'where_in':
                if( ! is_array( $value ) ) {
                    $value = explode(',', $value );
                }
                $this->set_where_in($key, $value, $priority);
            break;
            case 'where_in_or':
                if( ! is_array( $value ) ) {
                    $value = explode(',', $value );
                }
                $this->set_where_in_or($key, $value, $priority);
            break;
            case 'where_not_in':
                if( ! is_array( $value ) ) {
                    $value = explode(',', $value );
                }
                $this->set_where_not_in($key, $value, $priority);
            break;
            case 'where_not_in_or':
                if( ! is_array( $value ) ) {
                    $value = explode(',', $value );
                }
                $this->set_where_not_in_or($key, $value, $priority);
            break;
            case 'like':
                if( ! is_array( $value ) ) {
                    $value = explode(',', $value );
                }
                $this->set_like($key, $value, $priority);
            break;
            case 'like_or':
                if( ! is_array( $value ) ) {
                    $value = explode(',', $value );
                }
                $this->set_like_or($key, $value, $priority);
            break;
            case 'like_not':
                if( ! is_array( $value ) ) {
                    $value = explode(',', $value );
                }
                $this->set_like_not($key, $value, $priority);
            break;
            case 'like_not_or':
                if( ! is_array( $value ) ) {
                    $value = explode(',', $value );
                }
                $this->set_like_not_or($key, $value, $priority);
            break;
            default:
                $this->set_where($key, $value, $priority);
            break;
        }
    }
    
    // --------------------------------------------------------------------

    /**
    * Setup Conditional Clauses 
    * @access public
    * @return Null;
    */
    
    protected function __apply_condition($what, $condition) {
        if( is_array( $condition ) ) {
            foreach( $condition as $key => $value ) {
                $this->_db->$what( $key , $value );
            }
        } else {
            $this->_db->$what( $condition );
        }
    }
    
    protected function setup_conditions() {
        $return = FALSE;
        
        $conditions = array_merge( $this->_where, $this->_filter, $this->_where_or, $this->_where_in, $this->_where_in_or, $this->_where_not_in, $this->_where_not_in_or, $this->_like, $this->_like_or, $this->_like_not, $this->_like_not_or, $this->_having, $this->_having_or );
        
        if( count( $conditions ) > 0 ) {
            $i = 0;
            $sorted = array();
            
            foreach( $conditions as $condition ) {
                foreach( $condition as $field=>$options ) {
                    $priority = $options['priority'];
                    unset( $options['priority'] );
                    if( ! is_null( $priority ) ) {
                        while( isset($sorted[$priority]) ) {
                            $i++;
                            $priority += $i;
                        }
                        $sorted[ $priority ] = $options;
                    }
                }
            }
            
            foreach( $conditions as $condition ) {
                foreach( $condition as $field=>$options ) {
                    $priority = $options['priority'];
                    unset( $options['priority'] );
                    if( is_null( $priority )  ) {
                        while( isset($sorted[$i]) ) {
                            $i++;
                        }
                        $sorted[$i] = $options;
                    } 
                }
            }
            
            ksort( $sorted );
        
            foreach( $sorted as $sortd ) {
                $sortd_key = array_keys( $sortd );
                $sortd_value = array_values( $sortd );
                
                if( isset( $sortd_key[0] ) && $sortd_value[0] ) {
                    switch( $sortd_key[0] ) {
                        case 'where_or':
                            $this->__apply_condition('or_where', $sortd_value[0]);
                        break;
                        case 'where_in':
                            $this->__apply_condition('where_in', $sortd_value[0]);
                        break;
                        case 'where_in_or':
                            $this->__apply_condition('or_where_in', $sortd_value[0]);
                        break;
                        case 'where_not_in':
                            $this->__apply_condition('where_not_in', $sortd_value[0]);
                        break;
                        case 'where_not_in_or':
                            $this->__apply_condition('or_where_not_in', $sortd_value[0]);
                        break;
                        case 'like':
                            $this->__apply_condition('like', $sortd_value[0]);
                        break;
                        case 'like_or':
                            $this->__apply_condition('or_like', $sortd_value[0]);
                        break;
                        case 'like_not':
                            $this->__apply_condition('not_like', $sortd_value[0]);
                        break;
                        case 'like_not_or':
                            $this->__apply_condition('or_not_like', $sortd_value[0]);
                        break;
                        case 'having':
                            $this->__apply_condition('having', $sortd_value[0]);
                        break;
                        case 'having_or':
                            $this->__apply_condition('or_having', $sortd_value[0]);
                        break;
                        default:
                            $this->__apply_condition('where', $sortd_value[0]);
                        break;
                    }
                }
            }
            $return = TRUE;
        }
        
        return $return;
    }
    
    /**
    * Check Conditions Availability
    * @access public
    * @return Array;
    */
        
    private function has_conditions() {
        $conditions = array_merge( $this->_where, $this->_filter, $this->_where_or, $this->_where_in, $this->_where_in_or, $this->_where_not_in, $this->_where_not_in_or, $this->_like, $this->_like_or, $this->_like_not, $this->_like_not_or, $this->_having, $this->_having_or );
        if( count( $conditions ) > 0 ) {
            return true;
        }
        return false;
    }
    

    // --------------------------------------------------------------------
    /**
    * Set Join Clause 
    * @access public
    * @param String / Array
    * @return Array;
    */
    

    public function set_join($table, $connection, $option=NULL, $database=NULL) {
        
        $table = ( $database ) ? $database . "." . $table : $table;
        $option = ( $option ) ? $option : 'left';
        
        $this->_join[] = array('table'=>$table, 'connection'=>$connection, 'option'=>$option );
    }

    private function setup_join() {
        if( $this->_join ) {
            foreach( $this->_join as $join ) {
                $this->_db->join( $join['table'], $join['connection'], $join['option'] );
            }
            return false;
        }
        return true;
    }
    
    // --------------------------------------------------------------------

    /**
    * Set Filter 
    * @access public
    * @return Array;
    */
    
    public function set_filter($field, $value, $table=NULL, $priority=NULL, $underCondition='where') {
        $key = array();
        if( $table == NULL ) { 
            $table = $this->_db->database . '.' . $this->_table_name; 
        } 
        if( $table != '' ) {
            $key[] = $table;
        }
        $key[] = $field;
        
        $newField = implode('.', $key);
        
        if( is_null( $value ) ) {
            $where = $newField;
        } else {
            $where = array( $newField => $value );
        }
        
        $this->_filter[] = array( $newField => array( $underCondition => $where, 'priority'=>$priority ) );
    }
        
    public function clear_filter($field=NULL) {
        if( is_null( $field ) ) {
            unset($this->_filter);
            $this->_filter = array();
        } else {
            $newfilter = array();
            foreach($this->_filter as $filter ) {
                if( ! isset( $filter[$field] ) ) {
                    $newfilter[] = $filter;
                }
            }
            $this->_filter = $newfilter;
        }
    }

    // --------------------------------------------------------------------

    /**
    * Set Where 
    * @access public
    */
    
    public function set_where($field, $value=NULL, $priority=NULL) {
        if( is_null( $value ) ) {
            $where = $field;
        } else {
            $where = array( $field => $value );
        }
        $this->_where[] = array( $field => array( 'where' => $where, 'priority'=>$priority )); 
    }
        
    public function clear_where($field=NULL) {
        if( is_null( $field ) ) {
            unset($this->_where);
            $this->_where = array();
        } else {
            $newwhere = array();
            foreach($this->_where as $where ) {
                if( ! isset( $where[$field] ) ) {
                    $newwhere[] = $where;
                }
            }
            $this->_where = $newwhere;
        }
    }
    
    /**
    * Set Or Where 
    * @access public
    */
            
    public function set_where_or($field, $value=NULL, $priority=NULL) {
        if( is_null( $value ) ) {
            $where = $field;
        } else {
            $where = array( $field => $value );
        }
        $this->_where_or[] = array( $field => array( 'where_or' => $where, 'priority'=>$priority ));  
    }
    
    public function clear_where_or($field=NULL) {
        if( is_null( $field ) ) {
            unset($this->_where_or);
            $this->_where_or = array();
        } else {
            $newwhere_or = array();
            foreach($this->_where_or as $where_or ) {
                if( ! isset( $where_or[$field] ) ) {
                    $newwhere_or[] = $where_or;
                }
            }
            $this->_where_or = $newwhere_or;
        }
    }
    
    /**
    * Set Where In
    * @access public
    */
            
    public function set_where_in($field, $value=NULL, $priority=NULL) {
        if( is_null( $value ) ) {
            $where = $field;
        } else {
            $where = array( $field => $value );
        }
        $this->_where_in[] = array( $field => array( 'where_in' => $where, 'priority'=>$priority ));  
    }
    
    public function clear_where_in($field=NULL) {
        if( is_null( $field ) ) {
            unset($this->_where_in);
            $this->_where_in = array();
        } else {
            $newwhere_in = array();
            foreach($this->_where_in as $where_in ) {
                if( ! isset( $where_in[$field] ) ) {
                    $newwhere_in[] = $where_in;
                }
            }
            $this->_where_in = $newwhere_in;
        }
    }
    
    /**
    * Set Or Where In
    * @access public
    */
    
    public function set_where_in_or($field, $value=NULL, $priority=NULL) {
        if( is_null( $value ) ) {
            $where = $field;
        } else {
            $where = array( $field => $value );
        }
        $this->_where_in_or[] = array( $field => array( 'where_in_or' => $where, 'priority'=>$priority ));  
    }
    
    public function clear_where_in_or($field=NULL) {
        if( is_null( $field ) ) {
            unset($this->_where_in_or);
            $this->_where_in_or = array();
        } else {
            $newwhere_in_or = array();
            foreach($this->_where_in_or as $where_in_or ) {
                if( ! isset( $where_in_or[$field] ) ) {
                    $newwhere_in_or[] = $where_in_or;
                }
            }
            $this->_where_in_or = $newwhere_in_or;
        }
    }
    
    /**
    * Set Where Not In
    * @access public
    */
    
    public function set_where_not_in($field, $value=NULL, $priority=NULL) {
        if( is_null( $value ) ) {
            $where = $field;
        } else {
            $where = array( $field => $value );
        }
        $this->_where_not_in[] = array( $field => array( 'where_not_in' => $where, 'priority'=>$priority )); 
    }
    
    public function clear_where_not_in($field=NULL) {
        if( is_null( $field ) ) {
            unset($this->_where_not_in);
            $this->_where_not_in = array();
        } else {
            $newwhere_not_in = array();
            foreach($this->_where_not_in as $where_not_in ) {
                if( ! isset( $where_not_in[$field] ) ) {
                    $newwhere_not_in[] = $where_not_in;
                }
            }
            $this->_where_not_in = $newwhere_not_in;
        }
    }
    
    /**
    * Set Or Where Not In
    * @access public
    */
        
    public function set_where_not_in_or($field, $value=NULL, $priority=NULL) {
        if( is_null( $value ) ) {
            $where = $field;
        } else {
            $where = array( $field => $value );
        }
        $this->_where_not_in_or[] = array( $field => array( 'where_not_in_or' => $where, 'priority'=>$priority )); 
    }
        
    public function clear_where_not_in_or($field=NULL) {
        if( is_null( $field ) ) {
            unset($this->_where_not_in_or);
            $this->_where_not_in_or = array();
        } else {
            $newwhere_not_in_or = array();
            foreach($this->_where_not_in_or as $where_not_in_or ) {
                if( ! isset( $where_not_in_or[$field] ) ) {
                    $newwhere_not_in_or[] = $where_not_in_or;
                }
            }
            $this->_where_not_in_or = $newwhere_not_in_or;
        }
    }
    
    // --------------------------------------------------------------------

    /**
    * Set Like
    * @access public
    */

    public function set_like($field, $value=NULL, $priority=NULL) {
        if( is_null( $value ) ) {
            $where = $field;
        } else {
            $where = array( $field => $value );
        }
        $this->_like[] = array( $field => array( 'like' => $where, 'priority'=>$priority )); 
    }
        
    public function clear_like($field=NULL) {
        if( is_null( $field ) ) {
            unset($this->_like);
            $this->_like = array();
        } else {
            $newlike = array();
            foreach($this->_like as $like ) {
                if( ! isset( $like[$field] ) ) {
                    $newlike[] = $like;
                }
            }
            $this->_like = $newlike;
        }
    }
    
    /**
    * Set Like
    * @access public
    */
    
    public function set_like_or($field, $value=NULL, $priority=NULL) {
        if( is_null( $value ) ) {
            $where = $field;
        } else {
            $where = array( $field => $value );
        }
        $this->_like_or[] = array( $field => array( 'like_or' => $where, 'priority'=>$priority ));  
    }

    public function clear_like_or($field=NULL) {
        if( is_null( $field ) ) {
            unset($this->_like_or);
            $this->_like_or = array();
        } else {
            $newlike_or = array();
            foreach($this->_like_or as $like_or ) {
                if( ! isset( $like_or[$field] ) ) {
                    $newlike_or[] = $like_or;
                }
            }
            $this->_like_or = $newlike_or;
        }
    }
    
    /**
    * Set Like
    * @access public
    */
    
    public function set_like_not($field, $value=NULL, $priority=NULL) {
        if( is_null( $value ) ) {
            $where = $field;
        } else {
            $where = array( $field => $value );
        }
        $this->_like_not[] = array( $field => array( 'like_not' => $where, 'priority'=>$priority ));  
    }

    public function clear_like_not($field=NULL) {
        if( is_null( $field ) ) {
            unset($this->_like_not);
            $this->_like_not = array();
        } else {
            $newlike_not = array();
            foreach($this->_like_not as $like_not ) {
                if( ! isset( $like_not[$field] ) ) {
                    $newlike_not[] = $like_not;
                }
            }
            $this->_like_not = $newlike_not;
        }
    }
    
    /**
    * Set Like
    * @access public
    */

    public function set_like_not_or($field, $value=NULL, $priority=NULL) {
        if( is_null( $value ) ) {
            $where = $field;
        } else {
            $where = array( $field => $value );
        }
        $this->_like_not_or[] = array( $field => array( 'like_not_or' => $where, 'priority'=>$priority ));  
    }

    public function clear_like_not_or($field=NULL) {
        if( is_null( $field ) ) {
            unset($this->_like_not_or);
            $this->_like_not_or = array();
        } else {
            $newlike_not_or = array();
            foreach($this->_like_not_or as $like_not_or ) {
                if( ! isset( $like_not_or[$field] ) ) {
                    $newlike_not_or[] = $like_not_or;
                }
            }
            $this->_like_not_or = $newlike_not_or;
        }
    }
    
    // --------------------------------------------------------------------
    
    /**
    * Set Having 
    * @access public
    */
    
    public function set_having($field, $value=NULL, $priority=NULL) {
        if( is_null( $value ) ) {
            $having = $field;
        } else {
            $having = array( $field => $value );
        }
        $this->_having[] = array( $field => array( 'having' => $having, 'priority'=>$priority )); 
    }
    
    public function clear_having($field=NULL) {
        if( is_null( $field ) ) {
            unset($this->_having);
            $this->_having = array();
        } else {
            $newhaving = array();
            foreach($this->_having as $having ) {
                if( ! isset( $having[$field] ) ) {
                    $newhaving[] = $having;
                }
            }
            $this->_having = $newhaving;
        }
    }
    
    /**
    * Set Or Having 
    * @access public
    */

    public function set_having_or($field, $value=NULL, $priority=NULL) {
        if( is_null( $value ) ) {
            $having = $field;
        } else {
            $having = array( $field => $value );
        }
        $this->_having_or[] = array( $field => array( 'having_or' => $having, 'priority'=>$priority )); 
    }
    
    public function clear_having_or($field=NULL) {
        if( is_null( $field ) ) {
            unset($this->_having_or);
            $this->_having_or = array();
        } else {
            $newhaving_or = array();
            foreach($this->_having_or as $having_or ) {
                if( ! isset( $having_or[$field] ) ) {
                    $newhaving_or[] = $having_or;
                }
            }
            $this->_having_or = $newhaving_or;
        }
    }
    
    // --------------------------------------------------------------------

    /**
    * Set Group By
    * @access public
    */
    
    public function set_group_by($fields,$reset=FALSE) {
        if( $reset ) {
            unset($this->_group_by);
            $this->_group_by = array();
        }
        if( is_array( $fields ) ) { 
            $this->_group_by = array_merge( $this->_group_by, $fields );
        } else {
            $this->_group_by[] = $fields;
        }
        return $this;
    }

        
    private function setup_group_by() {
        if( $this->_group_by ) {
            $this->_db->group_by( $this->_group_by );
            return true;
        }
        return false;
    }
    
    // --------------------------------------------------------------------
    
    /**
    * Set Start  
    * @access public
    */

    public function set_start($value) {
        $this->_start = $value;
        return $this;
    }

        // --------------------------------------------------------------------

        /**
    * Get Start  
    * @access public
    */
    
    public function get_start() {
        return $this->_start;
    }

        // --------------------------------------------------------------------
        
    /**
    * Set Limit  
    * @access public
    */
    
    public function set_limit($value) {
        $this->_limit = $value;
        return $this;
    }

    // --------------------------------------------------------------------

        /**
    * Get Limit  
    * @access public
    */
    
    public function get_limit() {
        return $this->_limit;
    }

    // --------------------------------------------------------------------
    
    /**
    * Set Order  
    * @access public
    */
        
    public function set_order($field, $orientation='asc') {
        $this->_order[$field] = $orientation;
        return $this;
    }

    // --------------------------------------------------------------------

    /**
    * Set Select  
    * @access public
    */
        
    public function set_select($select, $priority=NULL, $reset=FALSE) {
        if($reset) {
            unset( $this->_select );
            $this->_select = array();
        }
        if( is_array ( $select ) ) {
            $this->_select = array_merge( $this->_select, $select );
        } else {
            if( is_null( $priority ) ) {
                $this->_select[] = $select;
            } else {
                $this->_select[$priority] = $select;
            }
        }
        return $this;
    }

    // --------------------------------------------------------------------

    /**
    * Set Exclude  
    * @access public
    */
            
    public function set_exclude($exclude, $reset=FALSE) {
        if($reset) {
            unset( $this->_exclude );
            $this->_exclude = array();
        }
        if( is_array ( $exclude ) ) {
            $this->_exclude = array_merge( $this->_exclude, $exclude );
        } else {
            $this->_exclude[] = $exclude;
        }
        return $this;
    }

    // --------------------------------------------------------------------

    /**
    * Set Exclude  
    * @access public
    */
    
    public function is_distinct($distinct=TRUE) {
        $this->_distinct = $distinct;
        return $this;
    }
    
    // --------------------------------------------------------------------

    /**
    * Count All  
    * @access public
    */

    public function count_all() {
        return  $this->_db->count_all($this->_db->database . '.' . $this->_table_name . ' ' . $this->_short_name);
    }

    // --------------------------------------------------------------------

    /**
    * Count All Results 
    * @access public
    */

    public function count_all_results() {
                $numrows = 0;
                $this->_db->from($this->_db->database . '.' . $this->_table_name . ' ' . $this->_short_name);
        $this->setup_conditions();
        $this->setup_join();
        if( $this->setup_group_by() ) {
            $this->_db->select($this->_short_name . ".*");
            $sql_select = $this->_db->get_compiled_select();
            $query = $this->_db->query("SELECT COUNT(*) as numrows FROM ({$sql_select}) as numrows_table;");
            $result = $query->result();
            $numrows = $result[0]->numrows;
        } else {
            $numrows = $this->_db->count_all_results();
        }
        return  $numrows;
    }

    // --------------------------------------------------------------------

    /**
    * SQL Functions  
    * @access public
    */

    public function sql_function($function, $field, $alias=false, $hasConditions=true) {
        if( $this->_select ) {
                $this->_db->select( implode(',' , $this->_select) );
        }
        if( $alias ) {
                        $this->_db->select($function.'('.$field.') AS ' . $alias);
        } else {
                        $this->_db->select($function.'('.$field.')');
        }
        if( $hasConditions ) {
                $this->setup_join();
                $this->setup_conditions();
                $this->setup_group_by();
        }
        return  $this->_db->get($this->_db->database . '.' . $this->_table_name . ' ' . $this->_short_name, 1);
    }   
    // --------------------------------------------------------------------

    /**
    * Cache Control
    * @access public
    */

    public function cache_on() {
        $this->_cache_on = TRUE;
    }

    public function cache_off() {
        $this->_cache_on = FALSE;
    }

    public function set_db_cache($value=false) {
        $this->_cache_on = $value;
    }

    public function db_close() {
        $this->_db->close();
    }

    public function get_compiled_select() {
        
        if( $this->_distinct ) {
            $this->_db->distinct();
        }
        
        if( $this->_select ) {
                $this->_db->select( implode(',' , $this->_select ) );
        }
        
        $this->setup_join();
        $this->setup_conditions();
        $this->setup_group_by();
        
        if( $this->_order ) {
            foreach( $this->_order as $field=>$orientation ) {
                $this->_db->order_by( $field, $orientation );
            }
        }
        
        if( $this->_limit > 0 ) {
            $this->_db->limit( $this->_limit,$this->_start);
        }

        return $this->_db->get_compiled_select( $this->_db->database . '.' . $this->_table_name . " " . $this->_short_name );
    }
}
