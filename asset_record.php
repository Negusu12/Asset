<?php
include 'backend/insert.php';
include("connect.php");

$user_data = check_login($con);
?>
<div class="navigation_arrow">
    <button class="navigation-btn" onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
    <button class="navigation-btn" onclick="goForward()"><i class="fas fa-arrow-right"></i></button>
</div>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 border-right">
                        <b class="text-muted">Asset Register</b>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Item Code</label>
                            <input type="text" name="item_c" class="form-control form-control-sm" oninvalid="this.setCustomValidity('Enter Item Code Here')" oninput="setCustomValidity('')" required>
                        </div>

                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Item Name</label>
                            <input type="text" name="item_name" class="form-control form-control-sm" oninvalid="this.setCustomValidity('Enter Item Name Here')" oninput="setCustomValidity('')" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">&nbsp;&nbsp;&nbsp;Brand</label>
                            <input type="text" name="brand" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">&nbsp;&nbsp;&nbsp;Model</label>
                            <input type="text" name="model" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Item Type</label>
                            <select name="item_type" id="item_type" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Select Item Type Here')" oninput="setCustomValidity('')" required>
                                <option value=""></option>
                                <option value="asset">Asset</option>
                                <option value="consumable">Consumable</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Item Category</label>
                            <select name="item_category" id="item_category" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Select Item Category Here')" oninput="setCustomValidity('')" required>
                                <option value=""></option>
                                <?php
                                $sql = "SELECT list_id, category FROM drop_down_list WHERE category IS NOT NULL AND category <> ''";
                                $result = mysqli_query($con, $sql);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["category"] . "'>" . $row["category"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <br />
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> UOM</label>
                            <select name="uom" id="uom" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Enter UOM Here')" oninput="setCustomValidity('')" required>
                                <option value=""></option>
                                <?php
                                $sql = "SELECT list_id, uom FROM drop_down_list WHERE uom IS NOT NULL AND uom <> ''";
                                $result = mysqli_query($con, $sql);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["uom"] . "'>" . $row["uom"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><span style="color: red;">*</span> Quantity</label>
                            <input type="number" class="form-control form-control-sm" name="qty" min="0" oninvalid="this.setCustomValidity('Enter Quantity Here')" oninput="setCustomValidity('')" required>
                        </div>

                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Date</label>
                            <input type="date" name="doc_date" id="doc_date" class="form-control form-control-sm" oninvalid="this.setCustomValidity('Enter Date Here')" oninput="setCustomValidity('')" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">&nbsp;&nbsp;&nbsp;Description</label>
                            <textarea name="description" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Upload Image</label>
                            <input class="form-control form-control-sm" type="file" name="image" id="image" accept="image/*" required>
                        </div>

                        <div class="form-group " style="display: none;">
                            <label class="control-label">Prepared By</label>
                            <input type="text" class="form-control form-control-sm" name="user_name" value="<?php echo $user_data['user_name']; ?>">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-lg-12 text-right justify-content-center d-flex">
                    <button class="btn btn-primary mr-2" type="submit" name="submit">Save</button>
                    <button class="btn btn-secondary" type="reset">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // JavaScript code for handling file input and preview
    document.addEventListener('DOMContentLoaded', function() {
        const dropArea = document.getElementById('drop-area');
        const dropMessage = document.getElementById('drop-message');
        const imagePreview = document.getElementById('image-preview');
        const inputPhotos = document.getElementById('photos');

        dropArea.addEventListener('dragover', function(event) {
            event.preventDefault();
            dropArea.classList.add('drag-over');
            dropMessage.textContent = 'Drop files here.';
        });

        dropArea.addEventListener('dragleave', function() {
            dropArea.classList.remove('drag-over');
            dropMessage.textContent = 'Drop files here or click to upload.';
        });

        dropArea.addEventListener('drop', function(event) {
            event.preventDefault();
            dropArea.classList.remove('drag-over');

            const files = event.dataTransfer.files;
            displayPreview(files);
            inputPhotos.files = files;
        });

        inputPhotos.addEventListener('change', function() {
            const files = this.files;
            displayPreview(files);
        });

        function displayPreview(files) {
            imagePreview.innerHTML = ''; // Clear existing preview

            for (const file of files) {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = file.name;
                        img.classList.add('preview-image');
                        imagePreview.appendChild(img);
                    };

                    reader.readAsDataURL(file);
                }
            }
        }
    });
</script>