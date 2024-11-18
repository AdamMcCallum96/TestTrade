class Graph {

    title
    dataStart
    dataEnd

    array
    calculatedData


    possibleYScales = [];
    validYScale = [];
    validGraphBottom = [];
    validGraphMax = [];
    testedGraphBottom = [];
    percentChange = [];
    
    constructor(canvasWidth, canvasHeight, data, timeline, canvas){
        this.canvasHeight = canvasHeight;
        this.canvasWidth = canvasWidth;
        this.data = data;
        this.timeline = timeline;
        this.canvas = canvas;
        this.yScaleLabelsMin = 3 //the number of labels on the y axis minimum
        this.yScaleLabelsMax = 6 // the max
        this.graphMarginLeft = 0.1 
        this.graphMarginRight = 0.2 //Extra room for legend
        this.graphMarginTop = 0.1
        this.graphMarginBottom = 0.1
    }

    init(){

    }


    calculateGraph(startDate, endDate, type){
        
        var tempData = this.data

        console.log(this.data);
        //Slice the data based on the users request dates
        tempData = this.sliceByDate(tempData, startDate, endDate);
        let tempTimeline = this.getTempTimeline();
        
        var max = this.getMaxData(tempData);
        var min = this.getMinData(tempData)

        var difference = max-min;
       
        var maxSharePrice = 10000000000
        var lowestSharePrice = 0.0001;
        var graphScales = new Array();
        //Calculate all possible graph scales
        while(lowestSharePrice <= maxSharePrice){
            graphScales.push(lowestSharePrice);
            graphScales.push(lowestSharePrice * 2);
            graphScales.push(lowestSharePrice * 5);
            lowestSharePrice = lowestSharePrice * 10; 
        }

        //The amount of labels to shown on the y axis
        var graphErrorPercent = new Array();
        let testsDone = 0;
        for(var yLabels = this.yScaleLabelsMin; yLabels <= this.yScaleLabelsMax; yLabels ++){
            
           // console.log(yLabels);
            //The calculated graph scale will always be lower or equal to the actual scale
            var calculatedYScale = difference/(yLabels-1);
            //console.log(calculatedYScale);
            
            //the actual Y scale should always be slightly bigger than the calculated one
            //this gives the graph some space
            var z = 0;
            var greaterThanYScale = false;
            var yScaleFound = 0;
            while(greaterThanYScale == false){

                if(graphScales[z] >= calculatedYScale){
                    yScaleFound = graphScales[z];
                    greaterThanYScale = true;
                }
                z++
            }

            this.possibleYScales[testsDone] = yScaleFound;
            this.testedGraphBottom[testsDone] = yScaleFound * Math.floor((min/yScaleFound));

            var testedMax = this.testedGraphBottom[testsDone] + (this.possibleYScales[testsDone] * (yLabels-1));

            //The data is within the bounds of the max, so it's usable.
            //Otherwise it's discarded
            if(testedMax >= max){
                this.validYScale.push(this.possibleYScales[testsDone]);
                this.validGraphBottom.push(this.testedGraphBottom[testsDone]);
                this.validGraphMax.push(testedMax);

            }

            
        }
        //Finding error percentage for valid data
        for(let x = 0; x < this.validYScale.length; x++){

            var errorPercent = 0;
            var divideByZero = min - this.validGraphBottom[x];

            if(divideByZero != 0){
                errorPercent += (min - this.validGraphBottom[x]) / difference; 
            } else {
                errorPercent += 0;
            }
           
            divideByZero = this.validGraphMax[x] - max;
            if(divideByZero != 0){
                errorPercent += (this.validGraphMax[x] - min) / difference; 
            } else {
                errorPercent += 0;
            }
            
            this.percentChange[x] = errorPercent;
        }

        //Maybe there is an easier way to calculate this

    let currentPercentChange = 0;
       for(let i = 0; i<= this.percentChange.length - 1; i++){

            if(i != 0){
                if(currentPercentChange > this.percentChange[i]){
                    this.graphMax = this.validGraphMax[i];
                    this.graphBottom = this.validGraphBottom[i];
                    this.graphYScale = this.validYScale[i];
                    currentPercentChange = this.percentChange[i];
                }
            } else {
                this.graphMax = this.validGraphMax[i];
                this.graphBottom = this.validGraphBottom[i];
                this.graphYScale = this.validYScale[i];
               
                currentPercentChange = this.percentChange[i];
            }
       }

       console.log("Data for final result");
       console.log(this.validGraphMax);
       console.log(this.validGraphBottom);
       console.log(this.validYScale);
       console.log(this.percentChange);
       console.log("Final Result");
       console.log(this.graphMax);
       console.log(this.graphBottom);
       console.log(this.graphYScale);
       console.log(currentPercentChange);
       console.log(tempData);


       
       var tempDataCursors = [];
       var tempDataMaxLengths = [];
       var previousYCoord = [];
       var previousXCoord = [];
       for(let x = 0; x < tempData.length; x++){
           tempDataCursors[x] = 0;
           tempDataMaxLengths[x] = tempData[x].length;
           console.log(tempData.length);
           console.log("temp length");
           console.log(tempDataMaxLengths[x]);
       }

       
       var canvas = this.canvas.getContext('2d');
       canvas.reset();
       canvas.beginPath();
       canvas.moveTo(0,0);
       canvas.strokeStyle = "green";
       console.log(this.canvas.height);
       console.log(this.canvas.width);
       console.log(tempDataCursors);
       console.log("timeline");
       console.log(this.timeline);
       console.log("temptimeline");
       console.log(tempTimeline);

        this.graphMarginLeft = 0.1 
        this.graphMarginRight = 0.2 //Extra room for legend
        this.graphMarginTop = 0.1
        this.graphMarginBottom = 0.1

        let bottomOffset = this.graphMarginBottom * this.canvasHeight;
        let topOffset = this.graphMarginTop * this.canvasHeight;
        let leftOffset = this.graphMarginLeft * this.canvasWidth;
        let rightOffset = this.graphMarginRight * this.canvasWidth;

        let coordYBottom = this.canvasHeight - bottomOffset;
        let coordYTop = topOffset;
        let coordXLeft = leftOffset;
        let coordXRight = this.canvasWidth - rightOffset
        let actualHeight = coordYBottom - coordYTop
        let actualWidth = coordXRight - coordXLeft
       //Draw Bounds
       canvas.moveTo(coordXLeft, coordYTop);
       canvas.lineTo(coordXLeft, coordYBottom);
       canvas.lineTo(coordXRight, coordYBottom);
       canvas.lineWidth = 3;
       canvas.strokeStyle = "black";
       canvas.stroke();
       canvas.lineWidth = 2;
       let labels = this.getTimeLabels(tempData, tempTimeline)
       //Labels array contains [[stockDate:'date', displayText: '2011']]

       //Draw XTimeLabels
       let n = 0;
       
       for(let i = 0; i < tempTimeline.length; i++){
        
            //console.log(labels[0]['stockDate']);
            
           
            if(n != labels.length){
                let tDate = new Date(tempTimeline[i]['stockDate'])
                let labelDate = new Date(labels[n]['stockDate'])
                if(labelDate <= tDate){
                    console.log("N: "+ n);
                
                //DRAW THE LABEL LINE AND TEXT
                let labelX = ((i+1) / tempTimeline.length * actualWidth) + coordXLeft;
                //
                let labelYText = coordYBottom + (0.5 * bottomOffset);
                canvas.textAlign = "center";
                //let font = labelYLineLength.toString()+"px serif"
                let number = 35
                let font = number.toString()+"px serif"
                canvas.font = font;
                canvas.fillText(labels[n]['displayText'],labelX,labelYText)
                console.log("BOTTOM OFFSET: "+ (coordYBottom +(0.5 * bottomOffset)));
                console.log(coordYBottom);
                console.log(labelX);
                console.log(labelYText);
                
                let labelYLineLength = coordYBottom + (0.25 * bottomOffset);
                canvas.moveTo(labelX, coordYBottom);
                canvas.lineTo(labelX, labelYLineLength);
                canvas.stroke();
                n+=1
                }
                
            }
    
       }

       for(let i = 0; i < tempTimeline.length; i++){
           
            //Draw Data
            for(let x = 0; x < tempData.length; x++){

                // console.log(x);
                let stockArray = tempData[x]
                
                
                // console.log(stockArray.length);
                // console.log(tempDataCursors[x]);
                // console.log("I#: "+i);
                // console.log("Datacursor #"+x+" "+ tempDataCursors[x]);
                // console.log("timeline: "+ this.timeline[i]['stockDate']);
                // console.log("stockarray: " + stockArray[tempDataCursors[x]]['stockDate']);
                
                if(tempDataCursors[x] < tempDataMaxLengths[x] && tempTimeline[i]['stockDate'] == stockArray[tempDataCursors[x]]['stockDate']){
                    
                    let value = stockArray[tempDataCursors[x]]['stockValue'];
                    
                    value = value - this.graphBottom
                    
                    value = value / (this.graphMax - this.graphBottom);
                    //let ycoord = (1 - value)* t;
                //    let ycoord = (1 - value)* this.canvas.height;
                //    let xcoord = ((i+1) / tempTimeline.length * this.canvas.width);
                    
                    let ycoord = ((1 - value)* actualHeight) + coordYTop;
                    let xcoord = ((i+1) / tempTimeline.length * actualWidth) + coordXLeft;
                     
                //    console.log(actualWidth);
                   //modify the coordinates according to the graph
                   
                   
                   
                // console.log("x: "+ xcoord + "y: "+ycoord);
                if(previousYCoord[x] == undefined && previousXCoord[x] == undefined){
                    canvas.moveTo(xcoord, ycoord);
                } else {
                    canvas.moveTo(previousXCoord[x],previousYCoord[x]);
                }
                    
                   previousYCoord[x] = ycoord;
                   previousXCoord[x] = xcoord;
                   canvas.lineTo(xcoord,ycoord);
                   
                    tempDataCursors[x] = tempDataCursors[x] + 1;
                    // console.log(tempDataCursors);
                } else {

                }
            }
            if(this.timeline[i] == "lol"){

           }
       }

       canvas.stroke();






        
        
    }

    getTimeLabels(tempData, tempTimeline){
        //Length rules
        var startDate = new Date(tempTimeline[0]['stockDate']);
        var endDate = new Date(tempTimeline[tempTimeline.length - 1]['stockDate']);
        // var startDate = new Date('2009-01-25');
        // var endDate = new Date('2009-08-25');
        
        var dateDifference = new Date(endDate.getTime() - startDate.getTime());
        console.log("Month: "+ dateDifference.getMonth());
        console.log("Year dif: "+ (dateDifference.getFullYear() - 1970));
        var monthDifference = dateDifference.getMonth()
        var yearsDifference = dateDifference.getFullYear() - 1970;
        let currentFunction = "";
        let period = 0;
        let dayLengthPeriods =[]
        tempTimeline.length / 6
        if(yearsDifference == 0 && monthDifference < 3){
            
            let days = tempTimeline.length
            let testNum = 1;
            while(testNum <= 10){
                dayLengthPeriods[testNum - 1] = days/testNum
                testNum++
            }
            12345
        }
        if(yearsDifference == 0 && monthDifference >= 3){
            //monthly
            currentFunction = "getMonth"
            period = 1;
        }
        
        if(yearsDifference == 0 && monthDifference >= 6){
            // bimonthly
            currentFunction = "getMonth"
            period = 2;
        }

        if(yearsDifference >= 1 && monthDifference >= 9){
           // quarterely
           currentFunction = "getMonth"
            period = 4;
        }

        if(yearsDifference >= 2 ){
            //half years
            currentFunction = "getMonth"
            period = 6;
        }

        if(yearsDifference >= 3){
            //yearly
            currentFunction = "getFullYear"
            period = 1;
        }

        if(yearsDifference >= 6){
            //twoyears
            currentFunction = "getFullYear"
            period = 2;
        }

        if(yearsDifference >= 12){
            let testNum = 12;
            let numFound = false;
            while(numFound == false){
                if(yearsDifference >= testNum * 2) {
                    testNum = testNum * 2;
                } else {
                    numFound = true;
                    period = testNum/3;
                }
            }
        }

        let result = 0;
        //let startDate = new Date(tempTimeline[z]['stockDate']);
        let testDate = startDate
        //let testDate = Object.create(startDate);
        // let testDate = JSON.parse(JSON.stringify(startDate));
        console.log("TESTDATE")
        console.log(testDate);
        console.log(tempTimeline[0]['stockDate']);
        console.log("PERIOD: "+ period);
        console.log("CURRENT FUNCTION: " + currentFunction);
        result = testDate[currentFunction]()
        
        let addedAmount = 0;
        let dateResults = [];
        console.log("TESTDATE:"+ testDate.getDate())
        console.log("RESULT before modulus: "+result);
        if(currentFunction == "getMonth"){
            //The labels on the axis can only be displayed
            //If the data starts exactly at the beginning of the month
            if(testDate.getDate() > 1){
                result += 1;
            }
            //2015-08-12
            while(result % period != 0){
                result = result + 1;
            }
            console.log("RESULT: "+ result);
            //testDate.setMonth(result)
            //let iteratorDate = new Date("2001-01-01")
            let tempDate = new  Date("2001-01-01")
            //tempDate.setMonth((testDate.getMonth()+ result));
            let day = result - 1
            tempDate.setMonth(day)
            //tempDate.setMonth(result - 1);
            let dateString = testDate.getFullYear().toString().concat('-',(tempDate.getMonth()+1),'-01')
            console.log("DATE STRING: "+ dateString);
            let temptemp = new Date(dateString);
            //for some odd reason the data above is a timestamp and needs
            //to be converted to a date again
            let iteratorDate = new Date(temptemp);
            // console.log("TESTEST");
            // console.log(iteratorDate);
            // console.log(temptemp);
           // iteratorDate
            //console.log(testDate);
            let numberOfLabels = 0;
            // console.log(testDate);
            // console.log(startDate);
            // console.log(endDate);
            console.log(iteratorDate >= startDate);
            console.log(iteratorDate <= endDate);
            while(iteratorDate >= startDate && iteratorDate <= endDate){
            
                let key = iteratorDate.getFullYear()
                let array = [];
                array['stockDate'] = iteratorDate.toISOString().substring(0, 10);
                array['displayText'] = iteratorDate.toLocaleString('default', { month: 'long' });
                dateResults.push(array);    
                numberOfLabels = numberOfLabels + 1
                iteratorDate = iteratorDate.setMonth(iteratorDate.getMonth() + period);
                iteratorDate = new Date(iteratorDate);

            }
        }
        // console.log("DATE RESULTS");
        // console.log("START" + startDate);
        // console.log("end" + endDate);
        console.log("Period: "+period);
        console.log(dateResults);
        if(currentFunction == "getFullYear"){
            console.log("FULL YEAR ______________________")
            let startingYear = startDate.getFullYear()
            let iteratorYear = new Date(startDate.toISOString());
            
            //very simply we are going to make the starting year to be the next period just to add space to the graph;
            //Zero the month and the day to the start of the year
            iteratorYear.setFullYear((iteratorYear.getFullYear() + period));
            
            iteratorYear.setMonth(0);
            iteratorYear.setDate(1);
            console.log("ITERATOR YEAR")
            console.log(iteratorYear);
            

            while(iteratorYear >= startDate && iteratorYear <= endDate){
                let array = [];
                array['stockDate'] = iteratorYear.toISOString().substring(0, 10);
                array['displayText'] = iteratorYear.getFullYear().toString();
                dateResults.push(array);
                iteratorYear.setFullYear((iteratorYear.getFullYear() + period));
            }
            
            
        }
       
        // console.log(dateResults)
        
        // console.log(yearsDifference);
        // console.log("GETTIMELABELS")
        // console.log(tempTimeline);

        return dateResults;
    }

    getTempTimeline(){
        let t = this.timeline;
        let start = this.startD;
        let end = this.endD;
        let tempTimeline = [];

    
        for(let i = 0; i < t.length; i++){
            let date = new Date(t[i]['stockDate'])
            if(date >= start && date <= end){
                // console.log("true")
                tempTimeline.push(t[i]);
            }

        }
        return tempTimeline;
    }
    displayGraph(){

    }
    //ALL OF THESE FUNCTIONS PURELY FOR COMPLEX CALCS
    getMaxData(passedData){
        var number = null;
        for(let i = 0; i < passedData.length; i++){
            
            let rows = passedData[i];
            for(let k = 0; k < rows.length; k++){
                if(number != null){
                
                    if(number < rows[k]['stockValue']){
                        number = rows[k]['stockValue'];
                    }
                } else {
                    number = rows[k]['stockValue']
                }
            }
        }

        return number;
    }

    getMinData(passedData){
        var number = null;
        for(let i = 0; i < passedData.length; i++){
            
            let rows = passedData[i];
            for(let k = 0; k < rows.length; k++){
                // console.log(rows[k]);
                if(number != null){
                
                    if(number > rows[k]['stockValue']){
                        number = rows[k]['stockValue'];
                    }
                } else {
                    number = rows[k]['stockValue']
                }
            }
        }

        return number;

    }

    sliceByDate(stockArray, startDate, endDate){
        
        console.log("sliceByDate");
        console.log(this.timeline);
        let startD = new Date(startDate);
        let endD = new Date(endDate);

        //Automatically set the start date to the earliest date of the data
        
      
        
        var dataStartDate = new Date(this.timeline[0]['stockDate']);
        
        var dataEndDate = new Date(this.timeline[this.timeline.length - 1]['stockDate'])
        //If some how the user selects the start date
        //To be before the data or after the data, set it to the start
        if(startD > dataEndDate || startD < dataStartDate || startD > endD){
            startD = dataStartDate;
        }
        //If the user selects the end date to be before the data, or after the data
        //Set it to the end of the data
        if(endD > dataEndDate || endD < dataStartDate || endDate < startDate){
            endD = dataEndDate;
        }

        //Find the start date in the timeline
        this.startD = startD;
        this.endD = endD;
        function filterDates(arrayItem){
           var itemDate = new Date(arrayItem['stockDate']);

           if(itemDate >= startD && itemDate <= endD){
               return arrayItem
           }
        }
        // console.log("stock array 0");
        // console.log(stockArray);

        for(let i = 0; i < stockArray.length; i++){
            stockArray[i] = stockArray[i].filter(filterDates);
        }
    
        // console.log(stockArray);
       
        // for(let i = 0; i < this.timeline.length; i++){
            
        //     let tempDate = new Date(this.timeline[i])
            
        //     for(let k = 0; k < stockDaily.length; k++){

        //     }
            
        // }

        // var filteredStockList = [];
        // for(let i = 0; i < stockArray.length; i++){
        //     var stockDaily = stockArray[i];
        //     let dateIterator = startD;
        //     for(let k = 0; k < stockDaily.length; k++){
                
        //         let stockDate = new Date(stockDaily[k]["stockDate"]);

        //         while(stockDate != dateIterator || dateIterator > dataEndDate){
        //             dateIterator.setDate(dateIterator.getDate() + 1);
        //             if(stockDate == dateIterator){

        //             }
        //         }
        //         if(k == 0){
        //             console.log(stockDaily[k]["stockDate"]);
        //         }
        //     }
        // }


        // console.log("endSliceDate");
        return stockArray;

    }

    

}