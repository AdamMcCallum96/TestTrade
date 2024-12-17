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
    childGraph
    
    constructor(data, timeline, colours, type, stockIDs){
        // this.canvasWidth = canvasWidth;
        // this.canvasHeight = canvasHeight;
        this.data = data;
        // console.log("DATA IN CONST");
        
        // console.log(data);
        // console.log(this.data);
        // console.log("TIMELINE");
        // console.log(timeline);
        this.timeline = timeline;
        // this.canvas = canvas;
        this.colours = colours;
        this.type = type;
        this.dataType = "default"; //default, percentage or percentageByPeriod
        this.stockIDs = stockIDs

        this.yScaleLabelsMin = 3 //the number of labels on the y axis minimum
        this.yScaleLabelsMax = 6 // the max
        this.graphMarginLeft = 0.1 
        this.graphMarginRight = 0.2 //Extra room for legend
        this.graphMarginTop = 0.1
        this.graphMarginBottom = 0.1
        this.graphMarginType = "default"
    }
    //smaller constructors/settings
    setChildGraph(childGraph){
        this.childGraph = childGraph;
    }

    setCanvasID(id){
        this.canvasID = id;
    }

    createChildGraph(){
    //    this.child = new Graph()
    }

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

    getDateFromIndex(index){
        return this.timeline[index]['stockDate'];
    }


    calculateGraph(startDate, endDate, type){
        var type = this.type
        //resetting all used globals
        this.graphMax = []
        this.graphBottom = []
        this.graphYScale = []
        this.percentChange = [];
        
        this.testedGraphBottom = [];
        this.possibleYScales = [];
        this.validYScale = [];
        this.validGraphBottom = [];
        this.validGraphMax = [];
        
        console.log("THIS DATA");
        console.log(this.data);
        this.tempData = [];
        // this.tempData = this.data.slice(0);
        this.tempData = JSON.parse(JSON.stringify(this.data));
        console.log("TEMPDATA AFTER SLICE")
        console.log(this.tempData)
        // console.log(this.data);
        //Slice the data based on the users request dates
        this.tempData = this.sliceByDate(this.tempData, startDate, endDate);
        this.tempTimeline = this.getTempTimeline();
        console.log(this.tempData);

        if(this.dataType == "percentageByPeriod"){
            this.filterDays()
        }
        this.convertToDataType(this.tempData, this.dataType)
        console.log(this.tempData);
        console.log("TEMPDATA BREAKPOINT");

        console.log("CALCULATE GRAPH S/E")
        console.log(startDate)
        console.log(endDate);
        
        console.log(this.tempTimeline);
        if(this.dataType == "default" || this.dataType == "percentageByPeriod"){
            var max = this.getMaxData(this.tempData, this.dataType);
            //var min = this.getMinData(this.tempData)
            var min = this.getMinData(this.tempData)
        } else {

            var max = this.getMaxData(this.tempData, this.dataType);
            // 0 percent of starting value is min
            // var min = this.getMinData(this.tempData)
            var min = 0; 
        }
        
        // psutil.Process.resume()
        
    

        var difference = max-min;
       console.log("MAX:" + max + "MIN:" + min)
       if(this.dataType == "percentageByPeriod"){
        //    debugger;
       }
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
            console.log("CALC:" + calculatedYScale+ " = " + difference + "/("+ yLabels+"-1)")
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
        console.log("Y SCALES:");
        console.log(this.validYScale);
        
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
       console.log("PERCENT CHANGE")
       console.log(this.percentChange)
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
            
            // console.log("BOTTOM:" +this.graphBottom)
            // console.log("YVALUE: " + currentYValue );
            // console.log("YSCALE: " + this.graphYScale);
            // console.log("my CALC: "+ (2.2 + 0.2) )
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
            // console.log(this.graphYScale);
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
       console.log("temp");
       console.log(this.tempData);
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
        // canvas.fillText(this.tempData[i][0]['stockID'], (legendXBox +( boxWidth *2)),height + boxWidth -5);
        console.log(this.stockIDs);
        canvas.fillText(this.stockIDs[i], (legendXBox +( boxWidth *2)),height + boxWidth -5);
        canvas.stroke();
        canvas.closePath()
       }
       console.log("Temp timeline 9999")
      //console.log(this.tempTimeline);
       


    }

    displayData(canvas){
        console.log("DISPLAY DATA TEMPDATA");
        console.log(this.tempData)

        

        for(let i = 0; i < this.tempTimeline.length; i++){
           
            //Draw Data
            for(let x = 0; x < this.tempData.length; x++){

                // console.log(x);
                let stockArray = this.tempData[x]
            
                
                if(this.tempDataCursors[x] < this.tempDataMaxLengths[x] && this.tempTimeline[i]['stockDate'] == stockArray[this.tempDataCursors[x]]['stockDate']){
                    
                    let value = stockArray[this.tempDataCursors[x]]['stockValue'];
                    
                    value = value - this.graphBottom
                    
                    value = value / (this.graphMax - this.graphBottom);
              
                    // console.log(value);
                    // console.log(this.graphMax);
                    // console.log(this.graphBottom);
                    // console.log(this.actualHeight);
                    // console.log(this.coordYTop);
                    let ycoord = ((1 - value)* this.actualHeight) + this.coordYTop;

                    //subtract 1 from temp timeline because it is zero based
                    let xcoord = ((i) / (this.tempTimeline.length - 1) * this.actualWidth) + this.coordXLeft;
                     
                canvas.beginPath()
                if(this.previousYCoord[x] == undefined && this.previousXCoord[x] == undefined){
                    canvas.moveTo(xcoord, ycoord);
                    // console.log(xcoord + " " +ycoord)
                } else {
                    canvas.moveTo(this.previousXCoord[x],this.previousYCoord[x]);
                    // console.log(xcoord + " " +ycoord)
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
        // console.log("BOTTOM");
        // console.log("");

        // console.log(typeof(this.graphYScale));
        // console.log(this.graphYScale.toString())
        let intDifference = this.graphYScale.toString().length - Math.floor(this.graphYScale).toString().length;
        let intMultiplier = 10 * intDifference;
        if(intDifference == 0){
            intMultiplier = 1;
        }
        while(currentYValue <= this.graphMax){
            //Percent of total graph
            
            // console.log("BOTTOM:" +this.graphBottom)
            // console.log("YVALUE: " + currentYValue );
            // console.log("YSCALE: " + this.graphYScale);
            // console.log("my CALC: "+ (2.2 + 0.2) )
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
            
            // console.log(this.graphYScale);
            // console.log("CURRENY Y VALUE=" + currentYValue);
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
            let years = 0;
            
            while(day >= 11){
                //testDate.setFullYear(testDate.getFullYear()+ 1);
                day = day - 12;
                years += 1
            }
            //tempDate.setMonth(result - 1);
            // let dateString = testDate.getFullYear().toString().concat('-',(tempDate.getMonth()+1),'-01')
            let dateString = (testDate.getFullYear() + years).toString().concat('-',(tempDate.getMonth()+1),'-01')
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
        console.log("IN TIMELINE");
        console.log(start);
        console.log(end);
        for(let i = 0; i < t.length; i++){
            let date = new Date(t[i]['stockDate'])
            if(date >= start && date <= end){
                // console.log("true")
                this.tempTimeline.push(t[i]);
            }

        }
        return this.tempTimeline;
    }

    runGraph(graphPage){
        console.log("GRAPH PAGE:" + graphPage)
        console.log(graphPage
            
        )
        var start = "2015-04-01";
        var end = "2013-01-10";
        this.calculateGraph(start, end, this.dataType)
        // window.stop();
        let graphPageID = document.getElementById(graphPage);
        graphPageID.style.width = "100%"
        if(this.type != "slider"){
            //add interactive ui elements / date range
            //on click functions
            //styles in the style sheet
            let graph = this;
            let buttonsContainer = document.createElement('div');
            buttonsContainer.classList.add("graphButtonsContainer")
            graphPageID.insertAdjacentElement("beforeend",buttonsContainer);

            let selectOptions = ['Stock Price','Percent Change','Percent By Period'];
            let value = ['default','percentage','percentageByPeriod'];
            
            let buttonContainer = document.createElement('div');
                buttonContainer.classList.add("graphButtonContainer");
                buttonsContainer.insertAdjacentElement("beforeend",buttonContainer);
           
                //Add select box and its items
            let selectBox = document.createElement('select')
                selectBox.classList.add("graphButton")
                selectBox.classList.add("graphSelectButton")
                buttonContainer.insertAdjacentElement("beforeend",selectBox)

                selectBox.addEventListener('input',function(){

                    let value = selectBox.value
                    if(value == "default"){ 
                        graph.dataType = "default"
                        // graph.childGraph.dataType = "default"
                    }
                    if(value == "percentage"){ 
                        graph.dataType = "percentage"
                        // graph.childGraph.dataType = "percentage"
                    } 

                    if(value == "percentageByPeriod"){
                        graph.dataType = "percentageByPeriod";
                    }

                    let start = graph.startD//graph.getDateFromIndex(graph.endSlider.value)
                    let end = graph.endD//graph.getDateFromIndex(graph.startSlider.value)
                    graph.calculateGraph(start, end, graph.dataType)
                    graph.displayGraph(graph.type);
                    graph.childGraph.calculateGraph(start, end, graph.dataType)
                    graph.childGraph.displayGraph(graph.childGraph.type);
                    window.alert(graph.childGraph.type)
                    
                    
                })
            for(let i = 0; i < selectOptions.length; i++){
                
                
                let option = document.createElement('option')
                option.textContent = selectOptions[i]
                option.value = value[i];
                
                selectBox.insertAdjacentElement("beforeend",option)

                

            }


            let buttonNames = ['Max','5Y','Y','6M','3M','M','W']
            let days = [36500,1825,365,182,91,31,7]

            for(let i = 0; i < days.length; i++){   
                //numbers of days * ms * s * m * h * d
                days[i] =  1000 * 60 * 60 * 24 *days[i]
            }
            // let graph = this;
            for(let i = 0; i < buttonNames.length; i ++){
                let buttonContainer = document.createElement('div');
                buttonContainer.classList.add("graphButtonContainer");
                
                buttonsContainer.insertAdjacentElement("beforeend",buttonContainer);

                let button = document.createElement('button')
                button.textContent = buttonNames[i]
                button.classList.add("graphButton");
                button.classList.add("graphDateButton");
                button.addEventListener("click", function(){
                    let endDate = new Date(graph.timeline[graph.timeline.length - 1]['stockDate']);
                    let startDate = new Date(new Date().setTime(endDate.getTime() - days[i]))
                    
                    
                    // console.log(startDate);
                    // console.log(endDate);
                    // startDate = startDate.toISOString().substring(0,10);
                    endDate = endDate.toISOString().substring(0,10);
                    
                    let goodValue = 0;
                    console.log(graph.timeline.length);
                    // console.log(typeof graph.childGraph);
                    // console.log(typeof graph.childGraph.type);
                   
                    // let arg2 = typeof graph.childGraph.type?
                    console.log("Child graph test")
                    if((typeof graph.childGraph != undefined) &&  (typeof graph.childGraph?.type != undefined) &&(graph.childGraph?.type == "slider")){ //graph.childGraph.type == "slider"){
                        console.log("pass child graph test")
                    // if("lol" == true){
                    console.log("lol");
                    for(let x = 0; x < graph.timeline.length; x++){

                            // console.log(startDate);
                            // console.log(graph.timeline[x]);
                            let currentDate = new Date(graph.timeline[x]['stockDate'])
                        if(currentDate >= startDate){
                            
                            goodValue = x;
                            break;
                        }
                    }
                    //Move event
                    //Change value before hand
                    console.log(startDate)
                    console.log("#########################################");
                    console.log("GOOD VALUE")
                    console.log(goodValue);
                    startDate = startDate.toISOString().substring(0,10);
                    graph.childGraph.startSlider.value = goodValue;
                    
                    graph.childGraph.endSlider.value = graph.timeline.length - 1

                    graph.childGraph.startSlider.dispatchEvent(new Event('input', { bubbles: false}));
                    graph.childGraph.endSlider.dispatchEvent(new Event('input', { bubbles: false}));
                    
                    //Click event
                    graph.childGraph.startSlider.dispatchEvent(new Event('click', { bubbles: false}));
                    graph.childGraph.endSlider.dispatchEvent(new Event('click', { bubbles: false}));
                }
                //     graph.startSlider.dispatchEvent(new Event('input', { bubbles: true}));
                //     graph.endSlider.dispatchEvent(new Event('input', { bubbles: true}));
                    
                //    // Click event
                //     graph.startSlider.dispatchEvent(new Event('click', { bubbles: true}));
                //     graph.endSlider.dispatchEvent(new Event('click', { bubbles: true}));
                    

                    graph.calculateGraph(startDate, endDate, graph.type);
                    graph.displayGraph(graph.type)
                })
                buttonContainer.insertAdjacentElement("beforeend", button);
            }

            // let buttonContainer = document.createElement('div');
            // buttonContainer.classList.add("graphButtonContainer");
            // buttonsContainer.insertAdjacentElement("beforeend",buttonContainer);

            // let button = document.createElement('button')
            // button.classList.add("graphButton");
            // buttonContainer.insertAdjacentElement("beforeend", button);
            
            // buttonContainer = document.createElement('div');
            // buttonContainer.classList.add("graphButtonContainer");
            // buttonsContainer.insertAdjacentElement("beforeend",buttonContainer);
            
            // button = document.createElement('button')
            // button.classList.add("graphButton");
            // buttonContainer.insertAdjacentElement("beforeend", button);
            
            // buttonContainer = document.createElement('div');
            // buttonContainer.classList.add("graphButtonContainer");
            // buttonsContainer.insertAdjacentElement("beforeend", buttonContainer);
            
            // button = document.createElement('button')
            // button.classList.add("graphButton");
            // buttonContainer.insertAdjacentElement("beforeend", button);
        }

        this.canvasContainer = document.createElement('div');
        this.canvasContainer.classList.add("canvasContainer");
        graphPageID.insertAdjacentElement("beforeend",this.canvasContainer);
        
        
        
        let graphElement = document.createElement('canvas');

        graphElement.id = this.canvasID;

        this.canvas = graphElement 
        let canvas = this.canvas 
        console.log(graphPageID)
        // canvas.insertAdjacentElement("beforeend",graphPageID)
        //graphPageID.insertAdjacentElement("beforeend",canvas)
        this.canvasContainer.insertAdjacentElement("beforeend",canvas)

        // let dataset = document.createElement('draw-canvas-data-set');
        // dataset.setAttribute("style", "color: rbg(255, 255, 255);");
        // dataset.height = "100px"
        // dataset.width = "100px"

        // this.canvasContainer.insertAdjacentElement("beforeend", dataset);
        console.log("TYPE TYPE TYPE>" + this.type)
        if(this.type == "slider"){
            console.log("IS SLIDER");
            this.sliderOverlay = document.createElement('div');
            this.sliderOverlay.id = "sliderOverlay";
            //graphPageID.insertAdjacentElement("beforeend",this.sliderOverlay);
            this.canvasContainer.insertAdjacentElement("beforeend",this.sliderOverlay);
            this.generalOverlay = document.createElement('div');
            this.generalOverlay.id = "generalOverlay"
            this.sliderOverlay.insertAdjacentElement("beforeend",this.generalOverlay);

            let ids = ["startOverlay","gapOverlay","endOverlay"]
            
            for(let i = 0; i < ids.length; i++){
                this[ids[i]] = document.createElement('div')
                this[ids[i]].id = ids[i];
                this[ids[i]].classList.add('overlay3')
                this.generalOverlay.insertAdjacentElement("beforeend",this[ids[i]]);

            }

            ids = ["startSlider","endSlider"];

            this.graphSlidersClass = this.canvasID + 'graphSliders' 
            for(let i = 0; i < ids.length; i ++){

                this[ids[i]] = document.createElement("input");
                this[ids[i]].setAttribute("type","range");
                this[ids[i]].setAttribute("id",ids[i]);
                this[ids[i]].setAttribute("class","graphSliders");
                this[ids[i]].classList.add(this.graphSlidersClass);
                this.sliderOverlay.insertAdjacentElement("beforeend",this[ids[i]]);

            }
            console.log("THISSSSSSSSSSSSSSSSSSSSSS")
            console.log(this);
            
            
        }
        var canvasParent = canvas.parentNode;
        console.log(canvas);
        console.log(canvasParent);
        let styles = getComputedStyle(canvasParent);
            let width = parseInt(styles.getPropertyValue("width"), 10);
            let height = parseInt(styles.getPropertyValue("height"), 10);

        canvas.width = width;
        canvas.height = width/2.66
        canvasParent.setAttribute("style","height:"+canvas.height+"px");
        
        if(this.type == "slider"){
            canvas.height = width/10
        }

        this.canvasWidth = width;
        this.canvasHeight = canvas.height;
        let cview = canvas.getContext("2d");
        cview.fillStyle = "white";
        cview.fillRect(0,0,100,100);
        //this.canvasContainer.height = this.canvasHeight;
        this.canvasContainer.style.height = canvas.height;

        this.setMarginsLRTBS(0.1,0.2,0.1,0.1,"percentile");
        // var start = "2015-04-01";
        // var end = "2013-01-10";
  
        //this.calculateGraph(start, end, this.type)
        console.log(this.type);
        this.displayGraph(this.type);
        
        if(this.type == "slider"){
            var sliders = document.getElementsByClassName(this.graphSlidersClass);
            // var sliders = 
            this.setSliderBounds(sliders);
        }
        // allGraphs.push(this.canvasID);
        
        
    }

    displayGraph(type){
        
        var canvas = this.canvas.getContext('2d');
        canvas.clearRect(0, 0, canvas.width, canvas.height)
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
            console.log(this.dataType);
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
            this.displayLegend(canvas)
            this.displayAxis(canvas)
            this.displayXLabels(canvas)

        }
        
       


    }

    
    //ALL OF THESE FUNCTIONS PURELY FOR COMPLEX CALCS
    convertToDataType(data, dataType){
        if(dataType == "default"){
            // do nothing
            return;
        }

        if(dataType == "percentage"){
            for(let i = 0; i < data.length; i++){
            
                let rows = data[i];
                if(rows.length >= 1){
                    var startValue = rows[0]['stockValue']
                    rows[0]['stockValue'] = 1;
                }
                
                
                for(let k = 1; k < rows.length; k++){
                    rows[k]['stockValue'] = rows[k]['stockValue']  / startValue
                    if(k < 10){
                        console.log(rows[k]['stockValue']  / startValue)
                    }
                    
                   
                }
            }
        }
        
        if(dataType == "percentageByPeriod"){

            
        // for(this.tempTimeline.length; i++){

        // }



            for(let i = 0; i < data.length; i++){
            
                let rows = data[i];
                // if(rows.length >= 1){
                //     var startValue = rows[0]['stockValue']
                //     rows[0]['stockValue'] = 0;
                // }
                
                let savedNextValue = 0;
                savedNextValue = rows[0]['stockValue']
                let percent = 0;
                for(let k = 1; k < rows.length; k++){
                    if(k < 30){
                        
                        console.log(rows[k]['stockValue'] +" "+ rows[k-1]['stockValue'] + "K Num: " + k + "Next V"+ savedNextValue)
                        console.log((rows[k]['stockValue'] * 1  / savedNextValue) );
                        console.log()
                    }

                    percent = 1 + (-rows[k]['stockValue'] * 1  / savedNextValue)
                    savedNextValue = rows[k]['stockValue']
                    rows[k]['stockValue']  = percent;
                    
                    // rows[k]['stockValue'] = 1 + (-rows[k]['stockValue']  / rows[k-1]['stockValue'])
                    // if(k < 10){
                    //     // console.log(rows[k]['stockValue'])
                    // }
                    
                   
                }

                if(rows.length >= 1){
                    var startValue = rows[0]['stockValue']
                    savedNextValue = rows[0]['stockValue']
                    rows[0]['stockValue'] = 0;
                }
                // debugger;
            }
        }
        

        return;
    }
    
    filterDays(){

        let pointsToPlot = 50;
        let daysPerPlot = 0;

        if(this.tempTimeline <= pointsToPlot){
            daysPerPlot = 1;
        } else {
            daysPerPlot = 1 + parseInt(this.tempTimeline.length / pointsToPlot)
        }
        let cursor = [];
        let maxLength = [];
        let startedLine = []; 
        let numberOfSplices = []
        for(let x = 0; x < this.tempData.length; x++){
            cursor[x] = daysPerPlot * 2;
            maxLength[x] = this.tempData[x].length;
            startedLine[x] = false;
            numberOfSplices[x] = 0
            
            
        }


        console.log("WTF LOL");
        console.log(this.tempTimeline);
        console.log(this.tempTimeline[5056]);
        for(let i = this.tempTimeline.length - 1; i >= 0; i--){
           
            //Draw Data
            for(let x = 0; x < this.tempData.length; x++){
                let stockArray = this.tempData[x]
            
                cursor[x] += 1
                console.log(i);
                if(cursor[x] < maxLength[x] && this.tempTimeline[i]['stockDate'] == stockArray[cursor[x]]['stockDate']){
                    
                    let value = stockArray[cursor[x]]['stockValue'];
                    //probably need to have cursor start at maxLength
                    
                    if(cursor[x] != 0 || startedLine[x] == false){
                        stockArray[x].splice(maxLength[x]-1-numberOfSplices[x],1)
                        numberOfSplices[x] += 1;
                        startedLine[x] = true;
                    } else {
                        cursor = daysPerPlot;
                        //stockArray[cursor[x]]['stockValue'];
                    }
              
                  
                
                    
                   
                   
                   
                    cursor[x] = cursor[x] + 1;
                    // console.log(this.tempDataCursors);
                } else {

                }
            }
        }
    }

    getMaxData(passedData, dataType){
        var number = null;

        // dataType = "default;"
        for(let i = 0; i < passedData.length; i++){
            
            let rows = passedData[i];
            // console.log("DATATYPE:" + dataType);
            for(let k = 0; k < rows.length; k++){
                if(number != null){
                        
                    if(number < rows[k]['stockValue']){
                        number = rows[k]['stockValue'];
                    }
                } else {
                    number = rows[k]['stockValue']
                }
        
                // if(dataType == "default"){
                  
                //     if(number != null){
                    
                //         if(number < rows[k]['stockValue']){
                //             number = rows[k]['stockValue'];
                //         }
                //     } else {
                //         number = rows[k]['stockValue']
                //     }
                // }

                // if(dataType == "percentage"){
                //     // console.log("PASS PERC")
                //     if(number != null){
                        
                //         if(number < rows[k]['stockValue']){
                //             number = rows[k]['stockValue'];
                //         }
                //     } else {
                //         number = rows[k]['stockValue']
                //     }
                // }
                
                
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
            console.log("PASS1");
        }
        //If the user selects the end date to be before the data, or after the data
        //Set it to the end of the data
        if(endD > dataEndDate || endD < dataStartDate || endDate < startDate){
            endD = dataEndDate;
            console.log("PASS2");
        }
        console.log("PASS3");
        //Find the start date in the timeline
        this.startD = startD;
        this.endD = endD;

        console.log(this.startD);
        console.log(this.endD);
        function filterDates(arrayItem){
           var itemDate = new Date(arrayItem['stockDate']);

           
           if(itemDate >= startD && itemDate <= endD){
            // console.log("ItemDate: "+ itemDate);
       
            // console.log("StartD: " + startD)
            // console.log("EndD: " + endD)
               return arrayItem
           }
        }
        // console.log("stock array 0");
        // console.log(stockArray);

        for(let i = 0; i < stockArray.length; i++){
            stockArray[i] = stockArray[i].filter(filterDates);
        }
        console.log("STOCK ARRAY");
        console.log(stockArray);

    
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

    getLength(){
        
        return this.timeline.length;

    }

    moveSlider(event){
        console.log("LOL3");
    }

    clickSlider(event){
        let originalID = event.target.id
        let movedElement = document.getElementById(originalID);
        console.log(event);


        var start = this.startSlider
        var end = this.endSlider
        console.log(end);
        console.log(start);
        console.log(this);
        console.log("WTF");
        if(start ==  movedElement){
            // console.log("START ELEMENT")
            // console.log(start.value);
            // console.log(end.value);
            console.log(start.value >= end.value)
            if(parseInt(start.value) >= parseInt(end.value)){
            start.value = parse_Int(end.value) - 1;
            }
        } else {
            // console.log("END ELEMENT")
            // console.log(start.value);
            // console.log(end.value);
            if(parseInt(end.value) <= parseInt(start.value)){
                end.value = parseInt(start.value) + 1;
            }
        }
        console.log(allGraphs);

       start = this.parentGraph.getDateFromIndex(start.value)
       end = this.parentGraph.getDateFromIndex(end.value)
    //    console.log("START START START:" + start)
    //    console.log("END VALUE" + end)
    this.parentGraph.calculateGraph(start, end, type)
    this.parentGraph.displayGraph("default")
    }

    setParentGraph(parentGraph){
        this.parentGraph = parentGraph
    }

    setChildGraph(childGraph){
        this.childGraph = childGraph
    }

    setSliderBounds(sliders){
        // console.log(slider);
        for(let i = 0; i < sliders.length; i++){
            var slider = sliders.item(i);
            // slider.addEventListener("click", this.clickSlider)
            var currentGraph = this;
            slider.addEventListener("click", function(){
               // clickSlider();
               let originalID = event.target.id
                let movedElement = document.getElementById(originalID);
                console.log(event);


                var start = currentGraph.startSlider
                var end = currentGraph.endSlider
                console.log(end);
                console.log(start);
                console.log(currentGraph);
                console.log("WTF");
                if(start ==  movedElement){
                    // console.log("START ELEMENT")
                    // console.log(start.value);
                    // console.log(end.value);
                    console.log(start.value >= end.value)
                    if(parseInt(start.value) >= parseInt(end.value)){
                    start.value = parse_Int(end.value) - 1;
                    }
                } else {
                    // console.log("END ELEMENT")
                    // console.log(start.value);
                    // console.log(end.value);
                    if(parseInt(end.value) <= parseInt(start.value)){
                        end.value = parseInt(start.value) + 1;
                    }
                }
                // console.log(allGraphs);

            
            start = currentGraph.parentGraph.getDateFromIndex(start.value)
            end = currentGraph.parentGraph.getDateFromIndex(end.value)
    //    console.log("START START START:" + start)
    //    console.log("END VALUE" + end)
        currentGraph.parentGraph.calculateGraph(start, end, currentGraph.parentGraph.type)
        currentGraph.parentGraph.displayGraph("default")

            })

            slider.addEventListener("input", function(){
                let originalID = event.target.id
                let movedElement = document.getElementById(originalID);
            
                let startOverlay = currentGraph.startOverlay
                let gapOverlay = currentGraph.gapOverlay
                let endOverlay = currentGraph.endOverlay
                let generalOverlay = currentGraph.generalOverlay
    
                // let startOverlay = document.getElementById("startOverlay");
                // let gapOverlay = document.getElementById("gapOverlay");
                // let endOverlay = document.getElementById("endOverlay");
                // let generalOverlay = document.getElementById("generalOverlay");
    
    
                var start = currentGraph.startSlider
                var end = currentGraph.endSlider
                // var start = document.getElementById("startSlider");
                // var end = document.getElementById("endSlider");

                let length = currentGraph.parentGraph.getLength()
                //let length = allGraphs[0].getLength();


                // I NEED TO FIND OUT WHY THESE TWO THINGS DO NOT EQUAL THE RIGHT AMOUNT.
                // console.log("START, MOVED ELEMENT")
                // console.log(start)
                // console.log(movedElement)
                if(start ==  movedElement){
                    
                    // console.log("VALUES");
                    // console.log(end.value);
                    // console.log(start.value);
                    if(parseInt(start.value) >= parseInt(end.value)){
                    start.value = end.value - 1;
                    }
    
                    
                } else {
                    console.log("END ELEMENT")
                    if(parseInt(end.value) <= parseInt(start.value)){
                        end.value = parseInt(start.value) + 1;
                    }
                }
                let standard = "z-index: 10;"
                
                
                let sv = start.value;
                let gv = parseInt(end.value) - parseInt(start.value);
                let ev = (length - 1) - parseInt(sv) - gv;
     
              
                
                let overlayColour = "rgba(0, 99, 106, 0.57);"
    
                let sStyle = standard+"background-color: "+ overlayColour
                let gStyle = standard;
                let eStyle = standard+ "background-color: "+ overlayColour
    
                // let sStyle = "flex: " +sv+ "; "+ standard+"background-color: "+ overlayColour
                // let gStyle = "flex: " +gv+ "; "+ standard;
                // let eStyle = "flex: " +ev+ "; "+ standard+ "background-color: "+ overlayColour
    
                // let sStyle = "flex: " +sv+ "; "+ standard+"background-color: "+ overlayColour
                // let gStyle = "flex: " +gv+ "; "+ standard;
                // let eStyle = "flex: " +ev+ "; "+ standard+ "background-color: "+ overlayColour
        
                startOverlay.setAttribute("style",sStyle)
                gapOverlay.setAttribute("style",gStyle)
                endOverlay.setAttribute("style",eStyle)
         
                
                let gov = currentGraph.generalOverlay
                //let gov = document.getElementById("generalOverlay");
                
                gov.style.height= currentGraph.canvasHeight
               let lOffset = currentGraph.leftOffset
               let rOffset = currentGraph.rightOffset
               let width = currentGraph.canvasWidth;
               gov.style.width = currentGraph.canvasWidth - rOffset - lOffset;
               
        
            //     gov.style.height= allGraphs[1].canvasHeight
            //    let lOffset = allGraphs[1].leftOffset
            //    let rOffset = allGraphs[1].rightOffset
            //    let width = allGraphs[1].canvasWidth;
            //    gov.style.width = allGraphs[1].canvasWidth - rOffset - lOffset;
    
            //    console.log("OFF SETS");
            //    console.log(lOffset);
            //    console.log(rOffset);


    
                generalOverlay.style.marginRight = rOffset;
                generalOverlay.style.marginLeft = lOffset;
    
    
    
               startOverlay.style.width = sv / length * (width - lOffset - rOffset)
               gapOverlay.style.width = gv / length * (width - lOffset - rOffset)
               endOverlay.style.width = ev / length * (width - lOffset - rOffset)
            
            //    console.log("WIDTHS:" )
            //    console.log("EV: "+ev+"SV: "+ sv+ "GV: " +gv);
            //    console.log(ev + sv + ev)
               if(endOverlay.style.width <= 1){
                   endOverlay.style.width = 0;
               }
            //    console.log("COMBINED WIDTH: " + (parseInt(sv) +parseInt(gv) +parseInt(ev)))
            //    console.log("END OVERLAY WIDTH")
            //    console.log(sv);
            //    console.log(gv);
            //    console.log(ev);
            //    console.log(ev / length * (width - lOffset - rOffset));
            //    console.log("WIDTH: " + gapOverlay.style.width)
            //    console.log("DOES THIS WORK");
            //    console.log(allGraphs[1].canvasHeight)
            //    console.log(allGraphs[1].canvasWidth)
            })
            slider.setAttribute("min",0);
            //slider.setAttribute("max",this.tempTimeline.length - 1);
            slider.setAttribute("max",currentGraph.tempTimeline.length - 1);
            if(i == 0){
                slider.setAttribute("value",0)
            }

            if(i == 1){
                //slider.setAttribute("value",this.tempTimeline.length - 1)
                slider.setAttribute("value",currentGraph.tempTimeline.length - 1)
            }

            // console.log("CANVAS WIDTH: " +this.canvasWidth);
            // console.log("ACT CANVAS WIDTH: "+this.canvas.getAttribute("width"));
            var styles = "width: "+ this.canvasWidth +"px;";
            styles += "height: "+ this.canvasHeight + "px;";
            styles += " padding-right: "+ this.rightOffset+"px;";
            styles += " padding-left: "+ this.leftOffset+"px;";
            styles += " margin: "+ "0px;";
            styles += ' background-color:rgba(94, 185, 214, 0.0);';
            styles += ' z-index: 100; '

            if(i == 0){
                styles += "margin-right: 10px;";
            } else {

            }
            
            slider.setAttribute("style",styles)

            // this.generalOverlay.height = this.canvas.height;
            // console.log(this)
            // console.log("GENERAL OVERLAY GRAPH OBJ ABOVE");

            // console.log(slider);
        
            
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