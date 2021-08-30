<aside>
    <section class="sidebar-container">
        <div class="sidebar-main">
            <ul class="sidebar-list ">
                <!-- <li><a href="admin_control.php" ><i class="fas fa-user-cog"></i> Admin Control Panel</a></li> -->
                <?php 

if ($_SESSION['role']==1) {?>
       <li><a href="admin-list.php" class="side-active-ML"><i class="fas fa-stream"></i> Admin List</a></li>

       <li><a href="dashboard.php"  class="side-active-DB"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="bid-request-list.php"  class="side-active-BRL"><i class="fas fa-stream"></i> Bid Request List</a></li>
        <li><a href="meeting-request-list.php" class="side-active-ML"><i class="fas fa-stream"></i> Meeting List</a></li>


<?php } ?>
             
              <li><a href="society-list.php" class="side-active-SL" ><i class="fas fa-stream"></i> Society List</a></li>
                <li><a href="developer-list.php" class="side-active-DL" ><i class="fas fa-stream"></i> Developer List</a></li>
            </ul>
        </div>
    </section>
</aside>



