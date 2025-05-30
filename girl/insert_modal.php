

<div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="insert.php">
        <div class="modal-header">
          <h5 class="modal-title" id="insertModalLabel">Add New Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="fn" class="form-label">Fullname</label>
                <input type="text" class="form-control" name="fn" id="fn" placeholder="Enter text" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" name="gender" id="gender" required>
                    <option value="Male" selected>Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" name="age" id="age" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="confirm" class="btn btn-primary" name="sub_add" id="sub_add">Confirm</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>


