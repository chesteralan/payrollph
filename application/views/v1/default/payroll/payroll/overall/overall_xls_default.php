<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
function isColumn($ths, $column_id,$print_columns) {
    if( $ths->input->get('columns') ) {
        if( in_array($column_id, $ths->input->get('columns')) ) {
            return true;
        }
    } else {
      if( $print_columns ) foreach($print_columns as $col) {
          if( ($col->column_id==$column_id) ) {
              return true;
          }
      }
    }
    return false;
}  
?>
<?xml version="1.0"?>
<?mso-application progid="Excel.Sheet"?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
  <Author>chesteralan</Author>
  <LastAuthor>alchie</LastAuthor>
  <LastPrinted>2018-01-11T02:35:24Z</LastPrinted>
  <Created>2017-12-01T07:04:58Z</Created>
  <Version>12.00</Version>
 </DocumentProperties>
 <ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
  <WindowHeight>11760</WindowHeight>
  <WindowWidth>20730</WindowWidth>
  <WindowTopX>360</WindowTopX>
  <WindowTopY>345</WindowTopY>
  <ProtectStructure>False</ProtectStructure>
  <ProtectWindows>False</ProtectWindows>
 </ExcelWorkbook>
 <Styles>

  <Style ss:ID="Default" ss:Name="Normal">
   <Alignment ss:Vertical="Bottom"/>
   <Borders/>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="s16" ss:Name="Comma">
   <NumberFormat ss:Format="_(* #,##0.00_);_(* \(#,##0.00\);_(* &quot;-&quot;??_);_(@_)"/>
  </Style>
  <Style ss:ID="m79168628">
   <Alignment ss:Horizontal="Right" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="12" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#CCCCCC" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="Standard"/>
  </Style>
  <Style ss:ID="s62">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="8" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#CCCCCC" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s63">
   <Alignment ss:Horizontal="Right" ss:Vertical="Center" ss:WrapText="1"/>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="8" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#CCCCCC" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s64">
   <Alignment ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#CCCCCC"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="8" ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s65">
   <Alignment ss:Horizontal="Right" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#CCCCCC"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="8" ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s66">
   <Alignment ss:Horizontal="Right" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#CCCCCC"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="8" ss:Color="#000000"/>
   <NumberFormat ss:Format="Standard"/>
  </Style>
  <Style ss:ID="s67">
   <Alignment ss:Horizontal="Right" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#CCCCCC"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="8" ss:Color="#000000"
    ss:Bold="1"/>
   <NumberFormat ss:Format="Standard"/>
  </Style>
  <Style ss:ID="s68">
   <Alignment ss:Horizontal="Right" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#CCCCCC"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="8" ss:Color="#000000"
    ss:Bold="1"/>
  </Style>
  <Style ss:ID="s69">
   <Alignment ss:Horizontal="Right" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#CCCCCC"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="7" ss:Color="#000000"
    ss:Bold="1"/>
   <NumberFormat ss:Format="Standard"/>
  </Style>
  <Style ss:ID="s70">
   <Alignment ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#CCCCCC"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="8" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#CCCCCC" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s71">
   <Alignment ss:Horizontal="Right" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#CCCCCC"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="8" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#CCCCCC" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s72">
   <Alignment ss:Horizontal="Right" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#CCCCCC"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="8" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#CCCCCC" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="Standard"/>
  </Style>
  <Style ss:ID="s73">
   <Alignment ss:Horizontal="Right" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#CCCCCC"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="7" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#CCCCCC" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="Standard"/>
  </Style>
  <Style ss:ID="s74">
   <Alignment ss:Horizontal="Right" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#CCCCCC"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="7" ss:Color="#000000"
    ss:Bold="1"/>
  </Style>
  <Style ss:ID="s75">
   <Alignment ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="8" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#CCCCCC" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s76">
   <Alignment ss:Horizontal="Right" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="8" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#CCCCCC" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s77">
   <Alignment ss:Horizontal="Right" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="8" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#CCCCCC" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="Standard"/>
  </Style>
  <Style ss:ID="s78">
   <Alignment ss:Horizontal="Right" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="7" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#CCCCCC" ss:Pattern="Solid"/>
   <NumberFormat ss:Format="Standard"/>
  </Style>
  <Style ss:ID="s80">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="12" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#CCCCCC" ss:Pattern="Solid"/>
  </Style>
 </Styles>
 <?php if( $payroll_groups ) {  
$total_net_pay = 0;
$pc_count = (count($print_columns)) ? count($print_columns) : 1;
$column_width = ceil(71 / $pc_count);

$columns_count = 1;
if( $column_group_salaries ) { 
  if( isColumn($this, 'working_days', $print_columns) ) { 
    $columns_count += 1;
  } 
  if( isColumn($this, 'absences', $print_columns) ) { 
    $columns_count += 1;
  } 
   if( isColumn($this, 'rate_per_day', $print_columns) ) { 
    $columns_count += 1;
   } 
   if( isColumn($this, 'basic_salary', $print_columns) ) { 
    $columns_count += 1;
   }
   if( isColumn($this, 'cola', $print_columns) ) { 
    $columns_count += 1;
  } 
   if( isColumn($this, 'absences_amount', $print_columns) ) { 
    $columns_count += 1;
   } 
  if( isColumn($this, 'gross_pay', $print_columns) ) { 
  $columns_count += 1;
  } 
} 

if( $column_group_earnings ) {
if( $earnings_columns ) foreach( $earnings_columns as $column ) {
if( isColumn($this, 'earning_'.$column->id, $print_columns) ) {
    $columns_count += 1;
}
}
}
if( $column_group_salaries || $column_group_earnings) {
    $columns_count += 1;
}
if( $column_group_benefits ) {
if( $benefits_columns ) foreach( $benefits_columns as $column ) {
if( isColumn($this, 'benefit_'.$column->id, $print_columns) ) {
    $columns_count += 2;
}
}
}
if( $column_group_deductions ) {
if( $deductions_columns ) foreach( $deductions_columns as $column ) {
if( isColumn($this, 'deduction_'.$column->id, $print_columns) ) {
    $columns_count += 1;
}
}
}
 if( $column_group_benefits||$column_group_deductions ) {
    $columns_count += 1;
}
  $columns_count += 1;

$rows = 0;
foreach($payroll_groups as $pg) {
  // header
  $rows += 1;
  $rows += count( $pg->employees );
  // group total
  $rows += 1;
}
// grand total
$rows += 1;
?>
 <Worksheet ss:Name="Sheet1">
  <Table ss:ExpandedColumnCount="<?php echo $columns_count; ?>" ss:ExpandedRowCount="<?php echo $rows; ?>" x:FullColumns="1"
   x:FullRows="1" ss:DefaultRowHeight="15">
   <Column ss:AutoFitWidth="0" ss:Width="176.25"/>
   <Column ss:Index="<?php echo $columns_count-1; ?>" ss:Width="51" ss:Span="1"/>
<?php foreach($payroll_groups as $payroll_group) { ?>
  <?php if($payroll_group->employees) { ?>
   <Row ss:AutoFitHeight="0" ss:Height="33.75">
    <Cell ss:StyleID="s62"><Data ss:Type="String"><?php echo strtoupper($payroll_group->name); ?></Data></Cell>
<?php if( $column_group_salaries ) { ?>
<?php if( isColumn($this, 'working_days', $print_columns) ) { ?>
    <Cell ss:StyleID="s63"><Data ss:Type="String">WORKING DAYS</Data></Cell>
<?php } ?>
<?php if( isColumn($this, 'absences', $print_columns) ) { ?>
    <Cell ss:StyleID="s63"><Data ss:Type="String">ABSENCES</Data></Cell>
<?php } ?>
<?php if( isColumn($this, 'rate_per_day', $print_columns) ) { ?>
    <Cell ss:StyleID="s63"><Data ss:Type="String">RATE PER DAY</Data></Cell>
<?php } ?>
<?php if( isColumn($this, 'basic_salary', $print_columns) ) { ?>
    <Cell ss:StyleID="s63"><Data ss:Type="String">BASIC SALARY</Data></Cell>
<?php } ?>
<?php if( isColumn($this, 'cola', $print_columns) ) { ?>
    <Cell ss:StyleID="s63"><Data ss:Type="String">COLA</Data></Cell>
<?php } ?>
<?php if( isColumn($this, 'absences_amount', $print_columns) ) { ?>
    <Cell ss:StyleID="s63"><Data ss:Type="String">ABSENCES</Data></Cell>
<?php } ?>
<?php if( isColumn($this, 'gross_pay', $print_columns) ) { ?>
    <Cell ss:StyleID="s63"><Data ss:Type="String">GROSS PAY</Data></Cell>
<?php } ?>
<?php } ?>
<?php if( $column_group_earnings ) { ?>
<?php if( $earnings_columns ) foreach( $earnings_columns as $column ) { ?>
<?php if( isColumn($this, 'earning_'.$column->id, $print_columns) ) { ?>
    <Cell ss:StyleID="s63"><Data ss:Type="String"><?php echo strtoupper($column->name); ?></Data></Cell>
<?php } ?>
<?php } ?>
<?php } ?>
<?php if( $column_group_salaries || $column_group_earnings) { ?>
    <Cell ss:StyleID="s63"><Data ss:Type="String">TOTAL EARNINGS</Data></Cell>
<?php } ?>
<?php if( $column_group_benefits ) { ?>
<?php if( $benefits_columns ) foreach( $benefits_columns as $column ) { ?>
<?php if( isColumn($this, 'benefit_'.$column->id, $print_columns) ) { ?>
    <Cell ss:StyleID="s63"><Data ss:Type="String"><?php echo strtoupper($column->name); ?>-EE</Data></Cell>
    <Cell ss:StyleID="s63"><Data ss:Type="String"><?php echo strtoupper($column->name); ?>-ER</Data></Cell>
<?php } ?>
<?php } ?>
<?php } ?>
<?php if( $column_group_deductions ) { ?>
<?php if( $deductions_columns ) foreach( $deductions_columns as $column ) { ?>
<?php if( isColumn($this, 'deduction_'.$column->id, $print_columns) ) { ?>
    <Cell ss:StyleID="s63"><Data ss:Type="String"><?php echo strtoupper($column->name); ?></Data></Cell>
<?php } ?>
<?php } ?>
<?php } ?>
 <?php if( $column_group_benefits || $column_group_deductions ) { ?>
    <Cell ss:StyleID="s63"><Data ss:Type="String">TOTAL DEDUCTIONS</Data></Cell>
<?php } ?>
    <Cell ss:StyleID="s63"><Data ss:Type="String">NET PAY</Data></Cell>
   </Row>
<?php 

$group_basic_salary = 0;
$group_absences = 0;
$group_gross_pay = 0;
$group_total_earnings = 0;
$group_total_deductions = 0;
$group_net_pay = 0;
$group_earnings = array();
$group_benefits = array();
$group_deductions = array();

foreach($payroll_group->employees as $employee) {

$total_deductions = 0;
$total_earnings = 0;
$working_hours = ($employee->working_hours) ? $employee->working_hours : 8;
$days_absent = ($employee->absences_hours) ? ($employee->absences_hours / $working_hours) : 0;
$monthly_rate = 0;
$daily_rate = 0;
$hourly_rate = 0;
$cola = 0;
$gross_pay = 0;
if( $employee->salary ) {
  $salary = $employee->salary;
  $cola = $salary->cola;
  switch( $salary->rate_per ) {
    case 'month':
      $monthly_rate = $salary->amount;
      $daily_rate = ( ($salary->amount * $salary->months) / $salary->annual_days );
      $hourly_rate = ( (($salary->amount * $salary->months) / $salary->annual_days) / $salary->hours );
    break;
    case 'day':
      $monthly_rate = ( $salary->amount * $salary->days );
      $daily_rate = $salary->amount;
      $hourly_rate = ( $salary->amount / $salary->hours );
    break;
    case 'hour':
      $monthly_rate = ( $salary->amount * $salary->days * $salary->hours );
      $daily_rate = ( $salary->amount * $salary->hours );
      $hourly_rate = $salary->amount;
    break;
  }
}

$present_days = $inclusive_dates->working_days - $days_absent;
//$basic_salary = ($daily_rate * $inclusive_dates->working_days);
$basic_salary = ($monthly_rate / 2);
$cola = ($cola * $present_days);
$absences = ($daily_rate * $days_absent);
$gross_pay = (($basic_salary + $cola) - $absences); 
$group_basic_salary += $basic_salary;
$group_absences += $absences;
$group_gross_pay += $gross_pay;
?>
   <Row ss:AutoFitHeight="0" ss:Height="15.75">
    <Cell ss:StyleID="s64"><Data ss:Type="String"><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo ($employee->middlename) ? substr($employee->middlename,0,1)."." : ""; ?></Data></Cell>
<?php if( $column_group_salaries ) { ?>
<?php if( isColumn($this, 'working_days', $print_columns) ) { ?>
    <Cell ss:StyleID="s65"><Data ss:Type="Number">15</Data></Cell>
<?php } ?>
<?php if( isColumn($this, 'absences', $print_columns) ) { ?>
    <Cell ss:StyleID="s65"><Data ss:Type="Number"><?php echo $days_absent; ?></Data></Cell>
<?php } ?>
<?php if( isColumn($this, 'rate_per_day', $print_columns) ) { ?>
    <Cell ss:StyleID="s65"><Data ss:Type="Number"><?php echo $daily_rate; ?></Data></Cell>
<?php } ?>
<?php if( isColumn($this, 'basic_salary', $print_columns) ) { ?>
    <Cell ss:StyleID="s66"><Data ss:Type="Number"><?php echo $basic_salary; ?></Data></Cell>
<?php } ?>
<?php if( isColumn($this, 'cola', $print_columns) ) { ?>
    <Cell ss:StyleID="s65"><Data ss:Type="Number"><?php echo $cola; ?></Data></Cell>
<?php } ?>
<?php 
if( isColumn($this, 'absences_amount', $print_columns) ) { ?>
    <Cell ss:StyleID="s66"><Data ss:Type="Number">-<?php echo $absences; ?></Data></Cell>
<?php } ?>
<?php if( isColumn($this, 'gross_pay', $print_columns) ) { ?>
    <Cell ss:StyleID="s65"><Data ss:Type="Number"><?php echo $gross_pay; ?></Data></Cell>
<?php } ?>
<?php } ?>
<?php if( $column_group_earnings ) { ?>
<?php if( $earnings_columns ) foreach( $earnings_columns as $column ) { ?>
      <?php 
      $var = 'earnings_' . $column->id;
      if( !isset($group_earnings[$var]) ) {
          $group_earnings[$var] = 0;
      }
      $group_earnings[$var] += $employee->$var;
      $total_earnings += $employee->$var;
      if( isColumn($this, 'earning_' . $column->id, $print_columns) ) { ?>
    <Cell ss:StyleID="s65"><Data ss:Type="Number"><?php echo $employee->$var; ?></Data></Cell>
                <?php } ?>
    <?php } ?>
<?php } ?>
<?php if( $column_group_salaries || $column_group_earnings) { ?>
<?php 
$total_gross_earnings = ($total_earnings + $gross_pay);
$group_total_earnings += $total_gross_earnings; ?>
    <Cell ss:StyleID="s67"><Data ss:Type="Number"><?php echo $total_gross_earnings; ?></Data></Cell>
<?php } ?>
<?php if( $column_group_benefits ) { ?>
<?php if( $benefits_columns ) foreach( $benefits_columns as $column ) { 
  $ee = 'ee_share_' . $column->id;
  if( !isset($group_benefits[$ee]) ) {
          $group_benefits[$ee] = 0;
  }
  $group_benefits[$ee] += $employee->$ee;

  $er = 'er_share_' . $column->id;
  if( !isset($group_benefits[$er]) ) {
          $group_benefits[$er] = 0;
  }

  $group_benefits[$er] += $employee->$er;
  $total_deductions += $employee->$ee;
  if( isColumn($this, 'benefit_' . $column->id, $print_columns) ) {
?>
    <Cell ss:StyleID="s65"><Data ss:Type="Number"><?php echo $employee->$ee; ?></Data></Cell>
    <Cell ss:StyleID="s65"><Data ss:Type="Number"><?php echo $employee->$er; ?></Data></Cell>
<?php } ?>
<?php } ?>
<?php } ?>
<?php if( $column_group_deductions ) { ?>
<?php if( $deductions_columns ) foreach( $deductions_columns as $column ) { 
  $var = 'deductions_' . $column->id;
  if( !isset($group_deductions[$var]) ) {
      $group_deductions[$var] = 0;
   }
   $group_deductions[$var] += $employee->$var;
  $total_deductions += $employee->$var;
  if( isColumn($this, 'deduction_' . $column->id, $print_columns) ) {
  ?>
    <Cell ss:StyleID="s65"><Data ss:Type="Number"><?php echo $employee->$var; ?></Data></Cell>
                <?php } ?>
 <?php } ?>
 <?php } ?>
 <?php 
$net_pay = (($total_earnings + $gross_pay) - $total_deductions); 
$total_net_pay += $net_pay;
$group_net_pay += $net_pay;
$group_total_deductions += $total_deductions;
?>
 <?php if( $column_group_benefits||$column_group_deductions ) { ?>
    <Cell ss:StyleID="s65"><Data ss:Type="Number"><?php echo $total_deductions; ?></Data></Cell>
<?php } ?>
    <Cell ss:StyleID="s69"><Data ss:Type="Number"><?php echo $net_pay; ?></Data></Cell>
   </Row>
<?php } ?>
   <Row ss:AutoFitHeight="0" ss:Height="15.75">
    <Cell ss:StyleID="s70"><Data ss:Type="String">GROUP TOTAL</Data></Cell>
<?php if( $column_group_salaries ) { ?>
<?php if( isColumn($this, 'working_days', $print_columns) ) { ?>
    <Cell ss:StyleID="s71"/>
<?php } ?>
<?php if( isColumn($this, 'absences', $print_columns) ) { ?>
    <Cell ss:StyleID="s71"/>
<?php } ?>
<?php if( isColumn($this, 'rate_per_day', $print_columns) ) { ?>
    <Cell ss:StyleID="s71"/>
<?php } ?>
<?php if( isColumn($this, 'basic_salary', $print_columns) ) { ?>
    <Cell ss:StyleID="s71"><Data ss:Type="Number">0</Data></Cell>
<?php } ?>
<?php if( isColumn($this, 'cola', $print_columns) ) { ?>
    <Cell ss:StyleID="s71"><Data ss:Type="Number">0</Data></Cell>
<?php } ?>
<?php if( isColumn($this, 'absences_amount', $print_columns) ) { ?>
    <Cell ss:StyleID="s71"><Data ss:Type="Number">0</Data></Cell>
<?php } ?>
<?php if( isColumn($this, 'gross_pay', $print_columns) ) { ?>
    <Cell ss:StyleID="s72"><Data ss:Type="Number"><?php echo $group_gross_pay; ?></Data></Cell>
<?php } ?>
<?php } ?>
<?php if( $column_group_earnings ) { ?>
<?php if( $earnings_columns ) foreach( $earnings_columns as $column ) { ?>
  <?php if( isColumn($this, 'earning_' . $column->id, $print_columns) ) {
$var = 'earnings_' . $column->id;
   ?>
    <Cell ss:StyleID="s71"><Data ss:Type="Number"><?php echo $group_earnings[$var]; ?></Data></Cell>
  <?php } ?>
<?php } ?>
<?php } ?>
<?php if( $column_group_salaries || $column_group_earnings) { ?>
    <Cell ss:StyleID="s72"><Data ss:Type="Number"><?php echo $group_total_earnings; ?></Data></Cell>
<?php } ?>
<?php if( $column_group_benefits ) { ?>
<?php if( $benefits_columns ) foreach( $benefits_columns as $column ) { ?>
  <?php  if( isColumn($this, 'benefit_' . $column->id, $print_columns) ) { 
$ee = 'ee_share_' . $column->id;
$er = 'er_share_' . $column->id;
    ?>
    <Cell ss:StyleID="s71"><Data ss:Type="Number"><?php echo $group_benefits[$ee]; ?></Data></Cell>
    <Cell ss:StyleID="s71"><Data ss:Type="Number"><?php echo $group_benefits[$er]; ?></Data></Cell>
  <?php } ?>
<?php } ?>
<?php } ?>
<?php if( $column_group_deductions ) { ?>
<?php if( $deductions_columns ) foreach( $deductions_columns as $column ) { 
  if( isColumn($this, 'deduction_' . $column->id, $print_columns) ) {
    $var = 'deductions_' . $column->id;
  ?>
    <Cell ss:StyleID="s71"><Data ss:Type="Number"><?php echo $group_deductions[$var]; ?></Data></Cell>
                 <?php } ?>
 <?php } ?>
 <?php } ?>
 <?php if( $column_group_benefits||$column_group_deductions ) { ?>
    <Cell ss:StyleID="s73"><Data ss:Type="Number"><?php echo $group_total_deductions; ?></Data></Cell>
<?php } ?>
    <Cell ss:StyleID="s73"><Data ss:Type="Number"><?php echo $group_net_pay; ?></Data></Cell>
   </Row>
<?php } ?>   
<?php } ?>   
   <Row ss:AutoFitHeight="0" ss:Height="22.5">
    <Cell ss:MergeAcross="<?php echo ($columns_count-4); ?>" ss:StyleID="s80"><Data ss:Type="String">TOTAL NET PAY</Data></Cell>
    <Cell ss:MergeAcross="2" ss:StyleID="m79168628"><Data ss:Type="Number"><?php echo $total_net_pay; ?></Data></Cell>
   </Row>
  </Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Layout x:Orientation="Landscape"/>
    <Header x:Margin="0.3"
     x:Data="&amp;L&amp;&quot;Calibri,Bold&quot;&amp;18<?php echo ($company->name) ? strtoupper($company->name) : ''; ?>&amp;&quot;Calibri,Regular&quot;&amp;11&#10;<?php echo ($company->address) ? $company->address : ''; ?>&#10;<?php echo ($company->phone) ? $company->phone : ''; ?>&amp;R&amp;&quot;Calibri,Bold&quot;&amp;16PAYROLL SUMMARY (#<?php echo $payroll->id; ?>)&amp;&quot;Calibri,Regular&quot;&amp;11&#10;<?php echo $payroll->name; ?>"/>
    <Footer x:Margin="0.3"
     x:Data="&amp;L&amp;&quot;Calibri,Bold&quot;Prepared by:&amp;&quot;Calibri,Regular&quot;&#10;&#10;<?php echo strtoupper($this->session->name); ?>&amp;C&amp;&quot;Calibri,Bold&quot;Checked by:&amp;&quot;Calibri,Regular&quot;&#10;&#10;<?php echo strtoupper($template->checked_by_name); ?>&amp;R&amp;&quot;Calibri,Bold&quot;Approved by:&amp;&quot;Calibri,Regular&quot;&#10;&#10;<?php echo strtoupper($template->approved_by_name); ?>"/>
    <PageMargins x:Bottom="0.75" x:Left="0.7" x:Right="0.7" x:Top="0.89"/>
   </PageSetup>
   <Unsynced/>
   <Print>
    <ValidPrinterInfo/>
    <PaperSizeIndex>200</PaperSizeIndex>
    <Scale>56</Scale>
    <HorizontalResolution>-3</HorizontalResolution>
    <VerticalResolution>-3</VerticalResolution>
   </Print>
   <ShowPageBreakZoom/>
   <PageBreakZoom>100</PageBreakZoom>
   <Selected/>
   <LeftColumnVisible>4</LeftColumnVisible>
   <Panes>
    <Pane>
     <Number>3</Number>
     <RangeSelection>R1:R6</RangeSelection>
    </Pane>
   </Panes>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>
 <?php } ?>
</Workbook>