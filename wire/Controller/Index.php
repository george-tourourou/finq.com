<?php 
	date_default_timezone_set('GMT');

    include_once("../Repository/Database.php");
    include_once("../Repository/IngenicoAPI.php");
    include_once("../Repository/IP.php");

    $repository = new WireTransferRepository();
    $response = $repository->Controller();

	echo json_encode($response);

	class WireTransferKeyValue {
	    public $Name;
	    public $Value;

	    public function __construct($name, $value)
        {
            $this->Name = $name;
            $this->Value = $value;
        }
    }

	class WireTransferRepository {
		public function Controller() {
            $bankRepository = new BankRepository();
			$errors = $this->validatePostModel();
			
			if (!empty($errors)) {
				$data['success'] = false;
				$data['errors']  = $errors;

				return $data;
			}

			$Amount = $_POST["Amount"];
			$company = $_POST["Company"];
            $BankAccountID = $_POST["BankAccountID"];

			$appConfiguration = new AppConfiguration();

            $IsIngenikoRequest = 0;

			if ($company == $appConfiguration->GetCompany())
			{
				$response = $bankRepository->GetBankDetails($BankAccountID);
                $logger = $response;
			} 
			else 
			{
			    $IsIngenikoRequest = 1;
				$model = $this->getModel();

				$ingenicoRepository = new IngenicoAPI();
                
				$responseStream = $ingenicoRepository->Request($model);

				$response = json_decode($responseStream, true);

				$logger= json_encode($response[merchantAction][showData]);

                $model = array();

                for($i = 0; $i < 8; $i++)
                {
                    $new_key = "";
                    $key = $response[merchantAction][showData][$i][key];

                    switch($key) {
                        case "SWIFTCODE":
                            $new_key = "Swift code";
                            break;
                        case "PAYMENTREFERENCE":
                            $new_key = "Payment reference";
                            break;
                        case "ACCOUNTHOLDER":
                            $new_key = "Account holder";
                            break;
                        case "BANKNAME":
                            $new_key = "Bank name";
                            break;
                        case "IBAN":
                            $new_key = "IBAN";
                            break;
                        case "BANKACCOUNTNUMBER":
                            $new_key = "Bank account number";
                            break;
                    }

                    if($new_key != "") {
                        $model[] = new WireTransferKeyValue($new_key, $response[merchantAction][showData][$i][value]);
                    }
                }
				$response = $model;
			}
			
			$data['success'] = true;
			$data['message'] = $response;

            $clientCountryCode = getenv("GEOIP2_COUNTRY_CODE");
            $bankRepository->StoreRequest($IsIngenikoRequest, $BankAccountID, $clientCountryCode, $Amount, $_POST, $logger);
			
			return $data;
		}

		private function validatePostModel() {
			$errors = array(); 
			
			if (empty($_POST['FirstName'])) {
				$errors['FirstName'] = 'Name is required.';
			}

			if (empty($_POST['LastName'])) {
				$errors['LastName'] = 'Last is required.';
			}
			
			if (empty($_POST['Email'])) {
				$errors['Email'] = 'Email is required.';
			}

			if (empty($_POST['Phone'])){
				$errors['Phone'] = 'Phone is required.';
			}
			
			if (empty($_POST['AccountID'])){
				$errors['AccountID'] = 'Account ID is required.';
			}

			if (empty($_POST['Amount'])) {
				$errors['Amount'] = 'Amount is required.';
			}		
			
			if (empty($_POST['Country'])) {
				$errors['Country'] = 'Country is required.';
			}
			
			if (empty($_POST['BankName'])) {
				$errors['BankName'] = 'Bank is required.';
			}
			
			return $errors;
		}	
		
		private function getModel() {
            /*
            $company = $_POST['Company'];
            $country = $_POST['Country'];
            $bank = $_POST['BankName'];
            */
			$firstname = $_POST['FirstName'] ;
			$lastname = $_POST['LastName'];
			$email = $_POST['Email'];
			$accountId = $_POST['AccountID'];
			$phone = $_POST['Phone'];
			$amount = $_POST['Amount'] * 100;
			$currency = $_POST['Currency'];
			$ingenicoCountryCode = $_POST['CountryCode'];
			$merchantOrderId = (time());
			
			$model = '{
					"order": {
						"amountOfMoney": {
							"currencyCode": "'.$currency.'",
							"amount": "'.$amount.'"
						},
						"customer": {
							"merchantCustomerId": "'.$accountId.'",
							"personalInformation": {
								"name": {
									"title": "Mr.",
									"firstName": "'.$firstname.'",
									"surname": "'.$lastname.'"
								}
							},
							"languageCode": "EN",
							"billingAddress": {
								"street": "",
								"houseNumber": "",
								"additionalInfo": "",
								"zip": "",
								"city": "",
								"state": "",
								"countryCode": "'.$ingenicoCountryCode.'"
							},
							"contactDetails": {
								"emailAddress": "'.$email.'",
								"phoneNumber": "'.$phone.'",
								"emailMessageType": "html"
							}
						},
						"references": {
							"merchantOrderId": "'.$merchantOrderId.'",
							"merchantReference": "TRADE'.$merchantOrderId.'"	
						}
					},
					"bankTransferPaymentMethodSpecificInput": {
						"additionalReference": false,
						"paymentProductId": 11
					}
				}';
				
			return $model;
		}
	}
?>