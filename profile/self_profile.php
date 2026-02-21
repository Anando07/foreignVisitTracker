<?php require_once __DIR__."/../controllers/ProfileController.php"; ?>

<div class="fvt-card">
    <div class="fvt-page-header" style="text-align:center;">👤 Update Profile</div>

    <form id="profileForm" method="post">
        <div class="fvt-grid">

            <!-- Full Name -->
            <div class="fvt-group">
                <label>Full Name <span class="required">*</span></label>
                <input type="text" name="name" required class="fvt-input" value="<?= htmlspecialchars($user['Name']) ?>">
                <div class="error-msg"></div>
            </div>

            <!-- Office -->
            <div class="fvt-group">
                <label>Office <span class="required">*</span></label>
                <select name="office" id="office" class="fvt-input" required>
                    <option value="">Select</option>
                    <?php
                    $offices = ["MoF"=>"Ministry of Finance","IRD"=>"IRD","NBR"=>"NBR","NSD"=>"NSD","TAT"=>"TAT","CEVT"=>"CEVT"];
                    foreach($offices as $k=>$v){
                        $sel = ($user['Office'] ?? '')==$k?'selected':''; 
                        echo "<option value='$k' $sel>$v</option>";
                    }
                    ?>
                </select>
                <div class="error-msg"></div>
            </div>

            <!-- Designation -->
            <div class="fvt-group">
                <label>Designation <span class="required">*</span></label>
                <select name="designation" id="designation" class="fvt-input" required
                        data-selected="<?= htmlspecialchars($user['Designation'] ?? '') ?>">
                    <option value="">Select Office First</option>
                </select>
                <div class="error-msg"></div>
            </div>

            <!-- Contact -->
            <div class="fvt-group">
                <label>Contact</label>
                <input type="text" name="contact" class="fvt-input" value="<?= htmlspecialchars($user['Contact']) ?>">
                <div class="error-msg"></div>
            </div>

            <?php if ($role === 'Administrator'): ?>
                <!-- Username -->
                <div class="fvt-group">
                    <label>Username <span class="required">*</span></label>
                    <input type="text" name="username" required class="fvt-input" value="<?= htmlspecialchars($user['UserName']) ?>">
                    <div class="error-msg"></div>
                </div>

                <!-- Email -->
                <div class="fvt-group">
                    <label>Email <span class="required">*</span></label>
                    <input type="email" name="email" required class="fvt-input" value="<?= htmlspecialchars($user['Email']) ?>">
                    <div class="error-msg"></div>
                </div>

                <!-- Role -->
                <div class="fvt-group">
                    <label>Role <span class="required">*</span></label>
                    <select name="role_id" required class="fvt-input">
                        <option value="">Select Role</option>
                        <?php foreach($roles as $id => $r): ?>
                            <option value="<?= $id ?>" <?= $user['Role_ID']==$id?'selected':'' ?>><?= $r ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="error-msg"></div>
                </div>
            <?php endif; ?>

            <!-- Status -->
            <div class="fvt-group">
                <label>Status</label>
                <input type="text" class="fvt-input" value="<?= $user['Status']==1?'Active':'Inactive' ?>" readonly>
            </div>

        </div>

        <!-- Action Buttons -->
        <div class="fvt-actions" style="text-align:center; margin-top:16px;">
            <button class="btn btn-success fvt-action-btn">Update Profile</button>
        </div>
    </form>
</div>

<script>
// Simple form validation
document.getElementById("profileForm").addEventListener("submit", function(e){
    let ok=true;
    document.querySelectorAll(".error-msg").forEach(x=>x.innerText="");
    document.querySelectorAll(".fvt-input").forEach(x=>x.classList.remove("error"));

    function err(el,msg){
        el.classList.add("error");
        el.nextElementSibling.innerText=msg;
        ok=false;
    }

    document.querySelectorAll(".fvt-input[required]").forEach(el=>{
        if(!el.value) err(el,"Required");
    });

    if(!ok) e.preventDefault();
});
</script>