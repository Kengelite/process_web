  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">
          <li class="nav-heading ">ทรัพย์สินองค์กร ( CP Assets )</li>

          <li class="nav-item">
              <a class="nav-link collapsed" id="index" href="{{route('pageindex')}}">
                  <!-- <i class="bi bi-person"></i> -->
                  <i class="ri-home-line"></i>
                  <span>หน้าแรก</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" id="pagedataforprocess" href="{{route('pageprocess')}}">
                  <i class="ri-file-text-line"></i>
                  <span>กระบวนการ ( Process ) </span>
              </a>
          </li><!-- End F.A.Q Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" id="pagedataforproject" href="{{route('pageproject')}}">
                  <i class="ri-file-list-2-line"></i>
                  <span>โปรเจค ( Project )</span>
              </a>
          </li><!-- End Contact Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" id="pagedataforproduct" href="{{route('pageproduct')}}">
                  <i class="ri-file-list-3-line"></i>
                  <span>ผลิตภัณฑ์ ( Product )</span>
              </a>
          </li><!-- End Register Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" id="pagedataforemployee" href="{{route('pageemployee')}}">
                  <i class="ri-team-line"></i>
                  <span> เจ้าหน้าที่
                      <!-- Login -->
                  </span>
              </a>
          </li><!-- End Login Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" id="pagedataforteacher" href="{{route('pageteacher')}}">
                  <i class="ri-user-3-line"></i>
                  <span>อาจารย์</span>
              </a>
          </li><!-- End Error 404 Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{route('pageout')}}">
                  <!-- <i class="bi bi-box-arrow-in-right"></i> -->
                  <i class="ri-logout-box-r-line"></i>
                  <span>ออกจากระบบ</span>
              </a>
          </li><!-- End Blank Page Nav -->

      </ul>

  </aside><!-- End Sidebar-->

  <script>
document.addEventListener('DOMContentLoaded', function() {
    const pathSegments = window.location.pathname.split('/'); // Split the path by "/"

    // Check the third segment of the path (index starts from 0)
    console.log(pathSegments[1])
    if (pathSegments[1] === '') {
        var element_p3 = document.getElementById('index');
        element_p3.classList.add('active');
        console.log('asdaddsa')
    } else if (pathSegments[1] === 'pagedataforprocess') {
        var element_p2 = document.getElementById('pagedataforprocess');
        element_p2.classList.add('active');
    }else if (pathSegments[1] === 'pagedataforproject') {
        var element_p2 = document.getElementById('pagedataforproject');
        element_p2.classList.add('active');
    }else if (pathSegments[1] === 'pagedataforproduct') {
        var element_p2 = document.getElementById('pagedataforproduct');
        element_p2.classList.add('active');
    }else if (pathSegments[1] === 'pagedataforemployee') {
        var element_p2 = document.getElementById('pagedataforemployee');
        element_p2.classList.add('active');
    }else if (pathSegments[1] === 'pagedataforteacher') {
        var element_p2 = document.getElementById('pagedataforteacher');
        element_p2.classList.add('active');
    }
    

});
  </script>