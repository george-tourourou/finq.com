<div id='popup-proccess-window' class='popup-window'>
    <div class='col-12_12'>
        <img src='http://lp.finq.com/campaign/Common/images/squares.gif' />
    </div>
    <div class='col-12_12'>
		<span>
		Please wait...<br />
		Your registration is in progress
		</span>
    </div>
</div>

<?php if (canAccess()) { ?>
   <!-- <form name="register" id="register" method="post" action="https://lp.finq.com/campaign/zap2/index.php"> -->
   <form name="register" id="register" method="post" enctype="application/x-www-form-urlencoded">
	
<!--        <span id="x-button" onclick="hideForm()" class="display-topright">&times;</span>-->
        <?php
        include_once('Parameters.php');
        ?>
        <div class="col-12_12 mg-top-20">
            <div class="col-12_12 form_row">
                <input class="input_box" id="fname" type="text" name="fname" value="<?php echo $fname;?>" pattern="[^1234567890!£$%&()_+-=<>?,.]+" title="Enter First Name With only Characters" required="" placeholder="<?php echo GetFormTranslation('first_name') ?>" tabindex="1"/>
                <span id='fnameError' class='error'>Enter First Name with only characters</span>
            </div>
            <div class="col-12_12 form_row">
                <input class="input_box" id="lname" type="text" name="lname" value="<?php echo $lname;?>" pattern="[^1234567890!£$%&()_+-=<>?,.]+" title="Enter Last Name With only Characters" required="" placeholder="<?php echo GetFormTranslation('last_name') ?>" tabindex="2"/>
                <span id='lnameError' class='error'>Enter Last Name with only characters</span>
            </div>
        </div>

        <div class="col-12_12 mg-top-20 form_row">
            <input class="input_box" id="email" type="text" name="email" value="<?php echo $nemail;?>" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Enter A Valid Email" required="" placeholder="<?php echo GetFormTranslation('e_mail') ?>" tabindex="3"/>

            <span id='emailError' class='error'>Enter a valid Email address</span>
            <span id='apiError' class='error'>An error has occurred. Please try again later.</span>
        </div>
        <div class="col-12_12 mg-top-20 form_row">
            <input type="tel" name="phone[]" size="3" value="<?php echo getPhoneCode(getUserCoutryCode()) ?>" pattern="(^[+]|[0]{2})([0-9]{1,3})$" title="Enter a Valid Country Code Number For Example : +44" required="" id="phone2"/>

            <input  id="phone" type="text" name="phone[]" value="<?php echo $nphone;?>" pattern="[0-9]{7,24}$" title="Enter a Valid Phone Number between 7 and 24 digits. For Example : 99001122" required="" placeholder="<?php echo GetFormTranslation('phone') ?>" tabindex="4"/>

            <span id='phone2Error' class='error'>Enter a valid Country Code Number For Example : +44</span>
            <span id='phoneError' class='error'>Enter a valid Phone Number between 7 and 24 digits. For example : 220011334</span>
        </div>

        <div class="col-12_12 mg-top-20 custom-submit-div">
            <span id='submitForm' class="btn btn-gold"><?php echo GetFormTranslation('start_trading') ?></span>
        </div>
    </form>
<?php 
//print_r($_SESSION);
//var_dump($_SESSION['form_token']);
//echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';

} else { ?>
    <br /><br />
    <h3 class='col-12_12 error'>Forbidden jurisdiction please contact support@finq.com</h3>
    <br /><br />
<?php } ?>