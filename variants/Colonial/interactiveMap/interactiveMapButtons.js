transSibTerritories = ['28','29','30','35','39','40'];

interactiveMap.parameters.imgTSR = 'variants/ColonialOptionalRules/interactiveMap/TSR.png';
interactiveMap.parameters.imgSuez = 'variants/ColonialOptionalRules/interactiveMap/Suez.png';

interactiveMap.interface.createOrderButtons = function() {
    var orderButtons = new Element('div',{'id':'orderButtons'});
    switch (context.phase) {
        case "Diplomacy":
            orderButtons.appendChild(new Element('button', {'id': 'hold', 'class':'buttonIA form-submit', 'onclick': 'interactiveMap.sendOrder("Hold")', 'disabled': 'true'}).update("HOLD"));
            orderButtons.appendChild(new Element('button', {'id': 'move', 'class':'buttonIA form-submit', 'onclick': 'interactiveMap.sendOrder("Move")', 'disabled': 'true'}).update("MOVE"));
            orderButtons.appendChild(new Element('button', {'id': 'sHold', 'class':'buttonIA form-submit', 'onclick': 'interactiveMap.sendOrder("Support hold")', 'disabled': 'true'}).update("SUPPORT HOLD"));
            orderButtons.appendChild(new Element('button', {'id': 'sMove', 'class':'buttonIA form-submit', 'onclick': 'interactiveMap.sendOrder("Support move")', 'disabled': 'true'}).update("SUPPORT MOVE"));
            orderButtons.appendChild(new Element('button', {'id': 'convoy', 'class':'buttonIA form-submit', 'onclick': 'interactiveMap.sendOrder("Convoy")', 'disabled': 'true'}).update("CONVOY"));
            
            //added
            if(context.countryID == "6")
                orderButtons.appendChild(new Element('button', {'id': 'tsr', 'class':'buttonIA form-submit', 'onclick': 'interactiveMap.sendOrder("TSR")', 'disabled': 'true'}).update("TSR"));
            if(!Object.isUndefined(MyOrders.find(function(order){return order.Unit.terrID === "126";})))
                orderButtons.appendChild(new Element('button', {'id': 'suez', 'class':'buttonIA form-submit', 'onclick': 'interactiveMap.sendOrder("Suez")', 'disabled': 'true'}).update("USE SUEZ"));
            
            break;
        case "Builds":
            if (MyOrders.length == 0) {
                orderButtons.appendChild(new Element('p').update("No orders this phase!"));
            } else if (MyOrders[0].type == "Destroy") {
                orderButtons.appendChild(new Element('button', {'id': 'destroy', 'class':'buttonIA form-submit', 'onclick': 'interactiveMap.sendOrder("Destroy")', 'disabled': 'true'}).update("DESTROY"));
            } else {
                orderButtons.appendChild(new Element('button', {'id': 'buildArmy', 'class':'buttonIA form-submit', 'onclick': 'interactiveMap.sendOrder("Build Army")', 'disabled': 'true'}).update("BUILD "+interactiveMap.parameters.armyName.toUpperCase()));
                orderButtons.appendChild(new Element('button', {'id': 'buildFleet', 'class':'buttonIA form-submit', 'onclick': 'interactiveMap.sendOrder("Build Fleet")', 'disabled': 'true'}).update("BUILD "+interactiveMap.parameters.fleetName.toUpperCase()));
                orderButtons.appendChild(new Element('button', {'id': 'wait', 'class':'buttonIA form-submit', 'onclick': 'interactiveMap.sendOrder("Wait")', 'disabled': 'true'}).update("WAIT"));
            }
            break;
        case "Retreats":
            if (MyOrders.length == 0) {
                orderButtons.appendChild(new Element('p').update("No orders this phase!"));
            } else {
                orderButtons.appendChild(new Element('button', {'id': 'retreat', 'class':'buttonIA form-submit', 'onclick': 'interactiveMap.sendOrder("Retreat")', 'disabled': 'true'}).update("RETREAT"));
                orderButtons.appendChild(new Element('button', {'id': 'disband', 'class':'buttonIA form-submit', 'onclick': 'interactiveMap.sendOrder("Disband")', 'disabled': 'true'}).update("DISBAND"));
            }
    }
    return orderButtons;
};


