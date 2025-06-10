<?php 
    error_reporting(E_ALL); // Enable error reporting for development
    ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">

<?php include "header.php"; ?>

<body>
    
    <!--*******************
        Preloader start
    ********************-->
    <?php include"loadingscreen.php" ?>
    <!--*******************
        Preloader end
    ********************-->
    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php 
            
            include "sidebar.php";
            
            // Fetch role from session
            $role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';
        ?>

<!-- MAIN WRAPPER -->
<div class="content-body" style="background-color: #f1f9f1">
    <div class="container-fluid">
    <!-- Centered Title -->
        <h3 class="text-center mb-0" style="color: #098209;">Organizational Chart</h3>

        <!-- Button aligned right below title -->
        <div class="d-flex justify-content-end mb-2">
            <a href="addOfficials.php" class="btn" style="background-color: #098209; color: white;">
                + Add Officials
            </a>
        </div>
        
        <div class="row justify-content-center">
            <!-- Vice Mayor -->
          <?php
              $query = mysqli_query($conn, "SELECT * FROM officials WHERE position = 'Vice-Mayor'");

              if ($query && mysqli_num_rows($query) > 0) {
                  $row = mysqli_fetch_assoc($query);
          ?>
                  <div class="col-md-3 text-center mb-4">
                    <div class="card" onclick='openModal(<?= json_encode($row) ?>, false)'>
                        <img src="<?= htmlspecialchars($row['photo_path']) ?>" class="card-img-top">
                        <!-- Pabago nalang here ng bg nung card if di bagay yung green ahhahaha -->
                        <div class="card-body text-white text-center" style="background-color: #098209; padding: 1rem;">
                            <h3 class="card-title mb-1 fw-bold text-white" style="font-size: 1.1rem;">
                                <?= htmlspecialchars($row['firstname'] . ' ' . $row['surname']) ?>
                            </h3>
                            <p class="card-text mb-0" style="font-size: 0.95rem; opacity: 0.9;">
                                <?= htmlspecialchars($row['position']) ?>
                            </p>
                        </div>  
                    </div>
                </div>

          <?php
              } else {
                  echo "<p class='text-center text-muted'>No Vice Mayor added yet.</p>";
              }
          ?>
          </div>

        <!-- First row of 4 Councilors -->
        <div class="row justify-content-center">
            <?php
                $query = mysqli_query($conn, "SELECT * FROM officials WHERE position = 'Councilor' LIMIT 4");
                if ($query && mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)):
            ?>
                <div class="col-md-3 text-center mb-4">
                    <div class="card" onclick='openModal(<?= json_encode($row) ?>)' style="cursor: pointer;">
                        <img src="<?= htmlspecialchars($row['photo_path']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body text-white text-center" style="background-color: #098209; padding: 1rem;">
                            <h3 class="card-title mb-1 fw-bold text-white" style="font-size: 1.1rem;">
                                <?= htmlspecialchars($row['firstname'] . ' ' . $row['surname']) ?>
                            </h3>
                            <p class="card-text mb-0" style="font-size: 0.95rem; opacity: 0.9;">
                                <?= htmlspecialchars($row['position']) ?>
                            </p>
                        </div>
                    </div>
                </div>

            <?php
                    endwhile;
                } else {
                    echo "<p class='text-center text-muted w-100'>No Councilors added yet.</p>";
                }
            ?>
        </div>

        <!-- Second row of 4 Councilors -->
        <div class="row justify-content-center">
            <?php
                $query = mysqli_query($conn, "SELECT * FROM officials WHERE position = 'Councilor' LIMIT 4 OFFSET 4");
                if ($query && mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)):
            ?>
                <div class="col-md-3 text-center mb-4">
                    <div class="card" onclick='openModal(<?= json_encode($row) ?>)' style="cursor: pointer;">
                        <img src="<?= htmlspecialchars($row['photo_path']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body text-white text-center" style="background-color: #098209; padding: 1rem;">
                            <h3 class="card-title mb-1 fw-bold text-white" style="font-size: 1.1rem;">
                                <?= htmlspecialchars($row['firstname'] . ' ' . $row['surname']) ?>
                            </h3>
                            <p class="card-text mb-0" style="font-size: 0.95rem; opacity: 0.9;">
                                <?= htmlspecialchars($row['position']) ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php
                    endwhile;
                } else {
                    echo "<p class='text-center text-muted w-100'>No additional Councilors added yet.</p>";
                }
            ?>
        </div>

        <!-- LNB and PPSK -->
        <div class="row justify-content-center">
            <?php
                $positions = ['LNB', 'PPSK'];
                foreach ($positions as $pos):
                    $query = mysqli_query($conn, "SELECT * FROM officials WHERE position = '$pos'");
                    if ($query && mysqli_num_rows($query) > 0) {
                        if ($row = mysqli_fetch_assoc($query)):
            ?>
                <div class="col-md-3 text-center mb-4">
                    <div class="card">
                        <img src="<?= htmlspecialchars($row['photo_path']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="col-md-3 text-center mb-4">
                            <div class="card" onclick='openModal(<?= json_encode($row) ?>)' style="cursor: pointer;">
                                <img src="<?= htmlspecialchars($row['photo_path']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                                <div class="card-body text-white text-center" style="background-color: #098209; padding: 1rem;">
                                    <h3 class="card-title mb-1 fw-bold text-white" style="font-size: 1.1rem;">
                                        <?= htmlspecialchars($row['firstname'] . ' ' . $row['surname']) ?>
                                    </h3>
                                    <p class="card-text mb-0" style="font-size: 0.95rem; opacity: 0.9;">
                                        <?= htmlspecialchars($row['position']) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                        endif;
                    } else {
                        echo "<p class='text-center text-muted w-100'>No $pos added yet.</p>";
                    }
                endforeach;
            ?>

        </div>


         <!-- ********VIEW MODAL******** -->
        <div class="modal fade" id="officialModal" tabindex="-1" aria-labelledby="officialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl"> <!-- wider modal -->
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="officialModalLabel">Official Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <!-- View Mode -->
            <div id="viewMode">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div style="background-color: #098209; color: white; padding: 1.5rem; border-radius: 0.5rem; height: 100%; display: flex; flex-direction: column; align-items: center;">

                            <!-- Image with top margin -->
                            <img id="modalImage" src="" class="img-fluid rounded shadow mb-3" style="max-height: 250px; margin-top: 2rem;">

                            <!-- Full Name and Position -->
                            <h4 id="modalName" class="mb-1 text-white text-center"></h4>
                            <p id="modalPosition" class="mb-3 text-white text-center"></p>

                            <!-- Contact Information -->
                            <div class="d-flex flex-column align-items-center px-3 mt-4">
                                <p class="mb-1 text-white d-flex align-items-start" style="font-size: 0.9rem; text-align: justify;">
                                    <i class="fa fa-envelope me-2 mt-1"></i>
                                    <span id="modalEmailleft"></span>
                                </p>
                                <p class="mb-1 text-white d-flex align-items-start" style="font-size: 0.9rem; text-align: justify;">
                                    <i class="fa fa-phone me-2 mt-1"></i>
                                    <span id="modalMobileleft"></span>
                                </p>
                                <p class="mb-3 text-white d-flex align-items-start" style="font-size: 0.9rem; text-align: justify;">
                                    <i class="fa fa-map-marker me-2 mt-1"></i>
                                    <span id="modalAddressleft"></span>
                                </p>
                            </div>

                                                                <!-- Buttons -->
                                                                <div class="mt-auto d-flex justify-content-center gap-2">
                                                                    <button type="button" class="btn btn-light btn-sm me-2" onclick="editOfficial(currentOfficialId)">
                                                                        <i class="fa fa-pencil"></i> Edit
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(currentOfficialId)">    
                                                                        <i class="fa fa-trash text-white"></i> Delete
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">

                                                            <!-- Personal Info -->
                                                            <h5 class="border-bottom pb-1 mb-2" style="color: #28a745;">Personal Information</h5>
                                                            <div class="row text-dark">
                                                                <div class="col-md-6 mb-2"><strong>Surname:</strong> <span id="modalSurname"></span></div>
                                                                <div class="col-md-6 mb-2"><strong>Firstname:</strong> <span id="modalFirstname"></span></div>
                                                                <div class="col-md-6 mb-2"><strong>Middlename:</strong> <span id="modalMiddlename"></span></div>
                                                                <div class="col-md-6 mb-2"><strong>Birthday:</strong> <span id="modalBirthday"></span></div>
                                                                <div class="col-md-6 mb-2"><strong>Birthplace:</strong> <span id="modalBirthplace"></span></div>
                                                                <div class="col-md-6 mb-2"><strong>Address:</strong> <span id="modalAddress"></span></div>
                                                                <div class="col-md-6 mb-2"><strong>Mobile Number:</strong> <span id="modalMobile"></span></div>
                                                                <div class="col-md-6 mb-2"><strong>Email:</strong> <span id="modalEmail"></span></div>
                                                                <div class="col-md-6 mb-2"><strong>Gender:</strong> <span id="modalGender"></span></div>
                                                            </div>

                    <!-- Education -->
                    <h5 class="border-bottom pb-1 mt-4 mb-2" style="color: #28a745;">Highest Educational Attaintment</h5>
                    <div class="row text-dark">
                        <div class="col-md-6 mb-2"><strong>Degree/Level:</strong> <span id="modalEduAttain"></span></div>
                        <div class="col-md-6 mb-2"><strong>School:</strong> <span id="modalEduSchool"></span></div>
                        <div class="col-md-6 mb-2"><strong>Year Graduated:</strong> <span id="modalEduDate"></span></div>
                    </div>

                    <!-- Family -->
                    <h5 class="border-bottom pb-1 mt-4 mb-2" style="color: #28a745;">Family Information</h5>
                    <div class="row text-dark">
                        <div class="col-md-6 mb-2"><strong>Civil Status:</strong> <span id="modalCivilStatus"></span></div>
                        <div class="col-md-6 mb-2"><strong>Spouse Name:</strong> <span id="modalSpouseName"></span></div>
                        <div class="col-md-6 mb-2"><strong>Spouse Birthday:</strong> <span id="modalSpouseBday"></span></div>
                        <div class="col-md-6 mb-2"><strong>Spouse Birthplace:</strong> <span id="modalSpouseBirthplace"></span></div>
                        <div class="col-md-6 mb-2"><strong>Dependents:</strong> <span id="modalDependents"></span></div>
                    </div>

                    <!-- Government Info -->
                    <h5 class="border-bottom pb-1 mt-4 mb-2" style="color: #28a745;">Government Details</h5>
                    <div class="row text-dark">
                        <div class="col-md-4 mb-2"><strong>GSIS No:</strong> <span id="modalGSIS"></span></div>
                        <div class="col-md-4 mb-2"><strong>PAG-IBIG No:</strong> <span id="modalPAGIBIG"></span></div>
                        <div class="col-md-4 mb-2"><strong>PhilHealth No:</strong> <span id="modalPhilHealth"></span></div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div> <!-- end #viewMode -->
            </div>
            </div>
        </div>
    </div>


        <!-- ********EDIT MODAL******** -->
        <div class="modal fade" id="editModeOfficial" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl"> <!-- wider modal -->
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="editModalLabel">Official Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                <!-- Edit Mode -->
                <div id="editMode">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div style="background-color: #098209; color: white; padding: 1.5rem; border-radius: 0.5rem; height: 100%; display: flex; flex-direction: column; align-items: center;">

                                <!-- Image with top margin -->
                                <img id="modalImageEdit" src="" class="img-fluid rounded shadow mb-3" style="max-height: 250px; margin-top: 2rem;">
                                <div class="mb-2">
                                    <label for="edit_image" class="form-label small" style="font-weight: normal;">Update Image:</label>
                                    <input type="file" class="form-control form-control-sm border" id="edit_image" name="edit_image" accept="image/*" style="border: 1px solid #ced4da; border-radius: 4px;">
                                </div>

                                <input type="hidden" id="edit_official_id" name="official_id" />
                                
                                <!-- Full Name and Position -->
                                <h4 id="modalNameEdit" class="mb-1 text-white text-center"></h4>
                                <p id="modalPositionEdit" class="mb-3 text-white text-center"></p>

                                <!-- Contact Information -->
                                <div class="d-flex flex-column align-items-center px-3 mt-4">
                                    <p class="mb-1 text-white d-flex align-items-start" style="font-size: 0.9rem; text-align: justify;">
                                        <i class="fa fa-envelope me-2 mt-1"></i>
                                        <span id="modalEmailleftEdit"></span>
                                    </p>
                                    <p class="mb-1 text-white d-flex align-items-start" style="font-size: 0.9rem; text-align: justify;">
                                        <i class="fa fa-phone me-2 mt-1"></i>
                                        <span id="modalMobileleftEdit"></span>
                                    </p>
                                    <p class="mb-3 text-white d-flex align-items-start" style="font-size: 0.9rem; text-align: justify;">
                                        <i class="fa fa-map-marker me-2 mt-1"></i>
                                        <span id="modalAddressleftEdit"></span>
                                    </p>
                                </div>

                                  <!-- <button id="saveBtn" type="submit" class="btn btn-primary">Save</button>
                                  <button id="cancelBtn" type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button> -->

                                <div class="d-flex gap-2 mt-3">
                                    <button id="saveBtn" type="submit" class="btn btn-primary btn-lg">
                                        <i class="fa fa-save me-1"></i> Save
                                    </button>
                                    <button id="cancelBtn" type="button" class="btn btn-secondary btn-lg">
                                        <i class="fa fa-close me-1"></i> Cancel
                                    </button>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-md-8">
                        <!-- Personal Info -->
                        <h5 class="border-bottom pb-1 mb-2" style="color: #28a745;">Personal Information</h5>
                        <div class="row text-dark">
                                <div class="col-md-6 mb-2">
                                    <label for="edit_surname" class="form-label">Surname:</label>
                                    <input type="text" class="form-control" id="edit_surname" name="surname">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="edit_firstname" class="form-label">First Name:</label>
                                    <input type="text" class="form-control" id="edit_firstname" name="firstname">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="edit_middlename" class="form-label">Middle Name:</label>
                                    <input type="text" class="form-control" id="edit_middlename" name="middlename">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="edit_birthday" class="form-label">Birthday:</label>
                                    <input type="date" class="form-control" id="edit_birthday" name="birthday">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="edit_birthplace" class="form-label">Birthplace:</label>
                                    <input type="text" class="form-control" id="edit_birthplace" name="birthplace">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="edit_address" class="form-label">Address:</label>
                                    <input type="text" class="form-control" id="edit_address" name="address">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="edit_contact" class="form-label">Mobile Number:</label>
                                    <input type="text" class="form-control" id="edit_contact" name="contact">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="edit_email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="edit_email" name="email">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="edit_gender" class="form-label">Gender:</label>
                                    <input type="text" class="form-control" id="edit_gender" name="gender">
                                </div>          
                        </div>

                        <!-- Education -->
                        <h5 class="border-bottom pb-1 mt-4 mb-2" style="color: #28a745;">Highest Educational Attaintment</h5>
                        <div class="row text-dark">
                            <div class="row text-dark">
                                <div class="col-md-6 mb-2">
                                    <label for="edit_education_attainment" class="form-label"><strong>Degree/Level:</strong></label>
                                    <input type="text" class="form-control" id="edit_education_attainment" name="education_attainment">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="edit_education_school" class="form-label"><strong>School:</strong></label>
                                    <input type="text" class="form-control" id="edit_education_school" name="education_school">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="edit_education_date" class="form-label"><strong>Year Graduated:</strong></label>
                                    <input type="date" class="form-control" id="edit_education_date" name="education_date">
                                </div>
                            </div>

                        </div>

                        <!-- Family -->
                        <h5 class="border-bottom pb-1 mt-4 mb-2" style="color: #28a745;">Family Information</h5>
                        <div class="row text-dark">
                            <div class="col-md-6 mb-2">
                                <label for="edit_civil_status" class="form-label"><strong>Civil Status:</strong></label>
                                <select class="form-control" id="edit_civil_status" name="civil_status">
                                    <option value="">Choose...</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Divorced">Divorced</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="edit_spouse_name" class="form-label"><strong>Spouse Name:</strong></label>
                                <input type="text" class="form-control" id="edit_spouse_name" name="spouse_name">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="edit_spouse_birthday" class="form-label"><strong>Spouse Birthday:</strong></label>
                                <input type="date" class="form-control" id="edit_spouse_birthday" name="spouse_birthday">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="edit_spouse_birthplace" class="form-label"><strong>Spouse Birthplace:</strong></label>
                                <input type="text" class="form-control" id="edit_spouse_birthplace" name="spouse_birthplace">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="edit_dependents" class="form-label"><strong>Dependents:</strong></label>
                                <input type="text" class="form-control" id="edit_dependents" name="dependents">
                            </div>
                        </div>

                        <!-- Government Info -->
                        <h5 class="border-bottom pb-1 mt-4 mb-2" style="color: #28a745;">Government Details</h5>
                        <div class="row text-dark">
                            <div class="col-md-4 mb-2">
                                <label for="edit_gsis" class="form-label"><strong>GSIS No:</strong></label>
                                <input type="text" class="form-control" id="edit_gsis" name="gsis_number" placeholder="Enter GSIS Number">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="edit_pagibig" class="form-label"><strong>PAG-IBIG No:</strong></label>
                                <input type="text" class="form-control" id="edit_pagibig" name="pagibig_number" placeholder="Enter PAG-IBIG Number">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="edit_philhealth" class="form-label"><strong>PhilHealth No:</strong></label>
                                <input type="text" class="form-control" id="edit_philhealth" name="philhealth_number" placeholder="Enter PhilHealth Number">
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- <div class="modal-footer">
                        <button class="btn btn-warning" onclick="toggleEdit()">Toggle Edit</button>
                    </div> -->
                    <div class="modal-footer">
                    </div> <!-- end #editMode -->
                </div>
                </div>
            </div>
        </div>


    <script>
        let currentOfficialId = null;

        // ********VIEW FUNCTION********
        function openModal(data, isEdit = false) {
            currentOfficialId = data.id;
             
        // Compose full name with optional middlename
        const fullName = `${data.firstname} ${data.middlename ? data.middlename + ' ' : ''}${data.surname}`.trim();

        // Set the full name into one element
        document.getElementById('modalName').textContent = fullName;

        
        // Dynamically handle image path
        let imagePath = 'uploads/default.png';  // fallback image
        if (data.image && data.image.trim() !== '') {
            imagePath = 'uploads/' + data.image;  // assuming 'image' is filename only
        } else if (data.photo_path && data.photo_path.trim() !== '') {
            imagePath = data.photo_path;  // if this is a full or relative path already
        }

        document.getElementById('modalImage').src = imagePath;

        // Set other fields as before
        document.getElementById('modalImage').src = data.photo_path;
        document.getElementById('modalPosition').textContent = data.position;
        // If you want to keep separate name fields, you can set them too:
        document.getElementById('modalSurname').textContent = data.surname;
        document.getElementById('modalFirstname').textContent = data.firstname;
        document.getElementById('modalMiddlename').textContent = data.middlename;

        document.getElementById('modalAddressleft').textContent = data.address;
        document.getElementById('modalMobileleft').textContent = data.mobile_number;
        document.getElementById('modalEmailleft').textContent = data.email;

        document.getElementById('modalBirthday').textContent = data.birthday;
        document.getElementById('modalBirthplace').textContent = data.birthplace;
        document.getElementById('modalAddress').textContent = data.address;
        document.getElementById('modalMobile').textContent = data.mobile_number;
        document.getElementById('modalEmail').textContent = data.email;
        document.getElementById('modalGender').textContent = data.gender;
        document.getElementById('modalEduAttain').textContent = data.education_attainment;
        document.getElementById('modalEduSchool').textContent = data.education_school;
        document.getElementById('modalEduDate').textContent = data.education_date;
        document.getElementById('modalCivilStatus').textContent = data.civil_status;
        document.getElementById('modalSpouseName').textContent = data.spouse_name;
        document.getElementById('modalSpouseBday').textContent = data.spouse_birthday;
        document.getElementById('modalSpouseBirthplace').textContent = data.spouse_birthplace;
        document.getElementById('modalDependents').textContent = data.dependents;
        document.getElementById('modalGSIS').textContent = data.gsis_number;
        document.getElementById('modalPAGIBIG').textContent = data.pagibig_number;
        document.getElementById('modalPhilHealth').textContent = data.philhealth_number;

        document.getElementById('viewMode').style.display = 'block';
        document.getElementById('editMode').style.display = 'none';

        new bootstrap.Modal(document.getElementById('officialModal')).show();

        const editBtn = document.getElementById('editBtn');
            if (editBtn) {
                editBtn.setAttribute('data-official-id', data.id);
            }

        if (isEdit) {
        setTimeout(function () {
            editOfficial(data.id);
        }, 300); // Wait a bit for modal to fully render before switching modes
    }
    }


    // ********EDIT FUNCTION********
    function setInputValue(id, value) {
        const el = document.getElementById(id);
        if (el) {
            el.value = value || '';
        }
    }
        function editOfficial(id) {
        fetch('getOfficialsData.php?id=' + id)
            .then(response => response.json())
            .then(official => {
            if (!official || Object.keys(official).length === 0) {
                alert('Official not found.');
                return;
            }

            // setInputValue('edit_official_id', official.id);
            setInputValue('edit_position', official.position);
            setInputValue('edit_surname', official.surname);
            setInputValue('edit_firstname', official.firstname);
            setInputValue('edit_middlename', official.middlename);
            setInputValue('edit_birthday', official.birthday);
            setInputValue('edit_birthplace', official.birthplace);
            setInputValue('edit_address', official.address);
            setInputValue('edit_contact', official.mobile_number);
            setInputValue('edit_email', official.email);
            setInputValue('edit_gender', official.gender);

            setInputValue('edit_education_attainment', official.education_attainment);
            setInputValue('edit_education_school', official.education_school);
            setInputValue('edit_education_date', official.education_date);

            setInputValue('edit_civil_status', official.civil_status);
            setInputValue('edit_spouse_name', official.spouse_name);
            setInputValue('edit_spouse_birthday', official.spouse_birthday);
            setInputValue('edit_spouse_birthplace', official.spouse_birthplace);
            setInputValue('edit_dependents', official.dependents);

            setInputValue('edit_gsis', official.gsis_number);
            setInputValue('edit_pagibig', official.pagibig_number);
            setInputValue('edit_philhealth', official.philhealth_number);

           // Dynamic Image Handling using photo_path
            const imagePath = official.photo_path && official.photo_path.trim() !== ''
                ? official.photo_path
                : 'uploads/default.png';

            document.getElementById('edit_official_id').value = official.id;
            document.getElementById('modalImageEdit').src = imagePath;
            document.getElementById('modalNameEdit').textContent = `${official.firstname || ''} ${official.middlename || ''} ${official.surname || ''}`.trim();
            document.getElementById('modalPositionEdit').textContent = official.position || 'N/A';
            document.getElementById('modalEmailleftEdit').textContent = official.email || 'N/A';
            document.getElementById('modalMobileleftEdit').textContent = official.mobile_number || 'N/A';
            document.getElementById('modalAddressleftEdit').textContent = official.address || 'N/A';


            // Show edit mode, hide view mode
            const viewModeEl = document.getElementById('viewMode');
            const editModeEl = document.getElementById('editMode');

            if (viewModeEl) viewModeEl.style.display = 'none';
            if (editModeEl) editModeEl.style.display = 'block';

            // Show the modal (assuming modal container id is 'officialModal')
            const modalEl = document.getElementById('editModeOfficial');
            if (modalEl) {
                const modal = new bootstrap.Modal(modalEl);
                modal.show();
            }
            })
            .catch(error => {
            console.error('Error fetching official data:', error);
            alert('Error fetching official data.');
            });
        }

        document.getElementById("editBtn").addEventListener("click", function () {
            const id = this.getAttribute('data-official-id'); // Assuming you set this attribute in your HTML
            if (!id) {
                alert('No official ID found!');
                return;
            }
            editOfficial(id);  // your existing editOfficial function
        });

        document.getElementById('edit_image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
            document.getElementById('modalImageEdit').src = e.target.result;  // show new image preview
            }
            reader.readAsDataURL(file);
        }
        });

        // SAVE CHANGES IN EDIT MODAL
        document.getElementById('saveBtn').addEventListener('click', function (e) {
            e.preventDefault();

            const formData = new FormData();
            formData.append('id', document.getElementById('edit_official_id').value); // make sure this hidden input exists
            // formData.append('position', document.getElementById('edit_position').value);
            formData.append('surname', document.getElementById('edit_surname').value);
            formData.append('firstname', document.getElementById('edit_firstname').value);
            formData.append('middlename', document.getElementById('edit_middlename').value);
            formData.append('birthday', document.getElementById('edit_birthday').value);
            formData.append('birthplace', document.getElementById('edit_birthplace').value);
            formData.append('address', document.getElementById('edit_address').value);
            formData.append('contact', document.getElementById('edit_contact').value);
            formData.append('email', document.getElementById('edit_email').value);
            formData.append('gender', document.getElementById('edit_gender').value);

            formData.append('education_attainment', document.getElementById('edit_education_attainment').value);
            formData.append('education_school', document.getElementById('edit_education_school').value);
            formData.append('education_date', document.getElementById('edit_education_date').value);

            formData.append('civil_status', document.getElementById('edit_civil_status').value);
            formData.append('spouse_name', document.getElementById('edit_spouse_name').value);
            formData.append('spouse_birthday', document.getElementById('edit_spouse_birthday').value);
            formData.append('spouse_birthplace', document.getElementById('edit_spouse_birthplace').value);
            formData.append('dependents', document.getElementById('edit_dependents').value);

            formData.append('gsis_number', document.getElementById('edit_gsis').value);
            formData.append('pagibig_number', document.getElementById('edit_pagibig').value);
            formData.append('philhealth_number', document.getElementById('edit_philhealth').value);


            // Image file
            const imageFile = document.getElementById('edit_image').files[0];
            if (imageFile) {
                formData.append('image', imageFile);
            }

            fetch('editOfficial.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(response => {
                if (response.success) {
                    alert('Official updated successfully!');
                    location.reload(); // Or re-fetch data if you're avoiding full reloads
                } else {
                    alert('Update failed: ' + response.message);
                }
            })
            .catch(err => {
                console.error(err);
                alert('An error occurred while saving.');
            });
        });

        // CANCEL BUTTON TO EDIT
        document.getElementById('cancelBtn').addEventListener('click', function () {
            const modal = bootstrap.Modal.getInstance(document.getElementById('editModeOfficial'));
            modal.hide();
        });
    
    // function toggleEdit() {
    //     const view = document.getElementById('viewMode');
    //     const edit = document.getElementById('editMode');
    //     if (edit.style.display === 'none') {
    //         view.style.display = 'none';
    //         edit.style.display = 'block';
    //     } else {
    //         edit.style.display = 'none';
    //         view.style.display = 'block';
    //     }
    // }

        function confirmDelete(id) {
            // Close the Bootstrap modal first
            const modalElement = document.getElementById('officialModal');
            const bsModal = bootstrap.Modal.getInstance(modalElement);
            if (bsModal) {
                bsModal.hide();
            }

            // Then show SweetAlert password input
            Swal.fire({
                title: "Enter Password",
                input: "password",
                inputAttributes: {
                    autocapitalize: "off",
                    required: true
                },
                showCancelButton: true,
                confirmButtonText: "Submit",
                showLoaderOnConfirm: true,
                preConfirm: (password) => {
                    return fetch("validate_password.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: "password=" + encodeURIComponent(password)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            throw new Error(data.message || "Incorrect password.");
                        }
                    })
                    .catch(error => {
                        Swal.showValidationMessage(error.message);
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Confirm!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Delete via AJAX
                            fetch("deleteOfficial.php?id=" + id)
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            title: "Deleted!",
                                            text: data.message,
                                            icon: "success",
                                            showConfirmButton: false,
                                            timer: 2000
                                        }).then(() => {
                                            location.reload(); // reload to reflect changes
                                        });
                                    } else {
                                        Swal.fire("Error", data.message, "error");
                                    }
                                });
                        }
                    });
                }
            });
        }

        // function confirmEdit(id) {
        //     Swal.fire({
        //         title: "Enter Password",
        //         input: "password",
        //         inputAttributes: {
        //             autocapitalize: "off",
        //             required: true
        //         },
        //         showCancelButton: true,
        //         confirmButtonText: "Submit",
        //         showLoaderOnConfirm: true,
        //         preConfirm: (password) => {
        //             return fetch("validate_password.php", {
        //                 method: "POST",
        //                 headers: {
        //                     "Content-Type": "application/x-www-form-urlencoded"
        //                 },
        //                 body: "password=" + encodeURIComponent(password)
        //             })
        //             .then(response => response.json())
        //             .then(data => {
        //                 if (!data.success) {
        //                     throw new Error(data.message || "Incorrect password.");
        //                 }
        //             })
        //             .catch(error => {
        //                 Swal.showValidationMessage(error.message);
        //             });
        //         },
        //         allowOutsideClick: () => !Swal.isLoading()
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             window.location.href = 'editofficial.php?id=' + id;
        //         }
        //     });
        //}
</script>

<style>
    .card {
        border: 2px solid #098209; /* Green border */
        cursor: pointer;
        transition: box-shadow 0.3s ease;
    }
    .card:hover {
        box-shadow: 0 0 15px rgba(9, 130, 9, 0.6); /* Glowing shadow on hover */
    }

</style>


    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    
