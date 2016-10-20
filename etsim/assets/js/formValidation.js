plant={};
eloger=function(newclass,text,element){
    a=document.createElement('section');
    a.setAttribute('class',newclass);
    a.innerHTML=text;
    element.append(a);
    elementToHide=element;
    setTimeout(function(){$('.error').remove();},2000);
};
notinitprice=true;
initVolumeLookup = function(){
    if(notinitprice){
        demand=parseFloat($('.demand_power')[0].id);
        notinitprice=false;
    }
    var volumesInput=$('input[name="volumeInGame"]');
    var plantsOption=$('.ListeBoxPlants').children();
    if(typeof(plant.length)==="undefined"){
        i=plantsOption.length-1;
        while(i>-1){
            var templi=plantsOption[i].value.split('-');
            plant[plantsOption[i].id]=
                parseInt(templi[templi.length-1].match(/\d+/)[0]);
            plantsOption[i].onclick=initVolumeLookup;
            i--;
        }
    }
    oldValue=0;
    j=0;
    while(j<volumesInput.length){
        onBidVolumeChangeFunction({target:volumesInput[j] });
        volumesInput[j].onchange=onBidVolumeChangeFunction;
        j++;
    }
    volumesInput.focus(function(){
        oldValue=this.value
    })
};
initMinPriceCheck =function(maxPrice){

};

onBidVolumeChangeFunction=function(e){
    var plantsOption=$(e.target).parent().parent().find('.ListeBoxPlants');
    currentId=$('#test').index($(e.target).parent().parent());
    var currentPlantId=$(plantsOption).find(':selected')[0].id;
    plant[currentPlantId]+=parseInt(oldValue);
    if(e.target.value>plant[currentPlantId]){
        e.target.value=plant[currentPlantId];
        plant[currentPlantId]-=oldValue;
        eloger("error","you can't produce that much!",$(e.target).parent().parent())
    }
    else{
        plant[currentPlantId]-=parseInt(e.target.value);
    }
    demand+= parseFloat(oldValue);
    demand-=parseFloat(e.target.value);
    if(demand<0){
        demand+= parseFloat(e.target.value);
        demand-=parseFloat(oldValue);
        eloger("error","you can't produce more then required",$(e.target).parent().parent());
        e.target.value=oldValue
    }
    oldValue=0;
};

setUpGraph=function(legend,profit,cost){
    var ctx = document.getElementById("myChart").getContext("2d");
    var option=option={
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero : false,

        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines : true,

        //String - Colour of the grid lines
        scaleGridLineColor : "rgba(0,0,0,.05)",

        //Number - Width of the grid lines
        scaleGridLineWidth : 1,

        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,

        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,

        //Boolean - If there is a stroke on each bar
        barShowStroke : true,

        //Number - Pixel width of the bar stroke
        barStrokeWidth : 2,

        //Number - Spacing between each of the X value sets
        barValueSpacing : 5,

        //Number - Spacing between data sets within X values
        barDatasetSpacing : 1,

        //String - A legend template
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

    };
    var data = {
        labels: legend,
        datasets: [
            {
                label: "profit",
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,0.8)",
                highlightFill: "rgba(220,220,220,0.75)",
                highlightStroke: "rgba(220,220,220,1)",
                data: profit
            },
            {
                label: "cost",
                fillColor: "rgba(151,187,205,0.5)",
                strokeColor: "rgba(151,187,205,0.8)",
                highlightFill: "rgba(151,187,205,0.75)",
                highlightStroke: "rgba(151,187,205,1)",
                data: cost
            }
        ]
    };
    var myBarChart = new Chart(ctx).Bar(data,option);
};