/*
 * creates the menu that appears when a user clicks on the map
 */
interactiveMap.interface.orderMenu.create = function() {
    if (typeof interactiveMap.interface.orderMenu.element == "undefined") {
        interactiveMap.interface.orderMenu.element = new Element('div', {'id': 'orderMenu'});
        interactiveMap.interface.orderMenu.element.setStyle({
            position: 'absolute',
            zIndex: interactiveMap.visibleMap.greyOutLayer.canvasElement.style.zIndex + 1,
            width: '10px'
            //width: '200px'
                    //backgroundColor: 'white'
        });
        var orderMenuOpt = {
            'id': '',
            'src': '',
            'title': '',
            'style': 'margin-left:5px;\n\
                background-color:LightGrey;\n\
                border:1px solid Grey;\n\
                display:none;',
            'onmouseover': 'this.setStyle({"backgroundColor":"GhostWhite"})',
            'onmouseout': 'this.setStyle({"backgroundColor":"LightGrey"})',
            'onmousedown': 'this.setStyle({"backgroundColor":"LightBlue"})',
            'onmouseup': 'interactiveMap.interface.orderMenu.element.hide()',
            'onclick': ''
        };

        switch (context.phase) {
            case "Diplomacy":
                orderMenuOpt.id = 'imgHold';
                orderMenuOpt.src = interactiveMap.parameters.imgHold;
                orderMenuOpt.onclick = 'interactiveMap.sendOrder("Hold")';
                orderMenuOpt.title = 'hold';
                interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});

                orderMenuOpt.id = 'imgMove';
                orderMenuOpt.src = interactiveMap.parameters.imgMove;
                orderMenuOpt.onclick = 'interactiveMap.sendOrder("Move")';
                orderMenuOpt.title = 'move';
                interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});

                orderMenuOpt.id = 'imgSHold';
                orderMenuOpt.src = interactiveMap.parameters.imgSHold;
                orderMenuOpt.onclick = 'interactiveMap.sendOrder("Support hold")';
                orderMenuOpt.title = 'support hold';
                interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});

                orderMenuOpt.id = 'imgSMove';
                orderMenuOpt.src = interactiveMap.parameters.imgSMove;
                orderMenuOpt.onclick = 'interactiveMap.sendOrder("Support move")';
                orderMenuOpt.title = 'support move';
                interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});

                orderMenuOpt.id = 'imgConvoy';
                orderMenuOpt.src = interactiveMap.parameters.imgConvoy;
                orderMenuOpt.onclick = 'interactiveMap.sendOrder("Convoy")';
                orderMenuOpt.title = 'convoy';
                interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});
                
                orderMenuOpt.id = 'imgTSR';
                orderMenuOpt.src = interactiveMap.parameters.imgTSR;
                orderMenuOpt.onclick = 'interactiveMap.sendOrder("TSR")';
                orderMenuOpt.title = 'Trans-Siberian Railroad (TSR)';
                interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});
                
                orderMenuOpt.id = 'imgSuez';
                orderMenuOpt.src = interactiveMap.parameters.imgSuez;
                orderMenuOpt.onclick = 'interactiveMap.sendOrder("Suez")';
                orderMenuOpt.title = 'use Suez Canal';
                interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});
                break;
            case "Builds":
                if (MyOrders.length == 0) {
                    interactiveMap.interface.orderMenu.element.appendChild(new Element('p', {'style': 'background-color:LightGrey;border:1px solid Grey'}).update("No orders this phase!"));
                } else if (MyOrders[0].type == "Destroy") {
                    orderMenuOpt.id = 'imgDestroy';
                    orderMenuOpt.src = interactiveMap.parameters.imgDestroy;
                    orderMenuOpt.onclick = 'interactiveMap.sendOrder("Destroy")';
                    orderMenuOpt.title = 'destroy';
                    interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});
                } else {
                    orderMenuOpt.id = 'imgBuildArmy';
                    orderMenuOpt.src = interactiveMap.parameters.imgBuildArmy;
                    orderMenuOpt.onclick = 'interactiveMap.sendOrder("Build Army")';
                    orderMenuOpt.title = 'build '+interactiveMap.parameters.armyName;
                    interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});

                    orderMenuOpt.id = 'imgBuildFleet';
                    orderMenuOpt.src = interactiveMap.parameters.imgBuildFleet;
                    orderMenuOpt.onclick = 'interactiveMap.sendOrder("Build Fleet")';
                    orderMenuOpt.title = 'build '+interactiveMap.parameters.fleetName;
                    interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});

                    orderMenuOpt.id = 'imgWait';
                    orderMenuOpt.src = interactiveMap.parameters.imgWait;
                    orderMenuOpt.onclick = 'interactiveMap.sendOrder("Wait")';
                    orderMenuOpt.title = 'wait/postpone build';
                    interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});
                }
                break;
            case "Retreats":
                if (MyOrders.length == 0) {
                    interactiveMap.interface.orderMenu.element.appendChild(new Element('p', {'style': 'background-color:LightGrey;border:1px solid Grey'}).update("No orders this phase!"));
                } else {
                    orderMenuOpt.id = 'imgRetreat';
                    orderMenuOpt.src = interactiveMap.parameters.imgRetreat;
                    orderMenuOpt.onclick = 'interactiveMap.sendOrder("Retreat")';
                    orderMenuOpt.title = 'retreat';
                    interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});

                    orderMenuOpt.id = 'imgDisband';
                    orderMenuOpt.src = interactiveMap.parameters.imgDisband;
                    orderMenuOpt.onclick = 'interactiveMap.sendOrder("Disband")';
                    orderMenuOpt.title = 'disband';
                    interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});
                }
        }
        $('mapCanDiv').appendChild(interactiveMap.interface.orderMenu.element).hide();
        
                    
        //var orderMenuElements = $A(interactiveMap.interface.orderMenu.element.childNodes);
        
        //orderMenuElements.each(function(element){element.hide(); interactiveMap.interface.orderMenu.showElement(element);});
    }
};

