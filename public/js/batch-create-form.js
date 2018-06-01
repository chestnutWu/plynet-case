var create_batch_modal;
var objectArray = [];
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

// This function will display the specified tab of the form 
function showTab(n) {
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //fix the Previous/Next buttons:
    if (n === 0) {
        document.getElementById("prevBtn").style.display = "none";
        document.getElementById("batchBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n === (x.length - 1)) {
        document.getElementById("nextBtn").style.display = "none";
        document.getElementById("batchBtn").style.display = "inline";
        document.getElementById("submitBtn").style.display = "inline";
    } else {
        document.getElementById("nextBtn").style.display = "inline";
        document.getElementById("submitBtn").style.display = "none";
    }
    // run a function that displays the correct step indicator:
    fixStepIndicator(n);
}

// This function will figure out which tab to display
function nextPrev(n) {
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :
    if (currentTab >= x.length) {
        //the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

// This function deals with validation of the form fields
function validateForm() {
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false:
            valid = false;
        }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
}

// This function removes the "active" class of all steps...
function fixStepIndicator(n) {
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //adds the "active" class to the current step:
    x[n].className += " active";
}

$('#create_batch_tickets_modal').on('show.bs.modal', function (e) {create_batch_modal = $(this); });
function cleanField() {
    create_batch_modal.find('input[name="started_at"]').val("");
    create_batch_modal.find('input[name="ended_at"]').val("");
    create_batch_modal.find('input[name="depart_date"]').val("");
    create_batch_modal.find('input[name="return_date"]').val("");
    create_batch_modal.find('input[name="price"]').val("");
    create_batch_modal.find('input[name="sales_instruction"]').val("");
    CKEDITOR.instances['create_batch_editor'].setData("");
}

function removeRow() {
    $("#preview_table").on('click', '.remove', function () {
        $(this).closest('tr').remove();
    });
}

function sendCreateRequest(){
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '/tickets/batch/create',
        type: 'POST',
        data: objectArray,
        success: function (){
            //window.location.href = '../tickets';
        },
        error: function(xhr){
            console.log(xhr.responseText);
        }
    });
}

function addBatch() {
    var started_at = '<td>' + create_batch_modal.find('input[name="started_at"]').val().trim() + '</td>';
    var ended_at = '<td>' + create_batch_modal.find('input[name="ended_at"]').val().trim() + '</td>';
    var depart_date = '<td>' + create_batch_modal.find('input[name="depart_date"]').val().trim() + '</td>';
    var return_date = '<td>' + create_batch_modal.find('input[name="return_date"]').val().trim() + '</td>';
    var price = '<td>' + create_batch_modal.find('input[name="price"]').val().trim() + '</td>';
    var action = '<td>' + '<a onclick=' + removeRow() + ' class="remove"><i class="material-icons">&#xE872;</i></a>' + '</td>';
    var row_content = started_at + ended_at + depart_date + return_date + price + action;
    $('#preview_table tbody').append('<tr>' + row_content + '</tr>');
    cleanField();
    var batchDataObject = {
        region: create_batch_modal.find('input[name="region"]').val().trim(),
        topic: create_batch_modal.find('input[name="topic"]').val().trim(),
        sales_tel: create_batch_modal.find('input[name="sales_tel"]').val().trim(),
        started_at: create_batch_modal.find('input[name="started_at"]').val().trim(),
        ended_at: create_batch_modal.find('input[name="ended_at"]').val().trim(),
        depart_date: create_batch_modal.find('input[name="depart_date"]').val().trim(),
        return_date: create_batch_modal.find('input[name="return_date"]').val().trim(),
        price: create_batch_modal.find('input[name="price"]').val().trim(),
        sales_instruction: create_batch_modal.find('input[name="sales_instruction"]').val().trim(),
        content: '如以下輸入',
        editor_input: CKEDITOR.instances['create_batch_editor'].getData()
    };
    console.log(batchDataObject);
    objectArray.push(batchDataObject);
}