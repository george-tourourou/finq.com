<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/wire/Configuration/Configuration.php";

    class RecordsRepository {
        /**
         * @return mysqli
         */
        function getConnection() {
            $dbName = 'Ingeniko' ;
            $dbHost = '343ceac831677d3fdb2676ca6fd4913ba6e030d8.rackspaceclouddb.com' ;
            $dbUsername = 'partners';
            $dbUserPassword = 'Yee9piey7phu';

            $conn = new mysqli($dbHost, $dbUsername, $dbUserPassword, $dbName);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            return $conn;
        }

        /**
         * @param $IP
         * @param $Form
         * @param $Response
         */
        function insertRecord($IP, $Form, $Response) {
            $appConfiguration = new AppConfiguration();

            $sql = "INSERT INTO Records (IP, BRAND, Form, Response) values(?, ?, ?, ?)";

            $connection = $this->getConnection();
            $brandID = $appConfiguration->getBrandID();

            $statement = $connection->prepare($sql);
            $statement->bind_param('ssss', $IP, $brandID, $Form, $Response);

            $results = $statement->execute();

            $connection->close();
        }

        /**
         * @param $Form
         * @param $Response
         */
        function Insert($Form, $Response) {
            $Form = json_encode($Form);
            $Response = json_encode($Response);
            $IP = $_SERVER['REMOTE_ADDR'];

            $this->insertRecord($IP, $Form, $Response);
        }
    }

    class BankRepository {
        /**
         * @return mysqli
         */
        private function getConnection() {
            $dbName = 'WireTransfer' ;
            $dbHost = 'd49c87a7aca54a17b10e27ed18e297523dff82f9.rackspaceclouddb.com' ;
            $dbUsername = 'dev-user';
            $dbUserPassword = 'Yee9piey7phu';

            $conn = new mysqli($dbHost, $dbUsername, $dbUserPassword, $dbName);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            return $conn;
        }

        /**
         * @param $BankAccountID
         * @return array
         */
        public function GetBankDetails($BankAccountID) {

            $BankAccountID = intval($BankAccountID);

            $sql  = " SELECT Companies.Name AS CompanyName, Banks.Name AS BankName, Currencies.Name AS Currency, Banks.Swift, Banks.Address, BankAccounts.Account, BankAccounts.IBAN, Countries.Name AS CountryName ";
            $sql .= " FROM BankAccounts AS BankAccounts ";
            $sql .= " JOIN Banks AS Banks ON Banks.ID = BankAccounts.BankID ";
            $sql .= " JOIN Countries AS Countries ON Countries.ID = Banks.CountryID ";
            $sql .= " JOIN Currencies AS Currencies ON Currencies.ID = BankAccounts.CurrencyID ";
            $sql .= " JOIN Companies AS Companies ON Companies.ID = BankAccounts.CompanyID ";
            $sql .= " WHERE BankAccounts.id = ?";


            $connection = $this->getConnection();

            $statement = $connection->prepare($sql);
            $statement->bind_param('i', $BankAccountID);

            $statement->execute();

            $result = $statement->get_result();

            $data = array();

            while($row =  $result->fetch_assoc())
            {
                $data[] = new WireTransferKeyValue("Beneficiary", $row['CompanyName']);
                $data[] = new WireTransferKeyValue("Bank name", $row['BankName']);
                $data[] = new WireTransferKeyValue("Address", $row['Address']);
                $data[] = new WireTransferKeyValue("Country", $row['CountryName']);
                $data[] = new WireTransferKeyValue("Account", $row['Account']);
                $data[] = new WireTransferKeyValue("Currency", $row['Currency']);
                $data[] = new WireTransferKeyValue("IBAN", $row['IBAN']);
                $data[] = new WireTransferKeyValue("Swift", $row['Swift']);

            }

            $connection->close();

            return $data;
        }

        /**
         * @return BankAccount[]
         */
        public function GetBankAccounts()
        {
            $appConfiguration = new AppConfiguration();
            $companyID = $appConfiguration->GetWireTransferBrandID();

            $query  = ' SELECT BankAccountID, Companies.Abbreviation AS CompanyName, Countries.Abbreviation AS CountryCode, Banks.Name AS BankName, BankTypes.Name as BankTypeName, UNIONTABLE.BankTypeID, PrimaryCountry.Name as PrimaryCountryName, Countries.Name AS CountryName, Countries.Abbreviation AS CountryCode, Currencies.Name AS CurrencyName ';
            $query .= ' FROM (';
                $query .= '	SELECT BA.ID AS BankAccountID, Banks.CountryID AS CountryID, 0 as BankTypeID';
                $query .= '	FROM BankAccounts AS BA';
                $query .= '	JOIN Banks AS Banks ON Banks.ID = BA.BankID';
                $query .= '	UNION ';
                $query .= '	SELECT CBA.BankAccountID AS BankAccountID, CBA.CountryID AS CountryID, 2 as BankTypeID';
                $query .= '	FROM CountryBankAccounts AS CBA';
                $query .= '	UNION ';
                $query .= '	SELECT DBA.BankAccountID AS BankAccountID, Banks.CountryID AS CountryID, 1 as BankTypeID';
                $query .= '	FROM DefaultBankAccounts AS DBA';
                $query .= '	JOIN BankAccounts ON BankAccounts.ID = BankAccountID';
                $query .= '	JOIN Banks ON Banks.ID = BankAccounts.BankID';
            $query .= ' ) AS UNIONTABLE';
            $query .= ' JOIN BankAccounts ON BankAccounts.ID = BankAccountID';
            $query .= ' JOIN Banks ON Banks.ID = BankAccounts.BankID';
            $query .= ' JOIN Countries ON Countries.ID = UNIONTABLE.CountryID';
            $query .= ' JOIN Countries as PrimaryCountry ON PrimaryCountry.ID = Banks.CountryID';
            $query .= ' JOIN Currencies ON Currencies.ID = BankAccounts.CurrencyID';
            $query .= ' JOIN Companies on Companies.ID = BankAccounts.CompanyID';
            $query .= ' JOIN BankTypes on BankTypes.ID = Banks.BankTypeID';
            $query .= ' WHERE BankAccounts.CompanyID in (?, 3) AND Banks.Status = 1 AND BankAccounts.Status = 1';
            $query .= ' ORDER BY BankAccounts.CompanyID, UNIONTABLE.BankTypeID, Banks.BankTypeID, UNIONTABLE.CountryID';

            $connection = $this->getConnection();

            $statement = $connection->prepare($query);
            $statement->bind_param('i', $companyID);

            $statement->execute();

            $result = $statement->get_result();

            $data = array();

            while($row =  $result->fetch_assoc())
            {
                $object = new BankAccount();

                $object->BankAccountID = $row['BankAccountID'];
                $object->BankName = $row['BankName'];
                $object->BankTypeName = $row['BankTypeName'];
                $object->PrimaryCountryName = $row['PrimaryCountryName'];
                $object->CountryName = $row['CountryName'];
                $object->CurrencyName = $row['CurrencyName'];
                $object->CompanyName = $row['CompanyName'];
                $object->CountryCode = $row['CountryCode'];
                $object->BankTypeID = $row['BankTypeID'];

                $data[] = $object;
            }

            $connection->close();

            return  $data;
        }

        /**
         * @return CurrencyMinMaxDeposits[]
         */
        public function GetCurrencies()
        {
            $query = "SELECT Name, MinimumDeposit, MaximumDeposit FROM Currencies";

            $connection = $this->getConnection();

            $statement = $connection->prepare($query);

            $statement->execute();

            $result = $statement->get_result();

            $data = array();

            while($row =  $result->fetch_assoc())
            {
                $object = new CurrencyMinMaxDeposits();

                $object->Name = $row['Name'];
                $object->MinimumDeposit = $row['MinimumDeposit'];
                $object->MaximumDeposit = $row['MaximumDeposit'];

                $data[] = $object;
            }

            $connection->close();

            return  $data;
        }

        /**
         * @return string[]
         */
        public function GetCountries()
        {
            $appConfiguration = new AppConfiguration();
            $companyID = $appConfiguration->GetWireTransferBrandID();

            $query  = " SELECT Name ";
            $query .= " FROM CompanyCountries ";
            $query .= " JOIN Countries on Countries.ID = CompanyCountries.CountryID ";
            $query .= " WHERE CompanyID in (?, 3) ";

            $connection = $this->getConnection();

            $statement = $connection->prepare($query);
            $statement->bind_param('i', $companyID);

            $statement->execute();

            $result = $statement->get_result();

            $data = array();

            while($row =  $result->fetch_assoc())
            {
                $data[] = $row['Name'];
            }

            $connection->close();

            return  $data;
        }

        public function StoreRequest($IsIngenikoRequest, $BankAccountID, $ClientCountryCode, $Amount, $Form, $Response)
        {
            $appConfiguration = new AppConfiguration();

            $BrandID = $appConfiguration->GetBrandID();
            $Form = json_encode($Form);
            $Response = json_encode($Response);
            $IP = $_SERVER['REMOTE_ADDR'];

            $sql = "INSERT INTO Requests (BrandID, IsIngenikoRequest, BankAccountID, Amount, IP, ClientCountryCode, Form, Response) values(?, ?, ?, ?, ?, ?, ?, ?)";

            $connection = $this->getConnection();

            $statement = $connection->prepare($sql);
            $statement->bind_param('iiiissss', $BrandID, $IsIngenikoRequest, $BankAccountID, $Amount, $IP, $ClientCountryCode, $Form, $Response);

            $statement->execute();

            $connection->close();
        }
    }



?>