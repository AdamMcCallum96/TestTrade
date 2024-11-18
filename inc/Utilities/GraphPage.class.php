<?php

class GraphPage {

    private $data; // All X/Y data
    private $timeline;  // All unique X data in sequence

    function __construct($data, $timeline){
        $this->data = $data;
        $this->timeline = $timeline;
    }
    
    function getData(){
        return $this->data;
    }
    // function initialize($data){
    //     $this->data = $data;
    // }

    function displayGraph() { ?>


        <script src="inc/Utilities/js/Graph.js"></script>

        <script 
        src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous">
        </script>

<div class="graphRelativesContainers">
        <div class="graphButtonsContainer">
            <!-- <button class='graphButton1' id='oneMonth' onClick="setGraph" style="">1M</button>
            <button class='graphButton1' id='sixMonths' onClick="setGraph" style="">6M</button>
            <button class='graphButton1' id='oneYear' onClick="setGraph" style="">1Y</button>
            <button class='graphButton1' id='fiveYears' onClick="setGraph" style="">5Y</button>
            <button class='graphButton1' id='max' onClick="setGraph" style="">Max</button> -->
        </div>

        <!-- Canvas to display the graph on -->
        <div class="graphFlexbox">
            <div class="leftFlex">
            <!-- le width="1600px" height="600px" -->
        <canvas le width="20px" height="10px" id='stockgraph'style='background-color: white;'></canvas>
        <!-- these were fit content for height and width before -->
        <!--  width: fit-content;-->
        <!--  position: absolute; -->
        <draw-canvas-data-set style='
        
        height: fit-content; 
        padding: 5px 15px;
        margin: 5px; 
        position: absolute; 
        border-style: solid;
        border-width: 3px;
        border-color: black;   
        left: 618px; top: 160px; opacity: 0.5; transition: all 0.5s ease 0s; color: rgb(255, 255, 255); background: rgb(3, 169, 244); 
       '> 
        <!-- left: 618px; top: 160px; opacity: 0.5; transition: all 0.5s ease 0s; color: rgb(255, 255, 255); background: rgb(3, 169, 244);' -->
        </draw-canvas-data-set>
            </div>

            <div class="rightFlex">
            </div>
        <!-- </chart> -->
        </div>
        </div>

        <script type="Text/JavaScript">

        console.log("not broken");
        // document.getElementById("oneMonth").addEventListener("click", setGraph)
        // document.getElementById("sixMonths").addEventListener("click", setGraph)
        // document.getElementById("oneYear").addEventListener("click", setGraph)
        // document.getElementById("fiveYears").addEventListener("click", setGraph)
        // document.getElementById("max").addEventListener("click", setGraph)
        s = document.getElementById("stockgraph")
        canvas = s;
        var canvasParent = canvas.parentNode,
            styles = getComputedStyle(canvasParent),
            width = parseInt(styles.getPropertyValue("width"), 10),
            height = parseInt(styles.getPropertyValue("height"), 10);

        s.width = width;
        s.height = width/2.66;
        // height = s.height
        // width = s.width
        graph = s.getContext('2d')

        //data = Stocks[Array of stock[StockDaily Obj: stockID, stockDate, stockValue]];
        console.log("lol");
        var data = <?php echo json_encode($this->data); ?>;
        var timeline = <?php echo json_encode($this->timeline); ?>;
        console.log(timeline);
        var graph = new Graph(s.width, s.height, data, timeline, s);
        // console.log(data);
        // console.log(timeline);
        // console.log("lol");
        var type = "reg";
        var start = "2008-04-25";
        var end = "2010-02-13";
        //var end = "2017-05-13";
        graph.calculateGraph(start, end, type);

        

        

        // function setGraph(event){
        //     buttonID = event.target.id;
        //     console.log(buttonID);
        // }
        </script>


<?php }

    

    
}


?>