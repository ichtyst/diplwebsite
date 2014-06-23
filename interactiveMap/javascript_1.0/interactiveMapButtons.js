/*
 Copyright (C) 2013 Tobias Florin
 
 This file is part of the InterActive-Map mod for webDiplomacy
 
 The InterActive-Map mod for webDiplomacy is free software: you can
 redistribute it and/or modify it under the terms of the GNU Affero General
 Public License as published by the Free Software Foundation, either version
 3 of the License, or (at your option) any later version.
 
 The InterActive-Map mod for webDiplomacy is distributed in the hope
 that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 See the GNU General Public License for more details.
 
 You should have received a copy of the GNU Affero General Public License
 along with webDiplomacy. If not, see <http://www.gnu.org/licenses/>.
 */

interactiveMap.interface = new Object();

//HTML-Element where the orders, setted via the interface, are shown (and other informations as well)
interactiveMap.interface.orderLine;
//HTML-Element where completed / aborted orders are shown
interactiveMap.interface.lastOrder;

interactiveMap.interface.orderMenu = new Object();
interactiveMap.interface.options = new Object();


/*
 * creates the button interface above the map
 */
interactiveMap.interface.create = function() {
    var orderDiv = $("orderDiv"+context.memberID);
    var IAswitch = orderDiv.insertBefore(new Element('div',{'id':'IAswitch', 'class':'gamelistings-tabs'}), $('orderFormElement'));
    //create Pseudolinks to use the tab-styles
    var dropDownInterface = IAswitch.appendChild(new Element('a',{'id':'dropDownInterface','href':'#mapstore','title':'View DropDown-OrderInterface', 'class':'current', 'onclick':'return false;'})).update('DropDown-OrderInterface');
    dropDownInterface.observe('click', function(){interactiveMap.activate(false);});
    var interactiveInterface = IAswitch.appendChild(new Element('a',{'id':'IAInterface','href':'#mapstore','title':'View InteractiveMap-OrderInterface', 'onclick':'return false;'})).update('InteractiveMap-OrderInterface (loading)');
    interactiveInterface.observe('click', function(){if(interactiveMap.ready) interactiveMap.activate(true);});
    
    var IADiv = new Element('div', {'id': 'IA'});
    var saveSubmit = $('orderFormElement').childElements().find(function(e){return e.tagName === 'DIV';});
    $('orderFormElement').insertBefore(IADiv, saveSubmit).hide();
    
    saveSubmit.observe('click', function(){interactiveMap.activate(false);});    //When saved or submittet, return dropDown-Interface
    
//first row of table
    var tr1 = new Element('tr');
    var tr1td1 = tr1.appendChild(new Element('td', {'style': 'text-align:left'}));
    var tr1td2 = tr1.appendChild(new Element('td', {'style': 'text-align:center'}));
    var tr1td3 = tr1.appendChild(new Element('td', {'style': 'text-align:right'}));
    
    var resetButton = new Element("Button", {'id': 'ResetOrder', 'class':'buttonIA form-submit', 'onclick': 'interactiveMap.abortOrder();', 'disabled': 'true'}).update("Reset Order");
    tr1td1.appendChild(resetButton);
    
    tr1td2.appendChild(interactiveMap.interface.createOrderButtons());
    
    tr1td3.appendChild(new Element("Button", {'id': 'options', 'class':'buttonIA form-submit', 'onclick': 'interactiveMap.interface.options.show()', 'disabled': 'true', 'style': 'text-align:right'})).update("Options");
    tr1td3.appendChild(new Element('button',{'class':'buttonIA form-submit', 'onclick':'window.open("interactiveMap/html/help.html","_blank")'})).update("Help");
    
//second row of table
    var tr3 = new Element('tr');
    interactiveMap.interface.lastOrder = new Element('div',{'style':'text-align:center;'});
    interactiveMap.interface.lastOrder.appendChild(new Element('img', {'id': 'lastOrderSign'}));
    interactiveMap.interface.lastOrder.appendChild(new Element('span',{'id':'content', 'style':'color:rgb(68,68,68)'}).update("..."));
    interactiveMap.interface.lastOrder.hide();
    interactiveMap.interface.orderLine = new Element('p', {'id':'orderLineIA','style': 'background-color:white;text-align:left;'}).hide();
    var tr3td = tr3.appendChild(new Element('td',{'colspan':'3'}));
    tr3td.appendChild(interactiveMap.interface.orderLine);
    tr3td.appendChild(interactiveMap.interface.lastOrder);
    
    IADiv.appendChild(new Element('table', {'id': 'IAtable', 'class':'orders'})).appendChild(tr1).parentNode.appendChild(tr3);

    interactiveMap.interface.orderLine.setStyle({'height': '15px', 'overflow': 'auto'});
    
    $('mapstore').appendChild(new Element('p',{'id':'IAnotice','style':'font-weight: bold;text-align: center;'})).update('The shown orders are a PREVIEW of your currently entered orders!<br>'+((!interactiveMap.autosave)?'They are not saved immediately!':'They were saved immediately!')).hide();
};

