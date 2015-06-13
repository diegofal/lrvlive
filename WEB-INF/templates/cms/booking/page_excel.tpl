<form name="form_excel" method="post" action="gen_excel_report.php">
      <table width="850" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="220" valign="top" class="content-padding"><table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="txt-side">Reports can be generated for an entire month or a specific day. </td>
              </tr>
          </table></td>
          <td width="630" valign="top" class="dotted-border content-padding2"><table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td class="calendar-header-months"><table width="100%" border="0" cellpadding="3" cellspacing="0">
                    <tr>
                      <td width="20%" class="sidetable-txt"><input name="type" type="radio" value="order_date" checked="checked" />&nbsp;&nbsp;Order date:  </td>
                      <td width="80%" nowrap>
                      {html_select_date 
                      display_years="0"
                      display_days="0"
                      prefix="order" 
                      month_extra='class="sidetable-dropdown4"' 
                      day_extra='class="sidetable-dropdown2"'
                      }
                      </td>
                    </tr>
                    <tr>
                      <td width="20%" class="sidetable-txt"><input name="type" type="radio" value="year" checked="checked" />&nbsp;&nbsp;Select year:  </td>
                      <td width="80%" nowrap>
                      {html_select_date start_year="-2" display_days=false display_months=false
                      year_extra='class="sidetable-dropdown3"'}
                      &nbsp;&nbsp;&nbsp;<span class="calendar-monthtxt"><strong>OR</strong></span></td>
                    </tr>
                    <tr>
                      <td width="20%" class="sidetable-txt"><input name="type" type="radio" value="month" checked="checked" />&nbsp;&nbsp;Select month:  </td>
                      <td width="80%" nowrap>
                      {html_select_date start_year="-2" prefix="months" display_days=false
                      year_extra='class="sidetable-dropdown3"' month_extra='class="sidetable-dropdown4"'}
                      &nbsp;&nbsp;&nbsp;<span class="calendar-monthtxt"><strong>OR</strong></span></td>
                    </tr>
                    <tr>
                      <td width="20%" class="sidetable-txt"><input name="type" type="radio" value="day" />&nbsp;&nbsp;Select date: </td>
                      <td width="80%" class="txt-tahoma">
                      {html_select_date start_year="-2" prefix="sel" 
                      year_extra='class="sidetable-dropdown3"' month_extra='class="sidetable-dropdown4"' day_extra='class="sidetable-dropdown2"'}
                    </td>
                    </tr>
                </table></td>
              </tr>
            </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><img src="images/spacer.gif" width="10" height="7"></td>
                </tr>
              </table>
            <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
                <tr>
                  <td width="4%" class="style1"><input name="order" type="checkbox" value="1" /></td>
                  <td width="96%" class="txt-tahoma">Include order date </td>
                </tr>
                <tr>
                  <td class="style1"> <input name="address" type="checkbox" value="1" /></td>
                  <td class="txt-tahoma">Include address </td>
                </tr>
                <tr>
                  <td class="style1"> <input name="phone" type="checkbox" value="1" /></td>
                  <td class="txt-tahoma">Include phone number </td>
                </tr>
                <tr>
                  <td class="style1"><input name="email" type="checkbox" value="1" /></td>
                  <td class="txt-tahoma">Include email </td>
                </tr>
                <tr>
                  <td class="style1"><input name="total" type="checkbox" value="1" /></td>
                  <td class="txt-tahoma">Include total order </td>
                </tr>
                <tr>
                  <td class="style1"><input name="payment" type="checkbox" value="1" /></td>
                  <td class="txt-tahoma">Include method of payment filtered by 
                    <select name="payment_filter" class="sidetable-dropdown3" style="width:85px; height:18px">
                        <option value="all">--- Filter ---</option>
                        {html_options values=$filter output=$filter}
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="style1"><input name="reseller" type="checkbox" value="1" /></td>
                  <td class="txt-tahoma">Include reseller
                    <select name="reseller_filter" class="sidetable-dropdown3" style="width:85px; height:18px">
                        <option value="all">All</option>
                        {section name=i loop=$resellers}
                        <option value="{$resellers[i].reseller_name}">{$resellers[i].reseller_name}</option>
                        {/section}
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="style1"><input name="find" type="checkbox" value="1" /></td>
                  <td class="txt-tahoma">Include "How did you find us?" </td>
                </tr>               
                <tr>
                  <td colspan=2 width="100%" class="sidetable-txt"><img src="images/line-grey.gif" width="100%" height="1"></td>
                </tr>
                <tr>
                  <td class="style1"><input name="per_boat" type="checkbox" value="1" /></td>
                  <td class="txt-tahoma">Per Boat Report</td>
                </tr>               

              </table>
            <table width="100%" border="0" cellpadding="2" cellspacing="1">
                <tr>
                  <td width="100%" class="sidetable-txt"><img src="images/line-grey.gif" width="100%" height="1"></td>
                </tr>
                <tr>
                  <td><img src="images/spacer.gif" width="10" height="4"></td>
                </tr>               
                <tr>
                  <td class="sidetable-txt"><div align="left"><a href="javascript:document.form_excel.submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image13','','images/button-generate-on.gif',1)"><img src="images/button-generate-off.gif" name="Image13" width="86" height="23" border="0"></a><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image18','','images/button-adddep-on.gif',1)"></a><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('999','','images/button-submit-on.gif',1)"></a></div></td>
                </tr>
              </table>
            <br>
              <br>
              <br>
              <br></td>
        </tr>
      </table>
</form>