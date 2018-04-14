"use strict";

var urls = [];
//var url = "http://www.espn.com/espn/rss/poker/master";

function checkBoxes(elem) {
    var url = "http://www.espn.com/espn/rss/" + elem.id + "/news";
    if(elem.checked) {
        urls.push(url);
    }
    else {
        var index = urls.indexOf(url);
        if(index > -1) {
            urls.splice(index, 1);
        }
    }
    init(urls);
}

window.onload = function(){
    init(urls);
}


function init(urls){
    if(urls.length > 0) {
        //NHL URL for ESPN RSS feed
        //console.log("Entering Init");   
        //document.querySelector("#newsContent").innerHTML = "<b>Loading news...</b>";
        //$("#newsContent").fadeOut(250);
        //fetch the data
        // for(var i=0; i<urls.length;i++)
        // {
        //     var url = urls[i];
        //     $.get(url).done(function(data){xmlLoaded(data);});
        // }
        
        xmlLoaded(urls);
        //alert(data);
    }
    else {
        document.querySelector("#newsContent").innerHTML = "<p>No news content loaded.</p>";
    }
    
}


function xmlLoaded(urls){
    //console.log("obj = " +obj);
    //console.log(obj.url);
    document.querySelector("#newsContent").innerHTML = "";
    urls.forEach(function(url){
        $.get(url).done(function(obj){
            var items = obj.querySelectorAll("item");
    
            //parse the data
            var html = "";
            for (var i=0;i<items.length;i++){
                //get the data out of the item
                var newsItem = items[i];
                var title = newsItem.querySelector("title").firstChild.nodeValue;
                //console.log(title);
                var description = newsItem.querySelector("description").firstChild.nodeValue;
                var link = newsItem.querySelector("link").firstChild.nodeValue;
                var pubDate = newsItem.querySelector("pubDate").firstChild.nodeValue;
                
                //present the item as HTML
                var line = '<div class="item">';
                line += "<h2>"+title+"</h2>";
                line += '<p><i>'+pubDate+'</i> - <a href="'+link+'" target="_blank">See original</a></p>';
                //title and description are always the same (for some reason) so I'm only including one
                //line += "<p>"+description+"</p>";
                line += "</div>";
                
                html += line;
            }
            document.querySelector("#newsContent").innerHTML += html;
        });
    });
    
        
    //$("#newsContent").fadeIn(1000);
}