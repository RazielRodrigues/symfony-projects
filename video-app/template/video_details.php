<?php include('includes/_header.php'); ?>
<?php include('includes/_menu.php'); ?>

<br>
<h1>Video title</h1>
<div align="center" class="embed-responsive embed-responsive-16by9">
    <iframe class="" src="https://player.vimeo.com/video/289729765" frameborder="0" allowfullscreen></iframe>
</div>

<hr>

<div class="row m-2">
    <a id="video_comments"></a>

    <?php for ($i = 1; $i <= 6; $i++) : ?>

    <ul class="list-unstyled text-left">
        <li class="media">
            <img class="mr-3" src="assets/img/user.jpg" alt="Generic placeholder image">
            <div class="media-body">
                <h5 class="mt-0 mb-1"><b>John Doe</b> <small class="text-muted">added a comment <small><b>3 days ago</b></small></small></h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus
                odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate
                fringilla. Donec lacinia congue felis in faucibus.
            </div>
        </li>
    </ul>
    <hr>

    <?php endfor; ?>

</div>

<div class="row">
    <div class="col-md-12">
        <form method="POST" action="video_details.php#video_comments">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Add a comment</label>
                <textarea required class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>

        </form>
    </div>
</div>


<?php include('includes/_footer_links.php'); ?>
<?php include('includes/_footer.php'); ?>