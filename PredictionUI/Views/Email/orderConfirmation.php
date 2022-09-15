<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!--[if IE 9 ]><html lang="en" class="ie9"><![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <title>Roost Material Design Real Estate</title>

    <!-- Client specific styles - DO NOT REMOVE -->
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        table {
            border-spacing: 0;
        }

        table td {
            border-collapse: collapse;
        }

        .appleLinks a {
            color:#b4b4b4;
            text-decoration: none;
        }

        .backgroundTable {
            margin:0 auto;
            padding:0;
            width:100%!important;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;
        }

        .ReadMsgBody {
            width: 100%;
            background-color: #ebebeb;
        }

        table {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        table td {
            border-collapse: collapse;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        .yshortcuts a {
            border-bottom: none !important;
        }

        @media screen and (max-width: 714px) {
            .force-row,
            .container,
            .tweet-col,
            .ecxtweet-col {
                width: 100% !important;
                max-width: 100% !important;
            }

            .container {
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }
        }
        .ios-footer a {
            color: #aaaaaa !important;
            text-decoration: underline;
        }
    </style>
</head>

<body bgcolor="#eeeeee" style="margin:0; padding:0; -webkit-font-smoothing: antialiased; background-color: #eeeeee;" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" valign="top">

            <table bgcolor="#ffffff" border="0" width="650" cellpadding="0" cellspacing="0" class="container" style="width:601px;padding:15px; max-width:650px; background-color: #ffffff;">
                <tr>
                    <td width="100%" border="0" style="padding-top:20px;padding-right:20px;padding-left:20px;background-color:#ffffff">
                        <table border="0" width="100%" cellpadding="0" cellspacing="0">

                            <tr>
                                <td style="font-family: Arial, sans-serif; font-size: 15px; color: #545454; text-align: left; line-height: 20px;">
                                    <Br>
                                    Hi Dear <?=ucfirst(BerkaPhp\Helper\Auth::GetActiveUser(true)->name)?>, you have successfully placed an sms order below is full order details
                                    <br><br>
                                    <table style="font-weight: bolder">
                                        <tr>
                                            <td>Order Number </td>
                                            <td>#<?=$order->id?></td>
                                        </tr>
                                        <tr>
                                            <td>SMS Quantity</td>
                                            <td><?=$order->credits?></td>
                                        </tr>
                                        <tr>
                                            <td>Price Per SMS</td>
                                            <td>R<?=$order->pricePerUnit?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Amount</td>
                                            <td>R<?=$order->amount?></td>
                                        </tr>
                                    </table>
                                    <br>
                                    Please note that your order is still in <strong><?=$order->status->name?></strong>, if you have not pay yet, please click below button to pay now.
                                    <br>
                                    <br>
                                    <a href="<?=SITE_URL . BerkaPhp\Helper\Html::action('/credits/checkout/'.$order->id)?>" style="text-align:center; padding: 10px; padding-top: 14px; border-radius: 2px; background-color: #4595e7; display: block;width: 90px;">
                                        <font color="#fff">Pay Now</font>
                                    </a>
                                    <br/>
                                    <br/>

                                    Kind Regards,<br>
                                    Softclick Tech (Pty) Ltd  Team
                                </td>
                            </tr>

                            <tr>
                                <td style="text-align: center;">
                                    <a href="" style="text-decoration: none;"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr><td valign="top" width="100%" style="line-height: 30px; font-size: 0" height="70;">&nbsp;</td></tr>

            </table>
        </td>
    </tr>
</table>

</body>
</html>
