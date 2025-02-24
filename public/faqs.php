<?php

session_start();

if (!isset($_SESSION['user_id'])) {
   
    header("Location: login.html");
    exit();
}

$faqs = [
    [
        "question" => "What is a logistics management system?",
        "answer" => "A logistics management system is a software application designed to streamline and automate the processes involved in transporting goods, managing inventory, and optimizing supply chains."
    ],
    [
        "question" => "Who can use this logistics management system?",
        "answer" => "This system is designed for businesses involved in shipping, warehousing, or inventory management, including logistics companies, e-commerce businesses, and manufacturers."
    ],
    [
        "question" => "What are the key features of this system?",
        "answer" => "The key features include:
        <ul>
            <li>Order management</li>
            <li>Real-time shipment tracking</li>
            <li>Inventory management</li>
            <li>Route optimization</li>
            <li>Customer and vendor management</li>
            <li>Detailed reporting and analytics</li>
        </ul>"
    ],
    [
        "question" => "What user roles are supported by the system?",
        "answer" => "The system supports multiple user roles, such as:
        <ul>
            <li><b>Admin</b>: Manages users, tracks all shipments, and generates reports.</li>
            <li><b>Customer</b>: Places orders and tracks their shipments.</li>
            <li><b>Logistics Manager</b>: Oversees operations like routing and inventory management.</li>
        </ul>"
    ],
    [
        "question" => "How can I register or log in to the system?",
        "answer" => "Users can register through the designated signup page or log in using their username and password on the login page."
    ],
    [
        "question" => "Does the system handle inventory management?",
        "answer" => "Yes, it includes features for monitoring stock levels, recording inventory movement, and generating alerts for low stock."
    ],
    [
        "question" => "Is the system secure?",
        "answer" => "Yes, the system uses encryption to protect sensitive data and implements user authentication for secure access."
    ],
    [
        "question" => "What kind of reports can the system generate?",
        "answer" => "The system can generate reports on:
        <ul>
            <li>Order statuses (pending, in-transit, delivered)</li>
            <li>Shipment delays</li>
            <li>Warehouse stock levels</li>
            <li>Revenue and expenses</li>
        </ul>"
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs</title>
    <link rel="icon" type="image/x-icon" href="fav.png">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Arial', sans-serif;
        }
        .faq-section {
            margin-top: 50px;
        }
        .faq-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }
        .accordion-button {
            font-weight: 600;
        }
        .accordion-item {
            border: none;
            margin-bottom: 10px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
        }
        .accordion-button:focus {
            box-shadow: none;
        }
        .accordion-button:not(.collapsed) {
            color: #007bff;
            background-color: #e9ecef;
        }
        .accordion-body {
            background-color: #ffffff;
            padding: 20px;
            border-top: 1px solid #e9ecef;
        }
    </style>
</head>
<body>
<?php include'header.php'; ?>
    <div class="container faq-section">
        <div class="faq-header">
            <h2>Frequently Asked Questions (FAQs)</h2>
        </div>
        <div class="accordion mt-4" id="faqAccordion">
            <?php foreach ($faqs as $index => $faq): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?= $index; ?>">
                        <button class="accordion-button <?= $index === 0 ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index; ?>" aria-expanded="<?= $index === 0 ? 'true' : 'false'; ?>" aria-controls="collapse<?= $index; ?>">
                            <?= htmlspecialchars($faq['question']); ?>
                        </button>
                    </h2>
                    <div id="collapse<?= $index; ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : ''; ?>" aria-labelledby="heading<?= $index; ?>" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <?= $faq['answer']; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include'footer.php'; ?>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
