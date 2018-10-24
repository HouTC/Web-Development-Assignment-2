// JavaScript source code
/* Tiancheng Hou, ID: 17967739
This JavaScript send assigning
AJAX requests and receives assigning
AJAX response
*/

// this function is called when user input
//booking reference number in the admin page
function assignData() {
    //Get booking reference number
    var bref = document.getElementById("bref").value;

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
        xhr.open("POST", "assignprocess.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("bref=" + bref);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("assignTarget").innerHTML = xhr.responseText;
            } // end if
        } // end anonymous call-back function
    } // end if
} // end function assignData()
