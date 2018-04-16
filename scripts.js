"use strict";

var urls = [];
var items = [];
var favs = [];

function del(elem) {
    var index = -1;
    favs.forEach(function(fav){
        if(fav.date.getTime() == new Date(elem.id).getTime()) {
            index = favs.indexOf(fav);
        }
    });
    favs.splice(index, 1);
    updateFavs();
}

function favorite(elem) {
    var line = '<button id="'+elem.id+'" onclick="favorite(this)"><img src="favorite.png"> Favorite</button>';
    items.forEach(function(item){
        if(item.date.getTime() == new Date(elem.id).getTime()) {
            item.htmlLine = item.htmlLine.replace(line,'<button id="'+elem.id+'" onclick="del(this)"><img src="del.png"> Remove</button>');
            favs.push(item);
        }
    });
    updateFavs();
}

function updateFavs() {
    var html = "";

    favs.sort(function(a,b){
        return b.date - a.date;
    });

    
    if (favs.length == 0) {
        html = "You haven't selected any favorites!"
    } else {
        favs.forEach(function(fav){
            html += fav.htmlLine;
        });
    }

    document.querySelector("#favorites").innerHTML = html;
}

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
        xmlLoaded(urls);
    } else {
        document.querySelector("#newsContent").innerHTML = "<p>No news content loaded.</p>";
    }
    
}

function xmlLoaded(urls){
    //console.log("obj = " +obj);
    //console.log(obj.url);
    document.querySelector("#newsContent").innerHTML = "";
    var newsItems = [];
    var count = 0;
    
    urls.forEach(function(url){
        $.get(url).done(function(obj){
            
            var items = obj.querySelectorAll("item");
            
            for (var i=0;i<items.length;i++){
                //get the data out of the item

                var newsItem = items[i];
                
                var title = newsItem.querySelector("title").firstChild.nodeValue;
                var description = newsItem.querySelector("description").firstChild.nodeValue;
                var link = newsItem.querySelector("link").firstChild.nodeValue;
                var pubDate = newsItem.querySelector("pubDate").firstChild.nodeValue;
                
                //present the item as HTML
                var line = '';
                if (url.indexOf('mlb') !== -1) {
                    line = '<div class="item" id="mlb">';
                } else if (url.indexOf('nhl') !== -1) {
                    line = '<div class="item" id="nhl">';
                } else if (url.indexOf('nfl') !== -1) {
                    line = '<div class="item" id="nfl">';
                }
                line += "<h2>"+title+"</h2>";
                line += '<p><i>'+pubDate+'</i> - <a href="'+link+'" target="_blank">See original</a></p>';
                line += '<button id="'+pubDate+'" onclick="favorite(this)"><img src="favorite.png"> Favorite</button>';
                line += "</div>";
                newsItems.push({ htmlLine: line, date: new Date(pubDate) });
            }
            count++;
            _callback(newsItems, count);  // wow this is janky
        });
    });
}

function _callback(newsItems, count) {
    if (count == urls.length) {  // yeah, THIS janky
        newsItems.sort(function(a,b){
            return b.date - a.date;
        });

        items = newsItems;

        var html = "";

        newsItems.forEach(function(item){
            html += item.htmlLine;
        });

        document.querySelector("#newsContent").innerHTML += html;
    }
}