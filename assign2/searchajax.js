// JavaScript source code
/* Tiancheng Hou, ID: 17967739
This JavaScript send searching
AJAX requests and receives searching
AJAX response
*/

// this function is called when user
//click "Search pick-up request" button in the admin page
function searchData() {
    //Create XMLHttpRequest Object
    var xhr;
    if (window.XMLHttpRequest) {
        // code for modern browsers
        xhr = new XMLHttpRequest();
    }
    else {
        // code for old IE browsers
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }

    if (xhr) {
        //Send Request To Server
        xhr.open("GET", "searchprocess.php", true);
        xhr.send();

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("searchTarget").innerHTML = xhr.responseText;
            } // end if
        } // end anonymous call-back function
    } // end if
} // end function searchData()
