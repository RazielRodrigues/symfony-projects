<?php include('includes/_header.php'); ?>

<h2>My profile <small><a onclick="return confirm('Are you sure?');" href="#">delete account</a></small></h2>
<p class="text-left">My plan - Pro. <a onclick="return confirm('Are you sure? This can not be undone. Remember also to cancel payment in your PayPal account.');"
        href="#">cancel plan</a></p>
<p class="text-left">My plan - Free. <a href="../payment.php">get paid plan</a></p>

<form class="mt-5" method="POST" action="#">
    <div class="form-group">
        <label for="vimeoapikey">Vimeo API key</label>
        <input required type="text" class="form-control is-invalid" id="vimeoapikey" placeholder="Enter api key">
        <div class="invalid-feedback">
            Please provide api key
        </div>
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input required type="text" class="form-control is-invalid" id="name" placeholder="Your name">
        <div class="invalid-feedback">
            Please provide your name
        </div>
    </div>
    <div class="form-group">
        <label for="lastname">Last name</label>
        <input required type="text" class="form-control is-invalid" id="lastname" placeholder="Your last name">
        <div class="invalid-feedback">
            Please provide your last name
        </div>
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input required type="email" class="form-control is-invalid" id="email" placeholder="Enter email">
        <div class="invalid-feedback">
            Please provide valid email address
        </div>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input required type="password" class="form-control is-invalid" id="password" placeholder="Password">
        <div class="invalid-feedback">
            Please provide password (min. 6 characters)
        </div>
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirm password</label>
        <input required type="password" class="form-control is-invalid" id="password_confirmation" placeholder="Confirm password">
        <div class="invalid-feedback">
            Please provide valid password confirmation
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>

<?php include('includes/_footer.php'); ?>