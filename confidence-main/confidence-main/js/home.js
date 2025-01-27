var link = document.createElement('link');
link.setAttribute("rel", "stylesheet");
link.setAttribute("type", "text/css");
link.setAttribute("href", "css/home.css");

var head = document.querySelector("head");
head.appendChild(link);

var bodyElement = document.querySelector("body");
bodyElement.setAttribute("class", "bg-dark");