/*
 * adds the needed options and make the orderMenu visible
 */
interactiveMap.interface.orderMenu.show = function(coor) {
    function getPosition(coor) {
        var width = interactiveMap.interface.orderMenu.element.getWidth();
        if (coor.x < width/2)
            return 0;
        else if (coor.x > (interactiveMap.visibleMap.mainLayer.canvasElement.width - width/2))
            return (interactiveMap.visibleMap.mainLayer.canvasElement.width - width);
        else
            return (coor.x - width/2);
    }

    switch (context.phase) {
        case 'Builds':
            if (MyOrders.length != 0) {
                if (MyOrders[0].type == "Destroy") {
                    if (interactiveMap.currentOrder != null) {
                        interactiveMap.interface.orderMenu.element.show();
                    }
                } else {
                    var SupplyCenter = SupplyCenters.detect(function(sc){return sc.id == interactiveMap.selectedTerritoryID});
                    if ((!Object.isUndefined(SupplyCenter)) && (!interactiveMap.isUnitIn(interactiveMap.selectedTerritoryID))) {
                        if (SupplyCenter.type != "Coast")
                            interactiveMap.interface.orderMenu.hideElement($("imgBuildFleet"));
                        else
                            interactiveMap.interface.orderMenu.showElement($("imgBuildFleet"));
                        interactiveMap.interface.orderMenu.element.show();
                    }
                }
            }
            break;
        case 'Diplomacy':
            interactiveMap.interface.orderMenu.showElement($("imgMove"));
            interactiveMap.interface.orderMenu.showElement($("imgHold"));
            interactiveMap.interface.orderMenu.showElement($("imgSMove"));
            interactiveMap.interface.orderMenu.showElement($("imgSHold"));
            interactiveMap.interface.orderMenu.showElement($("imgConvoy"));
            interactiveMap.interface.orderMenu.showElement($("imgTSR"));
            interactiveMap.interface.orderMenu.showElement($("imgSuez"));    
                if (interactiveMap.currentOrder != null) {//||(unit(interactiveMap.selectedTerritoryID)&&(Territories.get(interactiveMap.selectedTerritoryID).type=="Coast")&&(Territories.get(interactiveMap.selectedTerritoryID).Unit.type=="Army")))
                    if ((interactiveMap.currentOrder.Unit.type == "Fleet") || (Territories.get(interactiveMap.selectedTerritoryID).type != "Coast"))
                        interactiveMap.interface.orderMenu.hideElement($("imgConvoy"));
                        
                    //added
                    if ((interactiveMap.currentOrder.Unit.type == "Fleet") || interactiveMap.currentOrder.Unit.countryID != "6" || !transSibTerritories.include(interactiveMap.selectedTerritoryID))
                            interactiveMap.interface.orderMenu.hideElement($("imgTSR"));
                    
                    if(!['99','101'].include(interactiveMap.selectedTerritoryID) || Object.isUndefined(MyOrders.find(function(order){return order.Unit.terrID === "126";})))
                            interactiveMap.interface.orderMenu.hideElement($("imgSuez"));
                    
                    interactiveMap.interface.orderMenu.element.show();
                } else {
                    if ((Territories.get(interactiveMap.selectedTerritoryID).type == "Coast") && !Object.isUndefined(Territories.get(interactiveMap.selectedTerritoryID).Unit) && (Territories.get(interactiveMap.selectedTerritoryID).Unit.type == "Army")) {
                        interactiveMap.interface.orderMenu.hideElement($("imgMove"));
                        interactiveMap.interface.orderMenu.hideElement($("imgHold"));
                        interactiveMap.interface.orderMenu.hideElement($("imgSMove"));
                        interactiveMap.interface.orderMenu.hideElement($("imgSHold"));
                        interactiveMap.interface.orderMenu.hideElement($("imgTSR"));
                        interactiveMap.interface.orderMenu.hideElement($("imgSuez"));
                        interactiveMap.interface.orderMenu.showElement($("imgConvoy"));
                        interactiveMap.interface.orderMenu.element.show();
                    }
                    //added
                    else if (['99','101'].include(interactiveMap.selectedTerritoryID) && !Object.isUndefined(Territories.get(interactiveMap.selectedTerritoryID).Unit) && !Object.isUndefined(MyOrders.find(function(order){return order.Unit.terrID === "126";}))){
                        interactiveMap.interface.orderMenu.hideElement($("imgMove"));
                        interactiveMap.interface.orderMenu.hideElement($("imgHold"));
                        interactiveMap.interface.orderMenu.hideElement($("imgSMove"));
                        interactiveMap.interface.orderMenu.hideElement($("imgSHold"));
                        interactiveMap.interface.orderMenu.hideElement($("imgTSR"));
                        interactiveMap.interface.orderMenu.showElement($("imgSuez"));
                        interactiveMap.interface.orderMenu.hideElement($("imgConvoy"));
                        interactiveMap.interface.orderMenu.element.show();    
                    }
                }
            break;
        case 'Retreats':
            if (MyOrders.length != 0) {
                if (interactiveMap.currentOrder != null)
                    interactiveMap.interface.orderMenu.element.show();
            }
            break;
    }
    
    var height = interactiveMap.interface.orderMenu.element.getHeight();
    interactiveMap.interface.orderMenu.element.setStyle({
        top: (((coor.y + 25 + height)>interactiveMap.visibleMap.mainLayer.canvasElement.height)?interactiveMap.visibleMap.mainLayer.canvasElement.height-height:coor.y + 25) + 'px',
        left: getPosition(coor) + 'px'
    });
};