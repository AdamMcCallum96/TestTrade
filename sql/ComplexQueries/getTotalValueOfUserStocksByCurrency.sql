use mockstock;
/*currencyOfUserOwned.stockCurrency, sum(totalCurrentValue)*/
SELECT currencies.stockCurrency, sum(totalCurrentValue) FROM
	(SELECT *, boughtPriceTotal as actBoughtPrice, (stockValue * (boughtQuantity - soldQuantity))as totalCurrentValue FROM UserStockTotals
		INNER JOIN STOCK ON UserStockTotals.stockID = Stock.ID
		INNER JOIN(SELECT stockDaily.StockID as testSID, stockDaily.stockValue, stockDaily.stockDate
			FROM stockDaily
			INNER JOIN 
			(SELECT stockDaily.StockID as testSID, max(StockDaily.stockDate) as daysFound 
				FROM StockDaily 
				GROUP BY StockDaily.stockID
				
			) as currentSP
			ON stockDaily.stockDate = currentSP.daysFound
			AND stockDaily.stockID = currentSP.testSID
		) as SDData
		ON UserStockTotals.stockID = SDData.testSID
	 

	WHERE userID = "adammccallum96@gmail.com"
) as Currencies
GROUP BY Currencies.stockCurrency;

SELECT stockID, sum(quantity),sum(price * quantity) FROM userStockBought
WHERE userID = "adammccallum96@gmail.com"
GROUP BY stockID;


/* QUERY BELOW STILL WORKS FOR GOOD REFERENCE*/

SELECT *, sum(boughtPriceTotal) as actBoughtPrice FROM UserStockTotals
	INNER JOIN STOCK ON UserStockTotals.stockID = Stock.ID
    INNER JOIN(SELECT stockDaily.StockID, stockDaily.stockValue, stockDaily.stockDate
		FROM stockDaily
		INNER JOIN 
		(SELECT stockDaily.StockID as testSID, max(StockDaily.stockDate) as daysFound 
			FROM StockDaily 
			GROUP BY StockDaily.StockID
			
		) as currentSP
		ON stockDaily.stockDate = currentSP.daysFound
        AND stockDaily.stockID = currentSP.testSID
    ) as SDData
    ON UserStockTotals.stockID = SDData.stockID
 

WHERE userID = "adammccallum96@gmail.com"
GROUP BY stockCurrency;

SELECT * FROM UserStockTotals
	INNER JOIN STOCK ON UserStockTotals.stockID = Stock.ID
 

WHERE userID = "adammccallum96@gmail.com"
