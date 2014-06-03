interactiveMap.interface.orderMenu.showFinishCoast = function(coor) {
    function getPosition(coor) {
        var width = interactiveMap.interface.orderMenu.element.getWidth();
        if (coor.x < width/2)
            return 0;
        else if (coor.x > (interactiveMap.visibleMap.mainLayer.canvasElement.width - width/2))
            return (interactiveMap.visibleMap.mainLayer.canvasElement.width - width);
        else
            return (coor.x - width/2);
    }
    
    interactiveMap.interface.orderMenu.hideElement($("imgMove"));
    interactiveMap.interface.orderMenu.hideElement($("imgHold"));
    interactiveMap.interface.orderMenu.hideElement($("imgSMove"));
    interactiveMap.interface.orderMenu.hideElement($("imgSHold"));
    
    
    var imgConvoyOnClick = $("imgConvoy").readAttribute('onClick');
    $("imgConvoy").writeAttribute('onClick','interactiveMap.currentOrder.interactiveMap.finishCoastConvoy();');
    
    interactiveMap.interface.orderMenu.showElement($("imgConvoy"));
    

    interactiveMap.interface.orderMenu.element.show();

    
    var height = interactiveMap.interface.orderMenu.element.getHeight();
    interactiveMap.interface.orderMenu.element.setStyle({
        top: (((coor.y + 25 + height)>interactiveMap.visibleMap.mainLayer.canvasElement.height)?interactiveMap.visibleMap.mainLayer.canvasElement.height-height:coor.y + 25) + 'px',
        left: getPosition(coor) + 'px'
    });
    
    return imgConvoyOnClick;
};