class BetterMultigraph {

    
    
    //Y Axis
    
    

    //X Axis
    FilterTime

    //Provides all the graph settings
    graphType
    //Array 
    graphStockNames
    graphDate
    config

    constructor(canvasHeight, canvasWidth, heightOffset, widthOffset, XData, YData, topOffset, rightOffset, canvasID, type){
    
        this.widthOffset = widthOffset;
        this.heightOffset = heightOffset;
        this.canvasHeight = canvasHeight;
        this.canvasWidth = canvasWidth;
        this.graphHeight = canvasHeight - heightOffset -topOffset
        this.graphWidth = canvasWidth - widthOffset - rightOffset
        this.graphXLineStart = heightOffset
        this.graphYLineStart = widthOffset
        this.XData = XData
        this.YData = YData
        this.topOffset = topOffset
        this.rightOffset = rightOffset
        this.canvasID = canvasID
        this.type = type
    
    
    }


    display

}