/*
 * creates the specific order-buttons for each phase
 */
interactiveMap.interface.createOrderButtons = function() {
    var orderButtons = new Element('div',{'id':'orderButtons'});
    switch (context.phase) {
        case "Diplomacy":
            orderButtons.appendChild(new Element('button', {'id': 'hold', 'class':'buttonIA form-submit', 'onclick': 'interactiveMap.sendOrder("Hold")', 'disabled': 'true'}).update("HOLD"));
            orderButtons.appendChild(new Element('button', {'id': 'move', 'class':'buttonIA form-submit', 'onclick': 'interactiveMap.sendOrder("Move")', 'disabled': 'true'}).update("MOVE"));
            orderButtons.appendChild(new Element('button', {'id': 'sHold', 'class':'buttonIA form-submit', 'onclick': 'interactiveMap.sendOrder("Support hold")', 'disabled': 'true'}).update("SUPPORT HOLD"));
            orderButtons.appendChild(new Element('button', {'id': 'sMove', 'class':'buttonIA form-submit', 'onclick': 'interactiveMap.sendOrder("Support move")', 'disabled': 'true'}).update("SUPPORT MOVE"));
            orderButtons.appendChild(new Element('button', {'id': 'convoy', 'class':'buttonIA form-submit', 'onclick': 'interactiveMap.sendOrder("Convoy")', 'disabled': 'true'}).update("CONVOY"));
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
                interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});;

                orderMenuOpt.id = 'imgSHold';
                orderMenuOpt.src = interactiveMap.parameters.imgSHold;
                orderMenuOpt.onclick = 'interactiveMap.sendOrder("Support hold")';
                orderMenuOpt.title = 'support hold';
                interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});;

                orderMenuOpt.id = 'imgSMove';
                orderMenuOpt.src = interactiveMap.parameters.imgSMove;
                orderMenuOpt.onclick = 'interactiveMap.sendOrder("Support move")';
                orderMenuOpt.title = 'support move';
                interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});;

                orderMenuOpt.id = 'imgConvoy';
                orderMenuOpt.src = interactiveMap.parameters.imgConvoy;
                orderMenuOpt.onclick = 'interactiveMap.sendOrder("Convoy")';
                orderMenuOpt.title = 'convoy';
                interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});;
                break;
            case "Builds":
                if (MyOrders.length == 0) {
                    interactiveMap.interface.orderMenu.element.appendChild(new Element('p', {'style': 'background-color:LightGrey;border:1px solid Grey'}).update("No orders this phase!"));
                } else if (MyOrders[0].type == "Destroy") {
                    orderMenuOpt.id = 'imgDestroy';
                    orderMenuOpt.src = interactiveMap.parameters.imgDestroy;
                    orderMenuOpt.onclick = 'interactiveMap.sendOrder("Destroy")';
                    orderMenuOpt.title = 'destroy';
                    interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});;
                } else {
                    orderMenuOpt.id = 'imgBuildArmy';
                    orderMenuOpt.src = interactiveMap.parameters.imgBuildArmy;
                    orderMenuOpt.onclick = 'interactiveMap.sendOrder("Build Army")';
                    orderMenuOpt.title = 'build '+interactiveMap.parameters.armyName;
                    interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});;

                    orderMenuOpt.id = 'imgBuildFleet';
                    orderMenuOpt.src = interactiveMap.parameters.imgBuildFleet;
                    orderMenuOpt.onclick = 'interactiveMap.sendOrder("Build Fleet")';
                    orderMenuOpt.title = 'build '+interactiveMap.parameters.fleetName;
                    interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});;

                    orderMenuOpt.id = 'imgWait';
                    orderMenuOpt.src = interactiveMap.parameters.imgWait;
                    orderMenuOpt.onclick = 'interactiveMap.sendOrder("Wait")';
                    orderMenuOpt.title = 'wait/postpone build';
                    interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});;
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
                    interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});;

                    orderMenuOpt.id = 'imgDisband';
                    orderMenuOpt.src = interactiveMap.parameters.imgDisband;
                    orderMenuOpt.onclick = 'interactiveMap.sendOrder("Disband")';
                    orderMenuOpt.title = 'disband';
                    interactiveMap.interface.orderMenu.element.appendChild(new Element('img', orderMenuOpt)).observe('load',function(){interactiveMap.interface.orderMenu.showElement(this);});;
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
                if (interactiveMap.currentOrder != null) {//||(unit(interactiveMap.selectedTerritoryID)&&(Territories.get(interactiveMap.selectedTerritoryID).type=="Coast")&&(Territories.get(interactiveMap.selectedTerritoryID).Unit.type=="Army")))
                    if ((interactiveMap.currentOrder.Unit.type == "Fleet") || (Territories.get(interactiveMap.selectedTerritoryID).type != "Coast"))
                        interactiveMap.interface.orderMenu.hideElement($("imgConvoy"));
                    interactiveMap.interface.orderMenu.element.show();
                } else {
                    if ((Territories.get(interactiveMap.selectedTerritoryID).type == "Coast") && !Object.isUndefined(Territories.get(interactiveMap.selectedTerritoryID).Unit) && (Territories.get(interactiveMap.selectedTerritoryID).Unit.type == "Army")) {
                        interactiveMap.interface.orderMenu.hideElement($("imgMove"));
                        interactiveMap.interface.orderMenu.hideElement($("imgHold"));
                        interactiveMap.interface.orderMenu.hideElement($("imgSMove"));
                        interactiveMap.interface.orderMenu.hideElement($("imgSHold"));
                        interactiveMap.interface.orderMenu.showElement($("imgConvoy"));
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

interactiveMap.interface.orderMenu.showElement = function(element){
    if(element.style.display == "none"){
        element.show();
        var width = element.width;  //fix for safari which do not like element.width in the term below!
        interactiveMap.interface.orderMenu.element.style.width = (interactiveMap.interface.orderMenu.element.getWidth()+width+parseInt(element.style.marginLeft))+"px";
    }
};

interactiveMap.interface.orderMenu.hideElement = function(element){
    if(element.style.display != "none"){
        element.hide();
        interactiveMap.interface.orderMenu.element.style.width = (interactiveMap.interface.orderMenu.element.getWidth()-element.width-parseInt(element.style.marginLeft))+"px";
    }
};

/*
 * enables/disables the activate-Button
 */
interactiveMap.interface.activateButton = function() {
    interactiveMap.ready = true;
    $("IAInterface").innerHTML = "InteractiveMap-OrderInterface";
    //$("IAswitch").disabled = false;
};


/*
 * enables/disables the orderButtons
 * detects if phase is Builds and sets the orders to "wait" so the user can save at any time
 */
interactiveMap.interface.toggle = function() {
    var buttons = $("orderButtons").childNodes;
    if (interactiveMap.activated) {
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].disabled = false;
        }
        $("ResetOrder").disabled = false;
        interactiveMap.interface.orderLine.show();
        interactiveMap.interface.lastOrder.show();
        //$("largeMap").disabled = false;
        //$("greyOut").disabled = false;
        $("options").disabled = false;
        
        //$("IAswitch").innerHTML = "deactivate IA";
        $("dropDownInterface").removeClassName('current');
        $("IAInterface").addClassName('current');
        
        if (context.phase == "Builds") {
            interactiveMap.setWait();
        }
        
        $('mapstore').childElements().each(function(e){if(e.tagName === 'P') e.hide();});
        $('IAnotice').show();
        
        $('orderFormElement').childElements().find(function(e){return e.tagName === 'TABLE';}).hide(); //ORDER-TABLE
        $('IA').show();
    } else {
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].disabled = true;
        }
        $("ResetOrder").disabled = true;
        interactiveMap.interface.orderLine.hide();
        interactiveMap.interface.lastOrder.hide();
        //$("largeMap").disabled = true;
        //$("greyOut").disabled = true;
        $("options").disabled = true;
        
        //$("IAswitch").innerHTML = "activate IA";
        $("dropDownInterface").addClassName('current');
        $("IAInterface").removeClassName('current');
        
        $('mapstore').childElements().each(function(e){if(e.tagName === 'P') e.show();});
        $('IAnotice').hide();
        
        $('IA').hide();
        $('orderFormElement').childElements().find(function(e){return e.tagName === 'TABLE';}).show(); //ORDER-TABLE
    }
};

