<?php

Class Page {

    static function header() { ?>
        <!DOCTYPE html>
        <html>
            <title>Mock Stock </title>
            <body>
    <?php } 


    static function body() {?>
            <canvas></canvas>
            <script type="Text/JavaScript">
            let cx = document.querySelector("canvas").getContext("2d");
            cx.strokeStyle = "blue";
            cx.strokeRect(5, 5, 50, 50);
            cx.lineWidth = <?php echo 10 ?>;
            //cx.strokeRect(135, 5, 50, 50);
            cx.strokeRect(<?php echo 135?>, <?php echo 10?>, <?php echo 50?>, <?php echo 50?>);
            </script>
    <?php } 

    static function testGraph($testX, $testY) { ?>

        <div style='width: 700px; height: 400px; color: green;'>
        <input id='searchBar'type="text" placeholder="Search.." 
        style='height: 200px; width: 500px;'>
        </div>
        
        <chart>
        <canvas le width="700px" height="400px"></canvas>
        <draw-canvas-data-set style='width: fit-content;
        height: fit-content; 
        padding: 5px 15px;
        margin: 5px; 
        position: absolute; 
        left: 618px; top: 160px; opacity: 0; transition: all 0.5s ease 0s; color: rgb(255, 255, 255); background: rgb(3, 169, 244);'>
        </draw-canvas-data-set>
        </chart>
        <script type="Text/JavaScript">
        document.getElementById('searchBar').addEventListener("focus", searchFunction);
        // document.getElementById('searchBar').addEventListener("focus")
        function searchFunction() {
            alert("lol");
        }
        c = document.querySelector("canvas[le]")
        h = c.height
        w = c.width
        ctx = c.getContext('2d')
       
        console.log(<?php echo json_encode($testX, JSON_HEX_TAG);?>);
        var dataY = <?php echo json_encode($testY);?>;
        var dataX = <?php echo json_encode($testX);?>;
        console.log(dataX)
        //var test = <?php# echo $testX?>
        //dataY = ["Friday","Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday"]

        console.log(dataY)
        //dataX = [100,150,160,250,260,300,360]
        console.log(dataX)

        // un = Math.round(Math.max(...dataX)/15)
        un = Math.round((Math.max(...dataX)-Math.min(...dataX))/10)
        ys = (w-40)/dataY.length
        dataT = []

        chartLine()
        digram()
        data()
        draw()
        pointes()
        function digram(){
            y = 60
            x = 1
            ctx.strokeStyle = "#a7a7a7"
            while(y < w){
                ctx.beginPath()
                ctx.moveTo(y,0)
                ctx.lineTo(y,h-30)
                ctx.stroke()
                y += 30
            }
            while(x < h-30){
                ctx.beginPath()
                ctx.moveTo(60,x)
                ctx.lineTo(w,x)
                ctx.stroke()
                x += 30
            }
        }
        function chartLine() {
            ctx.strokeStyle = "#000"
            ctx.beginPath()
            ctx.moveTo(60,0)
            ctx.lineTo(60,h-30)
            ctx.stroke()

            ctx.beginPath()
            ctx.moveTo(w,h-30)
            ctx.lineTo(60,h-30)
            ctx.stroke()
        }

        function draw() {
            ctx.save()
            ctx.strokeStyle = "#460dd9"
            ctx.lineWidth = 3
            ctx.lineCap = 'square'
            ctx.beginPath()
            // ctx.lineJoin = "round";
            y = 60
            height = h-30
            line = 30
            start = 30
            // ctx.moveTo(60, h-30);
            for(data of dataX){
                max = Math.max(...dataX),
                
                test = 30;
                // while (max > data){
                //     max = max - 1
                //     test += line/un
                    
                // }
               // test = data
               //400 height = 0 price
               // 0 height = max price
                //amount = data/max * height
                //30 = max
                console.log(data)
                console.log(max)
                amount = (data/max * 340) + -30
                ctx.lineTo(30+y,amount)
                x = 30
                y += ys
            }
            ctx.stroke()
            ctx.restore()
        }
        function pointes() {
            ctx.fillStyle = "#0b95d3"
            y = 60
            height = h-30
            line = 30
            start = 30
            for (data of dataX) {
                max = Math.max(...dataX),
                    test = 30;
                while (max > data) {
                    max = max - 1
                    test += line / un
                }
                circle(30 + y, test)
                dataT.push({ data : Math.round(test) + "," + Math.round(30 + y) +","+Math.round(data)})
                x = 30
                y += ys
            }
            ctx.stroke()
        }
        function data() {
            y = 60
            x = 30
            n = Math.max(...dataX)
            for(ydata of dataY){
                ctx.font = "12px Arial";
                ctx.fillText(ydata, y,h-10);
                y += ys
            }
            while(x < h-30){
                ctx.font = "11px Arial";
                ctx.fillText(n, 0,x+5);
                n = n -un
                x += 30
            }
            
        }

        function circle(x,y) {
            ctx.beginPath();
            ctx.arc(x,y,0, 0, 2 * Math.PI);
            ctx.fill()
        
        }


        // c.onmousemove = function(e){
        //     for(let data of dataT){
        //         for (const [key, value] of Object.entries(data)) {
        //             let dataG = value.split(","),
        //             lx = e.layerX,
        //             ly = e.layerY,
        //             dx = dataG[1],
        //             dy = dataG[0]
        //                 if (range(dx-10,Math.floor(dx)+10).includes(lx) && range(dy-10,Math.floor(dy)+10).includes(ly)) {
        //                     $('draw-canvas-data-set').innerHTML = dataG[2]
        //                     $('draw-canvas-data-set').style.opacity = "1"
        //                     $('draw-canvas-data-set').style.left = e.clientX + "px"
        //                     $('draw-canvas-data-set').style.top = e.clientY + "px"
        //                 } if (range(dx-10,Math.floor(dx)+10).includes(lx) && !range(dy-10,Math.floor(dy)+10).includes(ly)) {
        //                     $('draw-canvas-data-set').style.opacity = "0"
        //                 }
        //                 lx = lx -1
        //                 dx = dx -1
        //         }
        //     }
        // }

        function range(start, end) {
            let range = [...Array(end + 1).keys()].filter(value => end >= value && start <= value );
            return range
        }
        function $(object){
            return document.querySelector(object);
        }
                </script>
            <?php } 

    static function footer() {?>
            </body>
        </html>
    <?php } 
    
}

?>