<?php
include('template/header.php');
?>

<?php
if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">'
        . htmlspecialchars($_SESSION['msg']) .
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    $_SESSION['msg'] = '';
}
?>

<!-- 🛰️ Star Wars Dashboard Panel -->
<div class="container mt-4">
    <div class="text-center mb-4">
        <h2 style="font-family: 'Orbitron', sans-serif; color: #FFD700;">
            <img src="assets/img/control_panel.png" style="width:40px; vertical-align: middle; margin-right: 10px;">
            Command Center: Student Archives
        </h2>
        <p style="color: white;">Manage your Jedi records or purge Sith data.</p>
    </div>

    <?php
    include('insert_modal.php');  // Use Star Wars form styling here too
    include('update_modal.php');
    include('delete_modal.php');
    include('view.php');          // Table display could have themed buttons/icons
    ?>
</div>

<?php
include('template/footer.php');
?>
