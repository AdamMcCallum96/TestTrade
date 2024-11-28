class MultiGraph {

    // The total bounds of the canvas
    //Type of graph "numeric or percentiles";
    type;
    graphPartitions = [20, 252/2,252, 5*252]

    status;
    canvasHeight;
    canvasWidth;
    possibleIncrements = [];
    validIncrements = [];
    validGraphBottom = [];
    validGraphMax = [];
    minimumPercentChange = [];
    bestElement;
    difference;
    xPoints = []
    yPoints = []
    
    xLabels = []
    xLabelsPoints = []

    pointsElements = []
    oneMonthElements = [];
    sixMonthsElements = [];
    oneYearElements = [];
    fiveYearsElements = []

    finalBestElement = [];
    finalMaxData = [];
    finalMinData = [];
    finalDifference = [];
    finalGraphBottom = [];
    finalGraphMax = [];
    finalIncrement = [];
    finalXPoints = [];
    finalYPoints = [];

    
    //It contains the elements related for X/Y points for different filter configurations IE:
    /*
    points Elements = [ Different graph categories
        [ Filtered#Days elements[monthly][6months][1year][5years]]
        [[][][]]
    ]


    */

    
    //The width of the canvas after offsets
    

    // graphXLineStart = heightOffset
    // graphYLineStart = widthOffset

    constructor(canvasHeight, canvasWidth, heightOffset, widthOffset, XData, YData, topOffset, rightOffset, canvasID, type){

        this.widthOffset = widthOffset;
        this.heightOffset = heightOffset;
        this.canvasHeight = canvasHeight;
        this.canvasWidth = canvasWidth;
        this.graphHeight = canvasHeight - heightOffset - topOffset
        this.graphWidth = canvasWidth - widthOffset - rightOffset
        this.graphXLineStart = heightOffset
        this.graphYLineStart = widthOffset
        this.XData = XData
        this.YData = YData
        this.topOffset = topOffset
        this.rightOffset = rightOffset
        this.canvasID = canvasID
        this.type = type
        

    }


    getGraphPoints(){

        if(this.status == "numeric graph"){
            result = this.numeric()
        } else if (this.status == "percentage graph") {
            result = this.percentage()
        }

        // console.log("SET GRAPH POINTS CALLED");
        
    }

    init() {
        
        this.testData = 0;
        // if(this.type == "percentile"){
        //     for(var u = 0; u < this.YData.length; u++){

        //         var oneStockLineData = this.YData[u];
        //         var startingStockValue = oneStockLineData[0];
        //         for(var k = 0; k < oneStockLineData.length; k++){
        //             oneStockLineData[k] = oneStockLineData[k] / startingStockValue;
        //         }
                
        //         this.YData[u] = oneStockLineData
        //     }
        // }
        

        console.log("YDATA");
        console.log(this.YData);
        var tempNumOfPoints = [];
        for(var i = 0; i < this.YData.length; i++){
            var singleStockArray = this.YData[i];

            tempNumOfPoints.push(singleStockArray.length);
        }

        var numberOfPointsToGraph = Math.max(...tempNumOfPoints);
        this.graphPartitions.push(numberOfPointsToGraph);

        // console.log("PARITION NUMBER ON INIT");
        // console.log(this.graphPartitions.length);
        for(let z = 0; z < this.graphPartitions.length; z++){
            this.testData += 1;
            var partition = this.graphPartitions[z]
            // console.log("PARITION CURRENT NUM: "+ partition);
            // console.log("Z CURRENT "+ z);
            // console.log("NUMBER TO GET TO CURRENT" +this.graphPartitions.length);

            //Y DATA / X DATA
            var XD = [];
            var YD = [];
            // console.log(this.XData);
            // console.log()
            for(let x = 0; x < this.XData.length; x++){

                this.getGraphPoints()
                // console.log("working lol");
                XD.push(this.XData[x].slice(-partition));
                YD.push(this.YData[x].slice(-partition));
                // console.log(this.XData[x]);
            }
            
            // console.log("TIMES RAN: "+ z);
            this.numeric(XD,YD);
            
        }
        // console.log("ANOTHER PARTITION");
        // console.log(this.graphPartitions.length);
        for(let z = 0; z < this.graphPartitions.length; z++){
            
            var partition = this.graphPartitions[z]
            // console.log("PARITION CURRENT NUM: "+ partition);
            // console.log("Z CURRENT "+ z);
            // console.log("NUMBER TO GET TO CURRENT" +this.graphPartitions.length);

            //Y DATA / X DATA
            var XD = [];
            var YD = [];
            // console.log(this.XData);
            // console.log()
            for(let x = 0; x < this.XData.length; x++){

                this.getGraphPoints()
                // console.log("working lol");
                XD.push(this.XData[x].slice(-partition));
                YD.push(this.YData[x].slice(-partition));
                // console.log(this.XData[x]);
            }
            
            // console.log("TIMES RAN: "+ z);
            this.loadTimeFilterData(XD,YD, z);
            
        }
    }

    numeric(x,y){
        //Y is an array of arrays of data
        // console.log("Y DATA PUT INTO NUMERIC")
        // console.log(y);

        //Find the max/min of all the numbers

        // console.log("NUMERICS: /n")
        // console.log(x)
        // console.log(this.XData);
        // console.log(y)
        // console.log(this.YData);
       
        if(this.type == "numeric"){
            var maxData = Math.max(...y.flat());
            var minData = Math.min(...y.flat());

            this.finalMaxData.push(maxData);
            this.finalMinData.push(minData);
            var difference = maxData - minData;
            this.difference = maxData - minData;
            this.finalDifference.push(difference);
        } else {
            
            for(let m = 0; m < y.length; m++){
                var stockData = y[m];
                
                var startingStockValue = stockData[0];
                for(var l = 0; l < stockData.length; l++){

                    stockData[l] = stockData[l] / startingStockValue;
                }


                y[m] = stockData;
                
                var max = Math.max(...stockData);

                var min = Math.min(...stockData);

                // max = max / stockData[0];
                // min = min / stockData[0];

                var maxData = max;
                var minData = min;

                this.finalMaxData.push(max);
                this.finalMinData.push(min)
                //We assume the min data is always 0 for graphing purposes
                var difference = maxData;
                this.difference = maxData;
                this.finalDifference.push(difference);

                


            }
        }

        // console.log("DATA GIVEN");
        // console.log(y);
        // var maxData = Math.max(...y.flat());
        // var minData = Math.min(...y.flat());

        // this.finalMaxData.push(maxData);
        // this.finalMinData.push(minData);
        // var difference = maxData - minData;
        // this.difference = maxData - minData;

     
        // this.finalDifference.push(difference);

        // console.log(this.YData);
        // console.log("Max Data: "+ maxData);
        // console.log("Min Data: "+ minData);
        // console.log("Difference: "+ difference);



        //Generate stock numbers 0.0001, 0.0002, 0.0005, 0.001 and etc

        let lowestPossibleStockValue = 0.0001;
        var graphIncrements = new Array();
        while(lowestPossibleStockValue <= 10000000000){
            graphIncrements.push(lowestPossibleStockValue);
            graphIncrements.push(lowestPossibleStockValue * 2);
            graphIncrements.push(lowestPossibleStockValue * 5);
            lowestPossibleStockValue = lowestPossibleStockValue * 10;
        }
        console.log(graphIncrements);
        for(let pointsOnGraph = 3; pointsOnGraph <= 6; pointsOnGraph++){
            //To get Y distance between two points you divide by one less than the number of points on the graph you want
            //Example: 100 Max for y / 2 = 50. y0, y50, y100
            var answer = difference/(pointsOnGraph-1);
            // console.log(pointsOnGraph +" Y points maxdata: "+ maxData+"/"+(pointsOnGraph-1)+" = "+answer + " (space between points on Y axis");

        }
        // console.log("");
        let tests = 0;
        for(var pointsOnGraph = 3; pointsOnGraph <= 6; pointsOnGraph++){

            var answer = difference/(pointsOnGraph-1);
            // console.log(answer);
           // console.log(i +" Y points incrementNumb: "+ maxData+"/"+(i-1)+" = "+answer + " (space between points on Y axis");
            var greaterNumberFound = false;
            let x = 0;
            var numFound = 0;
            while(greaterNumberFound == false){
                
                //Finding the next number bigger than or equal to
                //the tested graph increments (distance between points)
               if(graphIncrements[x] >= answer){
                    numFound = graphIncrements[x];
                    greaterNumberFound = true;
            
               }
                x++;
                
            }
            // console.log(pointsOnGraph +" Y points increment: "+ numFound + " Floor minData: "+minData +"FloorAct: "+ (Math.floor((minData/numFound))));

            this.possibleIncrements[tests] = numFound

            
            
            this.validGraphBottom[tests] = numFound * Math.floor((minData/numFound));

            if(this.type == "percentile"){
                this.validGraphBottom[tests] = 0;
            }

            //Valid graph bottoms + total incremented data should be >= maxdata
           
            var testedMax = this.validGraphBottom[tests] + (this.possibleIncrements[tests] * (pointsOnGraph-1));
            
            // console.log("");
            // console.log("Tested Maxes: "+ testedMax);
            // console.log("Tested Min:" + this.validGraphBottom[tests]);
            // console.log("this.possibleIncrements[tests]: "+this.possibleIncrements[tests]);
            // console.log("Points on graph -1: "+ (pointsOnGraph-1));
            if(testedMax >= maxData){
                this.validIncrements[tests] = this.possibleIncrements[tests];
                this.validGraphMax[tests] = testedMax;
            
            } else {
                this.validGraphMax[tests] = undefined;
                this.validIncrements[tests] = undefined;
                this.validGraphBottom[tests] = undefined;
                
                //The increment does not meet the threshold to clear the max data of the graph and therefor the next increment should be sufficient
                
            }

            //Testing percentiles outside of min and max data to get the closest match
            
            var testPercent = 0;
            var divideByZero = minData - this.validGraphBottom[tests]
            if(divideByZero != 0){
                testPercent += (minData - this.validGraphBottom[tests]) / difference 
            } else {
                testPercent += 0;
            }
           
            divideByZero = this.validGraphMax[tests] - maxData;
            if(divideByZero != 0){
                testPercent += (this.validGraphMax[tests] - maxData) / difference 
            } else {
                testPercent += 0;
            }
        

            // testPercent += (this.validGraphMax[tests] / maxData)- 1;
            //minData is bigger than graph bottom
            // testPercent += (minData / this.validGraphBottom[tests]) - 1;
            // console.log("test  Percent: "+ testPercent);

            if(this.validGraphMax[tests] == undefined){
                this.minimumPercentChange[tests] = undefined;
            } else {
                this.minimumPercentChange[tests] = testPercent; 
            }
            
            tests+= 1;
        }

        
        //Find the lowest percent change between the data min/max and the graph bounds min/max
        //Set percent change to something impossible
        var currentPercentChange = 0;
        var hasStarted = false;
        // console.log(this.minimumPercentChange);
        // console.log("Perc change length" + (this.minimumPercentChange.length - 1));
        
       for(let i = 0; i <= this.minimumPercentChange.length - 1; i++){
            
            if(hasStarted == false){
                
                if(this.minimumPercentChange[i] != undefined){
                    hasStarted = true;
                    currentPercentChange = this.minimumPercentChange[i];
                    this.bestElement = i;
                }
                
                // console.log("Current %Ch: "+currentPercentChange);
                
                // this.finalBestElement.push(this.bestElement);
                // this.finalGraphBottom.push(this.validGraphBottom[this.bestElement]);
            } else {
                // console.log("Current Percent: "+ currentPercentChange + "> Minimum percent: "+ this.minimumPercentChange[i]);
                // console.log(currentPercentChange < this.minimumPercentChange[i]);
                if(currentPercentChange > this.minimumPercentChange[i]){
                    currentPercentChange = this.minimumPercentChange[i];
                    this.bestElement = i;
                    // this.finalBestElement.push(this.bestElement);
                    // this.finalGraphBottom.push(this.validGraphBottom[this.bestElement]);
                }
            }

            
            // console.log("Percentage Changes: "+ currentPercentChange);
          
        }
                // console.log("VALIDS");
                // console.log(this.validGraphBottom);
                // console.log(this.validGraphMax);
                // console.log("BEST ELEMENT: "+ this.bestElement);
                //console.log("MINIMUM PERC CHANGE LGTH: "+ this.minimumPercentChange.length);
                this.finalBestElement.push(this.bestElement);
                this.finalGraphBottom.push(this.validGraphBottom[this.bestElement]);
                this.finalGraphMax.push(this.validGraphMax[this.bestElement]);
                this.finalIncrement.push(this.validIncrements[this.bestElement]);


       

        //Find the floor
        //Test the floor

        
        
        

        //Theory
        //130 MaxData
        //1 MinData

        //Testing
        
        //6 Y points
        //5 Y points
        //4 Y points
        //3 Y points 130/2 = 65 ->lowest space between points
        
        //Our graph scale is based on increments of base 1,2,5
        //Finding our possible number
        //For math purposes the lowest possible stock price is 0.0001
        //We will pregenerate these numbers

        //         Bottom 1.23

        // Increment 50


        // Bottom/Increment


        // Convert to the floor number

        //65

        // tscale = 0.000001
        // dividers = [3,4,5]
        // while(tscale < tdif/dividers[2]){
        //     tscale = tscale * 10;
        // }
    }



    percentage(){

    }

    graph(element){

        var g = document.getElementById(element);
        var canvas = g.getContext('2d');
        // canvas.globalAlpha = 0.5;
        canvas.overflow = "visible";

        // console.log(document.getElementById(element));
        // console.log("DATA LENGTH"+this.YData.length);
    
        // console.log(this.YData);

        var graphDif = this.validGraphMax[this.bestElement] - this.validGraphBottom[this.bestElement];
        for(var i = 0; i <= this.YData.length - 1; i++){
            canvas.beginPath();
            var graphCategory = this.YData[i];
            canvas.moveTo(this.graphXLineStart,this.yconversion(this.graphYLineStart));
            
            canvas.strokeStyle = `rgba(
                ${Math.floor(Math.random() * 255)}
                ${Math.floor(Math.random() * 255)}
                ${Math.floor(Math.random() * 255)})`;
            
            for(var x = 0; x <= graphCategory.length - 1; x++){

                //var xPoint this.graphXLineStart +
                var monetaryValue = graphCategory[x] - this.validGraphBottom[this.bestElement];

                var ypixels = ((monetaryValue / graphDif) * (this.graphHeight)) + this.graphYLineStart;

                var xpixels = 0;
                //var yPoint = this.graphYLineStart + (graphCategory[i] / this.val
                if(x != 0) {
                    xpixels = (x/graphCategory.length)* (this.graphWidth) + this.graphXLineStart
                } else {
                    xpixels = 0 + this.graphXLineStart;
                }
                
                // console.log(ypixels);
                canvas.lineTo(xpixels,this.yconversion(ypixels));
            }
            canvas.lineCap = "round";
            canvas.lineWidth = 2;
            canvas.stroke();
        }

        //Graph the increment/scale

        let incrementTotal = this.validGraphBottom[this.bestElement];
        while(incrementTotal <= this.validGraphMax[this.bestElement]){
            console.log("Is working");
            var pixelValue = ((incrementTotal / graphDif) * this.graphHeight) + this.graphYLineStart;
            console.log(pixelValue);
            console.log(incrementTotal);
            canvas.font= "15px serif";
            canvas.textAlign = "right";
            canvas.fillText(incrementTotal,this.graphXLineStart,this.yconversion(pixelValue));
            // canvas.fillText("100",this.graphXLineStart,100);
            // canvas.fillText("100",50,50);
            // console.log(this.conversion(pixelValue));
            incrementTotal += this.validIncrements[this.bestElement];

        }

        //make rectangle on top and right edge
        // canvas.fillStyle = "blue";

        // canvas.fillRect(0,0,this.canvasWidth,this.this.topOffset);
        // canvas.fillRect(this.graphWidth,0,this.canvasWidth,this.canvasHeight);

        


    }

    timeplot(timeSeriesArray){
        for(let i = 0; i < timeSeriesArray; i++){

        }
    }

    timeFilter(buttonID){

        switch(buttonID){
            case 'oneMonth':
                this.ggraph(this.pointsElements[0],0);
                break;
            case 'sixMonths':
                this.ggraph(this.pointsElements[1],1);
                break;
            case 'oneYear':
                this.ggraph(this.pointsElements[2],2);
                break;
            case 'fiveYears':
                this.ggraph(this.pointsElements[3],3);
                break;
            case 'max':
                this.ggraph(this.pointsElements[4],4);
                break;

                //max

        }
    }

    ggraph(stockArrayElements, thisIncrement){

        console.log("ACTUAL GRAPH DATA FEED");
        console.log(this.finalYPoints[thisIncrement])
        console.log("Graph Feed");
        console.log(stockArrayElements);
        console.log("G BOTTOMS");
        console.log(this.finalGraphBottom);
        console.log("POINTS ELEMENTS")
        console.log(this.pointsElements);
        console.log("STOCK ARRAY");
        console.log(stockArrayElements);
        console.log(this.finalYPoints);
        var canvas = this.canvasID.getContext('2d')
        canvas.reset();
        canvas.beginPath();
        // canvas.moveTo(0,0);
        // canvas.lineTo(100,300);
        console.log("ggraph it working");
        var numberOfPointsToGraph;
        var tempNumOfPoints = [];
        console.log(stockArrayElements);
        for(var i = 0; i < stockArrayElements.length; i++){
            var singleStockArray = stockArrayElements[i];

            tempNumOfPoints.push(singleStockArray.length);
        }

        numberOfPointsToGraph = Math.max(...tempNumOfPoints);
        
        console.log("Points to graph: "+numberOfPointsToGraph);
        
        console.log(numberOfPointsToGraph);
        console.log(stockArrayElements.length);
        console.log("ALL GRAPH DATA")
        console.log(this.finalYPoints);
        
        for (var x = 0; x < stockArrayElements.length; x++){
            canvas.beginPath();
            canvas.moveTo(this.graphXLineStart,this.yconversion(this.finalYPoints[thisIncrement][x][0]))

            canvas.strokeStyle = `rgba(
                ${Math.floor(Math.random() * 255)}
                ${Math.floor(Math.random() * 255)}
                ${Math.floor(Math.random() * 255)})`;
            

            console.log("MOVE TO:"+ this.graphXLineStart + ": "+ this.finalYPoints[x][numberOfPointsToGraph[0]]);
            var currentStock = stockArrayElements[x];
            for(var i = 0; i < numberOfPointsToGraph; i++){
               
                // var yPixel = this.yPoints[x][currentStock[i]];
                var yPixel = this.finalYPoints[thisIncrement][x][i];
                // console.log(x+" "+ yPixel);

                var xPixel = 0;

                if(i != 0) {
                    xPixel = (i/numberOfPointsToGraph)* (this.graphWidth) + this.graphXLineStart
                } else {
                    xPixel = 0 + this.graphXLineStart;

                }
                canvas.lineTo(xPixel, this.yconversion(yPixel));
                console.log("Line: "+x+" X Point: "+xPixel+" Y Point: "+yPixel);
               
            }
            canvas.stroke();
            
        }

        //Graph Axis
        let incrementTotal = this.finalGraphBottom[thisIncrement];

        console.log("INCREMENT START X AXIS");
        console.log(this.finalGraphBottom);
        console.log(this.type);
        
        var graphDif = this.finalGraphMax[thisIncrement] - this.finalGraphBottom[thisIncrement];
        var incrementTravelled = 0;
        while(incrementTotal <= this.finalGraphMax[thisIncrement]){
            console.log("incr: "+ incrementTotal + "/"+graphDif + "gdif");
            // var pixelValue = ((incrementTotal / graphDif) * this.graphHeight) + this.graphYLineStart;
            var pixelValue = ((incrementTravelled / graphDif) * this.graphHeight) + this.graphYLineStart;

            incrementTravelled += this.finalIncrement[thisIncrement];
            
            console.log(pixelValue);
            console.log(incrementTotal);
            canvas.font= "15px serif";
            canvas.textAlign = "right";
            if(this.type == "percentile"){
                canvas.fillText(incrementTotal * 100+ "%",this.graphXLineStart - 10,this.yconversion(pixelValue));
            } else {
                console.log("INCREMENT X AXIS: " + incrementTotal );
                canvas.fillText(incrementTotal,this.graphXLineStart - 10,this.yconversion(pixelValue));
            }
            // canvas.fillText(incrementTotal,this.graphXLineStart,this.yconversion(pixelValue));
            // canvas.fillText("100",this.graphXLineStart,100);
            // canvas.fillText("100",50,50);
            // console.log(this.conversion(pixelValue));
            incrementTotal += this.finalIncrement[thisIncrement];

        }

        canvas.moveTo(this.graphXLineStart, this.yconversion(this.graphYLineStart));
        canvas.lineTo(this.graphXLineStart, 0);
        canvas.moveTo(this.graphXLineStart, this.yconversion(this.graphYLineStart));
        canvas.lineTo(this.graphXLineStart + this.graphWidth, this.yconversion(this.graphYLineStart));

        
        canvas.strokeStyle = "black";
        canvas.lineCap = "round";
        canvas.lineWidth = 2;
        canvas.stroke();
        

        
    }

    //Done after INIT
    loadTimeFilterData(XD,YD, graphIncrement){
        // var XX = this.XData;
        // var YY = this.YData;

        //Getting the percent change of the Y Axis
        if(this.type == "percentile"){
            for(let m = 0; m < YD.length; m++){
                var stockData = YD[m];
                
                var startingStockValue = stockData[0];
                for(var l = 0; l < stockData.length; l++){

                    stockData[l] = stockData[l] / startingStockValue;
                }


                YD[m] = stockData;
            }
        }

        // let x = this.XData.slice(-20,0);
        // let y = this.YData.slice(-20,0);

        var tempNumOfPoints = [];
        console.log(this.yPoints);
        // console.log("X DATA");
        // console.log(this.xData);
        //console.log(this.XData.length);
        console.log(XD);
        for(var i = 0; i < XD.length; i++){
            var singleStockArray = XD[i];
            
            tempNumOfPoints.push(singleStockArray.length);
        }
        
        var numberOfPointsToGraph = Math.max(...tempNumOfPoints);
     
        var sliceAmounts = [20, 252/2,252, 5*252,numberOfPointsToGraph];
        //var graphDif = this.validGraphMax[this.bestElement] - this.validGraphBottom[this.bestElement];
        var graphDif = this.finalGraphMax[graphIncrement] - this.finalGraphBottom[graphIncrement]
        console.log("Graphy"+graphDif);
        console.log(this.finalGraphMax[graphIncrement]);
        console.log( this.finalGraphBottom[graphIncrement]);
        // console.log("ALL Y DATA FOR LOAD")
        // console.log(YD);
        for(var i = 0; i <= YD.length - 1; i++){
            
            var graphCategory = YD[i];
            //Day amounts for stock market 1M/6M/1Y/5Y
            

            // console.log("GRAPH CAT");
            console.log(graphCategory.length);
            console.log(this.graphPartitions);
            for(let z = 0; z <= this.graphPartitions.length - 1; z++){

                //Handling out of bounds index error
                // console.log("TF");
                // console.log(graphCategory.length < this.graphPartitions[z]);
                // if(graphCategory.length < this.graphPartitions[z]){
                //     this.graphPartitions = graphCategory.length;
                // }
            }

            var allX = [];
            var allY = [];
            console.log("G BOTTOM");
            console.log(this.finalGraphBottom[graphIncrement]);
            console.log("M VALUE");
            console.log(graphCategory[0]);
            console.log("GDIF:")
            console.log(graphDif);
            console.log(YD);
            for(var x = 0; x <= graphCategory.length - 1; x++){

                
                var monetaryValue = graphCategory[x] - this.finalGraphBottom[graphIncrement];
                //console.log("MV: "+ monetaryValue);
                // console.log(graphCategory[x]);

                if(this.type == "numeric"){
                    var ypixels = ((monetaryValue / graphDif) * (this.graphHeight)) + this.graphYLineStart;
                } else {
                    var ypixels = ((monetaryValue / graphDif) * (this.graphHeight)) + this.graphYLineStart;
                    //it's percentile
                }
                
                // console.log(monetaryValue);
                // console.log(graphDif);

                var xpixels = 0;
                //var yPoint = this.graphYLineStart + (graphCategory[i] / this.val
                if(x != 0) {
                    xpixels = (x/graphCategory.length)* (this.graphWidth) + this.graphXLineStart
                } else {
                    xpixels = 0 + this.graphXLineStart;

                }
                
                allX[x] = xpixels;
                allY[x] = ypixels
                // console.log(ypixels);
                //canvas.lineTo(xpixels,this.yconversion(ypixels));
            }

            // console.log("ALL Y" + 0);
            // console.log(typeof allY);
            
            this.xPoints.push(allX);
            this.yPoints.push(allY);
           // console.log("XPOINTS GENERATE");
            //console.log(this.xPoints);
            
        }
            //Graph category
        // console.log("np");
        // console.log(this.graphPartitions);
        // console.log(this.graphPartitions.length);
            // console.log("ELEMENTS FIX");
            // console.log(this.finalYPoints);
            for(var t = 0; t < this.graphPartitions.length; t++){
                // console.log("NP");
                var singleFilteredArray = [];

                for(var g = 0; g < this.XData.length; g++){
                    // console.log("Y POINTS")
                    // console.log(this.finalYPoints);
                    // console.log(this.finalYPoints.length);
                    // console.log(this.XData.length);
                    // var cat = this.finalYPoints[g];
                    // console.log(graphCat.length);
                    // var graphCat = cat[0];
                    // console.log("CAT")
                    // console.log(cat);
                    // console.log("GCAT")
                    // console.log(graphCat);
                    var totalNumberOfElements = this.graphPartitions[t];
                    // console.log("GCAT LENGTH: "+graphCat.length + "ELEMENTS LENGTH: "+ totalNumberOfElements+ "GRAPH PARTITIONS L: "+this.graphPartitions[t]);
                    // console.log("XDATA LEGNTH: " + this.XData[0].length);
                    //it's fine
                    // if(this.graphPartitions[t] > graphCat.length){
                    //     totalNumberOfElements = graphCat.length;
                    // }
                    var sliceArray = []
                    var start = this.XData[0].length - totalNumberOfElements;
                    // console.log("Start:" +start);
                    for(var j = start; j < this.XData[0].length; j++){
                        sliceArray.push(j);
                    }
                    
                    // console.log(graphCat);
                    // console.log(sliceArray);
                    //this.pointsElements[g][t].push(sliceArray);
                    singleFilteredArray.push(sliceArray);
                    // console.log("SF ARRAY");
                    // console.log(singleFilteredArray);
                


                }
                this.pointsElements.push(singleFilteredArray);
            }

            // console.log(this.pointsElements);
            // console.log("YPoints in load data");
            // console.log(this.yPoints);
            // console.log(this.pointsElements.length);
            this.finalXPoints.push(this.xPoints);
            this.finalYPoints.push(this.yPoints);

            this.xPoints = [];
            this.yPoints = [];
       




    }

    //Converts a datapoint, to an actualy point
    conversion(dataPoint){
        var result = this.canvasWidth - dataPoint;
        return result;
    }

    yconversion(dataPoint){
        var result = this.canvasHeight - dataPoint;
        return result;
    }

    displayButtons(){

        
    }





    

}