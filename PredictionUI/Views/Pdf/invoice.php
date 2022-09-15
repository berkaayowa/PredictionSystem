<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>invoice</title>
    <style>

    </style>
</head>
<body style="font-family: sans-serif;">

<table style="color: #000000;">
    <tr>
        <td>
            <table style="width: 100%;">
                <tr>
                    <td>
                        <img src="<?=LOGO?>" alt="Softclick Tech (Pty) Ltd"/>
                    </td>
                    <td style="text-align: right;">
                        <span><strong>Softclick Tech (Pty) Ltd</strong></span>
                        <br/>
                        <br/>
                        <span>
                            <?=$branch['PhysicalAddress']?>
                        </span>
                        <br/>
                        <span>
                            Tel : <?=$branch['Tel']?><br/>
                            Email : <?=$branch['EmailAddress']?> <br/>
                        </span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td>
            <table>
                <tr>
                    <td style="vertical-align: baseline;">
                        <span><strong>Customer:</strong></span>
                    </td>
                    <td>
                        <span><?=$receiver['FirstName']?> <?=$receiver['LastName']?></span>
                        <br/>
                        <br/>
                        <span>
                            <?=$receiver['PhysicalAddress']?>
                        </span>
                    </td>
                    <td style="vertical-align: baseline;">
                        <span><strong>Sender :</strong></span>
                    </td>
                    <td style="vertical-align: baseline;">
                        <span><?=$sender['FirstName']?> <?=$sender['LastName']?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: baseline;">
                        <span><strong>Transaction Date:&nbsp;&nbsp;</strong></span>
                    </td>
                    <td>
                        <span><?=$transaction['CreatedDate']?></span>&nbsp;
                    </td>
                    <td style="vertical-align: baseline;">
                        <span><strong>Teller :</strong></span>
                    </td>
                    <td style="vertical-align: baseline;">
                        <span>PRC5</span>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: baseline;">
                        <span><strong>Invoice No:</strong></span>
                    </td>
                    <td>
                        <span>377847</span>
                    </td>
                    <td style="vertical-align: baseline;">
                        <span><strong></strong></span>
                    </td>
                    <td style="vertical-align: baseline;">
                        <span></span>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: baseline;">
                        <span><strong>PIN:</strong></span>
                    </td>
                    <td>
                        <span>6787</span>
                    </td>
                    <td style="vertical-align: baseline;">
                        <span><strong></strong></span>
                    </td>
                    <td style="vertical-align: baseline;">
                        <span></span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td>
            <table style="width: 100%; text-align: left;" cellspacing="0">
                <thead>
                    <tr>
                        <th style="border-bottom: 1px solid #9e9797;padding-bottom: 5px;">
                            Currency
                        </th>
                        <th style="border-bottom: 1px solid #9e9797;padding-bottom: 5px;">
                            Amount
                        </th>
                        <th style="border-bottom: 1px solid #9e9797;padding-bottom: 5px;">
                            Rate
                        </th>
                        <th style="border-bottom: 1px solid #9e9797;padding-bottom: 5px;">
                            Fee
                        </th>
                        <th style="border-bottom: 1px solid #9e9797;padding-bottom: 5px;">
                            Total Local
                        </th>
                    </tr>
                </thead>
                <tbody>
                <tr style="border-bottom: 1px solid gray;">
                    <td style="padding: 10px 0 10px 0;">
                        ZAR
                    </td>
                    <td style="padding: 10px 0 10px 0;">
                        <?=$transaction['TransactionAmount']?>
                    </td>
                    <td style="padding: 10px 0 10px 0;">
                        11.2
                    </td>
                    <td style="padding: 10px 0 10px 0;">
                        20
                    </td>
                    <td style="padding: 10px 0 10px 0;">
                        <?=$transaction['TransactionAmount']?>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;
                    </td>
                    <td>
                        &nbsp;
                    </td>
                    <td>
                        &nbsp;
                    </td>
                    <td style="border-top: 1px solid #9e9797;padding-top: 5px;">
                        Total Due :
                    </td>
                    <td style="border-top: 1px solid #9e9797;padding-top: 5px;">
                        <?=$transaction['TransactionAmount']?>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td>
            <strong>Note</strong>
        </td>
    </tr>
    <tr>
        <td>
            <div style="font-size: 13px;color: #aba6a6;;">
                Cryptocurrencies is a type of currency which is available only in digital form, not in physical like banknotes and coins.
                It has properties similar to physical currencies, but allows for instantaneous transactions and borderless ownership transfer.
                With the invention of the first decentralized Cryptocurrencies known as bitcoin which was created in 2009 by Satoshi Nakamoto.
            </div>
        </td>
    </tr>
    <tr>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td>
            <strong>Declaration</strong>
        </td>
    </tr>
    <tr>
        <td>
            <div style="font-size: 13px;color: #aba6a6;;">
                Cryptocurrencies is a type of currency which is available only in digital form, not in physical like banknotes and coins.
                It has properties similar to physical currencies, but allows for instantaneous transactions and borderless ownership transfer.
                With the invention of the first decentralized Cryptocurrencies known as bitcoin which was created in 2009 by Satoshi Nakamoto.
            </div>
        </td>
    </tr>
    <tr>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td>
            Signature
        </td>
    </tr>
    <tr>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td>
            ------------------------------------
        </td>
    </tr>
    <tr>
        <td>

        </td>
    </tr>
    <tr>
        <td>

        </td>
    </tr>
</table>
</body>
</html>