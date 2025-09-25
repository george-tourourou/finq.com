<?php

class PopularInstrumentsModel {
    public $Name;
    public $TickerName;
    public $Price;
    public $OldPrice;
    public $Buy;
    public $Sell;
    public $PriceChange;

    public function __construct($name, $tickerName, $price, $oldPrice, $buy, $sell)
    {
        $this->Name = $name;
        $this->TickerName = $tickerName;
        $this->Price = $price;
        $this->OldPrice = $oldPrice;
        $this->Buy = $buy;
        $this->Sell = $sell;
        //$this->PriceChange = $price - $oldPrice;
        $this->PriceChange = (($price - $oldPrice) / $oldPrice) * 100;
        //$this->PriceChange = 0;
    }
}

class PopularInstruments
{
    function GetPopularInstruments() {

        
        $conn = $this->getConnection();

        $query = "SELECT Name, OldPrice, Price, Sell, Buy, TickerName, Alias AS Category " .
                " FROM Instruments " .
                " INNER JOIN InstrumentsCategory AS IC ON IC.ID = Instruments.CategoryID " ;

        $result = $conn->query($query);

        /** @var PopularInstrumentsModel[] $popularInstruments */
        $popularInstruments = [];

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc())
            {
                $instrumentSentiment = new PopularInstrumentsModel($row["Name"], $row["TickerName"], $row["Price"], $row["OldPrice"], $row["Buy"], $row["Sell"] );
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