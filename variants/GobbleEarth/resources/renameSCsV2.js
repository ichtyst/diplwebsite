Array.prototype.inArray = function (value)	{
	var i;
	for (i=0; i < this.length; i++) {
		if (this[i] == value) {
			return true;
		}
	}
	return false;
};	

function RenameSCs(homeSCs) {
	if (ordersData[0].type != "Destroy")
	{
		Territories.each(function(p){
			var t=p[1];
			if( !homeSCs.inArray(t.coastParent.name ))
			{
				t.coastParent.name = t.coastParent.name + " (colonial build)";
			}
		},this);
	}
}

