<?php

class PopularInstrumentsModel {
    public $Name;
    public $TickerName;
    public $Price;
    public $OldPrice;
    public $Buy;
    public $Sell;
    public $PriceChange;
}

$repos = new PopularInstruments();
$repos->Import();

class PopularInstruments
{
    private $brand = "finq";
    public function Import() {
        //$instruments = $this->GetPopularInstruments();
        $instruments = ['eurusd','usdjpy','gbpusd','usdchf','eurgbp','apple','facebook','hp','nike','gazprom','gold','wheat','oil','coffeec','cotton','bitcoin','ethereum','ripple','litecoin','dash','france40','usa500','japan225','uk100','moscow50'];
        foreach ($instruments as $instrument) {
            $data = $this->GetJson($instrument);

            foreach($data as $property => $obj) {
                //$obj = json_decode($obj);
                $model = new PopularInstrumentsModel();

                $model->TickerName = $instrument;
                $model->Buy = $obj->buy;
                $model->Sell = $obj->sell;
                $model->Price = $obj->price;
                $model->Name = $obj->display;

                $this->updateInstrument($model);
            }
        }
    }

    /**
     * @param PopularInstrumentsModel $data
     * @return bool
     */
    private function updateInstrument($data) {
        $connection = $this->getConnection();

        $query = 'UPDATE Instruments set Name = ?, Buy = ?, Sell = ?, Price = ?, Datetime = CURRENT_TIMESTAMP WHERE TickerName = ?';

        $statement = $connection->prepare($query);

        if($statement === false)
        {
            exit("Wrong statement");
            return false;
        }

        $bind = $statement->bind_param("sssss", $data->Name, $data->Buy, $data->Sell, $data->Price, $data->TickerName);

        if($bind === false)
        {
            exit("Bind error");
            return false;
        }

        $statement->execute();

        $statementError = $statement->error;

        if($statementError != "")
        {
            exit($statementError);
            return false;
        }

        $statement->close();
        $connection->close();
        $connection = null;
    }

    public function GetJson($alias) {
        $ch = curl_init();
        $url = $alias = sprintf("https://api-v2.finq.com/quotesv2?key=11&q=%s", $alias);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        $obj = json_decode($result);

        return $obj;
    }

    function GetPopularInstruments() {

        $conn = $this->getConnection();

        $query = "query...";

        $result = $conn->query($query);

        /** @var PopularInstrumentsModel[] $popularInstruments */
        $popularInstruments = [];

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc())
            {
                $instrumentSentiment = new PopularInstrumentsModel($row["Alias"], $row["Alias"], $row["Alias"]);

                $popularInstruments[] = $instrumentSentiment;
            }
        }
        $conn->close();

        return $popularInstruments;
    }

    function getConnection() {
        $dbName = 'LandingPages' ;
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
}