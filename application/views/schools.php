<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $title; ?></title>
  <meta charset="utf-8">
  <meta name="app-url" content="<?php echo base_url('/') ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  <script src = "https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js"> </script>  
</head>
<body>
<div class="container">
    <h2 class="text-center mt-5 mb-3"><?php echo $title; ?></h2>
    <div class="card">
        <div class="card-header">
            <button class="btn btn-outline-primary" onclick="createSchool()"> 
                Create New 
            </button>
        </div>
        <div class="card-body">
            <input id="tblsc" type="text" placeholder="Search..">
            <div id="alert-div">
             
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th width="240px">Action</th>
                    </tr>
                </thead>
                <tbody id="schools-table-body">
                     
                </tbody>
                 
            </table>
             <ul id="pagination-demo" class="pagination-sm"></ul> 
        </div>
        <div id="page-content" class="page-content"> Page 1</div>  
    </div>
</div>
 
<!-- modal for creating and editing function -->
<div class="modal" tabindex="-1" role="dialog" id="form-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">School Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="modal-alert-div">
             
        </div>
        <form>
            <input type="hidden" name="update_id" id="update_id">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <textarea class="form-control" id="location" rows="3" name="location"></textarea>
            </div>
            <button type="submit" class="btn btn-outline-primary" id="save-btn">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
 
<!-- view record modal -->
<div class="modal" tabindex="-1" role="dialog" id="view-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">School Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <b>Name:</b>
        <p id="name-info"></p>
        <b>location:</b>
        <p id="location-info"></p>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){ 
        $("#tblsc").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#schools-table-body tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
<script>  
$(function () {  
$("#pagination-demo").twbsPagination({  
  totalPages: 16,  
  visiblePages: 2,  
  next: "Next",  
  prev: "Prev",  
  onPageClick: function (event, page) {
    $("#page-content").text ("Page? + page) + ?content here";  
  }  
});  
});  
</script>  
<script type="text/javascript">
    showAllSchool();
    function showAllSchool()
    {
        let url = $('meta[name=app-url]').attr("content") + "school/show_all";
        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                $("#schools-table-body").html("");
                let school = response;
                for (var i = 0; i < school.length; i++) 
                {
                    let showBtn =  '<button ' +
                                        ' class="btn btn-outline-info" ' +
                                        ' onclick="showSchool(' + school[i].id + ')">Show' +
                                    '</button> ';
                    let editBtn =  '<button ' +
                                        ' class="btn btn-outline-success" ' +
                                        ' onclick="editSchool(' + school[i].id + ')">Edit' +
                                    '</button> ';
                    let deleteBtn =  '<button ' +
                                        ' class="btn btn-outline-danger" ' +
                                        ' onclick="destroySchool(' + school[i].id + ')">Delete' +
                                    '</button>';
 
                    let schoolRow = '<tr>' +
                                        '<td>' + school[i].name + '</td>' +
                                        '<td>' + school[i].location + '</td>' +
                                        '<td>' + showBtn + editBtn + deleteBtn + '</td>' +
                                    '</tr>';
                    $("#schools-table-body").append(schoolRow);
                }
 
                 
            },
            error: function(response) {
                console.log(response)
            }
        });
    }
    $("#save-btn").click(function(event ){
        event.preventDefault();
        if($("#update_id").val() == null || $("#update_id").val() == "")
        {
            storeSchool();
        } else {
            updateSchool();
        }
    })
    function createSchool()
    {
        $("#alert-div").html("");
        $("#modal-alert-div").html("");
        $("#update_id").val("");
        $("#name").val("");
        $("#location").val("");
        $("#form-modal").modal('show'); 
    }
    function storeSchool()
    {   
        $("#save-btn").prop('disabled', true);
        let url = $('meta[name=app-url]').attr("content") + "school/store";
        let data = {
            name: $("#name").val(),
            location: $("#location").val(),
        };
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            success: function(response) {
 
                $("#save-btn").prop('disabled', false);
                let successHtml = '<div class="alert alert-success" role="alert"><b>School Created Successfully</b></div>';
                $("#alert-div").html(successHtml);
                $("#name").val("");
                $("#location").val("");
                showAllSchool();
                $("#form-modal").modal('hide');
            },
            error: function(response) {
                $("#save-btn").prop('disabled', false);
            
                let responseData = JSON.parse(response.responseText);
                console.log(responseData.errors);
 
                if (typeof responseData.errors !== 'undefined') 
                {
                    let errorHtml = '<div class="alert alert-danger" role="alert">' +
                                        '<b>Validation Error!</b>' +
                                        responseData.errors +
                                    '</div>';
                    $("#modal-alert-div").html(errorHtml);      
                }
            }
        });
    }
    function editSchool(id)
    {
        let url = $('meta[name=app-url]').attr("content") + "school/edit/" + id ;
        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                let school = response;
                $("#alert-div").html("");
                $("#modal-alert-div").html("");
                $("#update_id").val(school.id);
                $("#name").val(school.name);
                $("#location").val(school.location);
                $("#form-modal").modal('show'); 
            },
            error: function(response) {
                 
            }
        });
    }
    function updateSchool()
    {
        $("#save-btn").prop('disabled', true);
        let url = $('meta[name=app-url]').attr("content") + "school/update/" + $("#update_id").val();
        let data = {
            id: $("#update_id").val(),
            name: $("#name").val(),
            location: $("#location").val(),
        };
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            success: function(response) {
                $("#save-btn").prop('disabled', false);
                let successHtml = '<div class="alert alert-success" role="alert"><b>School Updated Successfully</b></div>';
                $("#alert-div").html(successHtml);
                $("#name").val("");
                $("#location").val("");
                showAllSchool();
                $("#form-modal").modal('hide');
            },
            error: function(response) {
                /*
                    show validation error
                */
                $("#save-btn").prop('disabled', false);
            
                let responseData = JSON.parse(response.responseText);
                console.log(responseData.errors);
 
                if (typeof responseData.errors !== 'undefined') 
                {
                    let errorHtml = '<div class="alert alert-danger" role="alert">' +
                                        '<b>Validation Error!</b>' +
                                        responseData.errors +
                                    '</div>';
                    $("#modal-alert-div").html(errorHtml);      
                }
            }
        });
    }
    function showSchool(id)
    {
        $("#name-info").html("");
        $("#location-info").html("");
        let url = $('meta[name=app-url]').attr("content") + "school/show/" + id +"";
        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                console.log(response);
                let school = response;
                $("#name-info").html(school.name);
                $("#location-info").html(school.location);
                $("#view-modal").modal('show'); 
                 
            },
            error: function(response) {
                console.log(response)
            }
        });
    }
    function destroySchool(id)
    {
        let url = $('meta[name=app-url]').attr("content") + "/school/delete/" + id;
        let data = {
            name: $("#name").val(),
            location: $("#location").val(),
        };
        $.ajax({
            url: url,
            type: "DELETE",
            data: data,
            success: function(response) {
                let successHtml = '<div class="alert alert-success" role="alert"><b>School Deleted Successfully</b></div>';
                $("#alert-div").html(successHtml);
                showAllSchool();
            },
            error: function(response) {
                console.log(response)
            }
        });
    }
 
</script>
</body>
</html>