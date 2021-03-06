var create_batch_modal;
var objectArray = [];
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

// display the specified tab of the form 
function showTab(tabPage) {
    var tabs = document.getElementsByClassName("tab");
    tabs[tabPage].style.display = "block";
    //fix the Previous/Next buttons
    if (tabPage === 0) {
        document.getElementById("prevBtn").style.display = "none";
        document.getElementById("batchBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (tabPage > 0 && tabPage < (tabs.length - 1)) {
        document.getElementById("batchBtn").style.display = "inline";
    } else {
        document.getElementById("batchBtn").style.display = "none";
    }
    if (tabPage === (tabs.length - 1)) {
        document.getElementById("nextBtn").style.display = "none";
        document.getElementById("submitBtn").style.display = "inline";
    } else {
        document.getElementById("nextBtn").style.display = "inline";
        document.getElementById("submitBtn").style.display = "none";
    }
    fixStepIndicator(tabPage);
}

// figure out which tab to display
function nextPrev(n) { // n = 1(next page) , n = -1 (prev page)
    var tabs = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab
    tabs[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1
    currentTab = currentTab + n;
    // if you have reached the end of the form
    if (currentTab >= tabs.length) {
        sendCreateRequest();
        return false;
    }
    // Otherwise, display the correct tab
    showTab(currentTab);
}

// deals with validation of the form fields
function validateForm() {
    var tabs , inputs , validations , i , valid = true;
    var started_at,ended_at,depart_date,return_date;
    tabs = document.getElementsByClassName("tab");
    inputs = tabs[currentTab].getElementsByTagName("input");
    validations = tabs[currentTab].getElementsByClassName("validation-msg");
    // checks every input field in the current tab
    for (i = 0; i < inputs.length; i++) {
        if (inputs[i].value == "") {
            inputs[i].className += " invalid";
            validations[i].innerHTML = "此欄位不能為空";
            valid = false;
        }
        else {
            inputs[i].classList.remove("invalid");
            validations[i].innerHTML = "";
        }
        if (inputs[i].name == "price") {
            if (isNaN(inputs[i].value)) {
                inputs[i].className += " invalid";
                validations[i].innerHTML = "此欄位須為數字";
                valid = false;
            }
        }
//        if (inputs[i].name == "started_at") {started_at = inputs[i].value; console.log('hi');}
//        if (inputs[i].name == "ended_at") {ended_at = inputs[i].value; console.log('hi');}
//        if (inputs[i].name == "depart_date") {depart_date = inputs[i].value; console.log('hi');}
//        if (inputs[i].name == "return_date") {return_date = inputs[i].value; console.log('hi');}
    }
//    if(started_at > ended_at){ // 起始日大於截止日
//        inputs[0].className += " invalid";
//        validations[0].innerHTML = "顯示起始日不能晚於截止日";
//        valid = false;
//    }else {
//        inputs[0].classList.remove("invalid");
//        validations[0].innerHTML = "";
//    }
//    if(depart_date > return_date){ // 出發日大於回程日
//        inputs[2].className += " invalid";
//        validations[2].innerHTML = "出發日不能晚於回程日";
//        valid = false;
//    }else {
//        inputs[2].classList.remove("invalid");
//        validations[2].innerHTML = "";
//    }
//    if(ended_at > depart_date){
//        inputs[1].className += " invalid";
//        validations[1].innerHTML = "顯示截止日不能晚於出發日";
//        valid = false;
//    }else{
//        inputs[1].classList.remove("invalid");
//        validations[1].innerHTML = "";
//    }
    // If the valid status is true, mark the step as finished and valid
    if (valid) {document.getElementsByClassName("step")[currentTab].className += " finish";}
    return valid;
}

// displays the correct step indicator
function fixStepIndicator(tabPage) {
    var i, steps = document.getElementsByClassName("step");
    for (i = 0; i < steps.length; i++) {
        steps[i].className = steps[i].className.replace(" active", "");
    }
    //adds the "active" class to the current step
    steps[tabPage].className += " active";
}

$('#create_batch_tickets_modal').on('show.bs.modal', function (e) {create_batch_modal = $(this); });

function sendCreateRequest(){
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '/tickets/batch/create',
        type: 'POST',
        data: JSON.stringify(objectArray),
        contentType: "json",
        processData: false,
        success: function (){
            window.location.href = '../tickets';
        },
        error: function(xhr){
            console.log(xhr.responseText);
        }
    });
}

function fillRow(){
    var region = '<td>' + create_batch_modal.find('input[name="region"]').val().trim() + '</td>';
    var started_at = '<td>' + create_batch_modal.find('input[name="started_at"]').val().trim() + '</td>';
    var ended_at = '<td>' + create_batch_modal.find('input[name="ended_at"]').val().trim() + '</td>';
    var depart_date = '<td>' + create_batch_modal.find('input[name="depart_date"]').val().trim() + '</td>';
    var return_date = '<td>' + create_batch_modal.find('input[name="return_date"]').val().trim() + '</td>';
    var price = '<td>' + create_batch_modal.find('input[name="price"]').val().trim() + '</td>';
    var row_content = region + started_at + ended_at + depart_date + return_date + price;
    $('#preview_table tbody').append('<tr>' + row_content + '</tr>');
}

function addBatch() {
    if(validateForm()){
        fillRow();
        var batchDataObject = {
            region: create_batch_modal.find('input[name="region"]').val().trim(),
            topic: create_batch_modal.find('input[name="topic"]').val().trim(),
            sales_tel: create_batch_modal.find('input[name="sales_tel"]').val().trim(),
            started_at: create_batch_modal.find('input[name="started_at"]').val().trim(),
            ended_at: create_batch_modal.find('input[name="ended_at"]').val().trim(),
            depart_date: create_batch_modal.find('input[name="depart_date"]').val().trim(),
            return_date: create_batch_modal.find('input[name="return_date"]').val().trim(),
            price: create_batch_modal.find('input[name="price"]').val().trim(),
            sales_instruction: create_batch_modal.find('input[name="sales_instruction"]').val(),
            content: '如以下輸入',
            editor_input: CKEDITOR.instances['create_batch_editor'].getData()
        };
        objectArray.push(batchDataObject);
        alert("加入一筆資料到批量!"); //JSON.stringify(batchDataObject)
    }
}