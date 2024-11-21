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

    constructor(canvasHeight, canvasWidth, heightOffset, widthOffset, XData, YData, this.topOffset, this.rightOffset, canvasID, type){
    
        this.widthOffset = widthOffset;
        this.heightOffset = heightOffset;
        this.canvasHeight = canvasHeight;
        this.canvasWidth = canvasWidth;
        this.graphHeight = canvasHeight - heightOffset -this.topOffset
        this.graphWidth = canvasWidth - widthOffset - this.rightOffset
        this.graphXLineStart = heightOffset
        this.graphYLineStart = widthOffset
        this.XData = XData
        this.YData = YData
        this.this.topOffset = this.topOffset
        this.this.rightOffset = this.rightOffset
        this.canvasID = canvasID
        this.type = type
    
    
    }


    display

}