<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Demystifying Email Design</title>
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
                                <td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                    Hi <strong><?= $firstName ?></strong> welcome to <strong> soccerprediction.co.za</strong><br><br>
                                    To log in when visiting our site just click <a href="<?=SITE_URL?>/user/signin">Login</a>.
                                    <br/>
                                    <br/>
                                    Please click the button bellow to activate your account.
                                    <br/>
                                    <br/>
                                    <br/>
                                    <a href="<?=SITE_URL?>/users/activate/<?=$activationCode?>" style="padding: 15px;border: 2px solid;border-radius: 26px;color: white;background: #0083C1;font-weight: bold;">
                                        Activate now
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#202020" style="padding: 30px 30px 30px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td style="color: #0753cf; font-family: Arial, sans-serif; font-size: 14px; text-align: center" width="75%">
                                    <a target="_blank" href='https://www.facebook.com/profile.php?id=100094880164648'>Facebook </a> |
                                    <a target="_blank" href='https://www.youtube.com/@soccerprediction27/about'>Youtube</a> |
                                    <a href="mailto:<?=EMAIL_SUPPORT?>"><?=EMAIL_SUPPORT?></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>