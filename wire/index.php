<?php 
header("Location: https://www.finq.com/files/pdf/Finq_Banks.pdf");
die();
?>
<html lang="en" >
<head>
    <?php
        include_once $_SERVER['DOCUMENT_ROOT'] . "/wire/Controller/GetController.php";

        $Controller = new GetController();

        $Model = $Controller->Index();
    ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Angular Material style sheet -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" href="Content/Styles/normalize.css">
    <link rel="stylesheet" href="Content/Styles/main.css">
    <link rel="stylesheet" href="Content/Styles/Styles.css?<?php echo $Model->ClientSideVersion; ?>" />

	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>


    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-route.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>
    <script src="//s3-us-west-2.amazonaws.com/s.cdpn.io/t-114/svg-assets-cache.js"></script>
  <!--  <script src="//cdn.gitcdn.link/cdn/angular/bower-material/v1.1.5/angular-material.js"></script> -->
	<script src="/wire/angular-material.js"></script>
	
    <script src="//cdnjs.cloudflare.com/ajax/libs/angular-ui/0.4.0/angular-ui.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/angular-filter/0.5.17/angular-filter.js"></script>

    <script src="/wire/Content/Scripts/iso-3166-country-codes-angular.min.js"></script>
    <script src="/wire/Content/Scripts/angular-ui.js"></script>
    <script src="/wire/Content/Scripts/Controller.js?<?php echo $Model->ClientSideVersion; ?>"></script>
    <script src="/wire/Content/Scripts/modernizr-2.8.3.min.js"></script>
    <script src="/wire/Content/Scripts/ClientDetails.js?<?php echo $Model->ClientSideVersion; ?>"></script>


    <script>

        /**
         * @return {string}
         */
        function GetPredefinedAccountID() {
            return "<?php echo $Model->AccountID; ?>";
        }

        /**
         * @return {string}
         */
        function GetPredifinedClientID() {
            return "<?php echo $Model->ClientID; ?>";
        }

        /**
         * @return {string}
         */
        function GetPredifinedFirstName() {
            return "<?php echo $Model->FirstName; ?>";
        }

        /**
         * @return {string}
         */
        function GetPredifinedLastName() {
            return "<?php echo $Model->LastName; ?>";
        }

        /**
         * @return {string}
         */
        function IsMobileApp() {
            return "<?php echo $Model->IsMobileApplication == true ? 'true' : 'false'; ?>";
        }
        
        /**
         * @return {string}
         */
        function HasAccessToBarclaysBank() {
            return '<?php echo $Model->UserHasAccesToBarclaysBank; ?>';
        }

        /**
         * @return {array}
         */
        function GetAvailableCompanies() {
            return <?php echo $Model->AvailableCompanies; ?>;
        }

        /**
         * @return {string}
         */
        function GetWidgetUrl() {
            return "<?php echo $Model->WidgetUrl; ?>";
        }

        contructor(<?php echo $Model->BankAccounts; ?>, <?php echo $Model->Currencies; ?>, <?php echo $Model->Countries; ?>);
    </script>
