<?php slot('body_id') ?>body_donation<?php end_slot() ?>
<?php slot('page_header') ?><?php echo __('Donations') ?><?php end_slot() ?>

<h2 class="center"><?php echo __('Purpose') ?></h2>
<div>
<?php echo __('Donations support a wide range of causes: constructions, shelters, protection of the environment, food, transport, rents... It all is done through your kindness and generosity only.') ?>
</div>
<?php/*
<?php
/*
$news = NewsPeer::retrieveByPk(98);
$news_link = $news->getUrl();
/
$purpose_link = url_for('@projects_index');
?>
<p class="center_text">
<a href="<?php echo $purpose_link ?>" target="_blank"><?php echo $purpose_link ?></a>
</p>
*/ ?>

<?php /*
<p>
<?php echo __('Bodhi Shrawan Dharma Sangha is planning for the auspicious day, when Dharma Sangha\'s meditation will end on May 17, Buddha Jayanti\'s day. After that Dharma Sangha will be giving blessings to devotees for 15 days from 9am to 6pm tentatively.') ?>
<br/><br/>
<?php echo __('We need to raise donation to cover meals for different religious leaders, who will be praying for world peace, prayer mandala, making tents for the religious leaders, devotees, bringing drinking water, medicines, road traffic, 500 volunteers (whom we are providing meals) for smooth process of getting blessings, projectors on hire, sound systems, flex, toilet facilities, etc.') ?>
<br/><br/>
<?php echo __('This is once in a lifetime way of giving offerings to this kind of auspicious ceremony and you will earn many merits in this lifetime, if you can help in this noble cause where about 300,000 people will get blessings.') ?>
</p>
*/
?>
<h2 class="center"><?php echo __('PayPal or Credit Card') ?></h2>
<div class="center_text">
<form method="post" action="https://www.paypal.com/cgi-bin/webscr">
    <input type="hidden" value="_donations" name="cmd" />
    <input type="hidden" value="bsdsusa@gmail.com" name="business" />
    <input type="hidden" value="<?php echo strtoupper($sf_user->getCulture()) ?>" name="lc" />
    <input type="hidden" value="Bodhi Shrawan Dharma Sangha" name="item_name" />
    <input type="hidden" value="0" name="no_note" />
    <input type="hidden" value="USD" name="currency_code" />
    <input type="hidden" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest" name="bn" />
    <input type="image" src="https://www.paypalobjects.com/<?php echo UserPeer::getCulturePaypalButton() ?>/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="<?php echo __('PayPal - The safer, easier way to pay online!') ?>" style="border:0">
</form>
<br/>
<a href="javascript:toggleRecurringDonation(); void(0);"><?php echo __('Recurring Donation') ?></a>

    <div class="hidden" id="reccuring_donation">
        <br/>
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">

            <table class="left_text bordered" id="recurring_donation_form">
                <tr>
                    <td><?php echo __('Donation amount') ?></td>
                    <td>
                        <input type="text" value="" name="a3" onkeyup="recurringFormAmountChange(this)"/>
                        <?php echo __('USD') ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo __('Payment cycle') ?></td>
                    <td>
                        <select name="p3"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option></select>

                        <select name="t3"><option value="D"><?php echo __('day(s)') ?></option><option value="W"><?php echo __('week(s)') ?></option><option selected="" value="M"><?php echo __('month(s)') ?></option><option value="Y"><?php echo __('year(s)') ?></option></select>
                    </td>
                </tr>
                <tr>
                    <td><?php echo __('After how many cycles should sending donations stop') ?></td>
                    <td>
                        <select name="srt"><option value=""><?php echo __('Never') ?></option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option></select>
                    </td>
                </tr>
            </table>

            <input name="cmd" type="hidden" value="_xclick-subscriptions" />
            <input type="hidden" value="bsdsusa@gmail.com" name="business" />
            <input type="hidden" value="<?php echo strtoupper($sf_user->getCulture()) ?>" name="lc" />
            <input type="hidden" value="Bodhi Shrawan Dharma Sangha" name="item_name" />
            <input type="hidden" value="0" name="no_note" />
            <input type="hidden" value="1" name="no_shipping" />
            <input type="hidden" value="USD" name="currency_code" />
            <input type="hidden" name="src" value="1">
            <input type="hidden" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest" name="bn" />
            <br/>
            <input type="image" alt="<?php echo __('PayPal - The safer, easier way to pay online!') ?>" name="submit" src="https://www.paypalobjects.com/<?php echo UserPeer::getCulturePaypalButton() ?>/i/btn/btn_donateCC_LG.gif" style="border:0" />
        </form>
        <span class="light"><?php echo __('You have control over your payments through your Paypal account and can cancel at any time.') ?></span>
        <br/><br/>
    </div>
