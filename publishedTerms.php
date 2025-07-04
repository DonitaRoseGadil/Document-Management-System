<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';
include 'header.php';

$publishedTerms = $conn->query("SELECT DISTINCT term_start, term_end FROM published_terms ORDER BY term_start DESC");
$published = $publishedTerms->fetch_all(MYSQLI_ASSOC);
?>

<body>
    <?php include "loadingscreen.php"; ?>

    <div id="main-wrapper">
        <?php 
            include "sidebar.php";
            $role = $_SESSION['role'] ?? 'master';
        ?>

        <div class="content-body" style="background-color: #f1f9f1">
            <div class="container-fluid">
                <h3 class="text-center mb-4" style="color: #098209;">
                    <i class="icon icon-doc me-2"></i> Published Organization Charts
                </h3>

                <?php foreach ($published as $term): ?>
                    <div class="card mb-4">
                        <div class="card-header text-white" py-2 px-3 style="background-color: #098209;">
                            Term: <?= date("F j, Y", strtotime($term['term_start'])) ?> – <?= date("F j, Y", strtotime($term['term_end'])) ?>

                            <form method="POST" action="deletePublishedTerm.php" class="mt-2 text-end me-2 delete-term-form">
                                <input type="hidden" name="term_start" value="<?= htmlspecialchars($term['term_start']) ?>">
                                <input type="hidden" name="term_end" value="<?= htmlspecialchars($term['term_end']) ?>">
                                <button type="button" class="btn btn-danger btn-sm delete-term-btn">Delete Term</button>
                            </form>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php
                                $stmt = $conn->prepare("
                                    SELECT * FROM published_terms 
                                    WHERE term_start = ? AND term_end = ?
                                    ORDER BY 
                                        FIELD(position, 'Vice-Mayor', 'Councilor', 'LNB', 'PPSK'),
                                        name
                                ");
                                $stmt->bind_param("ss", $term['term_start'], $term['term_end']);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                while ($official = $result->fetch_assoc()):
                                ?>
                                    <div class="col-md-3 mb-3">
                                        <div class="card h-100 text-center">
                                            <img src="<?= htmlspecialchars($official['photo_path']) ?>" 
                                                 class="card-img-top" 
                                                 alt="<?= htmlspecialchars($official['name']) ?>" 
                                                 style="object-fit: cover; height: 200px;">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= htmlspecialchars($official['name']) ?></h5>
                                                <p class="card-text"><?= htmlspecialchars($official['position']) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
    document.querySelectorAll('.delete-term-btn').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "This will delete all officials under the selected term.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
    </script>


    <!-- Required Vendors and Scripts -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
