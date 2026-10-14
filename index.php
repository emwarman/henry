<?php
$dataFile = __DIR__ . '/messages.csv';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $message === '') {
        $error = 'Both name and message are required.';
    } else {
        $fh = fopen($dataFile, 'a');
        fputcsv($fh, [$name, $message, date('Y-m-d')], ',', '"', '\\');
        fclose($fh);
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

$entries = [];
if (file_exists($dataFile)) {
    $fh = fopen($dataFile, 'r');
    while (($row = fgetcsv($fh, 0, ',', '"', '\\')) !== false) {
        if (count($row) >= 2) {
            $entries[] = $row;
        }
    }
    fclose($fh);
}
$entries = array_reverse($entries);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Leave a Message</title>
<style>
    body {
        font-family: sans-serif;
        margin: 2rem;
        font-size: 0.8rem;
    }
    h1 {
        font-size: 1.5rem;
    }
    .row {
        display: flex;
        gap: 0.5rem;
        align-items: center;
        margin-bottom: 0.5rem;
    }
    .entry-row {
        align-items: flex-start;
    }
    .col-name {
        width: 200px;
    }
    .col-message {
        width: 400px;
    }
    .col-timestamp {
        width: 150px;
    }
    .col-name input, .col-message input {
        width: 100%;
        box-sizing: border-box;
        padding: 0.4rem;
    }
    .entry-name {
        color: red;
    }
    .entry-message {
        color: black;
    }
    .entry-timestamp {
        color: #888;
    }
    .error {
        color: red;
        margin-bottom: 1rem;
    }
</style>
</head>
<body>

<h1>Leave a message</h1>

<?php if ($error): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="post" id="messageForm">
    <div class="row">
        <div class="col-name"><input type="text" name="name" id="nameInput" placeholder="Name"></div>
        <div class="col-message"><input type="text" name="message" id="messageInput" placeholder="Message"></div>
        <button type="submit" id="submitBtn" disabled>Submit</button>
    </div>
</form>

<?php foreach ($entries as $entry): ?>
    <div class="row entry-row">
        <div class="col-name entry-name"><?= htmlspecialchars($entry[0]) ?></div>
        <div class="col-message entry-message"><?= htmlspecialchars($entry[1]) ?></div>
        <div class="col-timestamp entry-timestamp"><?= htmlspecialchars(substr($entry[2] ?? '', 0, 10)) ?></div>
    </div>
<?php endforeach; ?>

<script>
    const nameInput = document.getElementById('nameInput');
    const messageInput = document.getElementById('messageInput');
    const submitBtn = document.getElementById('submitBtn');

    function updateButtonState() {
        submitBtn.disabled = nameInput.value.trim() === '' || messageInput.value.trim() === '';
    }

    nameInput.addEventListener('input', updateButtonState);
    messageInput.addEventListener('input', updateButtonState);
</script>

</body>
</html>
