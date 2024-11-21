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
    
    constructor(canvasWidth, canvasHeight, data, timeline, canvas, colours){
        this.canvasHeight = canvasHeight;
        this.canvasWidth = canvasWidth;
        this.data = data;
        this.timeline = timeline;
        this.canvas = canvas;
        this.colours = colours;

        this.yScaleLabelsMin = 3 //the number of labels on the y axis minimum
        this.yScaleLabelsMax = 6 // the max
        this.graphMarginLeft = 0.1 
        this.graphMarginRight = 0.2 //Extra room for legend
        this.graphMarginTop = 0.1
        this.graphMarginBottom = 0.1
        this.graphMarginType = "default"
    }
    //smaller constructors/settings
    setMarginsLRTBS(left, right, top, bottom, settings){
        
        if(settings == "percentile"){
             this.bottomOffset = bottom * this.canvasHeight;
             this.topOffset = top * this.canvasHeight;
             this.leftOffset = left * this.canvasWidth;
             this.rightOffset = right * this.canvasWidth;
        }
        if(settings == "pixel"){
             this.bottomOffset = bottom;
             this.topOffset = top;
             this.leftOffset = left;
             this.rightOffset = right;
        }



        
    }


    calculateGraph(startDate, endDate, type){
        
        this.tempData = this.data

        console.log(this.data);
        //Slice the data based on the users request dates
        this.tempData = this.sliceByDate(this.tempData, startDate, endDate);
        this.tempTimeline = this.getTempTimeline();
        
        var max = this.getMaxData(this.tempData);
        var min = this.getMinData(this.tempData)

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
       
        this.tempDataCursors = [];
        this.tempDataMaxLengths = [];
        this.previousYCoord = [];
        this.previousXCoord = [];
       for(let x = 0; x < this.tempData.length; x++){
           this.tempDataCursors[x] = 0;
           this.tempDataMaxLengths[x] = this.tempData[x].length;
           
       }
       return;
       
       var canvas = this.canvas.getContext('2d');
       canvas.reset();
       canvas.beginPath();
       canvas.moveTo(0,0);
       canvas.strokeStyle = "green";
       

        // this.graphMarginLeft = 0.1 
        // this.graphMarginRight = 0.2 
        // this.graphMarginTop = 0.1
        // this.graphMarginBottom = 0.1

        this.bottomOffset = this.graphMarginBottom * this.canvasHeight;
        this.topOffset = this.graphMarginTop * this.canvasHeight;
        this.leftOffset = this.graphMarginLeft * this.canvasWidth;
        this.rightOffset = this.graphMarginRight * this.canvasWidth;

        this.coordYBottom = this.canvasHeight - this.bottomOffset;
        this.coordYTop = this.topOffset;
        this.coordXLeft = this.leftOffset;
        this.coordXRight = this.canvasWidth - this.rightOffset
        this.actualHeight = this.coordYBottom - this.coordYTop
        this.actualWidth = this.coordXRight - this.coordXLeft
        this.labelLineLength = 0.25 * this.bottomOffset
       //Draw Bounds
       
       canvas.lineWidth = 2;
 

       //DRAW Legend
       canvas.moveTo(this.coordXRight, this.coordYTop)
       canvas.stroke();
       canvas.beginPath();
       let legendYPixels = 0;
       for(let i = 0; i < this.tempData.length; i++) {

        //in theory we can have a max of ten things in our graph with this
        legendYPixels += (this.actualHeight / 10);
        let height = legendYPixels + this.coordYTop;
        let legendXBox = this.coordXRight + (this.rightOffset / 10)
        canvas.beginPath();
        canvas.fillStyle = this.colours[i]
        let boxWidth = 20;
        canvas.rect(legendXBox, height, boxWidth, 20);
    
        
        canvas.fill();
        canvas.closePath()
        
        canvas.beginPath()
        let number = parseInt(0.35   * this.bottomOffset);
        let font = number.toString()+"px serif"
        canvas.font = font;
        canvas.textAlign = "left";
        canvas.fillStyle = "black"
        canvas.fillText(this.tempData[i][0]['stockID'], (legendXBox +( boxWidth *2)),height + boxWidth -5);
        
        canvas.stroke();
        canvas.closePath()
       }
       console.log("Temp timeline 9999")
       console.log(this.tempTimeline);
       for(let i = 0; i < this.tempTimeline.length; i++){
           
            //Draw Data
            for(let x = 0; x < this.tempData.length; x++){

                // console.log(x);
                let stockArray = this.tempData[x]
            
                
                if(this.tempDataCursors[x] < this.tempDataMaxLengths[x] && this.tempTimeline[i]['stockDate'] == stockArray[this.tempDataCursors[x]]['stockDate']){
                    
                    let value = stockArray[this.tempDataCursors[x]]['stockValue'];
                    
                    value = value - this.graphBottom
                    
                    value = value / (this.graphMax - this.graphBottom);
              
                    
                    let ycoord = ((1 - value)* this.actualHeight) + this.coordYTop;

                    //subtract 1 from temp timeline because it is zero based
                    let xcoord = ((i) / (this.tempTimeline.length - 1) * this.actualWidth) + this.coordXLeft;
                     
                canvas.beginPath()
                if(this.previousYCoord[x] == undefined && this.previousXCoord[x] == undefined){
                    canvas.moveTo(xcoord, ycoord);
                } else {
                    canvas.moveTo(this.previousXCoord[x],this.previousYCoord[x]);
                }
                    
                   this.previousYCoord[x] = ycoord;
                   this.previousXCoord[x] = xcoord;
                   canvas.strokeStyle = colours[x]
                   canvas.lineTo(xcoord,ycoord);
                   canvas.stroke()
                   
                    this.tempDataCursors[x] = this.tempDataCursors[x] + 1;
                    // console.log(this.tempDataCursors);
                } else {

                }
            }
            if(this.timeline[i] == "lol"){

           }

            
       }

       canvas.stroke();
       //X/Y AXIS
        canvas.beginPath()
        canvas.moveTo(this.coordXLeft, this.coordYTop);
        canvas.lineTo(this.coordXLeft, this.coordYBottom);
        canvas.lineTo(this.coordXRight, this.coordYBottom);
        canvas.lineWidth = 3;
        canvas.strokeStyle = "black";
        canvas.stroke();

        let labels = this.getTimeLabels(this.tempData, this.tempTimeline)
        //Labels array contains [[stockDate:'date', displayText: '2011']]
 
        //Draw XTimeLabels
        let n = 0;
        
        for(let i = 0; i < this.tempTimeline.length; i++){
         
             //console.log(labels[0]['stockDate']);
             
            
             if(n != labels.length){
                 let tDate = new Date(this.tempTimeline[i]['stockDate'])
                 let labelDate = new Date(labels[n]['stockDate'])
                 if(labelDate <= tDate){
                     console.log("N: "+ n);
                 
                 //DRAW THE LABEL LINE AND TEXT
                 let labelX = ((i) / (this.tempTimeline.length - 1) * this.actualWidth) + this.coordXLeft;
                 //
                 let labelYText = this.coordYBottom + (0.6 * this.bottomOffset);
                 canvas.textAlign = "center";
                 //let font = labelYLineLength.toString()+"px serif"
                 let number = parseInt(0.35   * this.bottomOffset);
                 let font = number.toString()+"px serif"
                 canvas.font = font;
                 canvas.fillText(labels[n]['displayText'],labelX,labelYText)
                 
                 
                 let labelYLineLength = this.coordYBottom + this.labelLineLength;
                 canvas.moveTo(labelX, this.coordYBottom);
                 canvas.lineTo(labelX, labelYLineLength);
                 canvas.stroke();
                 n+=1
                 }
                 
             }
     
        }

        //Draw Y Labels
        let currentYValue = this.graphBottom
        console.log("BOTTOM");
        console.log("");

        console.log(typeof(this.graphYScale));
        console.log(this.graphYScale.toString())
        let intDifference = this.graphYScale.toString().length - Math.floor(this.graphYScale).toString().length;
        let intMultiplier = 10 * intDifference;
        while(currentYValue <= this.graphMax){
            //Percent of total graph
            
            console.log("BOTTOM:" +this.graphBottom)
            console.log("YVALUE: " + currentYValue );
            console.log("YSCALE: " + this.graphYScale);
            console.log("my CALC: "+ (2.2 + 0.2) )
            currentYValue = Math.floor(currentYValue * intMultiplier) / intMultiplier;


            let value = currentYValue - this.graphBottom
                    
            value = value / (this.graphMax - this.graphBottom);
            //value = this.graphBottom / (this.graphMax - this.graphBottom);
            
            let ycoord = ((1 - value)* this.actualHeight) + this.coordYTop;
            canvas.moveTo(this.coordXLeft, ycoord);
            //lineWidth =
            canvas.lineTo(this.coordXLeft - this.labelLineLength, ycoord);

            let number = parseInt(0.35   * this.bottomOffset);
                 let font = number.toString()+"px serif"
                 canvas.font = font;
            let labelDistance = 0.6 * this.bottomOffset;
            //console.log(this.coordXLeft - labelYText);
            canvas.textBaseline= "middle";
            canvas.fillText(currentYValue, this.coordXLeft - labelDistance,ycoord)
            canvas.stroke()


            currentYValue += this.graphYScale;
            console.log("CURRENY Y VALUE=" + currentYValue);
        }

        canvas.moveTo(this.coordXLeft - this.labelLineLength, this.coordYTop)
        canvas.lineTo(this.coordXLeft, this.coordYTop);
        canvas.lineTo(this.coordXLeft, this.coordYBottom );
        canvas.stroke();
    
        




        
        
    }

    initializeDisplay(){
        var canvas = this.canvas.getContext('2d');
        canvas.reset();
        canvas.beginPath();
        canvas.moveTo(0,0);
        this.coordYBottom = this.canvasHeight - this.bottomOffset;
        this.coordYTop = this.topOffset;
        this.coordXLeft = this.leftOffset;
        this.coordXRight = this.canvasWidth - this.rightOffset
        this.actualHeight = this.coordYBottom - this.coordYTop
        console.log("BOTTOM:" +this.coordYBottom);
        console.log("TOP:" +this.coordYTop);
        console.log("TOPLOL");
        console.log(this.bottomOffset);
        console.log(this.canvasHeight);
        this.actualWidth = this.coordXRight - this.coordXLeft
        this.labelLineLength = 0.25 * this.bottomOffset

    }

    displayLegend(canvas){
          //DRAW Legend
       canvas.moveTo(this.coordXRight, this.coordYTop)
       canvas.stroke();
       canvas.beginPath();
       let legendYPixels = 0;
       for(let i = 0; i < this.tempData.length; i++) {

        //in theory we can have a max of ten things in our graph with this
        legendYPixels += (this.actualHeight / 10);
        let height = legendYPixels + this.coordYTop;
        let legendXBox = this.coordXRight + (this.rightOffset / 10)
        canvas.beginPath();
        canvas.fillStyle = this.colours[i]
        let boxWidth = 20;
        canvas.rect(legendXBox, height, boxWidth, 20);
    
        
        canvas.fill();
        canvas.closePath()
        console.log("EVERTHING OKAY");
        console.log(this.tempData);
        canvas.beginPath()
        let number = parseInt(0.35   * this.bottomOffset);
        let font = number.toString()+"px serif"
        canvas.font = font;
        canvas.textAlign = "left";
        canvas.fillStyle = "black"
        canvas.fillText(this.tempData[i][0]['stockID'], (legendXBox +( boxWidth *2)),height + boxWidth -5);
        
        canvas.stroke();
        canvas.closePath()
       }
       console.log("Temp timeline 9999")
      //console.log(this.tempTimeline);
       


    }

    displayData(canvas){
        for(let i = 0; i < this.tempTimeline.length; i++){
           
            //Draw Data
            for(let x = 0; x < this.tempData.length; x++){

                // console.log(x);
                let stockArray = this.tempData[x]
            
                
                if(this.tempDataCursors[x] < this.tempDataMaxLengths[x] && this.tempTimeline[i]['stockDate'] == stockArray[this.tempDataCursors[x]]['stockDate']){
                    
                    let value = stockArray[this.tempDataCursors[x]]['stockValue'];
                    
                    value = value - this.graphBottom
                    
                    value = value / (this.graphMax - this.graphBottom);
              
                    console.log(value);
                    console.log(this.graphMax);
                    console.log(this.graphBottom);
                    console.log(this.actualHeight);
                    console.log(this.coordYTop);
                    let ycoord = ((1 - value)* this.actualHeight) + this.coordYTop;

                    //subtract 1 from temp timeline because it is zero based
                    let xcoord = ((i) / (this.tempTimeline.length - 1) * this.actualWidth) + this.coordXLeft;
                     
                canvas.beginPath()
                if(this.previousYCoord[x] == undefined && this.previousXCoord[x] == undefined){
                    canvas.moveTo(xcoord, ycoord);
                    console.log(xcoord + " " +ycoord)
                } else {
                    canvas.moveTo(this.previousXCoord[x],this.previousYCoord[x]);
                    console.log(xcoord + " " +ycoord)
                }
                    
                   this.previousYCoord[x] = ycoord;
                   this.previousXCoord[x] = xcoord;
                   canvas.strokeStyle = this.colours[x]
                   canvas.lineTo(xcoord,ycoord);
                   canvas.stroke()
                   
                    this.tempDataCursors[x] = this.tempDataCursors[x] + 1;
                    // console.log(this.tempDataCursors);
                } else {

                }
            }
            if(this.timeline[i] == "lol"){

           }

            
       }
    }

    displayAxis(canvas){
        canvas.stroke();
        //X/Y AXIS
         canvas.beginPath()
         canvas.moveTo(this.coordXLeft, this.coordYTop);
         canvas.lineTo(this.coordXLeft, this.coordYBottom);
         canvas.lineTo(this.coordXRight, this.coordYBottom);
         canvas.lineWidth = 3;
         canvas.strokeStyle = "black";
         canvas.stroke();
    }

    displayXLabels(canvas){
        let labels = this.getTimeLabels(this.tempData, this.tempTimeline)
        //Labels array contains [[stockDate:'date', displayText: '2011']]
 
        //Draw XTimeLabels
        let n = 0;
        
        for(let i = 0; i < this.tempTimeline.length; i++){
         
             //console.log(labels[0]['stockDate']);
             
            
             if(n != labels.length){
                 let tDate = new Date(this.tempTimeline[i]['stockDate'])
                 let labelDate = new Date(labels[n]['stockDate'])
                 if(labelDate <= tDate){
                     console.log("N: "+ n);
                 
                 //DRAW THE LABEL LINE AND TEXT
                 let labelX = ((i) / (this.tempTimeline.length - 1) * this.actualWidth) + this.coordXLeft;
                 //
                 let labelYText = this.coordYBottom + (0.6 * this.bottomOffset);
                 canvas.textAlign = "center";
                 //let font = labelYLineLength.toString()+"px serif"
                 let number = parseInt(0.35   * this.bottomOffset);
                 let font = number.toString()+"px serif"
                 canvas.font = font;
                 canvas.fillText(labels[n]['displayText'],labelX,labelYText)
                 
                 
                 let labelYLineLength = this.coordYBottom + this.labelLineLength;
                 canvas.moveTo(labelX, this.coordYBottom);
                 canvas.lineTo(labelX, labelYLineLength);
                 canvas.stroke();
                 n+=1
                 }
                 
             }
     
        }

    }

    displayYLabels(canvas){
        let currentYValue = this.graphBottom
        console.log("BOTTOM");
        console.log("");

        console.log(typeof(this.graphYScale));
        console.log(this.graphYScale.toString())
        let intDifference = this.graphYScale.toString().length - Math.floor(this.graphYScale).toString().length;
        let intMultiplier = 10 * intDifference;
        while(currentYValue <= this.graphMax){
            //Percent of total graph
            
            console.log("BOTTOM:" +this.graphBottom)
            console.log("YVALUE: " + currentYValue );
            console.log("YSCALE: " + this.graphYScale);
            console.log("my CALC: "+ (2.2 + 0.2) )
            currentYValue = Math.floor(currentYValue * intMultiplier) / intMultiplier;


            let value = currentYValue - this.graphBottom
                    
            value = value / (this.graphMax - this.graphBottom);
            //value = this.graphBottom / (this.graphMax - this.graphBottom);
            
            let ycoord = ((1 - value)* this.actualHeight) + this.coordYTop;
            canvas.moveTo(this.coordXLeft, ycoord);
            //lineWidth =
            canvas.lineTo(this.coordXLeft - this.labelLineLength, ycoord);

            let number = parseInt(0.35   * this.bottomOffset);
                 let font = number.toString()+"px serif"
                 canvas.font = font;
            let labelDistance = 0.6 * this.bottomOffset;
            //console.log(this.coordXLeft - labelYText);
            canvas.textBaseline= "middle";
            canvas.fillText(currentYValue, this.coordXLeft - labelDistance,ycoord)
            canvas.stroke()


            currentYValue += this.graphYScale;
            console.log("CURRENY Y VALUE=" + currentYValue);
        }

        canvas.moveTo(this.coordXLeft - this.labelLineLength, this.coordYTop)
        canvas.lineTo(this.coordXLeft, this.coordYTop);
        canvas.lineTo(this.coordXLeft, this.coordYBottom );
        canvas.stroke();
    }

    getTimeLabels(tempTimeline){
        
        //Length rules
        var startDate = new Date(this.tempTimeline[0]['stockDate']);
        var endDate = new Date(this.tempTimeline[this.tempTimeline.length - 1]['stockDate']);
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
        this.tempTimeline.length / 6
        if(yearsDifference == 0 && monthDifference < 3){
            console.log("hit GET DATE")
            currentFunction = "getDate";
            let days = this.tempTimeline.length
            let testNum = 1;
            while(testNum <= 6){
                dayLengthPeriods[testNum - 1] =  parseInt(days/testNum)      //Lets say we don't want the 24/8 = 2
                if(days/testNum < 2 && days/testNum >= 1.15){
                    dayLengthPeriods[testNum - 1] = 2;
                }
                testNum += 1;
            }
            let daysPerPeriod = dayLengthPeriods[0];
            for(let x = 0; x <= dayLengthPeriods.length; x++) {
                if(dayLengthPeriods[x] < daysPerPeriod && dayLengthPeriods[x] >= 1){
                    daysPerPeriod = dayLengthPeriods[x];

                }
            }

            period = daysPerPeriod;
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

        if(yearsDifference >= 1){
            // quarterely
            currentFunction = "getMonth"
             period = 3;
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
        //let startDate = new Date(this.tempTimeline[z]['stockDate']);
        let testDate = startDate
        //let testDate = Object.create(startDate);
        // let testDate = JSON.parse(JSON.stringify(startDate));
        console.log("TESTDATE")
        console.log(testDate);
        console.log(this.tempTimeline[0]['stockDate']);
        console.log("PERIOD: "+ period);
        console.log("CURRENT FUNCTION: " + currentFunction);
        result = testDate[currentFunction]()
        
        let addedAmount = 0;
        let dateResults = [];
        console.log("TESTDATE:"+ testDate.getDate())
        console.log("RESULT before modulus: "+result);
        let periodCounter = 0;
        if(currentFunction == "getDate") {
            //we automatically cut out the last day and the first day so there's no graph overlap
            for(let k = 1; k <  this.tempTimeline.length -1 ; k++){
                console.log("GET DAYS");
                console.log(period);
                periodCounter += 1; 
                console.log(periodCounter);
                if(periodCounter == period){
                    
                    //space needed after stockdate to convert to UTC (weird JS gimmick)
                    let currentDay = new Date((this.tempTimeline[k]['stockDate'] + " "))
                    let months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Nov","Dec"]
                    let array = [];
                    array['stockDate'] = this.tempTimeline[k]['stockDate']
                    array['displayText'] = months[currentDay.getMonth()] + " " + currentDay.getDate();
                    periodCounter = 0;
                    dateResults.push(array);
                }
            }
        }
        
        if(currentFunction == "getMonth"){
            //The labels on the axis can only be displayed
            //If the data starts exactly at the beginning of the month
            
            if((testDate.getDate()+ 1 )> 1){
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
            let day = result;   
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
            //time between start and end date
            let dateDifference = endDate.valueOf() - startDate.valueOf()
            while(iteratorDate >= startDate && iteratorDate <= endDate){
                
                let iDifference = endDate.valueOf() - iteratorDate.valueOf();
                //At the start of the loop the difference should be 
                // 1:1
                //by the end it will be close to
                //0:1
                console.log("IDIF: "+ iDifference);
                console.log("DDIF: " + dateDifference)
                console.log("DIVISION: " + iDifference/dateDifference);
                //The number was chosing by the  iDifference/dateDifference
                //To ensure that the graph does not display x axis labels
                //after the last 3.4% of the graph
                if(dateDifference * 0.034 >= iDifference){
                    
                    
                    break;
                }
                let key = iteratorDate.getFullYear()
                let array = [];
                array['stockDate'] = iteratorDate.toISOString().substring(0, 10);
                array['displayText'] = (iteratorDate.toLocaleString('default', { month: 'short' })+ " " + iteratorDate.getFullYear());
                dateResults.push(array);    
                numberOfLabels = numberOfLabels + 1
                iteratorDate = iteratorDate.setMonth(iteratorDate.getMonth() + period);
                iteratorDate = new Date(iteratorDate);

            }
        }
        
        console.log("Period: "+period);
        console.log("Date Results");
        console.log(dateResults);
        console.log(this.tempTimeline);
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
        // console.log(this.tempTimeline);

        return dateResults;
    }

    
    getTempTimeline(){
        let t = this.timeline;
        let start = this.startD;
        let end = this.endD;
        this.tempTimeline = [];

    
        for(let i = 0; i < t.length; i++){
            let date = new Date(t[i]['stockDate'])
            if(date >= start && date <= end){
                // console.log("true")
                this.tempTimeline.push(t[i]);
            }

        }
        return this.tempTimeline;
    }

    displayGraph(type){
        var canvas = this.canvas.getContext('2d');
        console.log("DEFAULT 0")
        if(type == "default"){
            console.log("default")
            this.initializeDisplay()
            console.log("default2")
            this.displayLegend(canvas)
            this.displayData(canvas)
            console.log("default3")
            this.displayAxis(canvas)
            console.log("default4")
            this.displayXLabels(canvas)
            console.log("default5")
            this.displayYLabels(canvas)
        }

        if(type == "percentage"){
            this.initializeDisplay()
            this.displayLegend(canvas)
            this.displayData(canvas)
            this.displayAxis(canvas)
            this.displayXLabels(canvas)
            this.displayYLabels(canvas)
        }

        if(type == "slider"){
            this.initializeDisplay()
            this.displayData(canvas)

        }
        
       


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

    setSliderBounds(sliders){
        // console.log(slider);
        for(let i = 0; i < sliders.length; i++){
            var slider = sliders.item(i);
            // slider.addEventListener("click", clickSlider)
            // slider.addEventListener("input", moveSlider)
            slider.setAttribute("min",0);
            slider.setAttribute("max",this.tempTimeline.length - 1);

            if(i == 0){
                slider.setAttribute("value",0)
            }

            if(i == 1){
                slider.setAttribute("value",this.tempTimeline.length - 1)
            }

            console.log("CANVAS WIDTH: " +this.canvasWidth);
            console.log("ACT CANVAS WIDTH: "+this.canvas.getAttribute("width"));
            var styles="width: 100%;"; 
            styles += " padding-right: "+ this.rightOffset+"px;";
            styles += " padding-left: "+ this.leftOffset+"px;";
            styles += " margin: "+ "0px;";
            styles += ' background-color:rgba(94, 185, 214, 0.4);';
            styles += ' z-index: 100; '
    
            slider.setAttribute("style",styles)

            console.log(slider);
        
            
        }

       
        // var styles="width: "+this.actualWidth+"px;"; 
        // console.log("CANVAS WIDTH: " +this.canvasWidth);
        // console.log("ACT CANVAS WIDTH: "+this.canvas.getAttribute("width"));
        // var styles="width: 100%;"; 
        // styles += " padding-right: "+ this.rightOffset+"px;";
        // styles += " padding-left: "+ this.leftOffset+"px;";
        // styles += " margin: "+ "0px;";
        // styles += ' background-color:rgba(94, 185, 214, 0.4);';
        // styles += ' z-index: 100; '

        // slider.setAttribute("style",styles)
        // slider.style.margin-left=this.leftOffset.toString()+"px";
        // slider.style.margin-right= this.rightOffset.toString()+"px";
        // slider.style.marginRight = "100px";
        // slider.style.width = "30px";
       // document.getElementById("lol").style.margin-left="lol"
        // slider.setAttribute("style","width:"+this.actualWidth+"px;");
        // slider.setAttribute("style","margin-left:"+ this.leftOffset+"px;");
        // slider.setAttribute("style","margin-right:"+ this.rightOffset+"px;");

    }

    

}