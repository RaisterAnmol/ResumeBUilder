<form method="POST" action="saveCv.php" enctype="multipart/form-data">
<h2>Create Resume</h2>
<input type="text" name="full_name" placeholder="Full Name" required><br>
<input type="email" name="email" placeholder="Email" required><br>
<input type="text" name="phone" placeholder="Phone" required><br>

<textarea name="skills" placeholder="Skills" required></textarea><br>
<textarea name="education" placeholder="Education"></textarea><br>
<textarea name="experience" placeholder="Experience"></textarea><br>

<input type="file" name="photo" required><br>
<button name="save">Save</button>
</form>