/*
 * additional options
 */
interactiveMap.interface.options.show = function() {
    if (typeof interactiveMap.interface.options.element == 'undefined')
        this.load();
    
    this.updateGreyOutIntensity();
    this.updateGreyOut();
    this.updateUnitGreyOut();
    this.updateScrollbars();
    interactiveMap.insertMessage("Options",true, true);
    
    $('options').disabled = true;
    interactiveMap.interface.options.element.show();
};

interactiveMap.interface.options.load = function(){
    function buildSlider() {
        var track = $("track");
        interactiveMap.interface.options.sliderControl = new Control.Slider(track.firstChild, track, {
            range: $R(0,1),
            sliderValue: interactiveMap.options.greyOutIntensity,
            onChange: function(value) {
                interactiveMap.options.greyOutIntensity = value;
                $("colorBox").setStyle({'backgroundColor':'rgba(0,0,0,'+interactiveMap.options.greyOutIntensity+')'});
                interactiveMap.insertMessage("grey-out intensity changed",true,true);
                interactiveMap.greyOut.cache = new Hash();            
                interactiveMap.resetOrder();
            },
            onSlide: function(value) {
                interactiveMap.options.greyOutIntensity = value;
                $("colorBox").setStyle({'backgroundColor':'rgba(0,0,0,'+interactiveMap.options.greyOutIntensity+')'});
            }
        });
    }
    
    this.element = new Element('div');

    this.element.setStyle({
        position: 'fixed',
        top: "0%",
        left: "25%",
        right: "25%",
        backgroundColor: 'LightGrey',
        zIndex: '20',
        textAlign: 'center',
        display: 'none',
        border: '10px solid black'
    });
    
    interactiveMap.interface.options.element.appendChild(new Element("h1").update("InteractiveMap Options:"));
    this.scrollbarsButton = interactiveMap.interface.options.element.appendChild(new Element("p")).appendChild(new Element("button", {'id': 'largeMap', 'class':'buttonIA form-submit'})).update("Toggle scrollbars on map");
    this.scrollbarsButton.observe('click', this.largeMap.bind(this));
        
    this.greyOutButton = interactiveMap.interface.options.element.appendChild(new Element("p")).appendChild(new Element("Button", {'id': 'greyOut', 'class':'buttonIA form-submit'}));
    this.greyOutButton.observe('click', this.greyOut.bind(this));
        
    this.greyOutOptions = interactiveMap.interface.options.element.appendChild(new Element("p",{'id':'greyOutOptions','style':'border:1px solid black'})).hide();
        
    this.greyOutUnitButton = this.greyOutOptions.appendChild(new Element("p")).appendChild(new Element("Button", {'id': 'unitGreyOut', 'class':'buttonIA form-submit'}));
    this.greyOutUnitButton.observe('click', this.unitGreyOut.bind(this));
    
    this.greyOutIntensitySlider = this.greyOutOptions.appendChild(new Element("p"));
    this.greyOutIntensitySlider.appendChild(new Element("p", {'style':'color:rgb(68,68,68)'})).update("Change grey-out intensity:");
    this.greyOutIntensitySlider.appendChild(new Element("p", {'id':'colorBox', 'style':'margin-left:auto; margin-right:auto; width:50px; height:20px; background-color:rgba(0,0,0,'+interactiveMap.options.greyOutIntensity+');'}));     
    var track = this.greyOutIntensitySlider.appendChild(new Element("div",{'id':'track', 'class':'buttonIA', 'style':'margin-left:auto; margin-right:auto; width:256px; background-color:GhostWhite; height:10px; position: relative;'}));
    track.appendChild(new Element("div",{'id':'handle', 'style':'width:10px; height:15px; background-color:Red; cursor:move; position: absolute;'}));
        
    this.closeButton = interactiveMap.interface.options.element.appendChild(new Element("p")).appendChild(new Element("Button", {'id': 'close', 'class':'buttonIA form-submit'})).update("Close");
    this.closeButton.observe('click', function(){interactiveMap.interface.options.element.hide(); $("options").disabled = false;});
    $('options').parentNode.appendChild(this.element).hide();
        
    buildSlider();
};

