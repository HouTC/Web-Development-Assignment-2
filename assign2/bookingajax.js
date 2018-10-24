// JavaScript source code
/* Tiancheng Hou, ID: 17967739
This JavaScript validates user's inputs, send booking
AJAX requests and receives booking AJAX response
*/

function getData() {
    //Get user inputs
    var cname = document.getElementById("cname").value;
    var phone = document.getElementById("phone").value;
    var unumber = document.getElementById("unumber").value;
    var snumber = document.getElementById("snumber").value;
    var sname = document.getElementById("sname").value;
    var suburb = document.getElementById("suburb").value;
    var dsurburb = document.getElementById("dsurburb").value;
    var pdate = document.getElementById("pdate").value;
    var ptime = document.getElementById("ptime").value;

    //generate current date and time
    var currentdt = new Date();
    //combine pick-up date and pick-up time together
    var pickdt = new Date(pdate + "T" + ptime);

    //validate if user inputs all the mandatory fields
    if (!cname == "" && !phone == "" && !snumber == "" && !sname == ""
        && !suburb == "" && !dsurburb == "" && !pdate == "" && !ptime == "") {

        //validate if pick-up date/time is later than current date/time.
        if (pickdt >= currentdt) {
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
                xhr.open("POST", "bookingprocess.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("cname=" + cname + "& phone=" + phone + "& unumber="
                    + unumber + "& snumber=" + snumber + "& sname=" + sname
                    + "& suburb=" + suburb + "& dsurburb=" + dsurburb + "& pdate="
                    + pdate + "& ptime=" + ptime);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById("targetPara").innerHTML = xhr.responseText;
                    } // end if
                } // end anonymous call-back function
            } // end if
        }

        else {
            alert("The pick-up date/time must be no earlier than the current date / time. ")
        }
    }

    else {
        alert("Please input all the mandatory fields.");
    }
} // end function getData()
