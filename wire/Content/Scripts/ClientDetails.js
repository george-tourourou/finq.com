

var _clientDetails;

function GetClientDetails() {
	return _clientDetails;
}

function SetClientDetails(ClientID, FirstName, LastName) {
    _clientDetails = {
        id: ClientID,
        username: "MobileAppRequest",
        firstName: FirstName,
        lastName: LastName,
        email: "MobileAppRequest@MobileAppRequest.com"
    };
}

function getAccountName(account) {
    var platformName = "Meta Trader 4";

    if(account.platform.toLowerCase() === "cosmos")
    {
        platformName = "Web Trader";
    }

    var name = account.currency.toUpperCase() + " - " + platformName + " (" +  account.id + ")";

    return name;
}

function getTradingAccountsLength(accounts) {
    var length = 0;

    for(var accountID in accounts) {

        var account = accounts[accountID];

        if(account.status === "active" && account.type === "real") {
            length++;
        }
    }

    return length;
}

function getAccountsList(accounts) {
    var model = [];

    for(var accountID in accounts) {

        var account = accounts[accountID];

        if(account.status === "active" && account.type === "real") {
            var name = getAccountName(account);

            model.push({
                Name: name,
                ID: account.id
            });
        }
    }

    return model;
}

function UpdateModel() {
    var scope = angular.element($("#AppCtrl")).scope();
    scope.$apply(function() {
        if(scope.hasAccount === false)
        {
            var clientDetails = GetClientDetails();
            var tradingAccounts = clientDetails.productList;
            var length = getTradingAccountsLength(tradingAccounts);

            if(length > 0)
            {
                scope.showAccountsList = true;
                scope.accountsList =  getAccountsList(GetClientDetails().productList);
            }
            else
            {
                scope.showAccountsList = false;
                scope.showContactSupportMessage = true;
            }
        }
    });
}

handleClientDetails = function (e) {
    try	{
        if (typeof e.origin !== 'undefined') {
            // the variable is defined
        }

        if(e.origin === GetWidgetUrl())
        {
            var msg=JSON.parse(e.data);

            switch(msg.type)
            {
                case 'GET_USER_DATA':
                    _clientDetails = msg.body;
                    UpdateModel();
				break;
            }
        }
    }
    catch (err) {
        console.log(err);
    }
}

window.addEventListener('message', handleClientDetails, false);