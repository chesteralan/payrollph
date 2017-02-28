
<div class="payslip_box cash_voucher full-border odd <?php echo (($box_count % 2) == 0) ? 'second-half' : 'first-half'; ?>">
  <div class="header-title">

<h2 class="text-center allcaps"><?php echo ($template->company_name) ? $template->company_name : ''; ?></h2>
<h3 class="text-center not-bold"><?php echo ($template->company_name) ? $template->company_address : ''; ?></h3>
<h3 class="text-center not-bold"><?php echo ($template->company_name) ? $template->company_contacts : ''; ?></h3>

</div>

<div class="full-border padding3">
<h3 class="pull-right">ID # <?php echo $payroll->id; ?></h3>
<h2 class="">CASH VOUCHER</h2>
<span><?php echo date('F d, Y', strtotime($inclusive_dates->start_date)); ?> - <?php echo date('F d, Y', strtotime($inclusive_dates->end_date)); ?></span>

</div>

<h2 class="text-center allcaps employee-name underlined" style="margin-bottom: 20px;"><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?></h2>

<div class="inner_body">
 <table width="100%" class="table table-details" cellpadding="0" cellspacing="0">
      <tr class="highlight">
        <td class="text-center allcaps bold">Particulars</td>
        <td class="text-center allcaps bold border-left">Amount</td>
      </tr>
      <tr>
        <td class="padding5">Particulars</td>
        <td class="padding5 border-left">Amount</td>
      </tr>
    </table>
</div>

<div class="signatories">
  <table width="100%">
    <tr>
      <td width="50%">Prepared By:
       <br><br><br>
<span class="allcaps bold"><?php echo $this->session->name; ?></span>
      </td>
      <td width="50%" class="text-right">Received By:
      <br><br><br>
<span class="allcaps bold text-right"><?php echo $employee->lastname; ?>, <?php echo $employee->firstname; ?> <?php echo substr($employee->middlename,0,1)."."; ?></span>
      </td>
    </tr>
  </table>
</div>

</div>

</div>