</head>
<body>
<?php if($Model->ShowHeader) { ?>
	<div layout-gt-sm="row" class="p-3 mb-2 header">
		<md-container class="md-block" flex-gt-sm="">
			<div class="container">
				<img height="50" src="<?php echo $Model->LogoUrl; ?>" />
			</div>
		</md-container>		
	</div>
<?php } ?>
	<div class="container">
        <?php if($Model->ShowHeader) { ?>
		<div layout-gt-sm="row">
			<md-container class="md-block" flex-gt-sm="">
				<h1 class="md-display-2">Bank Wire Transfer</h1>
			</md-container>		
		</div>
        <?php } ?>
		<div ng-controller="AppCtrl" id="AppCtrl" layout="column" ng-cloak="" class="inputdemoErrorsAdvanced" ng-app="MyApp">
            <md-content ng-show="showContactSupportMessage == false">
                <form name="userForm" ng-submit="processForm()" ng-show="formsuccess == false">
		            <label style="color: @brand-primary;">Please fill in your details carefully to avoid delays</label>

                    <div layout-gt-sm="row">
                      <md-input-container class="md-block" flex-gt-sm="">
                          <label>Phone Number</label>
                          <md-icon md-font-library="material-icons">phone</md-icon>
                          <input name="phone" ng-model="Model.Phone" required="" ng-pattern="/^[+][0-9]{2,3}[0-9]{7,24}$/">
                          <div class="hint" ng-show="showHints">+### #######</div>
                          <div ng-messages="userForm.phone.$error" ng-hide="showHints">
                              <div ng-message="pattern">+########## - Please enter a valid phone number.</div>
                          </div>
                      </md-input-container>
                    </div>
                    <div layout-gt-sm="row" ng-show="showAccountsList">
                        <md-input-container class="md-block" flex-gt-sm="">
                            <label>Account ID</label>
                            <md-icon md-font-library="material-icons">account_box</md-icon>
                            <md-select name="accountid" ng-model="Model.AccountID" ng-required="true">
                                <md-option ng-repeat="account in accountsList" value="{{account.ID}}">
                                    {{account.Name}}
                                </md-option>
                            </md-select>
                        </md-input-container>
                    </div>

                    <div layout-gt-sm="row">
                        <md-input-container class="md-block" flex-gt-sm >
                            <label>Select a country to see the relevant bank accounts for your transfer.</label>
                            <md-icon md-font-library="material-icons">location_on</md-icon>
                            <md-select name="countryDropdown1" ng-model="Model.Country" ng-change="changed()" ng-required="true">
                                <md-option ng-repeat="country in countries | orderBy" value="{{country}}" ng-click="getCountryBanks(country)">
                                    {{country}}
                                </md-option>
                            </md-select>
                        </md-input-container>
                    </div>
                    <div layout-gt-sm="row" ng-if="ShowBanksNoteDefault === true || ShowBanksNoteLocal === true">
                        <md-input-container class="md-block" flex-gt-sm >
                            <div ng-if="ShowBanksNoteDefault === true" class="alert alert-warning">Please note that we currently do not have a local bank in this country. You may select a bank from the below list to complete an international bank transfer.</div>
                            <div ng-if="ShowBanksNoteLocal === true" class="alert alert-success">Please find below a list of local banks</div>
                        </md-input-container>
                    </div>
                    <div layout-gt-sm="row" ng-show="ShowBankAccounts">
                      <md-input-container class="md-block" flex-gt-sm>
                            <label>Select Bank and Currency</label>
                                <md-select name="BankAccountID" ng-model="Model.BankAccountID" ng-required="true" ng-change="onBankSelect()">
                                    <md-option ng-repeat="BankAccount in BankAccounts | orderBy: BankAccount.BankTypeID" value="{{BankAccount.BankAccountID}}">
                                         <strong>Currency:</strong> {{BankAccount.CurrencyName}}
                                        -<strong> Bank Country:</strong> {{BankAccount.PrimaryCountryName}}
                                        -<strong> Bank Name:</strong> {{BankAccount.BankName}}
                                    </md-option>
                                </md-select>
                        </md-input-container>
                    </div>
                    <div layout-gt-sm="row" ng-show="ShowAmountArea">
                        <md-input-container class="md-block" flex-gt-sm="">
                            <label>Amount between {{Currency.Min}}, {{Currency.Max/1000}}K {{Currency.Name}}</label>
                            <md-icon md-font-library="material-icons">account_balance</md-icon>
                            <input type="number" min="{{Currency.Min}}" max="{{Currency.Max}}" name="amount" ng-model="Model.Amount" required="" />
                            <div class="hint row" ng-show="showHints">How much are you going to deposit? For deposits above {{Currency.Max/1000}}K {{Currency.Name}} please contact support</div>
                            <div ng-messages="userForm.amount.$error" ng-hide="showHints">
                                <div ng-message="pattern">Please enter a valid amount .</div>
                            </div>
                        </md-input-container>
                    </div>
                    <div layout-gt-sm="row">
                        <md-button type="submit" class="md-gold">Submit</md-button>
                    </div>
        <pre>
        </pre>
    </form>
                <div id="messages" ng-show="message">
                    <div layout-gt-sm="row">
                        <div layout-gt-sm="row" class="layout-gt-sm-row">
                            <h3 class="md-diplay-1">Important Information</h3>
                        </div>
                    </div>
                    <div class="BankDetails full alert alert-info" layout-gt-sm="row">
                        <div layout-gt-sm="row" ng-repeat="item in message" class="full">
                            <strong>{{item.Name}}:</strong>
                            <span>{{item.Value}}</span>
                        </div>
                    </div>
                    <div class="layout-gt-sm-row" layout-gt-sm="row">
                      <md-input-container class="md-block flex-gt-sm" flex-gt-sm="">
                            <div class="alert alert-warning ng-scope">
                                <strong>IMPORTANT NOTICE:</strong> Please do not forget to include all payment details in the instructions to the bank and provide your proof of deposit/receipt with the reference number from your bank to <?php echo $Model->Brand; ?> customer support in order to avoid any inconvenience
                            </div>
                            <div class="alert ng-scope" style="font-size:12px;font-style:italic;">* Global Collect is a payment processing partner of <?php echo $Model->Domain; ?></div>
                        </md-input-container>
                    </div>
                </div>
          </md-content>
            <div ng-show="showContactSupportMessage == true" class="alert alert-warning ng-scope margin-top-10px">
                Please contact our support team at <?php echo $Model->SupportMail; ?>
            </div>
        </div>
    </div>

    <?php if($Model->IsMobileApplication == false) { ?>
	    <iframe sandbox="allow-top-navigation allow-scripts allow-same-origin allow-forms" src="<?php echo $Model->WidgetIFrameUrl; ?>"></iframe>
    <?php } ?>
  <!-- Start of LiveChat (www.livechatinc.com) code -->
<script type="text/javascript">
	window.__lc = window.__lc || {};
	window.__lc.license = 7952201;
	(function() {
	  var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
	  lc.src = ('https:' === document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
	  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
	})();
	
</script>
<!-- End of LiveChat code -->
</body>
</html>