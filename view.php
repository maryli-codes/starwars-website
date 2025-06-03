<header>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</header>

<div class="row" style="margin-top: 30px;">

    <div class="col-md-2">&nbsp;</div>
    <div class="col-md-8">
        <div style="width:80%; margin:auto; background-color:rgb(248, 222, 76); padding: 20px; border-radius: 8px;">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Fullname</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php display_students($conn); ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-2">&nbsp;</div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this student?
        <input type="hidden" id="delete_student_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    function bindDeleteButtons() {
        $('.delete-btn').off('click').on('click', function() {
            const id = $(this).data('id');
            $('#delete_student_id').val(id);
            $('#deleteModal').modal('show');
        });
    }

    bindDeleteButtons();

    $('#confirmDeleteBtn').click(function() {
        const studentId = $('#delete_student_id').val();

        $.ajax({
            url: 'ajax-delete.php',
            type: 'POST',
            data: { id: studentId },
            success: function(response) {
                if (response.includes("successfully")) {

                    $('#deleteModal').modal('hide');
                    $('#example tbody').load('view.php #example tbody', function() {
                        bindDeleteButtons();
                } else {

                    console.error("Delete error: " + response);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: ", status, error);

            }
        });
    });
});
</script>

<?php

function display_students($conn)
{
    $sql = "SELECT * FROM personal_info";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["stud_fullname"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["stud_gender"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["stud_age"]) . "</td>";
            echo "<td>";

            echo "<button type='button' class='btn btn-link p-0' data-bs-toggle='modal' data-bs-target='#updateModal' " . 
                "data-id='" . $row['stud_id'] . "' " . 
                "data-fn='" . htmlspecialchars($row['stud_fullname'], ENT_QUOTES) . "' " . 
                "data-gender='" . $row['stud_gender'] . "' " . 
                "data-age='" . $row['stud_id'] . "' class='btn btn-sm btn-outline-primary'>Edit</a>";

            echo " "; 

            echo "<button type='button' class='btn btn-link p-0 delete-btn' data-bs-toggle='modal' data-bs-target='#deleteModal' " . 
                "data-id='" . $row['stud_id'] . "'>" . 
                "<img src='assets/img/delete.png' alt='Delete' width='20'>" . 
                "</button>";

            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr style='text-align:center;'>" . 
            "<td colspan='5'>No students found</td>" . 
            "</tr>";
    }
}
?>
