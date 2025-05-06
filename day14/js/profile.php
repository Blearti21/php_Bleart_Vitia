</a>
          </li>
    
        </ul>

      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>
          
      <div class="container">
        <div class="row">
          <div class="col-md-5">
            <form class="form-profile" action="update.php" method="post">
              <span class="text-muted" for='id'>Id</span>
              <input  type="number" class="form-control" id="floatingInput" placeholder="Id" name="id" value="<?php echo  $user_data['id'] ?>" readonly>

              <span class="text-muted" for='name'> Name </span>
              <input class="form-control" type="text" name="name" value="<?php echo $user_data['name'] ?>" required><br>

              <span class="text-muted"> Surname </span>
              <input class="form-control" type="text" name="surname" value="<?php echo$user_data['surname'] ?>" required><br>

              <span class="text-muted"> Username </span>
              <input class="form-control" type="text" name="username" value="<?php echo $user_data['username'] ?>" required><br>

              <span class="text-muted">Email</span>
              <input class="form-control" type="email" name="email" value="<?php echo $user_data['email'] ?>" required><br>

              <span class="text-muted">Password</span>
              <input class="form-control" type="password" name="password" required><br><br>
              
              <button class="btn btn-lg btn-primary" type="submit" name="update">Update</button>
            </form>
          </div>
        </div>    
      </div>
    </main>
  </div>
</div>

<?php include("footer.php"); ?>