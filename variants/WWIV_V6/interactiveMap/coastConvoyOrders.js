function loadCoastConvoyOrders(convoyCoasts) {

        MyOrders.map(function(o) {
                var IA = o.interactiveMap;

                IA.setOrderPart = function(terrID, coordinates) {
                        switch (this.orderType) {
                                case "Move":
                                        this.setMove(terrID, coordinates);
                                        break;
                                case "Support hold":
                                        this.setSupportHold(terrID);
                                        break;
                                case "Support move":
                                        this.setSupportMove(terrID, coordinates);
                                        break;
                                case "Support move from":
                                        this.setSupportMoveFrom(terrID);
                                        break;
                                case "Convoy":
                                        this.setConvoy(terrID, coordinates);
                                        break;

                                case "Retreat":
                                        this.setRetreat(terrID, coordinates);
                                        break;
                        }
                };

                IA.convoyOnClick = "";

                IA.setConvoy = function(terrID, coordinates) {
                        if (Territories.get(terrID).type == "Coast" && !(convoyCoasts.include(terrID) && this.isUnitIn(terrID) && Territories.get(terrID).Unit.type == "Fleet"))
                                this.finishConvoy(terrID);
                        else {
                                if (!this.isUnitIn(terrID)) {
                                        interactiveMap.errorMessages.noUnit(terrID);
                                        return;
                                }
                                if (Territories.get(terrID).Unit.type != "Fleet") {
                                        interactiveMap.errorMessages.noFleet(terrID);
                                        return;
                                }
                                /*if(Territories.get(terrID).type != "Sea"){
                                 alert("Convoying " + interactiveMap.parameters.fleetName + " not in Sea-Territory");
                                 return;
                                 }*/
                                if (!Territories.get(terrID).Unit.getMovableTerritories().pluck('coastParentID').include(Object.isUndefined(this.convoyChain[0]) ? this.Order.Unit.terrID : this.convoyChain[this.convoyChain.length - 1])) {
                                        alert(interactiveMap.parameters.fleetName + " (" + Territories.get(terrID).name + ") not neighbor of " + (Object.isUndefined(this.convoyChain[0]) ? this.Order.Unit.Territory.name : Territories.get(this.convoyChain[this.convoyChain.length - 1]).name) + "!");
                                        return;
                                }
                                if (this.convoyChain.any(function(e) {
                                        return terrID == e;
                                })) {
                                        alert(interactiveMap.parameters.fleetName + " (" + Territories.get(terrID).name + ") already selected!");
                                        return;
                                }
                                if (!Object.isUndefined(this.convoyChain[0]))
                                        interactiveMap.insertMessage(", ");
                                else
                                        this.convoyChain = new Array();
                                this.convoyChain.push(terrID);
                                interactiveMap.insertMessage(Territories.get(terrID).name);

                                this.getTerrChoices();
                                interactiveMap.greyOut.draw(this.terrChoices);

                                if (this.convoyOnClick != "") {
                                        $("imgConvoy").writeAttribute('onClick', this.convoyOnClick);
                                        this.convoyOnClick = "";
                                }

                                if (convoyCoasts.include(terrID) && this.isUnitIn(terrID) && Territories.get(terrID).Unit.type == "Fleet")
                                        this.convoyOnClick = interactiveMap.interface.orderMenu.showFinishCoast(coordinates);
                        }
                };

                IA.finishCoastConvoy = function() {
                        this.finishConvoy(this.convoyChain.pop());
                        $("imgConvoy").writeAttribute('onClick', this.convoyOnClick);
                };
        });

}
