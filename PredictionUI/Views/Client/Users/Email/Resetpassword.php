<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Softclicktech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0;background: #676767;">
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 45px;">
    <tr>
        <td style="padding: 10px 0 30px 0;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
                <tr>
                    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <?php BerkaPhp\Helper\Element::Render('EmailHeader')?>
                            <tr>
                                <td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 15px; line-height: 20px;">
                                    <?=23$emailContent ?>
                                    <br/>
                                    <br/>
                                    Thank you.
                                    <br>
                                    Softclicktech Team.
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php BerkaPhp\Helper\Element::Render('EmailFooter')?>
            </table>
        </td>
    </tr>
</table>
</body>
</html>