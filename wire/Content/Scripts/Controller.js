
var _bankAccounts, _currencies, _countries;

function contructor(bankAccounts, currencies, countries) {
    _bankAccounts = bankAccounts;
    _currencies = currencies;
    _countries = countries;
}

function trimAndLowercase(content) {
    return content.trim().toLowerCase();
}

angular.module('MyApp',['ngMaterial', 'ngMessages', 'material.svgAssetsCache', 'ui.filters','angular.filter','iso-3166-country-codes'])
    .controller('AppCtrl', function($scope, $http, $filter, ISO3166) {

        $scope.Currency = {
            Name: "EUR",
            Min: 100,
            Max: 50000
        };
        $scope.showContactSupportMessage = false;
        $scope.ShowAmountArea = false;

        $scope.showHints = true;
        $scope.content = null;

        $scope.onBankSelect = function()
        {
            var bankDetails = getBankAccountDetails($scope.Model.BankAccountID);

            $scope.Currency.Name = bankDetails.CurrencyName;

            var details = getCurrencyDetails($scope.Currency.Name);

            $scope.Currency.Min = details.MinimumDeposit;
            $scope.Currency.Max = details.MaximumDeposit;

            $scope.ShowAmountArea = true;
        };

        function getIngenikoBankAccountTypeName() {
            return 'ingeniko';
        }

        function getNormalBankAccountTypeName() {
            return 'normal';
        }

        $scope.getCountryBanks = function (country)
        {
            $scope.ShowBankAccounts = true;
            country = trimAndLowercase(country);

            var hasAccessToBarclaysBank = HasAccessToBarclaysBank();
            var bankAccounts = [];
            var bankType_Barclays = "Barclays Bank";
            ////
            var allBankAccounts = getBankAccounts();
            var length = allBankAccounts.length;
            var defaultBankAccountTypeID = 1;
            var i = 0;
            var CountryName = "";
            var foundLocalBank = false;

            $scope.ShowBanksNoteLocal = false;
            $scope.ShowBanksNoteDefault = false;
            var companyBankAccounts = [getNormalBankAccountTypeName(), getIngenikoBankAccountTypeName()];

            for(var j = 0; j < 2; j++)
            {
                var enableCompanyBankType = companyBankAccounts[j];

                //in case our local bank exist
                if(foundLocalBank === true)
                {
                    continue;
                }

                for(i = 0; i < length; i++)
                {
                    var bankAccount = allBankAccounts[i];

                    if(bankAccount.BankTypeName === bankType_Barclays && hasAccessToBarclaysBank === false)
                    {
                        continue;
                    }

                    var companyBankTypeName = trimAndLowercase(bankAccount.BankTypeName);

                    if(companyBankTypeName !== enableCompanyBankType)
                    {
                        continue;
                    }

                    CountryName = trimAndLowercase(bankAccount.PrimaryCountryName);

                    if(country === CountryName)
                    {
                        if(trimAndLowercase(bankAccount.BankTypeName) !== getIngenikoBankAccountTypeName())
                        {
                            $scope.ShowBanksNoteLocal = true;
                            foundLocalBank = true;
                        }

                        bankAccounts = InsertBankAccount(allBankAccounts, bankAccounts, bankAccount);
                    }
                }
            }

            if(foundLocalBank === false)
            {
                $scope.ShowBanksNoteDefault = true;

                //show default bank accounts
                for(i = 0; i < length; i++)
                {
                    var newbankAccount = allBankAccounts[i];
                    if(newbankAccount.BankTypeID === defaultBankAccountTypeID)
                    {
                        bankAccounts = InsertBankAccount(allBankAccounts, bankAccounts, newbankAccount);
                    }
                }

                //show alternative bank accounts of the requested country
                for(i = 0; i < length; i++)
                {
                    var newbankAccount = allBankAccounts[i];
                    if(newbankAccount.BankTypeName === bankType_Barclays && hasAccessToBarclaysBank === false)
                    {
                        continue;
                    }

                    CountryName = trimAndLowercase(newbankAccount.CountryName);

                    if(country === CountryName)
                    {
                        bankAccounts = InsertBankAccount(allBankAccounts, bankAccounts, newbankAccount);
                    }
                }
            }

            $scope.BankAccounts = bankAccounts;

            /*
            var bankTypes = ["FoundByName", "Normal", "Barclays Bank", "Ingeniko"];

            var groupBankAccounts = [];
            length = bankAccounts.length;

            for(var b = 0; b < bankTypes.length; b++)
            {
                for(var j = 0; j < length; j++)
                {
                    if(bankAccounts[j].BankTypeName === bankTypes[b])
                    {
                        groupBankAccounts.push(bankAccounts[j]);
                    }
                }
            }
            */
        };

        function InsertBankAccount(allBankAccounts, bankAccounts, newBankAccount) {
            var bankAccountsLength = bankAccounts.length;
            var found = false;
            var newBankAccountID = newBankAccount.BankAccountID;

            for(var j = 0; j < bankAccountsLength; j++)
            {
                if(newBankAccountID === bankAccounts[j].BankAccountID)
                {
                    found = true;
                    break;
                }
            }

            if(!found)
            {
                bankAccounts.push(newBankAccount);
            }

            return bankAccounts;
        }

        $scope.ShowBankAccounts = false;
        $scope.stateInput = false;


        function getBankAccounts() {
            return _bankAccounts;
        }

        function getCountries() {
            return _countries;
        }

        function getCurrenciesDetails()
        {
            return _currencies;
        }

        function getCurrencyDetails(currencyName) {
            var currencies = getCurrenciesDetails();
            var length = currencies.length;

            for(var i = 0; i < length; i++)
            {
                var currency = currencies[i];

                if(currency.Name === currencyName) {
                    return currency;
                }
            }

            return {
                MinimumDeposit: 100,
                MaximumDeposit: 50000
            };
        }

        $scope.countries = getCountries();

        $scope.formsuccess = false;

        //activated on client details
        $scope.showAccountsList = false;
        $scope.hasAccount = false;

        $scope.Model = {};

        var accountId = GetPredefinedAccountID();
        var isMobileApplication = IsMobileApp();

        if(accountId !== null && accountId !== "")
        {
            $scope.hasAccount = true;
            $scope.Model.AccountID = accountId;
        }

        if(isMobileApplication === 'true')
        {
            SetClientDetails(GetPredifinedClientID(), GetPredifinedFirstName(), GetPredifinedLastName());
        }

        function getBankAccountDetails(bankAccoundID) {
            bankAccoundID = parseInt(bankAccoundID);
            var allBanks = getBankAccounts();

            var length = allBanks.length;

            for(var i = 0; i < length; i++)
            {
                var item = allBanks[i];

                if(item.BankAccountID === bankAccoundID)
                {
                    return item;
                }
            }

            return null;
        }

        $scope.processForm = function()
        {
            var clientDetails = GetClientDetails();
            var bankDetails = getBankAccountDetails($scope.Model.BankAccountID);

            var model = {
                FirstName: clientDetails.firstName,
                LastName: clientDetails.lastName,
                Email: clientDetails.email,
                AccountID: $scope.Model.AccountID,
                Phone: $scope.Model.Phone,
                Amount: $scope.Model.Amount,
                Currency: bankDetails.CurrencyName,
                CountryCode: bankDetails.CountryCode,

                UserID: clientDetails.id,
                Username: clientDetails.username,
                ReferrerUrl: document.referrer,
                BankAccountID: $scope.Model.BankAccountID,
                BankName: bankDetails.BankName,
                Company: bankDetails.CompanyName,
                Country: bankDetails.CountryName
            };

            /*
                $scope.model.cosmosUserID = clientDetails.id;
                $scope.user.cosmosUsername = clientDetails.username;
                $scope.user.lastName = clientDetails.lastName;
                $scope.user.firstName = clientDetails.firstName;
                $scope.user.email = clientDetails.email;
                $scope.user
                $scope.user.referrerUrl = document.referrer;
            */

            $http({
                method  : 'POST',
                url     : '/wire/Controller/Index.php',
                data    : $.param(model),
                headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
            })
            .success(function(data)
            {
                if (!data.success)
                {
                    $scope.errorFirstName = data.errors.FirstName;
                    $scope.errorLastName = data.errors.LastName;
                    $scope.errorEmail = data.errors.Email;
                    $scope.errorPhone = data.errors.Phone;
                    $scope.errorAccountid = data.errors.AccountID;
                    $scope.errorAmount = data.errors.Amount;
                    $scope.errorCountry = data.errors.Country;
                    $scope.errormybankers = data.errors.BankName;
                }
                else
                {
                    $scope.message = data.message;
                    $scope.formsuccess = true;
                }
            })
            .error(function (data, status, headers, config) {
                console.log(data + " " + status + " " + headers + " " + config);
            });
        };
    });
