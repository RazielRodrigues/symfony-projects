<?php include('includes/_header.php'); ?>

<h2>Videos / My liked videos</h2>

<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Video name</th>
        <th>Link</th>
        <th>Category</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach(range(1,10) as $v): ?>
      <tr>
        <td><?=$v?></td>
        <td>Video name</td>
        <td><a target="_blank" href="http://vimeo.com">go to video</a></td>
        <td>
            <form action="#" method="POST">
                <select onchange="this.form.submit();">
                <option selected>Parent...</option>
                <option value="1">Funny</option>
                <option value="1">--For kids</option>
                <option value="1">----For adults</option>
                <option value="2">Scary</option>
                <option value="3">Motivating</option>
                </select>
            </form>
        </td>
        <td><a href="#" onclick="delete_video(event,2);"><i class="fas fa-trash"></i></a></td>
      </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script>
    function delete_video(e,video_id)
    {
        e.preventDefault();
        if(confirm('Are you sure?')) 
        {
            console.log(id);
            // delete video from vimeo
            // window.location.href = 'clear database record with Symfony';
        }
    }
</script>

<?php include('includes/_footer.php'); ?>