interactiveMap.interface.options.updateGreyOutIntensity = function(){
    this.sliderControl.setValue(interactiveMap.options.greyOutIntensity);
};

/*
 * removes scrollbars for large maps
 */
interactiveMap.interface.options.largeMap = function() {
    interactiveMap.options.scrollbars = !interactiveMap.options.scrollbars;
    this.updateScrollbars();
};

interactiveMap.interface.options.updateScrollbars = function(){
    if(interactiveMap.options.scrollbars){
        interactiveMap.visibleMap.element.setStyle({
            width: (new Number(interactiveMap.visibleMap.oldMap.width) + 10) + 'px',
            height: (new Number(interactiveMap.visibleMap.oldMap.height) + 10) + 'px',
            overflow: 'auto',
            left: '0px'
        });
    }else if(interactiveMap.visibleMap.element.style.overflow !== 'visible'){
        interactiveMap.visibleMap.element.scrollTop = 0;
        interactiveMap.visibleMap.element.scrollLeft = 0;
        var left = ((interactiveMap.visibleMap.element.up().getWidth()-interactiveMap.hiddenMap.canvasElement.width)/2-(interactiveMap.visibleMap.element.up().getWidth()-interactiveMap.visibleMap.oldMap.width)/2);
        if(-left > interactiveMap.visibleMap.element.cumulativeOffset().toArray()[0])
            left = -interactiveMap.visibleMap.element.cumulativeOffset().toArray()[0];
        interactiveMap.visibleMap.element.setStyle({
            width: interactiveMap.hiddenMap.canvasElement.width + 'px',
            height: interactiveMap.hiddenMap.canvasElement.height + 'px',
            overflow: 'visible',
            left: left+'px'
        });
    }
};


