<?php

class PageMultiGraph {

    
    private $yData = array();
    private $xData = array();

    function getData(){
        $data = [$this->xData, $this->yData];
        return $data;
    }


    function loadData($x, $y){
        $this->xData[] = $x;
        $this->yData[] = $y;
    }

    function displayGraph(){ ?>

        <script src="inc/Utilities/js/MultiGraph.js"></script>

        <script 
        src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous">
        </script>

        <div class="graphRelativesContainers">
        <div class="graphButtonsContainer">
            <button class='graphButton1' id='oneMonth' onClick="setGraph" style="">1M</button>
            <button class='graphButton1' id='sixMonths' onClick="setGraph" style="">6M</button>
            <button class='graphButton1' id='oneYear' onClick="setGraph" style="">1Y</button>
            <button class='graphButton1' id='fiveYears' onClick="setGraph" style="">5Y</button>
            <button class='graphButton1' id='max' onClick="setGraph" style="">Max</button>
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

        
        document.getElementById("oneMonth").addEventListener("click", setGraph)
        document.getElementById("sixMonths").addEventListener("click", setGraph)
        document.getElementById("oneYear").addEventListener("click", setGraph)
        document.getElementById("fiveYears").addEventListener("click", setGraph)
        document.getElementById("max").addEventListener("click", setGraph)
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


        
        // graph.moveTo(0,0);
        // graph.lineTo(100,100);
        // graph.lineTo(110,150);
        // graph.moveTo(0,0);
        // graph.lineTo(s.width,s.height);
        // graph.moveTo(-30,-0);
        // graph.lineTo(s.width,s.height);
        // graph.stroke();

       var graphXData = <?php echo json_encode($this->xData); ?>;
       var graphYData = <?php echo json_encode($this->yData); ?>;

       var multigraph = new MultiGraph(s.height,s.width,50,40,graphXData,graphYData, 100, 100,s,"numeric");
       var multigraph2 = new MultiGraph(s.height,s.width,50,40,graphXData,graphYData, 100, 100,s,"percentile");
    //      multigraph.displayButtons();
       multigraph.init();
       multigraph2.init();
    //    multigraph.graph("stockgraph");
    //    multigraph.loadTimeFilterData();
        var x = 0;
       function setGraph(event){
            buttonID = event.target.id;
            console.log(buttonID);
            focus = "";
            if(x == 0){
                
                multigraph.timeFilter(buttonID);
                console.log("THIS IS MULTIGRAPH 1")
                x += 1;
                focus = multigraph
            } else {
                multigraph2.timeFilter(buttonID);
                console.log("THIS IS MULTIGRAPH 2")
                x = 0;
                focus = multigraph2
            }

            console.log("Height: "+ focus['graphHeight']);
            console.log("Height: "+ focus['heightOffset']);
            console.log("Height: "+ focus['topOffset']);
            console.log("Graph Dif: "+ focus['graphDif']);
            
           
       }
  
    
        </script>

        

        



        <?php
    }


}

?>