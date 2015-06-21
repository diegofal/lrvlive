<?php /* Smarty version 2.6.25, created on 2015-06-13 14:01:32
         compiled from make_booking/page_resellers.tpl */ ?>
<html>
<head>
<title>Booking</title>
<link href="../WEB-INF/assets/css/site-styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/make_booking.js"></script>
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/validation.js"></script>	
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/macromedia.js"></script>	

<body>
<br />
<div style="position: relative; top: 30%; left: 40%;">
<div class="content-formatting"><strong>Please, select reseller:</strong></div>
<form name="resellers" method="post" action="make_booking.php?tour_id=<?php echo $this->_supers['get']['tour_id']; ?>
&departure_id=<?php echo $this->_supers['get']['departure_id']; ?>
&free=<?php echo $this->_supers['get']['free']; ?>
">
<select name="reseller_id" id="reseller_id" class="booking-cell107" style="width:180px;">
<option value="0">Choose Reseller Below</option>
<option value="-1">LRV</option>
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['resellers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
<option value="<?php echo $this->_tpl_vars['resellers'][$this->_sections['i']['index']]['reseller_id']; ?>
"><?php echo $this->_tpl_vars['resellers'][$this->_sections['i']['index']]['reseller_name']; ?>
</option>
<?php endfor; endif; ?>
</select><br><br>
<a href="#" onclick="return onChooseReseller();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image32','','../WEB-INF/assets/images/booking/button-proceed-on.gif',1)"><img src="../WEB-INF/assets/images/booking/button-proceed-off.gif" name="Image32" width="107" height="32" border="0"></a></div>
</form>
</body>
</head>