</div>
<?php /*
<h2 class="center"><?php echo __('PayPal') ?></h2>
<div class="center_text">
<form method="post" action="https://www.paypal.com/cgi-bin/webscr">
    <input type="hidden" value="_donations" name="cmd" />
    <input type="hidden" value="kim2004huyen@yahoo.com" name="business" />
    <input type="hidden" value="US" name="lc" />
    <input type="hidden" value="Bodhi Shravan Dharma Sangha" name="item_name" />
    <input type="hidden" value="0" name="no_note" />
    <input type="hidden" value="USD" name="currency_code" />
    <input type="hidden" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest" name="bn" />
    <input type="image" alt="PayPal - The safer, easier way to pay online!" name="submit" src="https://www.paypalobjects.com/WEBSCR-640-20110401-1/en_US/i/btn/btn_donateCC_LG.gif" style="border:0" />
</form>
</div>
* ?>

<?php /*
<h2 class="center"><?php echo __('PayPal') ?></h2>
<div class="center_text">
<form method="post" action="https://www.paypal.com/cgi-bin/webscr">
    <input type="hidden" value="_donations" name="cmd" />
    <input type="hidden" value="pld.hall@zoznam.sk" name="business" />
    <input type="hidden" value="US" name="lc" />
    <input type="hidden" value="dharmasangha.org.np" name="item_name" />
    <input type="hidden" value="0" name="no_note" />
    <input type="hidden" value="EUR" name="currency_code" />
    <input type="hidden" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest" name="bn" />
    <input type="image" alt="PayPal - The safer, easier way to pay online!" name="submit" src="https://www.paypalobjects.com/WEBSCR-640-20110401-1/en_US/i/btn/btn_donateCC_LG.gif" style="border:0" />
</form>
</div>
*/ ?>

<?php /*
<h2 class="center"><?php echo __('SMS') ?></h2>
<p class="center_text">
*/ ?>

<?php /*
<script type="text/javascript">
smsDonateId = 412067;
smsDonateButton = 1;
<?php if ($sf_user->getCulture() != 'ru'): ?>
smsDonateLanguage = "english";
<?php endif ?>
</script>
<script type="text/javascript" src="http://donate.smscoin.com/js/smsdonate.js"></script>
*/
?>
<?php /*
<script src="http://www.zaypay.com/pay/116564.js" type="text/javascript"></script><a href="http://www.zaypay.com/pay/116564" onclick="ZPayment(this); return false"><img src="http://www.zaypay.com/pay/116564/img" border="0" /></a>
*/ ?>

<?php /*
<script type="text/javascript">
$(document).ready(function(){
    $("#zay_pay_iframe").contents().find('body').html('<script src="http://www.zaypay.com/pay/116564.js" type="text/javascript"></script><a href="http://www.zaypay.com/pay/116564" onclick="ZPayment(this); return false"><img src="http://www.zaypay.com/pay/116564/img" border="0" /></a>');
});
</script>
*/ ?>

<?php /*
</p>
*/ ?>

