
CREATE TABLE User (
    email varchar(40) NOT NULL,
    username varchar(20) NOT NULL,
    pass varchar(25) NOT NULL,
    firstName varchar(25) NOT NULL,
    lastName varchar(25) NOT NULL,
    dateOfBirth DATE NOT NULL,

    UNIQUE(email),
    PRIMARY KEY (email)
);



CREATE TABLE Stock (
    ID varchar(60) NOT NULL,
    stockName varchar(60) NOT NULL,
    stockRegion varchar(60) NOT NULL,
    stockMarketOpen time NOT NULL,
    stockMarketClose time NOT NULL,
    stockTimezone varchar(10) NOT NULL,
    stockCurrency varchar(10) NOT NULL,

    PRIMARY KEY (ID)
);

CREATE TABLE Currency (
    currencyCode VARCHAR(3) UNIQUE NOT NULL,
    currencyName VARCHAR(64) NOT NULL,

	PRIMARY KEY (currencyCode)
);

CREATE TABLE UserAccountBalance (
	user_id varchar(40),
    currencyCode varchar(3) NOT NULL,
    balance decimal NOT NULL,
    
    PRIMARY KEY (user_id,currencyCode),
    FOREIGN KEY (user_id) REFERENCES User(email),
	FOREIGN KEY (currencyCode) REFERENCES Currency(currencyCode)


);

CREATE TABLE UserAccountTransaction (
    user_id varchar(40),
    currencyCode varchar(3) NOT NULL,
    transactionType varchar(12) NOT NULL, -- "withdrawl" or "deposit"
    amount decimal NOT NULL

);

CREATE TABLE CurrencyConversion (
    conversionID INT AUTO_INCREMENT,
    user_id varchar(40),
    initialType varchar(3) NOT NULL,
    resultingType varchar(3) NOT NULL,
    initialValue decimal, NOT NULL,
    resultingValue decimal, NOT NULL,
    fee decimal NOT NULL,
    conversionTime timestamp NOT NULL
);

CREATE TABLE UserStockBought (
    stockBoughtID int NOT NULL AUTO_INCREMENT,
    stockID varchar(60) NOT NULL,
    userID varchar(40) NOT NULL,
    price FLOAT NOT NULL,
    quantity INT NOT NULL,
    timeBought TIMESTAMP,
    finalized BIT,
    boughtTime timestamp NOT NULL

    PRIMARY KEY (stockBoughtID, StockID, userID), 
    FOREIGN KEY (stockID) REFERENCES Stock(ID),
    FOREIGN KEY (userID) REFERENCES User(email)


);


CREATE TABLE UserStockSold (
    stockSoldID int NOT NULL AUTO_INCREMENT,
    stockID varchar(60) NOT NULL,
    userID varchar(40) NOT NULL,
    price DECIMAL NOT NULL,
    quantity INT NOT NULL,
    timeSold TIMESTAMP,
    finalized BIT,
    soldTime timestamp NOT NULL,

    PRIMARY KEY (stockSoldID, StockID, userID),    
    FOREIGN KEY (stockID) REFERENCES Stock(ID),
    FOREIGN KEY (userID) REFERENCES User(email)
    
);

CREATE TABLE UserStockTotals (  
    stockID varchar(60) NOT NULL,
    userID varchar(40) NOT NULL,
    boughtPriceAvg FLOAT NOT NULL,
    soldPriceAvg FLOAT NOT NULL,
    boughtPriceTotal FLOAT NOT NULL,
    soldPriceTotal FLOAT NOT NULL,
    boughtQuantity FLOAT NOT NULL,
    soldQuantity FlOAT NOT NULL,
    
    PRIMARY KEY (stockID, userID),
    FOREIGN KEY (stockID) REFERENCES Stock(ID),
    FOREIGN KEY (userID) REFERENCES User(email)

    
);

CREATE TABLE StockOrder (
    stockID varchar(60) NOT NULL,
    userID varchar(50) NOT NULL,
    orderType varchar(3) NOT NULL, 
    quantity int NOT NULL,
    soldTime timestamp NOT NULL,
)

CREATE TABLE UserStock (
    ID INT NOT NULL,
    stockID varchar(60) NOT NULL,
    userID varchar(40) NOT NULL,
    currencyCode varchar(3) NOT NULL,
    quantityBought INT NOT NULL,
    quantitySold INT NOT NULL,
    purchasePrice FLOAT NOT NULL,
    priceTotal FLOAT NOT NULL,
    datePurchased INT NOT NULL,
    finalized INT NOT NULL,
    
    PRIMARY KEY (ID, stockID, userID, currencyCode),
    FOREIGN KEY (stockID) REFERENCES Stock(ID),
    FOREIGN KEY (userID) REFERENCES User(email),
    FOREIGN KEY (currencyCode) REFERENCES UserAccountBalance(currencyCode)
);


