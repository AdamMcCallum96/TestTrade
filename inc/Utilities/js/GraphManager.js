//Graph Managers works as an iteration tool
//To store graphs and display graphs upon request.
class GraphManager {
    constructor(id){

        //Div ID which holds all the content related to the graphs
        this.id = id;
        this.graphQueue = 0;
        this.graphsArray = [];
    }

    addGraph(graph){
       // const zeroPad = (num, places) => String(num).padStart(places, '0')

        let canvasID = String(this.graphsArray.length).padStart(4,'0');
        graph.setCanvasID((this.id+"&"+canvasID));
        graph.graphPageID = this.id;
        this.graphsArray.push(graph)
    }

    displayGraph(numberToDisplay){
        let i = 0;
       while(i < numberToDisplay){
        if(this.graphQueue < graphsArray.length){
            this.graphsArray[graphQueue].runGraph()
            this.graphQueue += 1;
        }
        i += 1;
       }
       
        
    }

    displayAllGraphs(){
        let i = 0;
        let numberToDisplay = this.graphsArray.length
        while(i < numberToDisplay){
            if(this.graphQueue < graphsArray.length){
                this.graphsArray[graphQueue].displayGraph()
                graphQueue += 1;
            }
            i += 1;
        }
    }
}