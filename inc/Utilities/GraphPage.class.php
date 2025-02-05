<?php

class GraphPage {

    private $data; // All X/Y data
    private $timeline;  // All unique X data in sequence
    private $colours;
    private $type;
    private $id;

    function __construct($data, $timeline, $colours, $type, $id){
        $this->data = $data;
        $this->timeline = $timeline;
        $this->colours = $colours;
        $this->type = $type;
        $this->id = $id;
        $this->sliderID = "slider" . $id;
    }
    
    function getData(){
        return $this->data;
    }
    // function initialize($data){
    //     $this->data = $data;
    // }

    function initJSProperties() { ?>
    <script type="Text/JavaScript">
        var allGraphs = [];
    </script>
    <?php }

    function addGraph($data, $dates, $colours, $type, $id, $stockIDs) { ?>
    

    
    
    <script 
    src="https://code.jquery.com/jquery-3.7.0.js"
    integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous">
    </script>
    <script type="Text/JavaScript">
    {
    
        
        let data = <?php $this->data = $data ; echo json_encode($this->data); ?>;
        console.log("ADDGRAPH DATA:")
        console.log(data);
        let timeline = <?php echo json_encode($dates); ?>;
        let colours = <?php echo json_encode($colours); ?>;
        let type = <?php echo json_encode($type); ?>;
        //let stockIDs = <?php //var_dump($stockIDs);//echo json_encode($stockIDs); ?>;
        let stockIDs = <?php echo json_encode($stockIDs); ?>;
        {
        var parentGraph = gm.getLastGraph();
        console.log("stockIDS")
        console.log(stockIDs)
        var testGraph = new Graph(data, timeline, colours, type, stockIDs);
        if(type == "slider"){
            testGraph.setParentGraph(parentGraph);
            parentGraph.setChildGraph(testGraph)
        }
        
        console.log("$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$")
        console.log("testGraph")
        console.log(testGraph);
        gm.addGraph(testGraph)
        }
        
        //Just ensure every ID generates a unique ID throughout your whole program
        //For every bit of javascript created
        

        
    }
    </script>
    <?php }

    function initGraphManager($id) { 
        // var_dump($id);
        
        $test = $id;
        // var_dump($test);
        // var_dump("second dump");
        // $test = "brosef";
        // var_dump($test);
        // var_dump(json_encode($test));
        $result = json_encode($test);
        // var_dump($result);
        // var_dump(json_decode($test));
        ?>
         <script src="inc/Utilities/js/Graph.js"></script>
        <script src="inc/Utilities/js/GraphManager.js"></script>
        <script type="Text/JavaScript">
            var gm = new GraphManager(<?php echo json_encode($id);?>);
        </script>
        <!-- <div id="wtf"></div> -->
        
        <div class="graphManager" id="<?php echo $id; ?>"></div> 
        <!-- <div id="<?php echo $test; ?>">lol</div> -->
        <!-- <div id="lol">lol</div> -->
        <!-- <div id="orange" class="graphManager"></div> -->
    <?php }

    function setParentDiv($name){?>
        
        <script type="Text/Javascript">
           var id = gm.getGraphManagerID();
            let gmContainer = document.getElementById(id);
            let newParent = document.getElementById(<?php echo json_encode($name)?>)
            console.log(gmContainer)
            console.log(newParent);
            console.log("NEW PARENT IS ABOVE")
            newParent.insertAdjacentElement("afterbegin",gmContainer);
        </script>

    <?php }
    function showGraph() { ?>

        
        <!-- <script src="inc/Utilities/js/Graph.js"></script> -->

        <script 
        src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous">
        </script>
        <script type="Text/Javascript">
        console.log("GRAPH MANAGER WORKING")
        gm.displayGraph(1)</script>
    <?php }
    
