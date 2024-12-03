//Graph Managers works as an iteration tool
//To store graphs and display graphs upon request.
class GraphManager {
    constructor(){

        this.graphQueue = 0;
    }

    addGraph(graph){
        this.graphsArray.push(graph)
    }

    displayGraph(numberToDisplay){
        let i = 0;
       while(i < numberToDisplay){
        if(this.graphQueue < graphsArray.length){
            this.graphsArray[graphQueue].displayGraph()
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