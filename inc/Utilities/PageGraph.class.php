<?php

Class PageGraph {

    static function displayGraph($xData, $yData){ ?>
        
        <!-- <script type="text/javascript" src="inc/Utilities/js/jquery.js"></script> -->
        
        <script
        src="https://code.jquery.com/jquery-3.7.0.js"
       
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
        <script type="text/javascript">
        

        // window.onload = function() {
        //     if (window.jQuery) {  
        //         // jQuery is loaded  
        //         alert("Yeah!");
        //     } else {
        //         // jQuery is not loaded
        //         alert("Doesn't Work");
        //     }
        // }

        // function loaddata()
        // {
        // var search=document.getElementById( "searchBar" );

        $(document).ready(function() {
            $("#searchBar").keyup(function() {
                // $(document).alert("lol");
                var search = $("#searchBar").val();
                console.log(search);
                
                 const url = window.location.href.split('?')[0];
                 console.log(url);
                $.post("inc/Utilities/Search.php", {
                    search_Bar:search
                    // previous_URL:url
                }, function(data, status){
                    $("#result_box").html(data);
                });
                // $("#result_box").load('inc/Utilities/Search.php');
            });
        });

        // console.log("lol1")
        // if(search)
        // {   
        // $.ajax({
        // type: 'POST',
        // // url: 'inc/Utilities/Search.php',
        // url: 'Search.php',
        // data: {
        // search_Bar:search,
        // },
        // success: function (response) {
        // // We get the element having id of display_info and put the response inside it
        //         alert(response);
        //         $( '#result_box' ).html(response);
        //     }
        //     });
        // }
            
        // else
        // {
        // $( '#result_box' ).html("Please Enter Some Words");
        // }
        // console.log("lol2");
        // }
        
        </script>
        <p>Above FILLER</p>
        <div id='result_box'></div>
        <p>FILLER BOX</p>

        

        <input id='searchBar' name='searchBar' type="text" placeholder="Search..">
        <div style="width: 500px; height: 100px; background-color: blue;">
            <button class='graphButton' id='1' onClick="setGraph" style="display: inline-block">Month</button>
            <button class='graphButton' id='2' onClick="setGraph" style="display: inline-block">Year</button>
            <button class='graphButton' id='3' onClick="setGraph" style="display: inline-block">5 Years</button>
            <button class='graphButton' id='4' onClick="setGraph" style="display: inline-block">Max</button>
        </div>
        <chart>
        <canvas le width="1100px" height="400px" id='stockgraph'style='background-color: white;'></canvas>
        <draw-canvas-data-set style='width: fit-content;
        height: fit-content; 
        padding: 5px 15px;
        margin: 5px; 
        position: absolute; 
        border-style: solid;
        border-width: 3px;
        border-color: black;  
        overflow-y: visible;  
        left: 618px; top: 160px; opacity: 0.5; transition: all 0.5s ease 0s; color: rgb(255, 255, 255); background: rgb(3, 169, 244);'>
        </draw-canvas-data-set>
        </chart>

        <script type="Text/JavaScript">
       // document.getElementById('searchBar').addEventListener("focus", searchFunction);
       // function searchFunction() {
            // this.value = 'ten';
            // document.cookie = "stockSearched = " + this.value;

            <?php 
            // $cookie = $_COOKIE["stockSearched"];
            // $start = "https://www.alphavantage.co/query?function=SYMBOL_SEARCH&keywords=";
            // $searchedValue = $cookie;
            // $end = "&apikey=RMBE8204LUUMD845";
            // $result = file_get_contents($start.$searchedValue.$end);
            ?>
            // var searchResult = <?php //echo json_encode($result);?>
            // alert(searchResult;)
            
            // $value = 
            // file_get_contents("https://www.alphavantage.co/query?function=SYMBOL_SEARCH&keywords=".$value."&apikey=RMBE8204LUUMD845")
            // alert()
        //}
        s = document.getElementById("stockgraph")
        height = s.height
        width = s.width
        graph = s.getContext('2d')
        
        //Setup Chart Data
        var dataY = <?php echo json_encode($yData);?>;
        var dataX = <?php echo json_encode($xData);?>;
        //Fill Missing Data
        // var dataY = [];
        // var dataX = [];
        // console.log(missingX)
        // for(let z = 0; z < missingX.length -2; z++){
            // currentDate = new Date(missingX[z])
            // nextDate = new Date(missingX[z + 1])
            //Push none missing Data
            // dataY.push(missingY[z])
            // dataX.push(missingX[z])
          
            // console.log(currentDate.getTime())
            
            //console.log(missingX[z]);
            // console.log("Type: "+ typeof currentDate)
            //  console.log("Current: "+ currentDate)
            //  console.log("Const: "+ currentDate.constructor.name)
            // console.log("Data: " + missingX[z])
            //Fill missing data with missing 
            // //console.log(Object.keys(currentDate));
            // noMoreDatesFound = false;
           
            //while(currentDate > nextDate && noMoreDatesFound == false) {
            // while(currentDate > nextDate) {
                //console.log(""missingX[z]);
                
              //  nextActualDate = new Date(currentDate.getTime());

               
                

                // nextActualDate.setDate(nextActualDate.getDate() - 1);
                // console.log(typeof nextActualDate)
                // console.log("Date: "+ typeof currentDate)

                // console.log("Current Date: " + currentDate)
                // console.log("Next Actual Date: "+ nextActualDate.toString())
                // console.log("Next Data: " + nextDate)
                
                
                //console.log("Current:" + currentDate.getDate())
                // if(nextActualDate > nextDate){
                    
                //     dataY.push("0")
                //     dataX.push("missing")
                //     //Change current Date
                //     currentDate = currentDate.setDate(currentDate.getDate() - 1)
                    //nextActualDate = new Date(currentDate.toString())
                    //nextActualDate = nextActualDate.setDate(nextActualDate.getDate() - 1)
            //     } else {
            //         noMoreDatesFound = true
            //     }
                
                
            // }
        
            
            
        //}
        console.log("Filled Data X");
        console.log(dataX)
        console.log("Filled Data Y");
        console.log(dataY)
        //Give 30 pixels of wiggle room between top and bottom max
        var bottomHeight = height - 30;
        //30 pixel offset from default 0 H
        var yOffset = 20;
        
        ;
        var XDestination = width
        let yPoints = new Array()
        let xPoints = new Array()
        drawGraph(dataX, dataY, dataX.length)
        
        document.getElementById("1").addEventListener("click", setGraph)
        document.getElementById("2").addEventListener("click", setGraph)
        document.getElementById("3").addEventListener("click", setGraph)
        document.getElementById("4").addEventListener("click", setGraph)

        function setChartBounds(){
            
        }

    function drawGraph(dataX, dataY, length){
        
        //dataPointWidth = (width-XOrigin) /dataY.length
        
        
        timeSlicedData = dataY.slice(0,length)
        console.log(dataY);
        console.log("break");
        console.log(timeSlicedData);
        

        var maxData = Math.max(...timeSlicedData);
        var minData = Math.min(...timeSlicedData);
        dataDifference = maxData - minData 
       

        percentageOfIncrease = (maxData - minData) / minData 


        scaler = [1, 0.2, 0.5];
        dividers = [3,4,5]
        tmax = maxData
        tmin = minData
        // tmax = 240
        // tmin = 88
        //tmax = 378
        //tmin = 90
        // tmax = 187
        // tmin = 153
        
        // tmax = 239
        // tmin = 231
        tdif = tmax - tmin
        tresults = []
        // 1 increment can be in groups of 4,5
        // 2 increment can be in groups of 3,4,5
        // 5 increment can be in groups of 3,4,5
        tscale = 0.000001
        tincrementer = []
        while(tscale < tdif/dividers[2]){
            tscale = tscale * 10
            console.log("tscale: "+tscale)
        }
        console.log("tdif/dividers for tscale: "+ tdif/dividers[2])
        for(let e = 0; e < dividers.length; e++)    {
            
            result = tdif/dividers[e]
            //for(let r = 0; r < scaler.length; r++) {
            if(result >= tscale * 0.5){
                //is a 1 increment
                tincrementer[e] = tscale 
            } else if(result >= tscale * 0.2){
                //is a 0.5 increment
                tincrementer[e] = tscale * 0.5
            } else {
                //is a 0.2 increment
                tincrementer[e] = tscale * 0.2
            }
            console.log("tincrementer: "+ tincrementer[e])
           // }
            
            console.log("tdif/dividers: "+ tdif/dividers[e])
        }

        console.log("test modulo: "+ (25 % 10))
        //chose best incrementer
        graphFloor = []
        graphCeiling = []
        graphYPoints = []
        for(let re = 0; re < tincrementer.length; re++) {
            remainder = 0
            startingNum = 0;
            // if(false == (Math.floor(minData) === minData)){
            //     //number is a decimal
            //     console.log("hit")
            //     totalDecimals = minData.toString().split(".")[1].length || 0;
            //     minDataInt = minData * 10 ** totalDecimals
            //     newIncrementer = tincrementer[re] * 10 ** totalDecimals
            //     remainder = newIncrementer % minDataInt
            //     remainder = remainder * 10 ** -totalDecimals

            // } else {
            //     remainder = tincrementer[re] % minData
            // }
            numFound = false
            console.log("tincre: " + tincrementer[re])
            console.log("mindata: " + minData)
            while(numFound == false){
                
                if(startingNum + tincrementer[re]> minData){
                    numFound = true;
                } else {
                    startingNum += tincrementer[re]
                }
            }
            remainder = tincrementer[re] % minData
            console.log("Starting Num: "+ startingNum)
            console.log(`Remainder of increment ${tincrementer[re]} mod ${minData} is ${remainder}`)//.format(tincrementer[re], minData, remainder))
            graphFloor[re] = startingNum
            graphCeiling[re] = startingNum
            //graphFloor[re] = minData - remainder
            //graphCeiling[re] = minData - remainder
            while(maxData > graphCeiling[re]){
                graphCeiling[re] += tincrementer[re]
            }
        }

        //Find lowest graph ceiling
        gFloor = 0
        gCeiling = 0
        gIncrementer = 0
        for(let le = 0; le < graphCeiling.length - 1; le ++){
            if(graphCeiling[le + 1] <= graphCeiling[le]){
                gCeiling = graphCeiling[le + 1]
                gFloor = graphFloor[le + 1]
                gIncrementer = tincrementer[le + 1]
            }
        }


        console.log("POI: " + percentageOfIncrease)
        // var maxHeightData = Math.max(...dataY.slice(0,length));
        // var minHeightData = Math.min(...dataY.slice(0,length));
        console.log("Max Height: " + maxData)
        console.log(dataX.slice(0,length))
        console.log(timeSlicedData)
        //console.log(dataY.slice(-length))
        graph.strokeStyle = "#5d80eb"
        graph.lineWidth = 2
     
        
        
      //  i = length - 1
       // x = 0
        // I need to make a number for each scale or indicate my current scale from 0.2,0.5,0.1 to max
        // if the number 
        OneFithHeight = maxData / 5
         
        cleanNumberFound = false
        
       
        //stockPercentageChange = MaxData/MinData
        //number to scale below possible stock prices world wide
        //number to scale will equal a number bigger than datadifference
        numberToScale = 0.0001
        testNumFound = false
        while(testNumFound == false){
            if (dataDifference / numberToScale >= 1){
                numberToScale = numberToScale * 10
            } else {
                //We have found the percentage scale
                testNumFound = true
            }
        }
            

        numFound = false
        cleanNumbersRange = new Array()
        cleanNumbersScale = new Array()
        
        //minGraph = minData - (minData % numberToScale)
        mod = numberToScale % minData
        minGraph = minData - (numberToScale % minData)
        console.log("numberToScale: "+ numberToScale)
        console.log("Min: "+ minData)
        console.log("Modulus: "+ mod )
        //1.10 for extra margin
        dividedAmount = dataDifference * 1.10 / 3

        // allowedDifference = 0.25
        // dividers = new Array(2,3,4,5,6)
        // IncrementsPossible = new Array(1,2,5)
        // for(let i = 0; i < dividers.length - 1; i++){

        //     dividedDataAmount = dataDifference / dividers
        //     //2
        //     //Rounds to zero, or rounded data changes the data by more than 5%
        //     if(Math.Round(dividedAmount) == 0 || Math.Round(dividedAmount) / dividedDataAmount >= 1.05){

        //     }
        
        // }
        // throw new Error("lol")
        counterArray = new Array(numberToScale/50,numberToScale/40, numberToScale/25, numberToScale/20, numberToScale/10, numberToScale/8, numberToScale/5, numberToScale/4,numberToScale/2 )
        //mustBeHigherThan = maxData - minGraph
        mustBeHigherThan = maxData
        startNum = mustBeHigherThan / 7
        endNum = mustBeHigherThan / 3 * 1.3
        console.log("MOD TEST:" + ( 21.4 % 0.2))
        console.log("Start num: "+ startNum)
        console.log("End num: " + endNum)
        console.log("Counter Array: " + counterArray)
        //throw new Error("lol")
        for(let i = 0; i < counterArray.length - 1; i++){
            //console.log("working")
            reachedEndNum = false
            numCounter = 0
            if(counterArray[i] >= startNum && counterArray[i] <= endNum){
                while(reachedEndNum == false){
                    numCounter += counterArray[i]
                   // console.log('stuck')
                    //if(counterArray[i] <= endNum){
                        if(numCounter >= mustBeHigherThan){
                          //  console.log('innerLoop')
                            reachedEndNum = true
                            // console.log("Array:" + counterArray[i])
                            // console.log("num scale:" + numberToScale)
                            cleanNumbersRange.push(numCounter)
                            cleanNumbersScale.push(counterArray[i])
                        }
                    //} else {
                       
                   // }
                }
            }
            
        }
        lowestNumber = 100000000000
        scaleNumber = 0
        for(let i = 0; i < cleanNumbersRange.length - 1; i++){
            console.log("working 2")
            if(cleanNumbersRange[i] >= mustBeHigherThan){
                if(cleanNumbersRange[i] < lowestNumber){
                    lowestNumber = cleanNumbersRange[i];
                    scaleNumber = cleanNumbersScale[i];
                }
            }
        }
        
        

    
        MaxLowerBound = dataDifference * 0.95
        MinHigherBound = dataDifference + (minData * 0.95)


        // console.log("length: "+ cleanNumbersRange.length)
        // console.log("cleanNumbers: " + cleanNumbersRange)
        // console.log("cleanNumbers Scale: " + cleanNumbersScale)
        // console.log("must be higherthan: "  + mustBeHigherThan)
        

        console.log("gIncrementer: "+ gIncrementer)
        console.log("gFloor: "+ gFloor)
        console.log("gCeiling: "+ gCeiling)

        //Find the lowest which does not exceed the lower/upper bounds by much
        xx = minGraph
        graph.strokeStyle = "blue"


        difference = gCeiling - gFloor
        increase = 0
        while(increase <= difference + gIncrementer){
           // graph.arc(25, bottomHeight - bottomHeight * ggFloor / gCeiling , 20, 0, 2 * Math.PI)
            //graph.arc(25, bottomHeight - bottomHeight * increase / difference , 20, 0, 2 * Math.PI)
            graph.textBaseline = "middle"
            graph.fillText(gFloor + increase, 0, yOffset + bottomHeight - bottomHeight * increase / difference)
            graph.stroke()
            console.log("Increase: " + increase)
            increase += gIncrementer
            if(graph.strokeStyle == 'blue'){
                graph.strokeStyle = 'red'
            }
        }

        // while(xx <= lowestNumber){
        //     graph.arc(25, bottomHeight - bottomHeight * xx / maxData , 20, 0, 2 * Math.PI)
        //     graph.stroke()
        //     xx += scaleNumber
        //     if(graph.strokeStyle == 'blue'){
        //         graph.strokeStyle = 'red'
        //     }
        // }
        console.log("Graph Range: "+ lowestNumber.toString() + "-"+xx.toString())
        console.log("Min-Max Data: "+minData.toString()+'-'+maxData.toString())
        console.log("Technical Graph Range: "+ minGraph.toString()+'-'+xx.toString())
        console.log("Y Scale: "+ scaleNumber)
        //Percentage pixel 
        var XOffset = width * 0.025
        //number of pixel offset
        //var XOffset = 25
        dataPointWidth = (width-XOffset) / length 
        x = 0
        i = length - 1
        while (i >= 0){
            //Edited height data
            //percentOfGraphBounds = parseFloat(dataY[i]) / 
            yDataHeight = yOffset + bottomHeight - bottomHeight *  ((parseFloat(dataY[i])- gFloor) / (gCeiling - gFloor))
            //yDataHeight = bottomHeight - bottomHeight * parseFloat(dataY[i]) / maxData
            xDataWidth = dataPointWidth * x;
            // console.log("gFloor: "+ gFloor)
            // console.log("gCeiling: "+ gCeiling)
            // console.log((parseFloat(dataY[i])))
            
            // console.log("Floor: "+gFloor+ " Ceiling: "+gCeiling +" Numerator: " + (parseFloat(dataY[i])- gFloor) + " Denominator: " + gCeiling)

            //"Floor: "+gFloor+ " Ceiling: "+gCeiling +" Numerator: " + (parseFloat(dataY[i])- gFloor) + " Denominator: " + gCeiling"
            //yPoints.push(yDataHeight);
            //xPoints.push(xDataWidth);
            graph.lineTo(xDataWidth + XOffset, yDataHeight);
            i -= 1;
            x += 1;
        }
        //graph.lineTo(xDataWidth, bottomHeight)
        graph.lineTo(XDestination, bottomHeight + yOffset)
        graph.lineTo(XDestination, bottomHeight - gCeiling + yOffset)
        graph.lineTo(XDestination, bottomHeight + yOffset)
        graph.lineTo(0, bottomHeight + yOffset)
        graph.moveTo(0, yOffset + bottomHeight - bottomHeight *  ((35 - gFloor) / (gCeiling - gFloor)))
        graph.lineTo(XDestination, yOffset + bottomHeight - bottomHeight *  ((35 - gFloor) / (gCeiling - gFloor)))
        graph.moveTo(0, yOffset + bottomHeight - bottomHeight *  ((30 - gFloor) / (gCeiling - gFloor)))
        graph.lineTo(XDestination, yOffset + bottomHeight - bottomHeight *  ((30 - gFloor) / (gCeiling - gFloor)))
        
        gradient = graph.createLinearGradient(0,0,0,200)
        gradient.addColorStop(0, "blue");
        gradient.addColorStop(0.9, "white");
        // gradient.addColorStop(0.5, "orange");
        // gradient.addColorStop(0.7, "black");
        graph.fillStyle = gradient;
        graph.fill()
        graph.stroke()

    }

        function setGraph(event) {
            id = event.target.id;
            console.log(id);
            
            graph.reset()
            switch(id){
                case '1':
                    drawGraph(dataX,dataY,20);
                    break;
                case '2':
                    drawGraph(dataX,dataY,252);
                    break;
                case '3':
                    drawGraph(dataX,dataY,252 * 5);
                    break;
                case '4':
                    drawGraph(dataX,dataY, dataY.length)
                    break;
            }
            

        }

    function getGraphBounds(minData, maxData){

    }    
        // function drawData(numDays){
        //     console.log(numDays);
        //     graph.reset();
        //     i = 0;
        //     while (i <= numDays - 1){
        //         graph.lineTo(xPoints[i] + 20,yPoints[i])
        //         i +=1
        //     }
        //     graph.stroke();

        // }

        
        </script>


        <?php
    }

}


?>