    function displayGraph(){ ?>
<div class="graphRelativesContainers">
        <div class="graphButtonsContainer">
        </div>

        <!-- Canvas to display the graph on -->
        <div class="graphFlexbox">
            <div class="leftFlex">
          
        <canvas le width="20px" height="10px" id='<?php echo $this->id ?>'style='background-color: white;'></canvas>
        <!-- these were fit content for height and width before -->
        <!--  width: fit-content;-->
        <!--  position: absolute; -->
        <draw-canvas-data-set style='
        
        height: fit-content; 
        
        margin: 5px; 
        position: absolute; 
        
        
        /*left: 618px; top: 160px; opacity: 0.5; transition: all 0.5s ease 0s; color: rgb(255, 255, 255); background: rgb(3, 169, 244);  */ */
       '> 
        <!-- left: 618px; top: 160px; opacity: 0.5; transition: all 0.5s ease 0s; color: rgb(255, 255, 255); background: rgb(3, 169, 244);' -->
        </draw-canvas-data-set>
        <?php if($this->type == "slider"){?>
        <div id="sliderOverlay">
            <div id="generalOverlay">
            <div id="startOverlay" class="overlay3"></div>
            <div id="gapOverlay" class="overlay3"></div>
            <div id="endOverlay" class="overlay3"></div>
            </div>
        <!-- </div> -->
        <input type = "range" class="graphSliders" id="startSlider" min="0" max="250">
        <input type = "range" class="graphSliders" id="endSlider" min="0" max="250">
        <?php }?>
            </div>

            <div class="rightFlex">
            </div>
        <!-- </chart> -->
        </div>
        </div>

        <script type="Text/JavaScript">
        
        
        var type = <?php echo json_encode($this->type);?>

     //   $(document).ready(function() {
    // This WILL work because we are listening on the 'document', 
    // for a click on an element with an ID of #test-element
            //$(".graphSliders").on("click",function() {
              //  event.
            // alert("click bound to document listening for #test-element");
           // });

    
      //  });

        
        graphSetup(type)
        function graphSetup(type){
            
            // document.onclick() =
            s = document.getElementById("<?php echo $this->id ?>")
            canvas = s;
            var canvasParent = canvas.parentNode,
            styles = getComputedStyle(canvasParent),
            width = parseInt(styles.getPropertyValue("width"), 10),
            height = parseInt(styles.getPropertyValue("height"), 10);
            

            console.log("PARENT HEGHT: " + height);
            s.width = width;
            s.height = width/2.66;
            
            canvasParent.setAttribute("style","height:"+s.height+"px");

            if(type == "slider"){
                s.height = width/10
            }
            
            canvasParent.setAttribute("style","height:"+s.height+"px");
            var data = <?php echo json_encode($this->data); ?>;
            var timeline = <?php echo json_encode($this->timeline); ?>;
            let colours = <?php echo json_encode($this->colours); ?>;
         
            var graph<?php echo $this->id?> = new Graph(s.width, s.height, data, timeline, s, colours);
            //var type = "reg";
            
            var start = "2015-04-01";
            var end = "2013-01-10";
            
            graph<?php echo $this->id?>.setMarginsLRTBS(0.1,0.2,0.1,0.1,"percentile")
            graph<?php echo $this->id?>.calculateGraph(start, end, type);
        
           
            console.log("working?")
            //graph.setMarginsLRTBS(0,0,0,0,"default");
            graph<?php echo $this->id?>.displayGraph(type)
            if(type=="slider"){
                
                var sliders = document.getElementsByClassName("graphSliders");
               // console.log("SLIDER: " +slider.item(0));
                graph<?php echo $this->id?>.setSliderBounds(sliders)
                    
                
            }
            allGraphs.push(graph<?php echo $this->id?>);
        }
        function moveSlider(event){
            let originalID = event.target.id
            let movedElement = document.getElementById(originalID);
 

            let startOverlay = document.getElementById("startOverlay");
            let gapOverlay = document.getElementById("gapOverlay");
            let endOverlay = document.getElementById("endOverlay");
            let generalOverlay = document.getElementById("generalOverlay");


        
            var start = document.getElementById("startSlider");
            var end = document.getElementById("endSlider");
            let length = allGraphs[0].getLength();
            
            if(start ==  movedElement){
               
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
            let ev = length - parseInt(sv) - gv;
 

            
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
     
            

            let gov = document.getElementById("generalOverlay");

           gov.style.height= allGraphs[1].canvasHeight
           
           let lOffset = allGraphs[1].leftOffset
           let rOffset = allGraphs[1].rightOffset
           let width = allGraphs[1].canvasWidth;
           gov.style.width = allGraphs[1].canvasWidth - rOffset - lOffset;

           console.log("OFF SETS");
           console.log(lOffset);
           console.log(rOffset);

            generalOverlay.style.marginRight = rOffset;
            generalOverlay.style.marginLeft = lOffset;



           startOverlay.style.width = sv / length * (width - lOffset - rOffset)
           gapOverlay.style.width = gv / length * (width - lOffset - rOffset)
           endOverlay.style.width = ev / length * (width - lOffset - rOffset)
           console.log("COMBINED WIDTH: " + (parseInt(sv) +parseInt(gv) +parseInt(ev)))
           console.log("END OVERLAY WIDTH")
           console.log(sv);
           console.log(gv);
           console.log(ev);
           console.log(ev / length * (width - lOffset - rOffset));
           console.log("WIDTH: " + gapOverlay.style.width)
           console.log("DOES THIS WORK");
           console.log(allGraphs[1].canvasHeight)
           console.log(allGraphs[1].canvasWidth)

            


        }

        function clickSlider(event){

            let originalID = event.target.id
            let movedElement = document.getElementById(originalID);
            console.log(event);


            var start = document.getElementById("startSlider");
            var end = document.getElementById("endSlider");
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

           start = allGraphs[0].getDateFromIndex(start.value)
           end = allGraphs[0].getDateFromIndex(end.value)
        //    console.log("START START START:" + start)
        //    console.log("END VALUE" + end)
           allGraphs[0].calculateGraph(start, end, type)
           allGraphs[0].displayGraph("default")
           
           

        }

        // function overlaySlider(){
            
        // }
        
        
    //     var data = <?php// echo json_encode($this->data); ?>;
    //     var timeline = <?php //echo json_encode($this->timeline); ?>;
    //     var colours = <?php// echo json_encode($this->colours); ?>;
    //    // console.log(timeline);
    //     var graph<?php// echo $this->id?> = new Graph(s.width, s.height, data, timeline, s, colours);
    //     var type = "reg";
    //     var start = "2012-04-01";
    //     var end = "2013-01-10";
        
        
    //     graph<?php// echo $this->id?>.setMarginsLRTBS(0.1,0.2,0.1,0.1,"percentile")
    //     graph<?php// echo $this->id?>.calculateGraph(start, end, type);
        
    //     let type2 = "default" //default or percentile
    //     console.log("working?")
    //     //graph.setMarginsLRTBS(0,0,0,0,"default");
    //     graph<?php// echo $this->id?>.displayGraph(type2)

        

        

        // function setGraph(event){
        //     buttonID = event.target.id;
        //     console.log(buttonID);
        // }
        </script>


<?php }

    

    
}


?>