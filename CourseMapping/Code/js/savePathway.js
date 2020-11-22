//file paths:
var savepath = "users/save.php";

// Returns the server's response as to whether the save was successful.
// If tabID is given, save the pathway with that as it's key in sessionStorage
// If not, use the global variable currentTab
function save(tabID) {
    var success;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          success = xhttp.responseText;
          alert(success);
        }
    };
    xhttp.open("POST", savepath, true);
    xhttp.setRequestHeader("Content-type", "application/json");
    if(tabID) {
        var pathway = sessionStorage[tabID];
    } else {
        var pathway = sessionStorage[currentTab];
    }
    pathway["sampleContent"] = "something";
    xhttp.send(JSON.stringify(pathway));
    return success;
  }

  