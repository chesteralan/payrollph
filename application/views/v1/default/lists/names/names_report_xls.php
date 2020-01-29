<?xml version="1.0"?>
<?mso-application progid="Excel.Sheet"?>
<?php 
$default_columns = array('name_id','lastname', 'firstname', 'middlename');
$columns = array(
  'info' => array(
        'title' => 'Personal Information', 
        'items' => array(
          'name_id' => array('name'=>'Name ID','field'=>'name_id'),
          'lastname' => array('name'=>'Last Name','field'=>'lastname'),
          'firstname' => array('name'=>'First Name','field'=>'firstname'),
          'middlename' => array('name'=>'Middle Name','field'=>'middlename'),
          'birthday' => array('name'=>'Birth Day','field'=>'birthday', 'data_type'=>'DateTime'),
          'birthplace' => array('name'=>'Birth Place','field'=>'birthplace'),
          'age' => array('name'=>'Age','field'=>'age'),
          'civil_status' => array('name'=>'Status','field'=>'civil_status'),
          'gender' => array('name'=>'Gender','field'=>'gender'),
          )),
  'employment' => array(
        'title' => 'Employment Information', 
        'items' => array(
          'emp_id' => array('name'=>'Employee ID','field'=>'employee_id'),
          'emp_hired' => array('name'=>'Date Hired','field'=>'hired', 'data_type'=>'DateTime'),
          'emp_status' => array('name'=>'Status','field'=>'status_name'),
          'emp_group' => array('name'=>'Group','field'=>'group_name'),
          'emp_position' => array('name'=>'Position','field'=>'position_name'),
          'emp_area' => array('name'=>'Area','field'=>'area_name'),
          )),
  'contacts' => array(
        'title' => 'Address & Contact Numbers', 
        'items' => array(
          'contact_address' => array('name'=>'Postal Address','field'=>'address'),
          'contact_email' => array('name'=>'Email Address','field'=>'email'),
          'contact_phone' => array('name'=>'Phone Number','field'=>'phone_number'),
          'contact_smart' => array('name'=>'Cellphone (Smart)','field'=>'cell_smart'),
          'contact_globe' => array('name'=>'Cellphone (Globe)','field'=>'cell_globe'),
          'contact_sun' => array('name'=>'Cellphone (Sun)','field'=>'cell_sun'),
          )),

  'social_media' => array(
        'title' => 'Social Media Accounts', 
        'items' => array(
          'sm_facebook' => array('name'=>'Facebook ID','field'=>'facebook_id'),
          'sm_twitter' => array('name'=>'Twitter ID','field'=>'twitter_id'),
          'sm_instagram' => array('name'=>'Instagram ID','field'=>'instagram_id'),
          'sm_skype' => array('name'=>'Skype ID','field'=>'skype_id'),
          'sm_yahoo' => array('name'=>'Yahoo ID','field'=>'yahoo_id'),
          'sm_google' => array('name'=>'Google ID','field'=>'google_id'),
          )),

  'idn' => array(
        'title' => 'Identification Numbers', 
        'items' => array(
          'idn_tin' => array('name'=>'Tax Identification Number (TIN)','field'=>'tin'),
          'idn_sss' => array('name'=>'SSS Number','field'=>'sss'),
          'idn_hdmf' => array('name'=>'Pag-ibig (HDMF)','field'=>'hdmf'),
          'idn_phic' => array('name'=>'PhilHealth','field'=>'phic'),
          'idn_driver' => array('name'=>'Driver\'s License','field'=>'drivers_license'),
          'idn_voter' => array('name'=>'Voter\'s Number','field'=>'voters_number'),
          )),

  'emergency' => array(
        'title' => 'Emergency Contacts', 
        'items' => array(
          'emergency_name' => array('name'=>'Name','field'=>'emergency_name'),
          'emergency_address' => array('name'=>'Address','field'=>'emergency_address'),
          'emergency_number' => array('name'=>'Contact Number','field'=>'emergency_contact'),
          'emergency_rel' => array('name'=>'Relationship','field'=>'emergency_relationship'),
          )),

  ) ;

