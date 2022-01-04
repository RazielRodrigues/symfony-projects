<?php include('includes/_header.php'); ?>

<style>
    .fa-ul>li {
    margin-top: 15px;
}
</style>

<h2>Categories list</h2>

<ul class="fa-ul text-left">
    <li><i class="fa-li fa fa-arrow-right"></i>Funny <a href="edit_category.php">edit</a> <a onclick="return confirm('Are you sure?');"
                href="#">delete</a></li>
    <ul class="fa-ul text-left">
        <li><i class="fa-li fa fa-arrow-right"></i>For kids <a href="edit_category.php">edit</a> <a onclick="return confirm('Are you sure?');"
                href="#">delete</a></li>
        <li><i class="fa-li fa fa-arrow-right"></i>For adults <a href="#">edit</a> <a onclick="return confirm('Are you sure?');"
                href="#">delete</a></li>
        <ul class="fa-ul text-left">
            <li><i class="fa-li fa fa-arrow-right"></i>Strange <a href="#">edit</a> <a onclick="return confirm('Are you sure?');"
                    href="#">delete</a></li>
        </ul>
    </ul>
    <li><i class="fa-li fa fa-arrow-right"></i>Scary <a href="#">edit</a> <a onclick="return confirm('Are you sure?');"
            href="#">delete</a></li>
    <li><i class="fa-li fa fa-arrow-right"></i>Unbelievable <a href="#">edit</a> <a onclick="return confirm('Are you sure?');"
            href="#">delete</a></li>
    <li><i class="fa-li fa fa-arrow-right"></i>Inspirational <a href="#">edit</a> <a onclick="return confirm('Are you sure?');"
            href="#">delete</a></li>
    <li><i class="fa-li fa fa-arrow-right"></i>Motivating <a href="#">edit</a> <a onclick="return confirm('Are you sure?');"
            href="#">delete</a></li>
    <li><i class="fa-li fa fa-arrow-right"></i>Surprising <a href="#">edit</a> <a onclick="return confirm('Are you sure?');"
            href="#">delete</a></li>
    <li><i class="fa-li fa fa-arrow-right"></i>Sad</li>
    <ul class="fa-ul text-left">
        <li><i class="fa-li fa fa-arrow-right"></i>Strange <a href="#">edit</a> <a onclick="return confirm('Are you sure?');"
                href="#">delete</a></li>
        <ul class="fa-ul text-left">
            <li><i class="fa-li fa fa-arrow-right"></i>Boring <a href="#">edit</a> <a onclick="return confirm('Are you sure?');"
                    href="#">delete</a></li>
        </ul>
    </ul>
    <li><i class="fa-li fa fa-arrow-right"></i>Relaxing <a href="#">edit</a> <a onclick="return confirm('Are you sure?');"
            href="#">delete</a></li>
</ul>

<form action="#" method="POST">
    <div class="col-md-4 mb-3">
        <label for="validationServer01">Add new category</label>
        <input type="text" class="form-control is-invalid" id="validationServer01" placeholder="Category name" value="Funny"
            required>
        <br>
	    <label for="inlineFormCustomSelect">Parent:</label>
        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
            <option value="1">Funny</option>
            <option value="1">--For kids</option>
            <option value="1">--For adults</option>
            <option value="1">----For 60+</option>
            <option value="2">Scary</option>
            <option value="3">Motivating</option>
        </select>
        <div class="invalid-feedback">
            Category already exists!
        </div>
        <button class="btn btn-primary mt-3" type="submit">Add</button>
    </div>
</form>


<?php include('includes/_footer.php'); ?>
