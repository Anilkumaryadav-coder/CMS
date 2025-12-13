  <!-- Sidebar -->
  <div class="sidebar">
    <a href="dashboard.php"><h2>CMS Admin</h2></a>

    <div class="menu-item" onclick="toggleSubmenu('clientsSub')">
      <span><i class="bi bi-people"></i> Clients</span>
      <i id="arrow-clientsSub" class="bi bi-chevron-right arrow"></i>
    </div>
    <div class="submenu" id="clientsSub">
      <a href="add-client.php"><i class="bi bi-person-plus"></i> Add Client</a>
      <a href="view-client.php"><i class="bi bi-pencil-square"></i> view Client</a>
    </div>

    <div class="menu-item" onclick="toggleSubmenu('pagesSub')">
      <span><i class="bi bi-file-earmark-text"></i> Pages</span> 
      <i id="arrow-pagesSub" class="bi bi-chevron-right arrow"></i>
    </div>
    <div class="submenu" id="pagesSub">
      <a href="add-page.php"><i class="bi bi-plus-circle"></i> Add Page</a>
      <a href="view-page.php"><i class="bi bi-pencil-square"></i> view Page</a>
    </div>


    <div class="menu-item" onclick="toggleSubmenu('servicesSub')">
      <span><i class="bi bi-person"></i> Services</span>
      <i id="arrow-usersSub" class="bi bi-chevron-right arrow"></i>
    </div>
    <div class="submenu" id="servicesSub">
      <a href="#"><i class="bi bi-person-plus"></i> Add Service </a>
      <a href="#"><i class="bi bi-pencil-square"></i> view Service</a>
    </div>


    <div class="menu-item" onclick="toggleSubmenu('usersSub')">
      <span><i class="bi bi-person"></i> Users</span>
      <i id="arrow-usersSub" class="bi bi-chevron-right arrow"></i>
    </div>
    <div class="submenu" id="usersSub">
      <a href="add-user.php"><i class="bi bi-person-plus"></i> Add User</a>
      <a href="view-user.php"><i class="bi bi-pencil-square"></i> view User</a>
    </div>

    <div class="menu-item" onclick="toggleSubmenu('settingsSub')">
      <span><i class="bi bi-gear"></i> Settings</span>
      <i id="arrow-settingsSub" class="bi bi-chevron-right arrow"></i>
    </div>
    <div class="submenu" id="settingsSub">
      <a href="settings.php"><i class="bi bi-sliders"></i> General</a>
      <a href="seo-settings.php"><i class="bi bi-bar-chart-line"></i> SEO</a>
      <a href="backup.php"><i class="bi bi-hdd-stack"></i> Backup</a>
      <a href="media-library.php"><i class="bi bi-image"></i> Media Library</a>
    </div>

    <a class="logout" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
  </div>

 
  <script>
    function toggleSubmenu(id) {
      const submenu = document.getElementById(id);
      const arrow = document.getElementById("arrow-" + id);
      if (submenu.style.display === "block") {
        submenu.style.display = "none";
        arrow.classList.remove("rotate");
      } else {
        submenu.style.display = "block";
        arrow.classList.add("rotate");
      }
    }
  </script>