$selected_columns = array_merge($default_columns, (($this->input->get('columns'))?$this->input->get('columns'):array()));
?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
  <Author><?php echo $this->session->userdata( 'username'); ?></Author>
  <LastAuthor><?php echo $this->session->userdata( 'username'); ?></LastAuthor>
  <LastPrinted><?php echo date("Y-m-d"); ?>T<?php echo date("H:i:s"); ?>Z</LastPrinted>
  <Created><?php echo date("Y-m-d"); ?>T<?php echo date("H:i:s"); ?>Z</Created>
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
  <Style ss:ID="s62">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center"/>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#CCCCCC" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s63">
   <Alignment ss:Horizontal="Right" ss:Vertical="Center" ss:WrapText="1"/>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#CCCCCC" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="s64">
   <Alignment ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#CCCCCC"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="11" ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s65">
   <Alignment ss:Horizontal="Right" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#CCCCCC"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="11" ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s66">
   <Alignment ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"
     ss:Color="#CCCCCC"/>
   </Borders>
   <Font ss:FontName="Arial" x:Family="Swiss" ss:Size="11" ss:Color="#000000"/>
   <NumberFormat ss:Format="m/d/yyyy;@"/>
  </Style>
 </Styles>
 <Worksheet ss:Name="Sheet1">
  <Names>
   <NamedRange ss:Name="Print_Titles" ss:RefersTo="=Sheet1!C1:C3,Sheet1!R1"/>
  </Names>
  <?php 
$names_count = (isset($names)) ? count($names) : 0;
  ?>
  <Table ss:ExpandedColumnCount="<?php echo count($selected_columns); ?>" ss:ExpandedRowCount="<?php echo $names_count + 1; ?>" x:FullColumns="1"
   x:FullRows="1" ss:DefaultRowHeight="25" ss:DefaultAutoFitWidth="1" ss:DefaultColumnWidth="120">
   <Row>
<?php foreach($columns as $col_id=>$column) { ?>
<?php foreach($column['items'] as $fld_id=>$fld) { ?>
<?php if( in_array($fld_id, $selected_columns)) { ?>
                <Cell ss:StyleID="s62"><Data ss:Type="String"><?php echo $fld['name']; ?></Data><NamedCell ss:Name="Print_Titles"/></Cell>
<?php } ?>
<?php } ?>
<?php } ?>
   </Row>
   
<?php if(isset($names)) foreach($names as $name) { ?>
 <Row>
<?php foreach($columns as $col_id=>$column) { ?>
<?php foreach($column['items'] as $fld_id=>$fld) { ?>
<?php if( in_array($fld_id, $selected_columns)) { 

$data_type = 'String';  
$var = $fld['field'];
$field_value = $name->$var;
$cell_style = 's64';
if( (isset($fld['data_type'])) && ($field_value) ) {
  switch($fld['data_type']) {
    case 'DateTime':
      $data_type = 'DateTime'; 
      $field_value = $name->$fld['field']."T00:00:00.000";
      $cell_style = 's66';
    break;
    default:
      $data_type = 'String';  
      $field_value = $name->$fld['field'];
      $cell_style = 's64';
    break;
  }
}

?>
    <Cell ss:StyleID="<?php echo $cell_style; ?>"><Data ss:Type="<?php echo $data_type; ?>"><?php echo $field_value; ?></Data>
<?php if( in_array($fld_id, $default_columns)) { ?>
  <NamedCell ss:Name="Print_Titles"/>
<?php } ?>
    </Cell>
<?php } ?>
<?php } ?>
<?php } ?>
</Row>
<?php } ?>
  </Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Layout x:Orientation="Landscape"/>
    <Header x:Margin="0"/>
    <Footer x:Margin="0"/>
    <PageMargins x:Bottom="0.5" x:Left="0.5" x:Right="0.5" x:Top="0.5"/>
   </PageSetup>
   <Unsynced/>
   <Print>
    <ValidPrinterInfo/>
    <PaperSizeIndex>200</PaperSizeIndex>
    <Scale>56</Scale>
    <HorizontalResolution>-3</HorizontalResolution>
    <VerticalResolution>-3</VerticalResolution>
   </Print>
   <PageBreakZoom>100</PageBreakZoom>
   <Selected/>
   <Panes>
    <Pane>
     <Number>3</Number>
     <ActiveRow>8</ActiveRow>
     <ActiveCol>8</ActiveCol>
    </Pane>
   </Panes>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>
</Workbook>
