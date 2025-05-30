<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg border-0 rounded" style="box-shadow: 0 8px 24px rgba(0,0,0,0.15); border-radius: 20px;">
      <form method="post" id="updateForm">
        <div class="modal-header" style="background: linear-gradient(45deg, #ffc107, #ffca2c); color: white; border-bottom: none; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
          <h5 class="modal-title" id="updateModalLabel" style="font-weight: 700; letter-spacing: 1px;">Update Student</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="stud_id" id="update_stud_id" value="">
            <div class="mb-3 position-relative">
                <label for="update_fn" class="form-label">Fullname</label>
                <input type="text" class="form-control ps-4" name="fn" id="update_fn" placeholder="Enter full name" required style="border-radius: 8px; transition: box-shadow 0.3s ease;">
                <i class="bi bi-person-fill position-absolute" style="top: 38px; left: 12px; color: #ffc107;"></i>
            </div>
            <div class="mb-3 position-relative">
                <label for="update_gender" class="form-label">Gender</label>
                <select class="form-select ps-4" name="gender" id="update_gender" required style="border-radius: 8px; transition: box-shadow 0.3s ease;">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <i class="bi bi-gender-ambiguous position-absolute" style="top: 38px; left: 12px; color: #ffc107;"></i>
            </div>
            <div class="mb-3 position-relative">
                <label for="update_age" class="form-label">Age</label>
                <input type="number" class="form-control ps-4" name="age" id="update_age" required style="border-radius: 8px; transition: box-shadow 0.3s ease;">
                <i class="bi bi-calendar-fill position-absolute" style="top: 38px; left: 12px; color: #ffc107;"></i>
            </div>
            <div id="updateFeedback" class="mt-2"></div>
        </div>
        <div class="modal-footer" style="border-top: none; padding-top: 1rem;">
          <button type="submit" class="btn btn-success" name="sub_update" id="sub_update" style="background-color: #28a745; border: none; border-radius: 8px; font-weight: 600; transition: background-color 0.3s ease;">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #6c757d; border: none; border-radius: 8px; font-weight: 600; transition: background-color 0.3s ease;">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
  .modal-content {
    border-radius: 20px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
  }
  .modal-header {
    border-bottom: none;
    background: linear-gradient(45deg, #ffc107, #ffca2c);
    color: white;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
  .modal-header .btn-close {
    filter: brightness(0) invert(1);
  }
  .form-label {
    font-weight: 700;
  }
  .form-control, .form-select {
    border-radius: 8px;
    padding-left: 2.5rem;
    transition: box-shadow 0.3s ease;
  }
  .form-control:focus, .form-select:focus {
    box-shadow: 0 0 8px rgba(255,193,7,0.6);
    border-color: #ffc107;
  }
  .btn-success {
    background-color: #28a745;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    transition: background-color 0.3s ease;
  }
  .btn-success:hover {
    background-color: #218838;
  }
  .btn-secondary {
    background-color: #6c757d;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    transition: background-color 0.3s ease;
  }
  .btn-secondary:hover {
    background-color: #5a6268;
  }
  /* Icon positioning */
  .position-relative i {
    position: absolute;
    top: 38px;
    left: 12px;
    pointer-events: none;
  }
  /* Alert margin */
  .alert {
    margin-top: 10px;
  }
</style>

<script>
$(document).ready(function() {
    $('#updateModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var fn = button.data('fn');
        var gender = button.data('gender');
        var age = button.data('age');

        var modal = $(this);
        modal.find('#update_stud_id').val(id);
        modal.find('#update_fn').val(fn);
        modal.find('#update_gender').val(gender);
        modal.find('#update_age').val(age);

        modal.find('#updateForm').attr('action', 'update.php?id=' + id);
        modal.find('#updateFeedback').html('');
    });

    $('#updateForm').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var feedback = $('#updateFeedback');
        console.log("Submitting update form via AJAX");
        $.ajax({
            type: 'POST',
            url: 'ajax-update.php',
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                console.log("AJAX success response:", response);
                if (response.status === 'success') {
                    feedback.html('<div class="alert alert-success" role="alert">' + response.message + '</div>');
                    setTimeout(function() {
                        $('#updateModal').modal('hide');
                    }, 2000);
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    feedback.html('<div class="alert alert-danger" role="alert">' + response.message + '</div>');
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX error:", error);
                feedback.html('<div class="alert alert-danger" role="alert">An error occurred: ' + error + '</div>');
            }
        });
    });
});
</script>
