<div class="userDetails">
    <div class="container borderBottom">
        <h2>EMAIL</h2>
        <input class="emailInput" type="text" value="" placeholder="email...">
        <span class="message"></span>
        <button class="button" onclick="updateEmail('emailInput')">SAVE</button>
    </div>
    <div class="container">
        <h2>PASSWORD</h2>
        <input class="oldPassword" type="text" placeholder="old password...">
        <span class="oldPasswordMessage message"></span>
        <input class="newPassword " type="text" placeholder="new password...">
        <span class="newPasswordMessage message"></span>
        <input class="confirmPassword" type="text"  placeholder="confirm password...">
        <span class="confirmPasswordMessage message"></span>
        <button class="button" onclick="updatePassword('oldPassword', 'newPassword', 'confirmPassword')">SAVE</button>
    </div>
</div>