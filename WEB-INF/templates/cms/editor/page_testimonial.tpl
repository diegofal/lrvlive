      <table width="850" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="220" valign="top" class="content-padding"><table width="91%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="txt-side">Testimonial page description. You may sort the list based on any table header. <br>
                <br>
                </td>
              </tr>
              <tr>
                <td class="txt-side">&nbsp;</td>
              </tr>
              <tr>
                <td class="txt-side"><strong>The Icons: </strong></td>
              </tr>
              <tr>
                <td class="txt-side"><img src="images/spacer.gif" width="10" height="5"></td>
              </tr>
              <tr>
                <td class="txt-side"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                         <td width="13%"><img src="images/icons/add_16.gif" width="16" height="16" border="0" alt="Add"></td>
                         <td width="87%" class="txt-side">Add new testimonial</td>
                     </tr>
                  </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%"><img src="images/icons/config_clock_16.gif" alt="Edit" width="16" height="16" vspace="2" border="0"></td>
                        <td width="87%" class="txt-side">Edit Testimonial</td>
                      </tr>
                    </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" vspace="2" border="0"></td>
                        <td width="87%" class="txt-side">Delete Testimonial</td>
                      </tr>
                  </table></td>
              </tr>
          </table></td>
          <td width="630" valign="top" class="dotted-border content-padding2">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/spacer.gif" width="10" height="10"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="1" class="outline-grey">
                  <tr>
                    <td width="35%" {$head.Tid}</td>
                    <td width="35%" {$head.TesimonialImage}</td>
                    <td width="30%" class="table-header">&nbsp;&nbsp; </td>
                  </tr>
				  {section name=i loop=$testimonials}
				  <tr bgcolor="{cycle values="#F8F8F8,#FFFFFF"}">
                    <td class="table-line">{$testimonials[i].Tid}</td>
                    <td class="table-line"><a href="testimonial_edit.php?Tid={$testimonials[i].Tid}" id="submenu">{if !empty($testimonials[i].TesimonialImage)}<img src="../img/testimonial/thumb/{$testimonials[i].TesimonialImage}">{/if}</a> </td>
                    <td class="table-line"><div align="center">
					<a href="testimonial_edit.php?Tid={$testimonials[i].Tid}"><img src="images/icons/config_clock_16.gif" alt="Edit" width="16" height="16" vspace="2" border="0"></a>
					<a href="testimonial.php?option=delete&Tid={$testimonials[i].Tid}" onclick="return confirm('Are you sure to delete this Testimonial?');"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" vspace="2" border="0"></a>
					</div></td>
                  </tr>
				  {sectionelse}
				  <tr>
                    <td bgcolor="#F8F8F8" class="table-line" colspan="6">There are no Testimonials in database!</td>
				  </tr>
				  {/section} 
				  <tr bgcolor="#FFFFFF">
                    <td class="table-line">*</td>
                    <td class="table-line">Add new Corporate Special Offer</td>
                    <td class="table-line"><div align="center"><a href="testimonial_edit.php?option=add"><img src="images/icons/add_16.gif" alt="Add" width="16" height="16" vspace="2" border="0"></a></div>
					</td>
                  </tr>

                </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><img src="images/spacer.gif" width="10" height="3"></td>
                  </tr>
                </table>
				
				{if !empty($navigator)}
                <table width="100%" border="0" cellpadding="4" cellspacing="1" class="outline-grey">
                  <tr>
                    <td class="txt-tahoma"><div align="right">{$navigator}</div></td>
                  </tr>
                </table>
				{/if}
                <br>
                <br>
          <br></td></tr>
      </table>
