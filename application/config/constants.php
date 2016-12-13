<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

// Chart of Accounts
defined('CHART_ACCOUNT_TYPES') OR define('CHART_ACCOUNT_TYPES', serialize(array(
	"Balance Sheet" => array(
		// BS - Assets
		"000_BS_ASS_CSH" => "Cash in Hand",
		"001_BS_ASS_CSB" => "Cash in Bank",
		"010_BS_ASS_ACR" => "Accounts Receivable",
		"020_BS_ASS_OCA" => "Other Current Asset",
		"030_BS_ASS_INV" => "Inventory",
		"040_BS_ASS_FIX" => "Fixed Asset",
		"050_BS_ASS_OAS" => "Other Asset",

		// BS - Liabilities
		"060_BS_LIB_ACP" => "Accounts Payable",
		"070_BS_LIB_OCL" => "Other Current Liability",
		"080_BS_LIB_LTL" => "Long Term Liability",

		// BS - Equity
		"090_BS_EQU_CAP" => "Equity",
	),
	"Income Statement" => array(
		// IS - Income
		"100_IS_INC_INC" => "Income",
		"110_IS_EXP_EXP" => "Expense",
	)
)));

// Coop Departments
defined('COOP_DEPT_SECT') OR define('COOP_DEPT_SECT', serialize(array(
	"SERVICES" => array("title" => "Savings", "sections" => array(
			"SAVINGS" => "Savings",
			"LENDING" => "Lending",
			"LAUNDRY" => "Laundry",
		)), 
	"MARKETING" => array("title" => "Marketing", "sections" => array(
			"MLM" => "Multi-Level Marketing"
		)), 
	"ACCOUNTING" => array("title" => "Accounting", "sections" => array(
			"RECEIVING" => "Cashier",
			"DISBURSING" => "Disbursing",
			"BOOKKEEPING" => "Bookkeeping",
		)), 
	"ADMINISTRATION" => array("title" => "Administration", "sections" => array()), 
)));

// Item Types
defined('CHECK_ITEM_TYPES') OR define('CHECK_ITEM_TYPES', serialize(array(

	"COMEXP" => 'Expense',
	"COMINC" => 'Income',

	// share capital
	"SHAWIT" => 'Capital Withdrawal',
	"SHADIV" => 'Dividends',

	// lending
	"LOANRE" => 'Loan',

	// laundry
	"LAUEXP" => 'Laundry Expense',

)));

// Item Types
defined('RECEIPT_ITEM_TYPES') OR define('RECEIPT_ITEM_TYPES', serialize(array(

	"COMINC" => 'Income',

	// share capital
	"SHACAP" => 'Share Capital',

	// lending
	"LOANPY" => 'Loan Payment',

	// laundry
	"LAUINC" => 'Laundry Income',

)));