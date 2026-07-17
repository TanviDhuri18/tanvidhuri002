<?php
include 'includes/header.php';
include 'config/db.php';

$villagers = $conn->query("SELECT id, name FROM villagers");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $villager_id = $_POST['villager_id'];
    $complaint = $_POST['complaint'];
    $sql = "INSERT INTO complaints (villager_id, complaint) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $villager_id, $complaint);
    $stmt->execute();
    echo "<div class='alert alert-success'>Complaint submitted!</div>";
}
?>
<h2>File a Complaint</h2>
<form method="post">
  <select class="form-control mb-2" name="villager_id" required>
    <option value="">Select Villager</option>
    <?php while($v = $villagers->fetch_assoc()): ?>
      <option value="<?= $v['id'] ?>"><?= $v['name'] ?></option>
    <?php endwhile; ?>
  </select>
  <textarea class="form-control mb-2" name="complaint" placeholder="Complaint" required></textarea>
  <button class="btn btn-green">Submit</button>
</form>
<?php include 'includes/footer.php'; ?>