<?php /*
<h2 class="center"><?php echo __('Bank account') ?></h2>
<p class="center_text">
<?php /*
    <strong>Organisation Name:</strong> Bodhi Shrawan Dharma Sangha
    <br/><strong>Bank Name:</strong> Standard Chartered Bank
    <br/><strong>Branch:</strong> Lazimpat Branch
    <br/><strong>Account No:</strong> 01-2231700-01
    <br/><strong>Street:</strong> Lazimpat
    <br/><strong>Swift Code:</strong> SCBLNPKA
    <br/><strong>Address:</strong> P.O.Box 3990, Lazimpat, Kathmandu, Nepal
    <br/><strong>Tel:</strong> 977-1-4418456
    <br/><strong>Fax No:</strong> 977-1-4417428
* ?>
    <strong><?php echo __('Account Holder\'s Name') ?>:</strong> Nil Bdr / Tomasz Hen
    <br/><strong><?php echo __('Account Number') ?>:</strong> 00700501204269
    <br/><strong><?php echo __('Bank Name') ?>:</strong> Everest Bank Limited
    <br/><strong><?php echo __('Branch') ?>:</strong> Simara Branch
    <br/><strong><?php echo __('Address') ?>:</strong> Simara Chowk (<?php echo __('street') ?>), Simara (<?php echo __('sity') ?>), Bara (<?php echo __('district') ?>), Nepal (<?php echo __('country') ?>)
    <br/><strong><?php echo __('SWIFT (BIC)') ?>:</strong> EVBLNPKA
    <br/><strong><?php echo __('Phone') ?>:</strong> 977-53-520506
    <br/><strong><?php echo __('Fax') ?>:</strong> 977-53-520616
    <br/><strong>Email:</strong> eblsim@ebl.com.np
</p>
*/ ?>
<?php /*
<h2 class="center"><?php echo __('Bank account') ?></h2>
<p class="center_text">
    <strong><?php echo __('Account Holder\'s Name') ?>:</strong> Darshan Limbu / Nil Bahadur Thing
    <br/><strong><?php echo __('Account Number') ?>:</strong> 00700501204924
    <br/><strong><?php echo __('Bank Name') ?>:</strong> Everest Bank Limited
    <br/><strong><?php echo __('Branch') ?>:</strong> Simara Branch
    <br/><strong><?php echo __('Address') ?>:</strong> Simara Chowk (<?php echo __('street') ?>), Simara (<?php echo __('sity') ?>), Bara (<?php echo __('district') ?>), Nepal (<?php echo __('country') ?>)
    <br/><strong><?php echo __('SWIFT (BIC)') ?>:</strong> EVBLNPKA
    <br/><strong><?php echo __('Phone') ?>:</strong> 977-53-520506
    <br/><strong><?php echo __('Fax') ?>:</strong> 977-53-520616
    <br/><strong>Email:</strong> eblsim@ebl.com.np
</p>
*/ ?>

<h2 class="center"><?php echo __('Bank account') ?></h2>
<p>
    <?php echo __('Email at') ?> <a href="mailto:info@etapasvi.com">info@etapasvi.com</a> <?php echo __('for instructions.') ?>
</p>
<?php if ($sf_user->getCulture() != 'ru'): ?>
<h2 class="center"><?php echo __('Sending a check') ?></h2>
<p>
    <table class="left_text bordered general_table">
    <tr>
        <td><strong><?php echo __('Order of') ?></strong></td>
        <td>Bodhi Shrawan Dharma Sangha USA</td>
    </tr>
    <tr>
        <td><strong><?php echo __('Address to') ?></strong></td>
        <td>
            BSDS-USA<br/>
            9315 Bolsa Avenue, # 111<br/>
            Westminster, CA 92683<br/>
            USA
        </td>
    </tr>
    </table>
</p>
<?php endif ?>

<h2 class="center"><?php echo __('Reports') ?></h2>
<div>
    <?php echo __('Detailed reports on received donations and expenses are being sent personally to donors.') ?>
</div>
<?php /*
<div class="center_text">
<a href="https://docs.google.com/spreadsheet/pub?hl=en_US&hl=en_US&key=0ApLTjOcBiwykdDlYNjBLZWVSaUlhaVg4ZG55S0VZdXc&single=true&gid=0&output=html" target="_blank"><?php echo __('Donations received') ?></a> | <a href="https://docs.google.com/document/pub?id=1bIX95gsuNxFDxrTbopjKXTK3ypPk894SHiKZmEOoBGU" target="_blank"><?php echo __('Planned expenses') ?></a> | <a href="https://docs.google.com/document/pub?id=1v46QPZq6iZnVWhmBRWRBSdVIqHW7kAsONfnbIWfViAI" target="_blank"><?php echo __('Income / Expenses') ?></a>
<br/><br/><a href="http://coinmill.com/NPR_calculator.html" target="_blank"><?php echo __('Currency Converter') ?></a>
</div>
*/ ?>
<br/><a href="http://coinmill.com/NPR_calculator.html" target="_blank"><?php echo __('Currency Converter') ?></a>
<br /><br />
<?php include_component('comments', 'show'); ?>