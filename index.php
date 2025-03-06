 



 <!DOCTYPE HTML>
 <html>
    <head> 
        <meta  charset="UTF-8">
        <meta name="viewport" content ="width=device-width,initial-scale=1.0">
        <title> Profile Page </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <style>
            body{
                font-family:Arial,sans-serf;
        text-align:center;

            }
            .profile-container{
                margin-top:50px;
                text-align:center;
                background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            }
            .profile-img{
                width:150px;
                height:150px;
                border-radius:50px%;
                border:2px solid #333;
                object-fit:cover;
            }
            .container {
            width: 50%;
            margin: auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #cccccc;
            border-radius: 4px;
        }
        .form-group textarea {
            resize: vertical;
        }
        .dob-group {
            display: flex;
            justify-content: space-between;
        }
        .dob-group select {
            width: 32%;
        }
        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
            </style>

        
       
     <form id="profileForm" action="upload.php" method="POST" enctype="multipart/form-data">      
    <div class="container">
        <h2>Profile Form</h2>
            
        <div class="container mt-5">
        <div class="row ">
                    <h4 class="text-center mb-4">Profile Picture</h4>
                    <div class="text-center mb-3">
                        <img id="profileImage" src="default.png" class="profile-pic" alt="Profile Picture">
                    </div>
                    <form id="profileForm" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="file" class="form-control" id="imageUpload" accept="image/*">
                        </div>
                        <button type="button" class="btn btn-primary w-100" onclick="uploadImage()">Upload</button>
                        <button type="button" class="btn btn-danger w-100 mt-2" onclick="deleteImage()">Delete</button>
                    </form>
                </div>
            </div>
        

 
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <div class="dob-group">
                    <select id="dob-month" name="dob-month">
                        <option value="">Month</option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                    <select id="dob-day" name="dob-day">
                        <option value="">Day</option>
                        <!-- Add day options from 1 to 31 -->
                        ${Array.from({ length: 31 }, (_, i) => `<option value="${i + 1}">${i + 1}</option>`).join('')}
                    </select>
                    <select id="dob-year" name="dob-year">
                        <option value="">Year</option>
                        <!-- Add year options from 1900 to the current year -->
                        ${Array.from({ length: new Date().getFullYear() - 1899 }, (_, i) => `<option value="${1900 + i}">${1900 + i}</option>`).join('')}
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="biography">Biography:</label>
                <textarea id="biography" name="biography" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="family">Family:</label>
                <input type="text" id="family" name="family">
            </div>
            <div class="form-group">
                <label for="school">School:</label>
                <input type="text" id="school" name="school">
            </div>
            <div class="form-group">
                <label for="relationship-status">Relationship Status:</label>
                <select id="relationship-status" name="relationship-status">
                    <option value="">Select</option>
                    <option value="single">Single</option>
                    <option value="taken">Taken</option>
                    <option value="married">Married</option>
                    <option value="others">Others</option>
                </select>
            </div>
            <div class="form-group">
                <label for="education-level">Level of Education:</label>
                <input type="text" id="education-level" name="education-level">
            </div>
            <div class="form-group">
                <label for="work-level">Work Level:</label>
                <input type="text" id="work-level" name="work-level">
            </div>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
    </form>
</body>
</html>
    





 <script>

function deleteImage() {
    document.getElementById('profileImage').src = 'default.png';
    document.getElementById('imageUpload').value = "";
}
<script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

document.getElementById('imageUpload').addEventListener('change', function() {
    const fileInput = this;
    const file = fileInput.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profileImage').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});

function deleteImage() {
    document.getElementById('profileImage').src = 'default.png';
    document.getElementById('imageUpload').value = "";
    document.getElementById('uploadStatus').innerHTML = "";
}

</script>