/*
 * toggles the greyOut of territories during the orders
 */
interactiveMap.interface.options.greyOut = function() {
    interactiveMap.options.greyOut = !interactiveMap.options.greyOut;
    this.updateGreyOut();
};

interactiveMap.interface.options.updateGreyOut = function(){
    if(interactiveMap.options.greyOut){
        interactiveMap.interface.options.greyOutButton.update("Deactivate territory-grey-out").disabled = false;
        interactiveMap.interface.options.greyOutOptions.show();
        interactiveMap.insertMessage("territory-grey-out activated",true,true);
        interactiveMap.resetOrder();
    } else {
        interactiveMap.interface.options.greyOutButton.update("Activate territory-grey-out");
        interactiveMap.interface.options.greyOutOptions.hide();
        interactiveMap.insertMessage("territory-grey-out deactivated",true,true);
        interactiveMap.resetOrder();
    }
};

/*
 * toggles the unitGreyOut
 */
interactiveMap.interface.options.unitGreyOut = function() {
    interactiveMap.options.unitGreyOut = !interactiveMap.options.unitGreyOut;
    this.updateUnitGreyOut();
};

interactiveMap.interface.options.updateUnitGreyOut = function(){
    if(interactiveMap.options.unitGreyOut){
        interactiveMap.interface.options.greyOutUnitButton.update("Deactivate highlighting of own units");
        interactiveMap.insertMessage("highlighting of units activated",true,true);
    }else{
        interactiveMap.interface.options.greyOutUnitButton.update("Activate highlighting of own units");
        interactiveMap.insertMessage("highlighting of units deactivated",true,true);
    }
    interactiveMap.resetOrder();
};
