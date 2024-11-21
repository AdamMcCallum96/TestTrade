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
        <input type = "range" class="graphSliders" id="<?php echo $this->sliderID ?>" min="0" max="250">
        <input type = "range" class="graphSliders" id="<?php echo $this->sliderID ?>" min="0" max="250">
        <?php }?>
            </div>

            <div class="rightFlex">
            </div>
        <!-- </chart> -->
        </div>
        </div>

        <script type="Text/JavaScript">
        
        
        var type = <?php echo json_encode($this->type);?>

        $(document).ready(function() {
    // This WILL work because we are listening on the 'document', 
    // for a click on an element with an ID of #test-element
            $(".graphSliders").on("click",function() {
              //  event.
            alert("click bound to document listening for #test-element");
            });

    
        });


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
            
            var start = "2012-04-01";
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
        }
        function moveSlider(event){
            let originalID = event.target.id;
            console.log(event);
            // var sliders[]
            console.log(event.clientX)
            console.log("lol1")
            var sliders = document.getElementsByClassName("graphSliders");
            for(let i = 0; i <= sliders.length; i++){
                
            }

        }

        function clickSlider(event){

            console.log(event.target.id);
            console.log("lol2")
            // sliderID = event.target.id;
            // var sliders = []
            var sliders = document.getElementsByClassName("graphSliders");
            console.log(event.clientX);
            for(let i = 0; i <= sliders.length; i++){
                
            }

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