// This file will contain functions which are used very often.
function getCookie(cname) {
  	// function will return the value of a cookie by a certain name

  	var name = cname + "=";
  	var decodedCookie = decodeURIComponent(document.cookie);
  	var ca = decodedCookie.split(';');
  
  	for(var i = 0; i <ca.length; i++) {
    	
    	var c = ca[i];
    	
    	while (c.charAt(0) == ' ') {
      	
      		c = c.substring(1);
    	}
    	if (c.indexOf(name) == 0) {
      	
      	return c.substring(name.length, c.length);
    	}
  	}
  	return "";
}

function getTechUsedString (dataObject) {
	// Will return the correct tech used string

	var techUsedString = "";

	if (dataObject["python"] == "1") { techUsedString += "PYTHON "; }
	if (dataObject["html"] == "1") { techUsedString += "HTML "; }
	if (dataObject["css"] == "1") { techUsedString += "CSS "; }
	if (dataObject["mysql"] == "1") { techUsedString += "MYSQL "; }
	if (dataObject["javascript"] == "1") { techUsedString += "JAVASCRIPT "; }
	if (dataObject["php"] == "1") { techUsedString += "PHP "; }

	// Removing space at the end so the last displayed tech wont have a comma
	techUsedString = techUsedString.trim();

	// Replacing all spaces with space and comma
	var techUsedStringFinal = techUsedString.split(" ").join(", ");
	return techUsedStringFinal;
}
