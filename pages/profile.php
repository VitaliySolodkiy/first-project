<?php
if (!isset($_SESSION['user'])) {
    header("location: index.php?page=login");
}
require_once "./elements/user.php";
?>
<h1>Profile</h1>
<h2>Hello, <?= $_SESSION['user']['login'] ?></h2>
<div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
    <div class="card p-4">
        <div class=" image d-flex flex-column justify-content-center align-items-center">
            <button class="btn btn-secondary">
                <img src="https://i.imgur.com/wvxPV9S.png" height="100" width="100" />
            </button>
            <span class="name mt-3"><?= $user_login ?></span>
            <span class="idd"><?= $user_email ?></span>

            <div class="d-flex flex-row justify-content-center align-items-center mt-3"> <span class="number">1069 <span class="follow">Followers</span></span> </div>
            <div class=" d-flex mt-2"> <button class="btn1 btn-dark">Edit Profile</button> </div>
            <div class="text mt-3"> <span>Eleanor Pena is a creator of minimalistic x bold graphics and digital artwork.<br><br> Artist/ Creative Director by Day #NFT minting@ with FND night. </span> </div>

            <div class="gap-3 mt-3 icons d-flex flex-row justify-content-center align-items-center">
                <span><i class="fa fa-twitter"></i></span>
                <span><i class="fa fa-facebook-f"></i></span>
                <span><i class="fa fa-instagram"></i></span>
                <span><i class="fa fa-linkedin"></i></span>
            </div>
            <div class=" px-2 rounded mt-4 date "> <span class="join">Joined May,2021</span> </div>
        </div>
    </div>
</div>