CREATE TABLE StockDaily (
    stockID varchar(60) NOT NULL,
    stockDate DATE NOT NULL,
    stockValue FLOAT NOT NULL,

    PRIMARY KEY (stockID, stockDate),
    FOREIGN KEY (stockID) REFERENCES Stock(ID)
);

CREATE TABLE StockRealTime (
    stockID varchar(60) NOT NULL,
    stockTime DATETIME NOT NULL,
    stockValue INT NOT NULL,
    
    PRIMARY KEY (stockID, stockTime)
);

CREATE TABLE StockFavourties (
    stock_id varchar(60) NOT NULL,
    user_id varchar(40),

    PRIMARY KEY (stockID, user_id),
    FOREIGN KEY (stockID) REFERENCES Stock(ID),
    FOREIGN KEY (user_id) REFERENCES User(email)

);











CREATE TABLE StockGraphs (
    user_id INT NOT NULL,
    graphID INT NOT NULL,
    graphName varchar(30) NOT NULL,
    graphType varchar(10) NOT NULL,
    graphCustomTime bit NOT NULL,
    graphStartDate DATE NOT NULL,
    graphEndDate DATE NOT NULL,

    PRIMARY KEY (user_id, graphID),
    FOREIGN KEY (user_id) REFERENCES User(email)
);

--Each graph has multiple tickers
CREATE TABLE StockGraphsTickers (
    user_id INT NOT NULL,
	graph_id INT NOT NULL,
    stock_id varchar(60) NOT NULL,
    
	PRIMARY KEY (user_id, stock_id, graph_id),
    FOREIGN KEY (user_id, graph_id) REFERENCES StockGraphs(user_id, graphID),
    FOREIGN KEY (stock_id) REFERENCES Stock(ID)
);

CREATE TABLE QuickGraphHistory (
    history_id INT NOT NULL AUTO_INCREMENT,
    user_id varchar(40) NOT NULL,
    historyText varchar(128) NOT NULL,

    PRIMARY KEY (history_id, user_id),
    FOREIGN KEY (user_id) REFERENCES User(email)
    
);



