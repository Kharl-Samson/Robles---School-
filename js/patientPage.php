
<script>
//Adding in obstestrical history
var i = 0;
function add_obHistory(){
    i++;

    if(i<=50){
        document.getElementById("val_totalChild").innerHTML = i;

        var div1 = document.createElement('div');
        div1.setAttribute("id", 'div_test'+i)
    
        div1.innerHTML = '<p id="child_no">Child '+i+'</p>'+
        '<div id="child_inp">'+
            '<div id="col1">'+
                '<label>Gender <span style="color:red; font-size:2.5vh;">*</span></label>'+
                '<select name="child_gender[]" id="gender_obh1">'+
                    '<option value="Male">Male</option>'+
                    '<option value="Female">Female</option>'+
                '</select>'+
            '</div>'+
            '<div id="col1">'+
                '<label>Birthday <span style="color:red; font-size:2.5vh;">*</span></label>'+
                '<input type="date" id="bday" class="bday_obh1" name="child_bday[]" max="<?php echo date("Y-m-d"); ?>">'+
            '</div>'+
            '<div id="col2">'+
                '<label>Birthplace <span style="color:red; font-size:2.5vh;">*</span></label>'+
                '<input type="text"  id="bplace_obh1" placeholder="ex. Pampanga" name="birhtplace[]" class="bplace" onkeyup="hide_addpatientValidation()">'+
            '</div>'+
        '</div>'+
    
        '<div id="child_inp">'+
            '<div class="col_weight">'+
                '<label>Weight <span style="color:red; font-size:2.5vh;">*</span></label>'+
                '<div id="weight_inp">'+
                    '<input type="number" placeholder="Ex. 67" name="weight_child[]" class="child_weight" onkeyup="hide_addpatientValidation()" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==3) return false;" />'+
                    '<div>kg</div>'+
                '</div>'+
            '</div>'+
            '<div id="col1">'+
                '<label>Type of delivery <span style="color:red; font-size:2.5vh;">*</span></label>'+
                '<select name="delivery[]" id="type_delObh">'+
                    '<option value="Normal">Normal</option>'+
                    '<option value="Cesarean">Cesarean</option>'+
                '</select>'+
            '</div>'+
            '<div id="col1">'+
                '<label>Type of birth <span style="color:red; font-size:2.5vh;">*</span></label>'+
                '<select name="birthtype[]" id="type_birthObh">'+
                    '<option value="Pre-Term">Pre-Term</option>'+
                    '<option value="Post-Term">Post-Term</option>'+
                '</select>'+
            '</div>'+
        '</div>';
    
        document.getElementById("total_child_container").appendChild(div1);
    }
}


function decrease_obHistory(){
    var x = document.getElementById("val_totalChild").innerHTML;
    if(x>0){
        i--;
        document.getElementById("val_totalChild").innerHTML = i;
         var element = document. getElementById("div_test"+x);
         element.parentNode.removeChild(element);
    }
}


setInterval(function(){ 
    var gender_obHist1 = document.getElementById("gender_obHist1");
    var bday_obHist1 = document.getElementById("bday_obHist1");
    var bplace_obHist1 = document.getElementById("bplace_obHist1");
    var weight_obHist1 = document.getElementById("weight_obHist1");
    var delivery_obHist1 = document.getElementById("delivery_obHist1");
    var type_obHist1 = document.getElementById("type_obHist1");
    
    var gender_obh1 = jQuery("select[id='gender_obh1']").length

    var gender_obh1Val = document.querySelectorAll("#gender_obh1");
    var bdayobh1Val = document.querySelectorAll(".bday_obh1");
    var bplace_obh1Val = document.querySelectorAll("#bplace_obh1");
    var child_weightVal = document.querySelectorAll(".child_weight");
    var type_delObhVal = document.querySelectorAll("#type_delObh");
    var type_birthObhVal = document.querySelectorAll("#type_birthObh");

    var strGender = "";
    var strBday = "";
    var strbplace = "";
    var strWeight = "";
    var strType = "";
    var strTypeB = "";

    for(y=0 ; y<gender_obh1 ; y++){
        strGender += gender_obh1Val[y].value +",";
        strBday += bdayobh1Val[y].value +",";
        strbplace += bplace_obh1Val[y].value +"|";
        strWeight += child_weightVal[y].value +",";
        strType += type_delObhVal[y].value +",";
        strTypeB += type_birthObhVal[y].value +",";
    }
    strGender = strGender.slice(0, -1) 
    gender_obHist1.value = strGender;
    strBday = strBday.slice(0, -1);
    bday_obHist1.value = strBday;
    strbplace = strbplace.slice(0, -1);
    bplace_obHist1.value = strbplace;
    strWeight = strWeight.slice(0, -1);
    weight_obHist1.value = strWeight;
    strType = strType.slice(0, -1);
    delivery_obHist1.value = strType;
    strTypeB = strTypeB.slice(0, -1);
    type_obHist1.value = strTypeB;
}, 100);
</script>