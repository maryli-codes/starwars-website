<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('ocs/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    if (ob_get_length()) {
        ob_end_clean();
    }
    header('Content-Type: application/json');

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $sql = "DELETE FROM personal_info WHERE stud_id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Record deleted successfully']);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Error deleting record: ' . $conn->error]);
    }
    exit();
}
?>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title d-flex align-items-center" id="deleteModalLabel">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill me-2" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.964 0L.165 13.233c-.457.778.091 1.767.982 1.767h13.706c.89 0 1.438-.99.982-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
          </svg>
          Confirm Delete
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this student?
        <input type="hidden" id="delete_student_id">
        <div id="deleteAlertPlaceholder" class="mt-3"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
          <span id="deleteBtnText">Delete</span>
          <span id="deleteBtnSpinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    $('#deleteModal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget);
        const id = button.data('id');
        $('#delete_student_id').val(id);
        $('#deleteAlertPlaceholder').empty();
        $('#confirmDeleteBtn').prop('disabled', false);
        $('#deleteBtnSpinner').addClass('d-none');
        $('#deleteBtnText').text('Delete');
    });

    function showAlert(message, type) {
        const alertHtml = `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
        $('#deleteAlertPlaceholder').html(alertHtml);
    }

    $('#confirmDeleteBtn').click(function(e) {
        e.preventDefault();

        var studentId = $('#delete_student_id').val();

        $('#confirmDeleteBtn').prop('disabled', true);
        $('#deleteBtnSpinner').removeClass('d-none');
        $('#deleteBtnText').text('Deleting...');

        $.ajax({
            url: 'delete_modal.php',
            type: 'POST',
            data: { id: studentId },
            dataType: 'json',
            success: function(response) {
                if (response.status === "success") {
                    showAlert(response.message, 'success');
                    setTimeout(function() {
                        $('#deleteModal').modal('hide');
                        location.reload();
                    }, 1500);
                } else {
                    showAlert(response.message, 'danger');
                    $('#confirmDeleteBtn').prop('disabled', false);
                    $('#deleteBtnSpinner').addClass('d-none');
                    $('#deleteBtnText').text('Delete');
                }
            },
            error: function(xhr, status, error) {
                showAlert('AJAX Error: ' + error, 'danger');
                $('#confirmDeleteBtn').prop('disabled', false);
                $('#deleteBtnSpinner').addClass('d-none');
                $('#deleteBtnText').text('Delete');
            },
            complete: function() {
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
            }
        });
    });
});
</script>