INSERT INTO Currency (currencyCode, currencyName) VALUES ('AED', 'United Arab Emirates Dirham');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('AFN', 'Afghan Afghani');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('ALL', 'Albanian Lek');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('AMD', 'Armenian Dram');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('ANG', 'Netherlands Antillean Guilder');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('AOA', 'Angolan Kwanza');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('ARS', 'Argentine Peso');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('AUD', 'Australian Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('AWG', 'Aruban Florin');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('AZN', 'Azerbaijani Manat');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('BAM', 'Bosnia-Herzegovina Convertible Mark');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('BBD', 'Barbadian Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('BDT', 'Bangladeshi Taka');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('BGN', 'Bulgarian Lev');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('BHD', 'Bahraini Dinar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('BIF', 'Burundian Franc');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('BMD', 'Bermudan Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('BND', 'Brunei Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('BOB', 'Bolivian Boliviano');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('BRL', 'Brazilian Real');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('BSD', 'Bahamian Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('BTN', 'Bhutanese Ngultrum');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('BWP', 'Botswanan Pula');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('BZD', 'Belize Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('CAD', 'Canadian Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('CDF', 'Congolese Franc');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('CHF', 'Swiss Franc');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('CLF', 'Chilean Unit of Account UF');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('CLP', 'Chilean Peso');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('CNH', 'Chinese Yuan Offshore');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('CNY', 'Chinese Yuan');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('COP', 'Colombian Peso');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('CUP', 'Cuban Peso');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('CVE', 'Cape Verdean Escudo');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('CZK', 'Czech Republic Koruna');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('DJF', 'Djiboutian Franc');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('DKK', 'Danish Krone');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('DOP', 'Dominican Peso');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('DZD', 'Algerian Dinar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('EGP', 'Egyptian Pound');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('ERN', 'Eritrean Nakfa');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('ETB', 'Ethiopian Birr');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('EUR', 'Euro');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('FJD', 'Fijian Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('FKP', 'Falkland Islands Pound');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('GBP', 'British Pound Sterling');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('GEL', 'Georgian Lari');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('GHS', 'Ghanaian Cedi');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('GIP', 'Gibraltar Pound');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('GMD', 'Gambian Dalasi');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('GNF', 'Guinean Franc');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('GTQ', 'Guatemalan Quetzal');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('GYD', 'Guyanaese Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('HKD', 'Hong Kong Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('HNL', 'Honduran Lempira');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('HRK', 'Croatian Kuna');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('HTG', 'Haitian Gourde');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('HUF', 'Hungarian Forint');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('ICP', 'Internet Computer');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('IDR', 'Indonesian Rupiah');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('ILS', 'Israeli New Sheqel');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('INR', 'Indian Rupee');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('IQD', 'Iraqi Dinar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('IRR', 'Iranian Rial');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('ISK', 'Icelandic Krona');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('JEP', 'Jersey Pound');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('JMD', 'Jamaican Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('JOD', 'Jordanian Dinar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('JPY', 'Japanese Yen');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('KES', 'Kenyan Shilling');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('KGS', 'Kyrgystani Som');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('KHR', 'Cambodian Riel');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('KMF', 'Comorian Franc');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('KPW', 'North Korean Won');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('KRW', 'South Korean Won');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('KWD', 'Kuwaiti Dinar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('KYD', 'Cayman Islands Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('KZT', 'Kazakhstani Tenge');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('LAK', 'Laotian Kip');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('LBP', 'Lebanese Pound');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('LKR', 'Sri Lankan Rupee');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('LRD', 'Liberian Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('LSL', 'Lesotho Loti');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('LYD', 'Libyan Dinar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('MAD', 'Moroccan Dirham');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('MDL', 'Moldovan Leu');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('MGA', 'Malagasy Ariary');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('MKD', 'Macedonian Denar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('MMK', 'Myanma Kyat');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('MNT', 'Mongolian Tugrik');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('MOP', 'Macanese Pataca');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('MRO', 'Mauritanian Ouguiya (pre-2018)');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('MRU', 'Mauritanian Ouguiya');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('MUR', 'Mauritian Rupee');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('MVR', 'Maldivian Rufiyaa');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('MWK', 'Malawian Kwacha');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('MXN', 'Mexican Peso');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('MYR', 'Malaysian Ringgit');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('MZN', 'Mozambican Metical');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('NAD', 'Namibian Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('NGN', 'Nigerian Naira');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('NOK', 'Norwegian Krone');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('NPR', 'Nepalese Rupee');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('NZD', 'New Zealand Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('OMR', 'Omani Rial');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('PAB', 'Panamanian Balboa');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('PEN', 'Peruvian Nuevo Sol');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('PGK', 'Papua New Guinean Kina');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('PHP', 'Philippine Peso');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('PKR', 'Pakistani Rupee');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('PLN', 'Polish Zloty');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('PYG', 'Paraguayan Guarani');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('QAR', 'Qatari Rial');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('RON', 'Romanian Leu');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('RSD', 'Serbian Dinar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('RUB', 'Russian Ruble');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('RUR', 'Old Russian Ruble');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('RWF', 'Rwandan Franc');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('SAR', 'Saudi Riyal');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('SBDf', 'Solomon Islands Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('SCR', 'Seychellois Rupee');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('SDG', 'Sudanese Pound');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('SDR', 'Special Drawing Rights');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('SEK', 'Swedish Krona');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('SGD', 'Singapore Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('SHP', 'Saint Helena Pound');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('SLL', 'Sierra Leonean Leone');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('SOS', 'Somali Shilling');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('SRD', 'Surinamese Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('SYP', 'Syrian Pound');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('SZL', 'Swazi Lilangeni');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('THB', 'Thai Baht');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('TJS', 'Tajikistani Somoni');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('TMT', 'Turkmenistani Manat');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('TND', 'Tunisian Dinar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('TOP', 'Tongan Paanga');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('TRY', 'Turkish Lira');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('TTD', 'Trinidad and Tobago Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('TWD', 'New Taiwan Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('TZS', 'Tanzanian Shilling');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('UAH', 'Ukrainian Hryvnia');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('UGX', 'Ugandan Shilling');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('USD', 'United States Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('UYU', 'Uruguayan Peso');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('UZS', 'Uzbekistan Som');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('VND', 'Vietnamese Dong');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('VUV', 'Vanuatu Vatu');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('WST', 'Samoan Tala');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('XAF', 'CFA Franc BEAC');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('XCD', 'East Caribbean Dollar');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('XDR', 'Special Drawing Rights');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('XOF', 'CFA Franc BCEAO');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('XPF', 'CFP Franc');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('YER', 'Yemeni Rial');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('ZAR', 'South African Rand');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('ZMW', 'Zambian Kwacha');
INSERT INTO Currency (currencyCode, currencyName) VALUES ('ZWL', 'Zimbabwean Dollar');
