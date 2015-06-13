<table width="850" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="220" valign="top" class="content-padding"><table width="90%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="txt-side">Currently added offers are listed in the table presented. To add a new offer, use the form on the right. </td>
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
                                <td width="13%"><img src="images/icons/config_clock_16.gif" alt="Edit" width="16" height="16" vspace="2" border="0"></td>
                                <td width="87%" class="txt-side">Edit Offer</td>
                            </tr>
                        </table>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="13%"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" vspace="2" border="0"></td>
                                <td width="87%" class="txt-side">Delete Offer</td>
                            </tr>
                        </table></td>
                </tr>
            </table></td>
        <td width="630" class="dotted-border content-padding2">
            <form name="filter_form">
                <p class="txt-side">Please select reseller :
                    <select name="filter" class="cell-130" onchange="filter_resellers();">
                        {section name=i loop=$resellers}
                            <option value="{$resellers[i].reseller_id}" {if $smarty.get.reseller_id==$resellers[i].reseller_id}selected{/if}>{$resellers[i].reseller_name}</option>
                        {/section}
                    </select>
                </p>
            </form>
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tr>
                    <td width="56%" valign="top" class="outline-grey"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                            <tr>
                                <td width="43%" class="table-header">Offer Name </td>
                                <td width="20%" class="table-header">Price</td>
                                <td width="14%" class="table-header">Seats</td>
                                <td width="23%" class="table-header">&nbsp;</td>
                            </tr>
                            {section name=i loop=$reseller_offers}
                                <tr  bgcolor="{cycle values="#F8F8F8,#FFFFFF"}">
                                    <td class="table-line">{$reseller_offers[i].name}</td>
                                    <td class="table-line">&pound;{$reseller_offers[i].price}</td>
                                    <td class="table-line">{section name=t loop=$reseller_seat_count}{if $reseller_offers[i].reseller_offer_id == $reseller_seat_count[t].reseller_offer_id}{$reseller_seat_count[t].seats_count}{/if}{/section}</td>
                                    <td nowrap class="table-line"><div align="left">&nbsp; <a href="reseller_offers.php?reseller_id={$reseller_id}&option=edit&id={$reseller_offers[i].reseller_offer_id}"><img src="images/icons/config_clock_16.gif" alt="Edit" width="16" height="16" border="0"></a>&nbsp; &nbsp; <a href="reseller_offers.php?option=delete&reseller_id={$reseller_id}&id={$reseller_offers[i].reseller_offer_id}" onclick="return confirm('Are you sure you want to delete this offer?');"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" border="0"></a></div></td>
                                </tr>
                                {sectionelse}
                                <tr>
                                    <td colspan="3" bgcolor="#F8F8F8" class="table-line">There are no reseller offers defined!</td>
                                </tr>
                            {/section}
                        </table></td>
                    <form name="offer_edit" method="post" action="reseller_offers.php?reseller_id={$reseller_id}&option={$smarty.get.option}&id={$smarty.get.id}" onsubmit="validate(); return returnVal;">
                        <input type="hidden" name="reseller_id" value="{$reseller_id}" />
                        <td width="44%" valign="top" class="outline-grey"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                                <tr>
                                    <td class="table-header-light">&nbsp; {if $smarty.get.option == edit}Edit{else}Add new{/if} offer: </td>
                                </tr>
                                <tr>
                                    <td valign="top" class="sitetable-padding"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">

                                            <tr>
                                                <td width="39%" class="sidetable-txt">Offer name: </td>
                                                <td width="61%" class="sidetable-txt"><input name="name" type="text" maxlength="50" value="{$reseller_offer.name}" class="cell-130" /></td>
                                            </tr>
                                            <tr>
                                                <td class="sidetable-txt"> Price: </td>
                                                <td class="sidetable-txt"><input name="price" type="text" maxlength="5" value="{$reseller_offer.price}"  class="sidetable-dropdown3" /></td>
                                            </tr>

                                            {section name=x loop=$tours}
                                                <tr>
                                                    <td colspan="2" class="sidetable-txt"><br /><img src="images/line-grey.gif" width="100%" height="1"><br /></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="sidetable-txt">{$tours[x].tour_name}<br /><br /></td>
                                                </tr>
                                                {section name=i loop=$tickets}
                                                    {if $tickets[i].ticket_tour_id == $tours[x].tour_id}
                                                        <tr>
                                                            <td class="table-line"> {$tickets[i].ticket_type} &pound;: </td>
                                                            <td class="sidetable-txt"><input name="reseller_ticket_{$tickets[i].ticket_id}" type="text" maxlength="5" class="sidetable-dropdown5" value="{section name=t loop=$reseller_offer_tickets}{if $tickets[i].ticket_id == $reseller_offer_tickets[t].ticket_id}{$reseller_offer_tickets[t].quantity}{/if}{/section}" /></td>
                                                        </tr>
                                                    {/if}
                                                    {sectionelse}
                                                    <tr>
                                                        <td colspan="3" bgcolor="#F8F8F8" class="table-line">There are no tickets defined!</td>
                                                    </tr>
                                                {/section}

                                            {/section}
                                            <tr>
                                                <td colspan="2" class="sidetable-txt"><div align="center"><a href="javascript: document.offer_edit.submit();" onclick="validate(); return returnVal;" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image39','','images/button-submit-on.gif',1)"><img src="images/button-submit-off.gif" alt="Submit" name="Image39" width="63" height="23" border="0"></a></div></td>
                                            </tr>
                                        </table></td>
                                </tr>
                            </table></td>
                    </form>
                </tr>
            </table>
            <br></td></tr>
</table>
<br>